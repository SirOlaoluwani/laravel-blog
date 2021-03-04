<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientGalleryResource;
use App\Models\Client;
use App\Models\ClientGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Mail\RequestMoreAboutClient;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        // $clients = Client::when($request->name, function ($query) use ($request) {
        //     return $query->where('name', 'like', "%{$request->name}%");
        // })
        // ->when($request->search, function ($query) use ($request) {
        //     return $query->where('name', 'like', "%{$request->search}%")
        //                  ->orWhere('description', 'like', "%{$request->search}%");
        // })
        // ->when($request->order, function ($query) use ($request) {
        //     if ($request->order == 'oldest') {
        //         return $query->oldest();
        //     }

        //     return $query->latest();
        // }, function ($query) {
        //     return $query->latest();
        // })
        // ->when($request->status, function ($query) use ($request) {
        //     if ($query->status == 'published') {
        //         return $query->published();
        //     }

        //     return $query->drafted();
        // })
        // ->with(['gallery'])
        // ->paginate($request->get('limit', 5));


        // return ClientResource::collection($clients);
    }
    
    public function show($id)
    {
        $client = Client::where('slug', $id)->first();
        return $client;
    }
    
    public function showWithGallery($id, $client_uuid)
    {
        $client = Client::where('slug', $id)->where('uuid', $client_uuid)->with(['gallery'])->first();
        return $client;
    }
    
    public function showGallery($client)
    {
        $client = ClientGallery::where('client_id', $client)->whereNot('category', "Portrait Commissions")->take(3);
        return ClientGalleryResource::collection($client);
    }
    
    public function sendRequestMoreDetailsMail(Request $request, $client_uuid)
    {
        try {
            $client = Client::where('uuid', $client_uuid)->first();
            Mail::to($client->email)->send(new RequestMoreAboutClient($client->name, $request));
            return response()->json([
                'result' => 'success'
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}