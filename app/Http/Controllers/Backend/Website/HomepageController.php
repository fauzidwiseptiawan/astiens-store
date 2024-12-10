<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\SliderGroups;
use App\Models\SliderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomepageController extends Controller
{
    public function index()
    {
        $sliderGroups = SliderGroups::with('sliderItems')->orderBy('order', 'asc')->get();
        return view('backend.homepage.index', compact('sliderGroups'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:slider_groups,id', // ID grup slider
            'slider_items' => 'required|array', // Array slider items
            'slider_items.*.id' => 'nullable|exists:slider_items,id', // ID slider item, jika ada
            'slider_items.*.title_h4' => 'nullable|string|max:255',
            'slider_items.*.subtitle_h2' => 'nullable|string|max:255',
            'slider_items.*.main_heading_h1' => 'required|string|max:255',
            'slider_items.*.description_p' => 'required|string',
            'slider_items.*.link_url' => 'required|string',
            // 'slider_items.*.image' => 'nullable|image|max:2048',
        ], [
            'group_id.required' => 'The slider group ID is required.',
            'group_id.exists' => 'The selected slider group ID is invalid.',
            'slider_items.required' => 'Slider items are required.',
            'slider_items.array' => 'Slider items must be an array.',
            'slider_items.*.id.exists' => 'The slider item ID is not found.',
            'slider_items.*.title_h4.string' => 'The title (H4) must be a string.',
            'slider_items.*.title_h4.max' => 'The title (H4) cannot exceed 255 characters.',
            'slider_items.*.subtitle_h2.string' => 'The subtitle (H2) must be a string.',
            'slider_items.*.subtitle_h2.max' => 'The subtitle (H2) cannot exceed 255 characters.',
            'slider_items.*.main_heading_h1.required' => 'The main heading (H1) is required.',
            'slider_items.*.main_heading_h1.string' => 'The main heading (H1) must be a string.',
            'slider_items.*.main_heading_h1.max' => 'The main heading (H1) cannot exceed 255 characters.',
            'slider_items.*.description_p.required' => 'The description (P) is required.',
            'slider_items.*.description_p.string' => 'The description (P) must be a string.',
            'slider_items.*.link_url.required' => 'The link URL is required.',
            'slider_items.*.link_url.string' => 'The link URL must be a string.',
            // 'slider_items.*.image.image' => 'The uploaded file must be an image.',
            // 'slider_items.*.image.max' => 'The image size cannot exceed 2MB.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status'   => 400,
                'message'  => $validator->errors()->toArray()
            ]);
        }

        $validatedData = $validator->validated();

        // Loop untuk memproses setiap slider item
        foreach ($validatedData['slider_items'] as $item) {
            // Jika id tidak kosong, update atau create
            if (empty($item['id'])) {
                // Periksa duplikasi berdasarkan title_h4 dan group_id
                $existingItem = SliderItems::where('slider_groups_id', $validatedData['group_id'])
                    ->where('title_h4', $item['title_h4'])
                    ->where('main_heading_h1', $item['main_heading_h1'])
                    ->where('description_p', $item['description_p'])
                    ->first();

                if (!$existingItem) {
                    // Tambahkan data baru jika tidak ada yang sama
                    SliderItems::create([
                        'slider_groups_id' => $validatedData['group_id'],
                        'title_h4' => $item['title_h4'],
                        'subtitle_h2' => $item['subtitle_h2'],
                        'main_heading_h1' => $item['main_heading_h1'],
                        'description_p' => $item['description_p'],
                        'link_url' => $item['link_url'],
                        // 'image' => isset($item['image']) ? $item['image']->store('slider-images') : null,
                    ]);
                }
            } else {
                // Jika ID ada, perbarui data berdasarkan ID
                SliderItems::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'slider_groups_id' => $validatedData['group_id'],
                        'title_h4' => $item['title_h4'],
                        'subtitle_h2' => $item['subtitle_h2'],
                        'main_heading_h1' => $item['main_heading_h1'],
                        'description_p' => $item['description_p'],
                        'link_url' => $item['link_url'],
                        // 'image' => isset($item['image']) ? $item['image']->store('slider-images') : null,
                    ]
                );
            }
        }

        return response()->json([
            'status'   => 200,
            'message'  => 'Adding data was successful!'
        ]);
    }

    public function destroy($id)
    {
        $sliderItem = SliderItems::find($id);

        if ($sliderItem) {
            $sliderItem->delete();
            return response()->json([
                'status'   => 200,
                'message'  => 'Successfully deleted data!'
            ]);
        } else {
            return response()->json([
                'status'   => 404,
                'message'  => 'Error deleted data!'
            ]);
        }
    }
}
