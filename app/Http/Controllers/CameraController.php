<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class CameraController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $imageData = $request->input('image');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageName = time().'.png';

        \File::put(public_path('images'). '/' . $imageName, base64_decode($imageData));

        return response()->json(['success' => 'Gambar berhasil diunggah!']);
    }
}
