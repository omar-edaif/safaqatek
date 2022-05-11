<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DashbordController extends Controller
{
    public function index()
    {
        return view('dashbord.index');
    }


















    public function upload(Request $request)
    {
        if ($request->load) {
            $file = File::get(public_path($request->load));
            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');
            return $response;
        }

        $folder = 'public/tmp/' . uniqid() . '-' . now()->timestamp;

        foreach (request()->allFiles() as $file) {
            $File = $file->storepublicly($folder);
            return ($folder . '||' . str_replace($folder, '', $File));
        }
        return '';
    }
    public function filedelete(Request $request)
    {
        return Storage::delete(($request->all()));
    }
}
