<?php

namespace App\Http\Controllers\Admin;

use App\ClientPastExhibitions;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientEventRequest;
use App\Http\Requests\ClientPastExhibitionRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientWorkRequest;
use App\Http\Requests\EditClientWorkRequest;
use App\Models\Client;
use App\Models\ClientEvent;
use App\Models\ClientGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ClientWorkController extends Controller
{
    public function index($client_id)
    {
        $gallery = ClientGallery::where("client_id", $client_id)->paginate(10);
        $client = Client::where("id", $client_id)->first();
        return view('admin.clients.works.index', ['gallery' => $gallery, "client" => $client]);
    }

    public function create($client_id)
    {
        return view('admin.clients.works.create', ["client" => $client_id]);
    }

    public function edit($client_id, $id)
    {
        $work = ClientGallery::where('id', $id)->first();
        return view('admin.clients.works.edit', ["work" => $work, "client" => $client_id]);
    }

    public function store(ClientWorkRequest $request, $client_id)
    {
        try {
            $validated = $request->validated();
            $now = Carbon::now();
            
            foreach($validated['client_works'] as $clientIG) {
                $extension = $clientIG['client_image']->extension();
                $imageName = Str::slug($clientIG['title'], '-').$now.".".$extension;
                
                $clientIG['client_image']->storeAs('/public', $imageName);
                
                ClientGallery::create([
                    'client_id' => $client_id, 
                    'image_url' => Storage::url($imageName),
                    'title' => $clientIG['title'],
                    'medium' => $clientIG['medium'],
                    'year_completed' => $clientIG['year_completed'],
                    'category'=> $clientIG['category'],
                    'status' => $clientIG['status'],
                    'visibility' => $clientIG['visibility'],
                ]);
            }
            
            flash()->overlay('Client work created successfully.');
    
            return redirect("/admin/client/works/$client_id");
        } catch(\Exception $e) {
            flash()->overlay($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(EditClientWorkRequest $request, $client_id, $id)
    {
        try {
            $validated = $request->validated();
            
            $gallery = ClientGallery::where("id", $id)->first();
            
            $slug = Str::slug($validated['title'],'-');
            
            if(!empty($validated['client_image'])){
                $now = Carbon::now();
                $extension = $validated['client_image']->extension();
                $imageName = $slug.$now.".".$extension;
                $validated['client_image']->storeAs('/public', $imageName);
                $featuredImageUrl = Storage::url($imageName);
                $validated['image_url'] = $featuredImageUrl;
            }

            $gallery->update([
                'title' => $validated['title'],
                'medium' => $validated['medium'],
                'year_completed' => $validated['year_completed'],
                'category'=> $validated['category'],
                'status' => $validated['status'],
                'visibility' => $validated['visibility'],
                'image_url' => $validated['image_url'] ?? $gallery->image_url
            ]);
    
            flash()->overlay('Client work updated successfully.');
    
            return redirect("/admin/client/works/$client_id");
        } catch(\Exception $e) {
            flash()->overlay($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id) {
        $gallery = ClientGallery::where("id", $id)->first();
        $gallery->delete();
        flash()->overlay('Client Work deleted successfully.');

        return redirect()->back();
    }
}