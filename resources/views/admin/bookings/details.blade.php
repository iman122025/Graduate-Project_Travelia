@extends('admin.layouts.content_main')

@section('content')
    <style type="text/css">
        th{text-align: right !important;}
    </style>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">تفاصيل الحجز</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">الصفحة الرئيسية</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">تفاصيل الحجز</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center py-1">
                    <!--begin::Wrapper-->
                    <div class="me-4">
                        <!--begin::Menu-->


                        <!--end::Menu-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Button-->
                    <a href="{{route('admin.bookings.index')}}" class="btn btn-sm btn-primary">قائمة الحجوزات</a>
                    <!--end::Button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-12 me-xl-12">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-12">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success text-center">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!--begin::Form-->

                                    <!--end::Separator-->
                                    <!--begin::Wrapper-->

                                    <div class="mb-0">
                                        <!--begin::Row-->
                                        <div class="row gx-10 mb-5">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">اسم العميل: </label>
                                                    {{$booking->user->name}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">البريد الالكتروني: </label>
                                                    {{$booking->user->email}}
                                                </div>
                                                <div class="mb-5 border-bottom pb-3">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">رقم الهاتف: </label>
                                                    {{$booking->user->phone}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">نوع الحجز: </label>
                                                    @if ($booking->type == 1)
                                                        <span class="badge badge-success">مباشر</span></a>
                                                    @else
                                                        <span class="badge badge-danger">مع تخطيط</span></a>
                                                    @endif
                                                </div>
                                                <div class="mb-5 border-bottom pb-3">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">تاريخ الحجز: </label>
                                                    {{$booking->created_at}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">الفندق:</label>
                                                    {{$booking->hotel->name}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">عدد الغرف:</label>
                                                    {{$booking->rooms_no}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">عدد البالغين:</label>
                                                    {{$booking->adults_no}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">عدد الاطفال:</label>
                                                    {{$booking->children_no}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">تاريخ المغادرة:</label>
                                                    {{$booking->arrival_date}}
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">تاريخ الوصول:</label>
                                                    {{$booking->departure_date}}
                                                </div>
                                                <div class="mb-5 border-bottom pb-3">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">الملاحظات:</label>
                                                    {{$booking->notes}}
                                                </div>

                                                <!--end::Input group-->
                                                <!--begin::Input group-->

                                                <!--end::Input group-->
                                            </div>

                                            @if($booking->days->isNotEmpty())

                                            <h4 class="text-gray-700">مخطط الأيام:</h4>

                                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                                                        <th class="min-w-40px">#</th>
                                                        <th class="min-w-100px">العنوان</th>
                                                        <th class="min-w-100px">الموقع</th>
                                                        <th class="min-w-100px">الأنشطة</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                    </thead>
                                                    <!--end::Table head-->
                                                    <!--begin::Table body-->
                                                    <tbody class="fw-bold text-gray-600">
                                                    @foreach ($booking->days as $day)
                                                        <tr>
                                                            <!--begin::Checkbox-->
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>

                                                            <td>
                                                                {{$day->title}}
                                                            </td>
                                                            <!--end::Email=-->
                                                            <!--begin::Company=-->
                                                            <td>{{$day->location}}</td>
                                                            <!--end::Company=-->

                                                            <td>{{$day->activities}}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>

                                            @endif

                                            <!--end::Col-->
                                            <!--begin::Col-->

                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Table wrapper-->

                                        <!--end::Table-->
                                        <!--begin::Item template-->


                                        <!--end::Notes-->
                                    </div>

                                    <!--end::Wrapper-->

                                <!--end::Form-->
                            </div>



                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->

                </div>
                <!--end::Layout-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

