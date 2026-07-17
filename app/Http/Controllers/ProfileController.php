<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Mostrar la página de configuración.
     */
    public function settings()
    {
        return response()
            ->view('profile.settings')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Actualizar el nombre de usuario.
     */
    public function updateSettings(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'username' => [
                'nullable',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-zA-Z0-9._-]+$/',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
        ], [
            'username.min' => 'El nombre de usuario debe contener al menos 3 caracteres.',
            'username.max' => 'El nombre de usuario no puede superar los 30 caracteres.',
            'username.regex' => 'Solo puedes usar letras, números, puntos, guiones y guiones bajos.',
            'username.unique' => 'Ese nombre de usuario ya está ocupado.',
        ]);

        $username = trim((string) $request->username);

        $user->username = $username !== ''
            ? $username
            : null;

        $user->save();

        return redirect()
            ->route('profile.settings')
            ->with('success', 'El nombre de usuario fue actualizado correctamente.');
    }

    // Informacion del perfil
    public function profile()
    {
        $user = Auth::user();

        // Temas visibles
        $publicaciones = DB::table('foro')
            ->where('id_usuario', $user->id)
            ->where('visible', 1)
            ->count();

        // Comentarios escritos
        $comentarios = DB::table('comentarios')
            ->where('id_usuario', $user->id)
            ->count();

        // Likes recibidos
        $meGustaRecibidos = DB::table('likes')
            ->join('foro', 'likes.id_foro', '=', 'foro.id_foro')
            ->where('foro.id_usuario', $user->id)
            ->where('foro.visible', 1)
            ->count();

        return response()
            ->view('profile.profile', compact(
                'publicaciones',
                'comentarios',
                'meGustaRecibidos'
            ))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}