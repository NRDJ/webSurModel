<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Event\Event;
use App\Models\Event\Publication;
use App\Models\Location\Region;
use App\Models\User\Person;

use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use Image;

class FileAccessController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except' => ['imageSponsor','imageEvent','temporalAccessPhoto']]);
    }
    
    public function accessHonoraryTicket($id_publication,$id_person,$image){

        $path = "invoices/{$id_publication}/{$id_person}/{$image}";
        $extension = pathinfo($image,PATHINFO_EXTENSION);

        if(Auth::user()->id == $id_person || Auth::user()->role->key == 'admin'){
            if($extension == 'pdf'){
                $storagePath = storage_path('app/'.$path);
                if (file_exists($storagePath)) {
                    $headers = [
                        'Content-Type' => 'application/pdf'
                    ];
                    return response()->download($storagePath, 'Boleta', $headers, 'inline');
                } else {
                    abort(404, 'File not found!');
                }
            }
            elseif ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $storagePath = storage_path('app/'.$path);
                return Image::make($storagePath)->response();
                // $storagePath = storage_path('app/'.$path);

                // $response = response()->make(Storage::get($path), 200);
                // $response->header("Content-Type", 'image/png');
                // return $response;

                // return Image::make($storagePath)->response();
            }
        }

        abort(404);
    }

    public function accessVoucher($id_publication,$id_person,$image){
        $path = "vouchers/{$id_publication}/{$id_person}/{$image}";
        $extension = pathinfo($image,PATHINFO_EXTENSION);

        if(Auth::user()->id == $id_person || Auth::user()->role->key == 'admin'){
            if($extension == 'pdf'){
                $storagePath = storage_path('app/'.$path);
                if (file_exists($storagePath)) {
                    $headers = [
                        'Content-Type' => 'application/pdf'
                    ];
                    return response()->download($storagePath, 'Boleta', $headers, 'inline');
                } else {
                    abort(404, 'File not found!');
                }
            }
            elseif ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $storagePath = storage_path('app/'.$path);
                return Image::make($storagePath)->response();
                // return Image::make($storagePath)->response();
                // $storagePath = storage_path('app/'.$path);

                // $response = response()->make(Storage::get($path), 200);
                // $response->header("Content-Type", 'image/png');
                // return $response;

                // return Image::make($storagePath)->response();
            }
        }

        abort(404);
    }

    public function imageSponsor($image){
        $path = "sponsors/{$image}";

        $storagePath = storage_path('app/'.$path);
        return Image::make($storagePath)->response();

    }

    public function imageEvent($image){
        $path = "events/{$image}";

        $storagePath = storage_path('app/'.$path);
        return Image::make($storagePath)->response();

    }

    public function temporalAccessPhoto(Request $request,$id,$image){
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        $path = "photos/{$id}/{$image}";
        if(Storage::exists($path)){
            //valdiacion ruta de foto
            $response = response()->make(Storage::get($path), 200);
            $response->header("Content-Type", 'image/png');
            return $response;
        }

        abort(404);

    }
}
