<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded image
        $request->validate([
            'document' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('document');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // 1. Store on MinIO
        $minioPath = $file->storeAs('uploads', $fileName, 'minio');
        $minioUrl = env('MINIO_ENDPOINT') . '/' . env('MINIO_BUCKET') . '/' . $minioPath;

        // 2. Store locally (public disk)
        $localPath = $file->storeAs('uploads', $fileName, 'public');

        // 3. Create thumbnail using Intervention Image
        $thumbnailImage = Image::make($file->getRealPath());
        $thumbnailImage->fit(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        $thumbnailFileName = 'thumb_' . $fileName;
        $thumbnailPath = 'thumbnails/' . $thumbnailFileName;

        // Save thumbnail to local public storage
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());

        return response()->json([
            'minio_path'     => $minioPath,
            'minio_url'      => $minioUrl,
            'local_path'     => $localPath,
            'thumbnail_path' => $thumbnailPath,
        ], 201);
    }
}