<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadTinymceController extends Controller
{

    public function upload_image(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan file ke storage (public disk)
        $path = $request->file('file')->store('tinymce_images', 'public');

        // Kembalikan URL file
        return response()->json([
            'location' => url(Storage::url($path)), // URL file
        ]);
    }

    public function update_image(Request $request)
    {
        $request->validate([
            'old_location' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Hapus file lama
        $urlPath = parse_url($request->old_location, PHP_URL_PATH);
        $relativePath = str_replace('/storage/', '', $urlPath);

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath); // Hapus file lama
        }

        // Simpan file baru
        $path = $request->file('file')->store('tinymce_images', 'public');

        // Kembalikan URL file baru
        return response()->json([
            'new_location' => url(Storage::url($path)),
        ]);
    }

    public function delete_image(Request $request)
    {
        // Menghapus prefix URL untuk mendapatkan path relatif
        $imagePath = str_replace(asset('storage/'), '', $request->image_path);

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'error' => 'File not found.']);
    }
}
