<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User\Photo;

class PhotosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function access($id,$image){

        $path = "photos/{$id}/{$image}";
        if(Storage::exists($path)){
            //valdiacion ruta de foto
            if(Auth::user()->id == $id || Auth::user()->role->key == 'admin' ){
                $response = response()->make(Storage::get($path), 200);
                $response->header("Content-Type", 'image/png');
                return $response;
            }
        }

        abort(404);

    }

}
