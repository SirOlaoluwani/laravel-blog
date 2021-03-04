<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityWorksRequest;
use App\Models\CommunityWorks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class CommunityWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communityWorks = CommunityWorks::paginate(5);

        return view('admin.community-works.index', compact('communityWorks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.community-works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityWorksRequest $request)
    {
        $validated = $request->validate([
            'featured_image' => 'required|image|max:2048'
        ]);
        
        $now = Carbon::now();
        $extension = $validated['featured_image']->extension();
        $imageName = $request->title.$now.".".$extension;
        $validated['featured_image']->storeAs('/public', $imageName);
        $featuredImageUrl = Storage::url($imageName);
        
        $post = CommunityWorks::create([
            'title'       => $request->title,
            'body'        => $request->body,
            'featured_image_url' => $featuredImageUrl
        ]);
        
        flash()->overlay('Community Work created successfully.');

        return redirect('/admin/community-works');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $communityWork = CommunityWorks::where("id", $id)->first();

        return view('admin.community-works.show', compact('communityWork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityWorks $communityWork)
    {
        return view('admin.community-works.edit', compact('communityWork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommunityWorksRequest $request, $id)
    {
        $communityWorks = CommunityWorks::where("id", $id)->first();
        
        $input = [
            'title'       => $request->title,
            'body'        => $request->body,
        ];
        
        if($request->hasFile('featured_image')){
            $now = Carbon::now();
            $extension = $request->featured_image->extension();
            $imageName = $request->title.$now.".".$extension;
            $request->featured_image->storeAs('/public', $imageName);
            $featuredImageUrl = Storage::url($imageName);
            $input['featured_image_url'] = $featuredImageUrl;
        }

        $communityWorks->update($input);

        flash()->overlay('Community Work updated successfully.');

        return redirect('/admin/community-works');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $communityWorks = CommunityWorks::where("id", $id)->first();
        $communityWorks->delete();
        flash()->overlay('Community Work deleted successfully.');

        return redirect('/admin/community-works');
    }

    public function publish(CommunityWorks $communityWorks)
    {
        // dd('communityWorks', $communityWorks->is_published);
        $communityWorks->is_published = $communityWorks->is_published === "0" ? 1: 0;
        $communityWorks->save();
        flash()->overlay('Community Work changed successfully.');

        return redirect('/admin/community-works');
    }
}
