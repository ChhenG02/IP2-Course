<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        // Validate image
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        // Get image
        $image = $request->file('image');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Upload original image to MinIO
        $originalPath = $image->storeAs('uploads', $fileName, 'minio');

        // Generate thumbnail using Intervention Image (GD)
        $thumbnailLocalPath = storage_path('app/thumbnails/' . $fileName);
        Image::make($image->getRealPath())
            ->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($thumbnailLocalPath);

        // Upload thumbnail to MinIO
        Storage::disk('minio')->put('thumbnails/' . $fileName, file_get_contents($thumbnailLocalPath));

        // Delete local copy
        unlink($thumbnailLocalPath);

        return back()->with('success', 'Image and thumbnail uploaded to MinIO.');
    }
}
