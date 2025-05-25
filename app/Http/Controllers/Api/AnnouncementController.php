<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class AnnouncementController extends Controller
{

public function index()
{
    $me = Auth::guard('api')->user();
    $query = Announcement::with('author','category');
    
    if ($me->role_id === 3) {
        // Alumno: ve anuncios de su tutor asignado y de todos los administradores
        $adminUsers = Role::where('id', 1)->first()->users()->pluck('id')->toArray();
        $ids = array_filter(array_merge([$me->tutor_id], $adminUsers));
        $query->whereIn('user_id', $ids);
    } elseif ($me->role_id === 2) {
        // Tutor: ve sus propios anuncios y todos los anuncios de usuarios con rol 1 (administradores)
        $adminUsers = Role::where('id', 1)->first()->users()->pluck('id')->toArray();
        $ids = array_merge([$me->id], $adminUsers);
        $query->whereIn('user_id', $ids);
    }
    // Si es admin (role_id === 1), no añadimos WHERE y cargamos TODOS

    $announcements = $query
        ->orderByDesc('created_at')
        ->get();

    return  AnnouncementResource::collection($announcements);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // validacion
    $request->validate([
        'title'       => 'required|max:255',
        'slug'        => 'nullable|alpha_dash|unique:announcements,slug',
        'content'     => 'required',
        'category_id' => 'required|exists:categories,id',
    ]);

    // 2) Obtener usuario
    $user = Auth::guard('api')->user();

    // 3) Generar slug a partir del título si no viene en la petición
    $slug = $request->input('slug', Str::slug($request->title));

    // 4) Asegurarnos de que el slug sea único
    if (Announcement::where('slug', $slug)->exists()) {
        $slug .= '-' . time();
    }

    // 5) Crear el anuncio INCLUYENDO el user_id
    $announcement = Announcement::create([
        'title'       => $request->title,
        'slug'        => $slug,
        'content'     => $request->content,
        'category_id' => $request->category_id,
        'user_id'     => $user->id,
    ]);

    return response()->json([
        'message' => 'Anuncio creado correctamente',
        'data'    => $announcement,
    ], 201);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $announcements = Announcement::with('category')
            ->included()
            ->findOrFail($id);
        return AnnouncementResource::make($announcements);
    }


    public function update(Request $request, Announcement $announcement)
    {
        //!Regla de validacion
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
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
