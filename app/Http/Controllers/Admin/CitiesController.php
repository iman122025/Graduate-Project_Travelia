<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel_image;
use App\Models\Hotels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'season' => 'required|in:الصيف,الشتاء,الربيع,الخريف',
            'image' => 'required|image|max:51200',
        ], [
            'name.required' => 'اسم المدينة مطلوب.',
            'country.required' => 'اسم الدولة مطلوب.',
            'season.required' => 'اسم الموسم مطلوب.',
            'image.required' => 'صورة المدينة مطلوبة.',
            'season.in' => 'الموسم يجب أن يكون أحد الفصول التالية: الصيف، الشتاء، الربيع، أو الخريف.',
        ]);

        if ($request->hasFile('image')) {
            $mainImageName = $request->file('image')->store('cities', 'public');
        }

        City::create([
            'name' => $request->name,
            'country' => $request->country,
            'season' => $request->season,
            'image' => $mainImageName
        ]);

        return redirect()->route('admin.cities.index')->with('success', 'تم حفظ المدينة بنجاح!');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);

        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'season' => 'required|in:الصيف,الشتاء,الربيع,الخريف',
            'image' => 'nullable|image|max:51200',
        ], [
            'season.in' => 'الموسم يجب أن يكون أحد الفصول التالية: الصيف، الشتاء، الربيع، أو الخريف.',
        ]);


        $city = City::findOrFail($id);

        $data = [
            'name'    => $request->name,
            'country' => $request->country,
            'season'  => $request->season,
        ];

        if ($request->hasFile('image')) {
            $mainImageName = $request->file('image')->store('cities', 'public');
            $data['image'] = $mainImageName;
        }

        $city->update($data);

        return redirect()->route('admin.cities.index')->with('success', 'تم تحديث بيانات المدينة بنجاح!');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $city->delete();

        return redirect()->route('admin.cities.index')->with('success', 'تم حذف المدينة بنجاح!');
    }

}
