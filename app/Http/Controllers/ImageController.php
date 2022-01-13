<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Image;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
        return view('image.create');
    }

    public function save(Request $request) {

        /**Validacion */
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|file|image'
        ]);

        /**Recogiendo datos */
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        /**Asignar valores al nuevo objeto */
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;/**Relacion en la BD */
        $image->description = $description;

        /**subir el fichero */
        if ($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            /** (nombre del archivo original que sube el usuario, archivo a guardar) */
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name; /** Setear el nombre de la img */
        }

        $image->save();/** Guardar en la BD */
        return redirect()->route('home')->with([
            'message' => 'La foto ha sido subida correctamente'
        ]);
    }

    public function getImage($filename) {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id) {
        $image = Image::find($id);
        return view ('image.detail', [
            'image' => $image
        ]);
    }
}
