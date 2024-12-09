<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        return view('images.show', compact('image'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image = $request->file('image');
        $originalName = $image->getClientOriginalName();
        $storedName = Carbon::now()->format('Y_m_d_H_i_s') . '_' . $originalName;

        if (!Storage::exists('private/ejercicio')) {
            Storage::makeDirectory('private/ejercicio');
        }        

        $path = $image->storeAs('private/ejercicio', $storedName);

        Image::create([
            'original_name' => $originalName,
            'stored_name' => $storedName,
        ]);

        return redirect()->route('images.index');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::delete('private/ejercicio/' . $image->stored_name);
        $image->delete();

        return redirect()->route('images.index');
    }

    public function getImage($storedName)
{
    $path = 'private/ejercicio/' . $storedName;

    // Verifica si el archivo existe
    if (!Storage::exists($path)) {
        abort(404, 'Imagen no encontrada');
    }

    // Obtiene el archivo y su tipo MIME
    $file = Storage::get($path);
    $type = Storage::mimeType($path);

    // Devuelve la imagen con el encabezado correcto
    return response($file)->header('Content-Type', $type);
}

}
