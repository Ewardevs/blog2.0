<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\AskPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("profile", compact("user"));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Asegúrate de obtener el usuario actual

        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|max:6000',
        ]);

        // Si el usuario sube una nueva foto, guardarla y actualizar el campo 'photo'
        if ($request->hasFile('photo')) {
            // Borrar la foto antigua si existe
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Guardar la nueva foto
            $path = $request->file('photo')->store('profiles', 'public');
            $validated['photo'] = $path;
        }

        // Actualizar los datos del usuario
        $user->update(array_filter($validated)); // Actualizamos sin los campos nulos

        // Redirigir a la vista de edición del perfil con un mensaje de éxito
        return redirect()->route('pages.profile.update')->with('success', 'Perfil actualizado correctamente.');
    }

    public function showform()
    {
        return view('permi');
    }

    public function askPermission(Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string|min:15',
            'file'   => 'required|mimes:pdf|max:2000'
        ]);

        // Guardar archivo con un nombre único
        $file = $request->file('file');
        $path = $file->store('pdfs',"public"); // Opcional: Usa `storeAs()` para personalizar el nombre

        if (!$path) {
            return back()->with('error', 'Hubo un problema al subir el archivo.');
        }

        // Crear la solicitud de permiso
        AskPermission::create([
            'file'    => $path,
            'reason'  => $validated['reason'], // Usamos el array validado
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('pages.profile.update')->with('success', 'Solicitud enviada correctamente.');
    }
}
