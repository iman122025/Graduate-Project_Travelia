<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Employee;
use App\Models\Cities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminsController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 1)->get();

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
            'password' => 'required|min:6',
        ],
        [
            'name.required' => 'الاسم كاملا مطلوب.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل.',
            'address.required' => 'العنوان مطلوب.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 6 أحرف.',
        ]
    );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 1,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'تم حفظ المشرف بنجاح!');
    }

    public function edit($id)

    {
        $admin = User::findOrFail($id);

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'address' => 'required',
            'password' => 'nullable|min:6',
        ],
        [
            'name.required' => 'الاسم كاملا مطلوب.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل.',
            'address.required' => 'العنوان مطلوب.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 6 أحرف.',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
        ]
    );

        $admin = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'تم تحديث بيانات المشرف بنجاح!');

    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'تم حذف المشرف بنجاح!');
    }


}
