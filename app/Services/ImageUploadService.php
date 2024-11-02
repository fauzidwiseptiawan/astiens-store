<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class ImageUploadService
{
    /**
     * Upload dan resize gambar
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $pathResize
     * @param string $pathResize
     * @param int $width
     * @param int $heigh
     * @param string $id
     * @return array Berisi nama file, ukuran, dan ekstensi
     */
    public function uploadAndResize(UploadedFile $file, string $path, string $pathResize, int $width = 300, int $height = 300, int $quality = 75, ?string $id = null)
    {
        // Membangun nama file
        $fileName = ($id ? $id . '_' : '') . time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.webp';

        // Menyimpan file asli
        $file->storeAs($path, $fileName, 'public');

        // Mengambil ukuran dan ekstensi file
        $fileSize = $file->getSize();
        $fileExtension = $file->extension();

        // Resize gambar
        $manager = new ImageManager(new Driver());
        $resizeImg = $manager->read($file);
        $resizeImg->resize($width, $height); // Meresize gambar
        // Mengatur path dan nama file untuk penyimpanan
        $fullPathResize = storage_path("app/public/{$pathResize}");

        // Memastikan direktori untuk menyimpan gambar sudah ada
        if (!File::exists($fullPathResize)) {
            File::makeDirectory($fullPathResize, 0755, true); // Membuat direktori jika belum ada
        }

        // Menyimpan gambar yang telah diubah ukurannya
        $resizeImg->save("{$fullPathResize}/{$fileName}", $quality);

        // Mengembalikan nama file, ukuran, dan ekstensi dalam bentuk array
        return [
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'file_extension' => $fileExtension
        ];
    }
}
