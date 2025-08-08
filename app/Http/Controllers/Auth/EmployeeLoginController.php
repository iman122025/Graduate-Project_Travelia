<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmployeeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.employee_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            //return redirect()->route('employee.dashboard');
            return redirect('/');
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();      // تسجيل الخروج
        $request->session()->invalidate();      // إلغاء الجلسة
        $request->session()->regenerateToken(); // حماية CSRF

        return redirect('/'); // إعادة التوجيه للصفحة الرئيسية مثلاً
    }

}
