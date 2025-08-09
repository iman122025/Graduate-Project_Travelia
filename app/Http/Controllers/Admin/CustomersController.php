<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Hotels;
use App\Models\Feedback;
use App\Models\Hotel_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 2)->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);

        return view('admin.customers.edit', compact('customer'));
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

        $customer = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح!');
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);

        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'تم حذف المستخدم بنجاح!');
    }



    //////////////////// ملاحظات العملاء //////////////////

    public function index_notes() //
    {
        $notes = Feedback::all();

        return view('admin.notes.index', compact('notes'));
    }

}
