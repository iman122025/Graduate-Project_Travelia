<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\Tag;
use App\Models\City;
use App\Models\Plan;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class SiteController extends Controller
{
    public function index()
    {
        $cities = City::all();

        return view('site.index', compact('cities'));
    }

    public function account()
    {
        $customer = Auth::guard('customer')->user();

        $bookings = Booking::with('hotel.city')
            ->where('user_id', $customer->id)
            ->get();

        return view('site.account', compact('bookings'));
    }

    public function aboutus()
    {
        return view('site.aboutus');
    }

    public function city_hotels($id)
    {
        $hotels = Hotel::with('city')->where('city_id', $id)->get();

        return view('site.plan', [
            'filteredHotels' => $hotels
        ]);
    }

    public function planning()
    {
        $cities = City::all();

        return view('site.planning', compact('cities'));
    }

    ////////////

    /* public function plan(Request $request)
    {

        //dd($request->all());

        $from = Carbon::parse($request->from_date);
        $to   = Carbon::parse($request->to_date);

        $days = $from->diffInDays($to);

        session([
            'days' => $days,
        ]);

        session([
            'filter_city' => $request->to_city_id,
            'filter_budget' => $request->budget,
        ]);

        $hotels = Hotel::with('city')
            ->where('city_id', $request->to_city_id);

        if ($request->budget) {
            $hotels->where('price', '<=', $request->budget);
        }

        $filteredHotels = $hotels->get();


        ///////////////////////
        /* $hotels = Hotel::with('city')
            ->when($request->to_city_id, fn($q) => $q->where('city_id', $request->to_city_id))
            ->when($request->budget, fn($q) => $q->where('price', '<=', $request->budget))
            ->get(); */

        ///////////////////////
        /* $filteredHotels = Hotel::with('city')
            ->where('city_id', $request->to_city_id)
            ->when($request->budget, function ($query) use ($request) {
                $query->where('price', '<=', $request->budget);
            })
            ->get(); */

        ///////////////////////
/*
        return view('site.plan', compact('filteredHotels'));
    } */

////////////

    public function plan(Request $request)
{
    // إذا أرسل الطلب تواريخ، احسب الفرق وعدد الأيام وخزنها
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $from = Carbon::parse($request->from_date);
        $to   = Carbon::parse($request->to_date);
        $days = $from->diffInDays($to);
        session(['days' => $days]);
    }

    // جلب قيم الفلترة من الريكوست أو من السيشن إذا لم تكن موجودة في الريكوست
    $cityId = $request->filled('to_city_id') ? $request->to_city_id : session('filter_city');
    $budget = $request->filled('budget') ? $request->budget : session('filter_budget');

    // إذا جاءت بيانات فلترة في الريكوست حدث السيشن بها
    if ($request->filled('to_city_id')) {
        session(['filter_city' => $request->to_city_id]);
    }
    if ($request->filled('budget')) {
        session(['filter_budget' => $request->budget]);
    }

    // بناء الاستعلام بناءً على القيم
    $hotelsQuery = Hotel::with('city');

    if ($cityId) {
        $hotelsQuery->where('city_id', $cityId);
    }

    if ($budget) {
        $hotelsQuery->where('price', '<=', $budget);
    }

    $filteredHotels = $hotelsQuery->get();

    return view('site.plan', compact('filteredHotels'));
}
//////

    public function booking($id) // الحجز المباشر
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $customer = Auth::guard('customer')->user();


        $hotel_id = $id;
        $daysIds = [];

        // return view('site.booking', compact('hotel_id','planIds'));

        // OR

        // طريقة أخرى لارسال المتغيرات للفيو
        return view('site.booking', [
            'hotel_id' => $hotel_id,
            'daysIds' => $daysIds,
        ]);

        ////////////////
    }

    public function save_booking(Request $request)
    {
        // dd($request->all());

        $request->validate([
              'rooms_no' => 'required',
              'adults_no' => 'required',
              'children_no' => 'required',
              'arrival_date' => 'required',
              'departure_date' => 'required',
              'notes' => 'nullable',
          ], [
              'rooms_no.required' => 'عدد الغرف مطلوب.',
              'adults_no.required' => 'عدد البالغين مطلوب.',
              'children_no.required' => 'عدد الاطفال مطلوب.',
              'arrival_date.required' => 'تاريخ المغادرة مطلوب.',
              'departure_date.required' => 'تاريخ الوصول مطلوب.',
          ]);

        if ($request->has('day_id') && is_array($request->day_id) && count($request->day_id) > 0) {
            $type = 2;
            $message = 'تم الحجز مع التخطيط بنجاح';
        } else {
            $type = 1;
            $message = 'تم الحجز بنجاح';
        }


        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
        }

        $booking = Booking::create([
            'hotel_id'       => $request->hotel_id,
            'user_id'        => $customer->id,
            'rooms_no'       => $request->rooms_no,
            'adults_no'      => $request->adults_no,
            'children_no'    => $request->children_no,
            'arrival_date'   => $request->arrival_date,
            'departure_date' => $request->departure_date,
            'notes'          => $request->notes,
            'type'           => $type,
        ]);


        if ($request->has('day_id')) {
            $booking->days()->attach($request->day_id);
        }

        // return redirect('/hotel/' . $booking->hotel_id)->with('success', $message);
        return redirect('/planning')->with('success', $message);

    }


    public function hotel($id)
    {

        $hotel = Hotel::with(['city', 'images'])->findOrFail($id);

        return view('site.hotel', compact('hotel'));

    }

    public function planning_process($id)
    {
        if (!Auth::guard('customer')->check()) {

            return redirect()->back()->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $tags = Tag::all();
        $hotel = Hotel::findOrFail($id);

        return view('site.planning_process', compact('hotel','tags'));
    }

    public function plan_ready(Request $request)
    {
        if (!Auth::guard('customer')->check()) {

            return redirect()->back()->with('error', 'يجب تسجيل الدخول أولاً');
        }

        // $hotel_id= $request->hotel_id;

        $hotel = Hotel::findOrFail($request->hotel_id);
        $selectedTags = $request->input('activities', []);

        if (empty($selectedTags)) {
            return back()->with('error', 'يرجى اختيار نشاط واحد على الأقل.');
        }


        $days = session('days');


        $planDays = collect(); // Larvel collection like array

        $daysPerTag = ceil($days / count($selectedTags)); // عدد الأيام لكل تاج

        foreach ($selectedTags as $tagName) {
            $tagDays = Day::with('tag')
                ->where('city_id', $hotel->city_id) // فقط داخل المدينة التي اختارها
                ->whereHas('tag', function ($query) use ($tagName) {
                    $query->where('name', $tagName);
                })
                ->inRandomOrder()
                ->limit($daysPerTag)
                ->get();

            $planDays = $planDays->merge($tagDays);
        }

        // تأكيد أن العدد النهائي لا يتجاوز العدد المطلوب
        $planDays = $planDays->take($days);

            ///////////////

        return view('site.plan_ready', compact('planDays', 'hotel'));
    }

    public function plan_booking(Request $request) // مع تخطيط
    {
        if (!Auth::guard('customer')->check()) {
            // إذا لم يكن المستخدم مسجل دخول
            return redirect()->back()->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $hotel_id= $request->hotel_id;
        // $hotel = Hotel::findOrFail($request->hotel_id);

        $daysIds = $request->input('days_ids');


        return view('site.booking',compact('daysIds','hotel_id'));
    }

    public function edit_info()
    {

        $customer = Auth::guard('customer')->user();

        return view('profile.edit_info', compact('customer'));
    }

    public function update_customer(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'address' => 'required',
        ],
        [
            'name.required' => 'الاسم كاملا مطلوب.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل.',
            'address.required' => 'العنوان مطلوب.',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        ///////////

        return redirect()->route('site.account')->with('success', 'تم تحديث بيانات المستخدم بنجاح!');

    }

    public function edit_password()
    {
        $customer = Auth::guard('customer')->user();

        return view('profile.edit_password', compact('customer'));
    }

    public function update_password(Request $request)
    {

        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
        ], [
            'currentPassword.required' => 'كلمة المرور الحالية مطلوبة.',
            'newPassword.required' => 'كلمة المرور الجديدة مطلوبة.',
            'newPassword.min' => 'كلمة المرور الجديدة يجب ألا تقل عن 6 أحرف.',
            'newPassword.confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::guard('customer')->user();

        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'كلمة المرور الحالية غير صحيحة.']);
        }

        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        return redirect()->route('site.account')->with('success', 'تم تحديث كلمة المرور بنجاح!');
        ///////////////
    }

    public function feedback_store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ],
        [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'message.required' => 'الملاحظة مطلوبة.',
        ]
    );

        Feedback::create([
            'email' => $request->email,
            'message' => $request->message,
        ]);


        // return redirect()->route('site.home')->with('success', 'تم إرسال الملاحظة بنجاح');

        return redirect()->back()->with('success', 'تم إرسال الملاحظة بنجاح!');


    }


}
