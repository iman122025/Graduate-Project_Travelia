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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">تعديل الفندق</h1>
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
                        <li class="breadcrumb-item text-dark">تعديل الفندق</li>
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
                    <a href="{{route('admin.hotels.index')}}" class="btn btn-sm btn-primary">قائمة الفنادق</a>
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
                                <form action="{{ route('admin.hotels.update', $hotel->id) }}" id="kt_invoice_form"  method="POST" enctype="multipart/form-data">
                                    <!--begin::Wrapper-->
                                    @csrf
                                    @method('PUT') {{-- مهمة جداً لإعلام Laravel أن هذا الطلب هو تحديث وليس إدخال جديد --}}
                                    <!--end::Separator-->
                                    <!--begin::Wrapper-->

                                    <div class="mb-0">
                                        <!--begin::Row-->
                                        <div class="row gx-10 mb-5">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">اسم الفندق</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" name="name" id="name" value="{{$hotel->name}}" class="form-control form-control-solid" placeholder="مثال: فندق ريجنسي" />
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">عدد النجوم</label>
                                                    <input type="text" id="star_no" min="1" max="5" name="star_no" value="{{$hotel->star_no}}" class="form-control form-control-solid" placeholder="مثال: 5" />
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">المدينة</label>
                                                    <select name="city_id" id="city_id" class="form-control ">
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->id }}" {{ $hotel->city->id == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">سعر الليلة</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" id="price" name="price" value="{{$hotel->price}}" class="form-control form-control-solid" placeholder="مثال: 250$" />
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">صورة الفندق</label>
                                                <div class="mb-5">
                                                    <input type="file" name="main_image" id="main_image" class="form-control form-control-solid" placeholder="مثال: 250$" />
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">صور الفندق</label>
                                                <div class="mb-5">
                                                    <input type="file" name="image_path[]" multiple class="form-control form-control-solid" />
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Table wrapper-->

                                        <!--end::Table-->
                                        <!--begin::Item template-->


                                        <!--end::Item template-->
                                        <!--begin::Notes-->
                                        <div class="mb-0">
                                            <label class="form-label fs-6 fw-bolder text-gray-700">مرافق الفندق</label>
                                            <textarea name="description" id="description" class="form-control form-control-solid" rows="3" placeholder="اكتب هنا تفاصيل الفندق...">{{$hotel->description}}</textarea>
                                        </div>
                                        <!--end::Notes-->
                                    </div>
                                    <br></br>
                                    <button  type="submit" class="btn btn-primary btn-sm">
                                        <span class="indicator-label">
                                            <i class="la la-plus fs-3"></i>تحديث
                                        </span>
                                                <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>

                                    <!--end::Wrapper-->
                                </form>
                                <!--end::Form-->
                            </div>

                            <div class="card-body pt-0">
                                <h2>صور الفندق</h2>
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                                        <th class="min-w-125px">#</th>
                                        <th class="min-w-125px">الصورة</th>
                                        <th class="text-end min-w-70px">الاجراءات</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                    @foreach ($hotel->images as $image)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <!--end::Name=-->
                                        <!--begin::Email=-->

                                        <!--end::Email=-->
                                        <!--begin::Company=-->

                                        <td data-filter="mastercard">
                                            <img src="{{ asset('storage/'.$image->image_path) }}" class="w-60px me-3" alt="" />
                                        </td>


                                        <!--end::Date=-->
                                        <!--begin::Action=-->
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">الاجراءات
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
															</svg>
														</span>
                                                <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->

                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('admin.hotels.deleteImage', $image->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه الصورة؟');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="menu-link px-3 btn btn-link p-0 m-0" style="color: inherit; text-decoration: none;">
                                                            حذف
                                                        </button>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
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

