<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\ClientGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        try {
            $validated = $request->validated();
            // dd($validated);
            $now = Carbon::now();
            $extension = $validated['client_image']->extension();
            $imageName = Str::slug($validated['name'], '-').$now.".".$extension;
            $validated['client_image']->storeAs('/public', $imageName);
            $featuredImageUrl = Storage::url($imageName);
            
            $client = Client::create([
                'name'       => $validated['name'],
                'description'        => $validated['description'],
                'client_image_url' => $featuredImageUrl,
                'uuid' => Uuid::uuid4(),
                'slug' => Str::slug($validated['name'], '.'),
            ]);
            
            if(!empty($validated['client_works'])) {
                foreach($validated['client_works'] as $clientIG) {
                    $extension = $clientIG['client_image']->extension();
                    $imageName = Str::slug($clientIG['title'], '-').$now.".".$extension;
                    
                    $clientIG['client_image']->storeAs('/public', $imageName);
                    
                    ClientGallery::create([
                        'client_id' => $client->id, 
                        'image_url' => Storage::url($imageName),
                        'title' => $clientIG['title'],
                        'medium' => $clientIG['medium'],
                        'year_completed' => $clientIG['year_completed'],
                        'category'=> $clientIG['category']
                    ]);
                }
            }
            
            flash()->overlay('Client created successfully.');
    
            return redirect('/admin/clients');
        } catch(\Exception $e) {
            flash()->overlay($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $client = Client::where("id", $id)->first();

        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where('id', $id)->with(['gallery'])->first();
        return view('admin.clients.edit', compact('client'));
    }
    
    public function works($id)
    {
        $client = Client::where('id', $id)->with(['gallery'])->first();
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        dd($request->all());
        try {
            $validated = $request->validated();
            
            $client = Client::where("id", $id)->first();
            
            $input = [
                'name' => $validated['name'],
                'description' => $validated['description'],
            ];
            
            $slug = Str::slug($validated['name'],'-');
            
            if($request->hasFile('client_image')){
                $now = Carbon::now();
                $extension = $validated['client_image']->extension();
                $imageName = $slug.$now.".".$extension;
                $validated['client_image']->storeAs('/public', $imageName);
                $featuredImageUrl = Storage::url($imageName);
                $input['client_image_url'] = $featuredImageUrl;
            }
            
            if(!empty($validated['client_works'])) {
                foreach($validated['client_works'] as $clientIG) {
                    $now = Carbon::now();
                    $extension = $clientIG['client_image']->extension();
                    $imageName = Str::slug($clientIG['title'], '-').$now.".".$extension;
                    
                    $clientIG['client_image']->storeAs('/public', $imageName);
                    
                    ClientGallery::create([
                        'client_id' => $client->id, 
                        'image_url' => Storage::url($imageName),
                        'title' => $clientIG['title'],
                        'medium' => $clientIG['medium'],
                        'year_completed' => $clientIG['year_completed'],
                        'category'=> $clientIG['category'],
                    ]);
                }
            }
    
            $client->update($input);
    
            flash()->overlay('Client updated successfully.');
    
            return redirect('/admin/clients');
        } catch(\Exception $e) {
            flash()->overlay($e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    public function generateClientLink(Request $request) {
        
        try {
            $id = $request->client;
            
            $client = Client::where("id", $id)->first();
            
            $client->update([
                'expiry_date' => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 2, date('Y'))),
            ]);
    
            flash()->overlay("Client link - <a href='https://www.bdicofficial.com/clients/$client->slug/$client->uuid/full-info'>https://www.bdicofficial.com/clients/$client->slug/$client->uuid/full-info</a>.");
    
            return redirect('/admin/clients');
        } catch(\Exception $e) {
            flash()->overlay($e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    public function deleteGallery(Request $request) {
        $gallery = ClientGallery::where("id", $request->gallery)->first();
        $gallery->delete();
        flash()->overlay('Client Work deleted successfully.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $communityWorks = Client::where("id", $id)->first();
        $communityWorks->delete();
        flash()->overlay('Client deleted successfully.');

        return redirect('/admin/clients');
    }

    public function publish(Client $client)
    {
        // dd('communityWorks', $communityWorks->is_published);
        $client->is_published = $client->is_published === "0" ? 1: 0;
        $client->save();
        flash()->overlay('Client changed successfully.');

        return redirect('/admin/clients');
    }
}
