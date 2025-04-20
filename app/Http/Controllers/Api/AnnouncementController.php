<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;





class AnnouncementController extends Controller
{

    public function index()
    {
        $announcements = Announcement::included()->fitter()
            ->sort()
            ->getOrPaginate();
        return AnnouncementResource::collection($announcements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //!Regla de validacion
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:announcements',
            'urgent' => 'boolean',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = Auth::guard('api')->user();
        $data['user_id'] = $user->id;

        $announcements = Announcement::create($data);
        return AnnouncementResource::make($announcements);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $announcements = Announcement::included()->findOrFail($id);
        return AnnouncementResource::make($announcements);
    }


    public function update(Request $request, Announcement $announcement)
    {
        //!Regla de validacion
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:announcements,slug,' . $announcement->id,
            'urgent' => 'boolean',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $announcement->update($request->all());
        return AnnouncementResource::make($announcement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return AnnouncementResource::make($announcement);
    }
}
