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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">قائمة الحجوزات</h1>
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
                        <li class="breadcrumb-item text-muted">الحجوزات</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">قائمة الحجوزات</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->

                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->

                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">

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

                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                                <th class="min-w-20px">#</th>
                                <th class="min-w-80px">اسم العميل</th>
                                <th class="min-w-100px">الفندق</th>
                                <th class="min-w-100px">المدينة/الدولة</th>
                                <th class="min-w-90px">تاريخ الحجز</th>
                                <th class="min-w-90px">عدد الغرف</th>
                                <th class="min-w-90px">عدد البالغين</th>
                                <th class="min-w-90px">عدد الاطفال</th>
                                <th class="min-w-90px">تاريخ الوصول</th>
                                <th class="min-w-90px">تاريخ المغادرة</th>
                                <th class="min-w-160px">نوع الحجز</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                           @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{$booking->user->name}}
                                </td>
                                <td>
                                    {{$booking->hotel->name}}
                                </td>
                                <td>
                                    {{$booking->hotel->city->name}} - {{$booking->hotel->city->country}}
                                </td>
                                <td>
                                    {{$booking->created_at}}
                                </td>
                                <td>
                                    {{$booking->rooms_no}}
                                </td>
                                <td>
                                    {{$booking->adults_no}}
                                </td>
                                <td>
                                    {{$booking->children_no}}
                                </td>
                                <td>
                                    {{$booking->arrival_date}}
                                </td>

                                <td>
                                    {{$booking->departure_date}}
                                </td>
                                <td>
                                    @if ($booking->type == 1)
                                        <a href="{{route('admin.bookings.details',$booking->id)}}"> <span class="badge badge-success">مباشر</span></a>
                                    @else
                                        <a href="{{route('admin.bookings.details',$booking->id)}}"><span class="badge badge-danger">مع تخطيط</span></a>
                                    @endif
                                </td>

                                <!--end::Action=-->
                            </tr>
                           @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

