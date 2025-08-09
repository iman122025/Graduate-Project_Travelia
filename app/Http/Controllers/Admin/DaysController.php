<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DaysController extends Controller
{
    public function index()
    {
        $days = Day::with('tag')->get();

        return view('admin.days.index', compact('days'));
    }

    public function create()
    {
        $tags = Tag::all();

        return view('admin.days.create',compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'activities' => 'required',
            'tag_id' => 'required',
            'image' => 'required|image|max:51200',
        ],
        [
            'title.required' => 'العنوان مطلوب.',
            'location.required' => 'الموقع مطلوب.',
            'activities.required' => 'الأنشطة مطلوبة.',
            'tag_id.required' => 'التاغ مطلوب.',
            'image.required' => 'الصورة مطلوبة.',
        ]);

        if ($request->hasFile('image')) {
            $mainImageName = $request->file('image')->store('days/main', 'public');
        }

        Day::create([
            'title' => $request->title,
            'location' => $request->location,
            'activities' => $request->activities,
            'tag_id' => $request->tag_id,
            'image' => $mainImageName
        ]);

        return redirect()->route('admin.days.index')->with('success', 'تم حفظ اليوم بنجاح!');
    }

    public function edit($id)
    {
        $tags = Tag::all();

        $day = Day::with('tag')->findOrFail($id);

        return view('admin.days.edit', compact('day','tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'activities' => 'required',
            'tag_id' => 'required',
            'image' => 'nullable|image|max:51200',
        ],
        [
            'title.required' => 'العنوان مطلوب.',
            'location.required' => 'الموقع مطلوب.',
            'activities.required' => 'الأنشطة مطلوبة.',
            'tag_id.required' => 'التاغ مطلوب.',
            'image.required' => 'الصورة مطلوبة.',
        ]);

        $day = Day::findOrFail($id);

        if ($request->hasFile('image')) {
            $mainImageName = $request->file('image')->store('days/main', 'public');
            $day->image = $mainImageName;
        }

        $day->update([
            'title' => $request->title,
            'location' => $request->location,
            'activities' => $request->activities,
            'tag_id' => $request->tag_id,
        ]);

        return redirect()->route('admin.days.index')->with('success', 'تم تحديث بيانات اليوم بنجاح!');
    }

    public function destroy($id)
    {
        $days = Day::findOrFail($id);

        $days->delete();

        return redirect()->route('admin.days.index')->with('success', 'تم حذف المدينة بنجاح!');

    }
}
