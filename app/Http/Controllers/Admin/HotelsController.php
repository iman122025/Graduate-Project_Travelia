<?php

namespace App\Http\Controllers\admin;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Image;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelsController extends Controller
{
    public function index()
    {

        $hotels = Hotel::with('city')->get();

        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $cities = City::all();

        return view('admin.hotels.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'star_no' => 'required|integer|between:1,5',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'main_image' => 'required|image',
            'images.*' => 'image'
        ],
        [
            'name.required' => 'اسم الفندق مطلوب.',
            'city_id.required' => 'المدينة مطلوبة.',
            'star_no.required' => 'عدد النجوم مطلوب.',
            'star_no.between' => 'عدد النجوم يجب أن يكون بين 1 و 5.',
            'description.required' => 'مرافق الفندق أو الوصف مطلوب.',
            'price.required' => 'السعر مطلوب.',
            'main_image.required' => 'الصورة الرئيسية مطلوبة.',
        ]
    );

        if ($request->hasFile('main_image')) {
            $mainImageName = $request->file('main_image')->store('hotels/main', 'public');
        }

        $hotel = Hotel::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'star_no' => $request->star_no,
            'description' => $request->description,
            'price' => $request->price,
            'main_image' => $mainImageName
        ]);

       if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $image) {
                $path = $image->store('hotels/gallery', 'public');

                $hotel->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        return redirect()->route('admin.hotels.index')->with('success', 'تم حفظ الفندق مع الصور بنجاح!');
    }

    public function edit($id)
    {

        $cities = City::all();

        $hotel = Hotel::with('city', 'images')->findOrFail($id); // فندق مع المدينة والصور التابعة له

        return view('admin.hotels.edit', compact('cities', 'hotel'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'star_no' => 'required|integer|between:1,5',
            'description' => 'required',
            'price' => 'required|numeric|min:0.01',
            'main_image' => 'nullable',
            'images.*' => 'image'
        ],
        [
            'name.required' => 'اسم الفندق مطلوب.',
            'city_id.required' => 'المدينة مطلوبة.',
            'star_no.required' => 'عدد النجوم مطلوب.',
            'star_no.between' => 'عدد النجوم يجب أن يكون بين 1 و 5.',
            'description.required' => 'مرافق الفندق أو الوصف مطلوب.',
            'price.required' => 'السعر مطلوب.',
            'main_image.required' => 'الصورة الرئيسية مطلوبة.',
        ]
    );

        $hotel = Hotel::findOrFail($id);

        if ($request->hasFile('main_image')) {
            $mainImageName = $request->file('main_image')->store('hotels/main', 'public');
            $hotel->main_image = $mainImageName;
        }

        $hotel->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'star_no' => $request->star_no,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $image) {
                $path = $image->store('hotels/gallery', 'public');

                $hotel->images()->create([ // يضيف إلى الصور الموجودة في المعرض، واذا اردنا حذف البعض يوجد خيار حذف منها
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.hotels.index')->with('success', 'تم تحديث بيانات الفندق بنجاح!');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();

        return redirect()->route('admin.hotels.index')->with('success', 'تم حذف الفندق بنجاح!');
    }

    ///////////////// حذف بعض الصور من المعرض ///////////////

    public function deleteImage($id)
    {
        $image = Image::findOrFail($id);

        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->back()->with('success', 'تم حذف الصورة بنجاح');
    }

}
