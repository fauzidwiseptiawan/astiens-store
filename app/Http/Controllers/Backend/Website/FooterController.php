<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        // Mendapatkan semua footer
        $footer = Footer::first();
        return view('backend.website.footer.index', compact('footer'));
    }

    public function store(Request $request)
    {
        // Validasi langsung pada input request
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:footers,id',
            'email'         => 'required',
            'phone'         => 'required',
            'address'         => 'required',
            'show_link'         => 'required',
            'facebook'         => 'required',
            'twitter'         => 'required',
            'instagram'         => 'required',
            'youtube'         => 'required',
            'pinterest'         => 'required',
            'show_store'         => 'required',
            'app_store'         => 'required',
            'play_store'         => 'required',
            'image1' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'link_menu' => 'required|json', // Validasi link_menu harus JSON
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->toArray(),
            ]);
        }

        // Decode JSON setelah validasi berhasil
        $linkMenuArray = json_decode($request->input('link_menu'), true);

        // Validasi array hasil decode (title & link_menu detail validation)
        $detailValidator = Validator::make([
            'link_menu' => $linkMenuArray
        ], [
            'link_menu' => 'required|array',
            'link_menu.*.title' => 'required|string',
            'link_menu.*.url' => 'required|string',
        ]);

        if ($detailValidator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $detailValidator->errors()->toArray(),
            ]);
        }


        // Lanjutkan dengan proses penyimpanan
        $encodedNavMenu = json_encode($linkMenuArray, JSON_UNESCAPED_UNICODE);

        // Cek jika ID dikirim, artinya update
        $footer = null;
        if ($request->input('id')) {
            $footer = Footer::find($request->input('id')); // Ambil data lama
        }

        // Proses penyimpanan gambar
        $fileInfo1 = null;
        $fileInfo2 = null;
        if ($request->hasFile('image1')) {
            // Hapus gambar lama untuk image1 jika ada
            if ($footer && $footer->image1) {
                $path_exist = 'storage/upload/image/footer/' . $footer->image1;
                $path_resize_exist = 'storage/upload/image/footer/thumbnail/' . $footer->image1;

                if (File::exists($path_exist)) {
                    File::delete($path_exist);
                    File::delete($path_resize_exist);
                }
            }

            // Upload gambar baru untuk image1
            $path = 'upload/image/footer';
            $pathResize = 'upload/image/footer/thumbnail';
            $fileInfo1 = $this->imageUploadService->uploadAndResize(
                $request->file('image1'),
                $path,
                $pathResize
            );
        }

        if ($request->hasFile('image2')) {
            // Hapus gambar lama untuk image2 jika ada
            if ($footer && $footer->image2) {
                $path_exist = 'storage/upload/image/footer/' . $footer->image2;
                $path_resize_exist = 'storage/upload/image/footer/thumbnail/' . $footer->image2;

                if (File::exists($path_exist)) {
                    File::delete($path_exist);
                    File::delete($path_resize_exist);
                }
            }

            // Upload gambar baru untuk image2
            $path = 'upload/image/footer';
            $pathResize = 'upload/image/footer/thumbnail';
            $fileInfo2 = $this->imageUploadService->uploadAndResize(
                $request->file('image2'),
                $path,
                $pathResize
            );
        }
        // Update atau buat baru data footer
        Footer::updateOrCreate(
            ['id' => $request->input('id')], // Cari berdasarkan ID
            [
                'address' => $request->address,
                'phone' => $request->phone,
                'show_link' => $request->show_link,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'pinterest' => $request->pinterest,
                'show_store' => $request->show_store,
                'app_store' => $request->app_store,
                'play_store' => $request->play_store,
                'image1' => $fileInfo1['file_name'] ?? ($footer->image1 ?? null), // Gunakan gambar lama jika tidak ada yang baru
                'image2' => $fileInfo2['file_name'] ?? ($footer->image2 ?? null),
                'ext1' => $fileInfo1['file_extension'] ?? ($footer->ext1 ?? null),
                'ext2' => $fileInfo2['file_extension'] ?? ($footer->ext2 ?? null),
                'size1' => $fileInfo1['file_size'] ?? ($footer->size1 ?? null),
                'size2' => $fileInfo2['file_size'] ?? ($footer->size2 ?? null),
                'link_menu' => $encodedNavMenu,
            ]
        );

        return response()->json([
            'status' => 200,
            'message' => 'Save data was successful!',
        ]);
    }
}
