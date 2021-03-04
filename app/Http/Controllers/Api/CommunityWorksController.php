<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityWorksResource;
use App\Models\CommunityWorks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommunityWorksController extends Controller
{
    public function index(Request $request)
    {
        $communityWorks = CommunityWorks::when($request->title, function ($query) use ($request) {
            return $query->where('title', 'like', "%{$request->title}%");
        })
        ->when($request->search, function ($query) use ($request) {
            return $query->where('title', 'like', "%{$request->search}%")
                         ->orWhere('body', 'like', "%{$request->search}%");
        })
        ->when($request->order, function ($query) use ($request) {
            if ($request->order == 'oldest') {
                return $query->oldest();
            }

            return $query->latest();
        }, function ($query) {
            return $query->latest();
        })
        ->when($request->status, function ($query) use ($request) {
            if ($query->status == 'published') {
                return $query->published();
            }

            return $query->drafted();
        })
        ->paginate($request->get('limit', 5));

        return CommunityWorksResource::collection($communityWorks);
    }
    
    public function show($id)
    {
        
        $communityWorks = CommunityWorks::where('id', $id)->first();

        return new CommunityWorksResource($communityWorks);
    }
}
