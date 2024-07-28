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
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $imageData = $request->input('image');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageName = time().'.png';

        \File::put(public_path('images') . '/' . $imageName, base64_decode($imageData));

        // Simpan data lokasi (latitude dan longitude)
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Anda dapat menyimpan lokasi ini ke database jika diperlukan
        // Contoh: Location::create(['latitude' => $latitude, 'longitude' => $longitude]);

        return response()->json(['success' => 'Gambar berhasil diunggah!', 'image' => $imageName, 'latitude' => $latitude, 'longitude' => $longitude]);
    }
}
