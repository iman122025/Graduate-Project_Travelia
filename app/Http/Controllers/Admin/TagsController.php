<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::All();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'image' => 'required|image|max:5120', // 5MB
            ],
            [
                'name.required' => 'اسم التاج مطلوب.',
                'image.required' => 'الصورة مطلوبة.',
                'image.image'    => 'الملف يجب أن يكون صورة.',
                'image.max'      => 'حجم الصورة يجب ألا يتجاوز 5 ميغابايت.',
            ]
        );

        if ($request->hasFile('image')) {
            $mainImageName = $request->file('image')->store('tags', 'public');
        }

        Tag::create([
            'name' => $request->name,
            'image' => $mainImageName
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'تم حفظ التاغ بنجاح!');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
                'name' => 'required',
                'image' => 'nullable|image|max:5120', // 5MB
            ],
            [
                'name.required' => 'اسم التاج مطلوب.',
                'image.required' => 'الصورة مطلوبة.',
                'image.image'    => 'الملف يجب أن يكون صورة.',
                'image.max'      => 'حجم الصورة يجب ألا يتجاوز 5 ميغابايت.',
            ]
        );

        $tag = Tag::findOrFail($id);


        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('image')) {
            $mainImageName = $request->file('image')->store('tags', 'public');
            $data['image'] = $mainImageName;
        }

        $tag->update($data);

        return redirect()->route('admin.tags.index')->with('success', 'تم تحديث بيانات التاغ بنجاح!');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'تم حذف التاغ بنجاح!');
    }

}
