<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        // Mendapatkan semua header
        $headers = Header::first();

        return view('backend.website.header.index', compact('headers'));
    }

    public function store(Request $request)
    {
        // Validasi langsung pada input request
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:headers,id',
            'image' => 'nullable|image|max:2048',
            'title' => 'required|json', // Validasi title harus JSON
            'nav_menu' => 'required|json', // Validasi nav_menu harus JSON
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->toArray(),
            ]);
        }

        // Decode JSON setelah validasi berhasil
        $titleArray = json_decode($request->input('title'), true);
        $navMenuArray = json_decode($request->input('nav_menu'), true);

        // Validasi array hasil decode (title & nav_menu detail validation)
        $detailValidator = Validator::make([
            'title' => $titleArray,
            'nav_menu' => $navMenuArray
        ], [
            'title' => 'required|array',
            'title.*.title' => 'required|string',
            'nav_menu' => 'required|array',
            'nav_menu.*.name' => 'required|string',
            'nav_menu.*.url' => 'required|string',
        ]);

        if ($detailValidator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $detailValidator->errors()->toArray(),
            ]);
        }


        // Lanjutkan dengan proses penyimpanan
        $encodedTitlePromo = json_encode($titleArray, JSON_UNESCAPED_UNICODE);
        $encodedNavMenu = json_encode($navMenuArray, JSON_UNESCAPED_UNICODE);

        // Cek jika ID dikirim, artinya update
        $header = null;
        if ($request->input('id')) {
            $header = Header::find($request->input('id')); // Ambil data lama
        }

        // Proses penyimpanan gambar
        $fileInfo = null;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($header && $header->image) {
                $path_exist = 'storage/upload/image/header/' . $header->image;
                $path_resize_exist = 'storage/upload/image/header/thumbnail/' . $header->image;

                // Menghapus file gambar yang ada jika ada
                if (File::exists($path_exist)) {
                    File::delete($path_exist);
                    File::delete($path_resize_exist);
                }
            }

            // Upload gambar baru
            $path = 'upload/image/header';
            $pathResize = 'upload/image/header/thumbnail';
            $fileInfo = $this->imageUploadService->uploadAndResize(
                $request->file('image'),
                $path,
                $pathResize
            );
        }

        // Update atau buat baru data header
        Header::updateOrCreate(
            ['id' => $request->input('id')], // Cari berdasarkan ID
            [
                'title_promo' => $encodedTitlePromo,
                'image' => $fileInfo['file_name'] ?? ($header->image ?? null), // Gunakan gambar lama jika tidak ada yang baru
                'ext' => $fileInfo['file_extension'] ?? ($header->ext ?? null),
                'size' => $fileInfo['file_size'] ?? ($header->size ?? null),
                'nav_menu' => $encodedNavMenu,
            ]
        );

        return response()->json([
            'status' => 200,
            'message' => 'Save data was successful!',
        ]);
    }
}
