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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">تعديل اليوم</h1>
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
                        <li class="breadcrumb-item text-dark">تعديل اليوم</li>
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
                    <a href="{{route('admin.days.index')}}" class="btn btn-sm btn-primary">قائمة الأيام</a>
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
                                <form action="{{ route('admin.days.update',$day->id) }}" method="POST" id="kt_invoice_form" enctype="multipart/form-data">
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
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">العنوان</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" name="title" id="title" value="{{$day->title}}" class="form-control form-control-solid" placeholder="مثال: كندا" />
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">الموقع</label>
                                                    <input type="text" id="location" name="location" value="{{$day->location}}" class="form-control form-control-solid" placeholder="مثال: اتاوا" />
                                                </div>

                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">الانشطة</label>
                                                    <textarea rows="7" id="activities" name="activities"  class="form-control form-control-solid" >{{$day->activities}}</textarea>
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">الصورة</label>
                                                    <input type="file" id="image" name="image"  class="form-control form-control-solid" />
                                                </div>
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">التاغات</label>
                                                    <select id="tag_id" name="tag_id"  class="form-control form-control-solid" >
                                                        <option value="">اختر التاغ</option>
                                                        @foreach ($tags as $tag)
                                                            <option value="{{ $tag->id }}" {{ $tag->id == $day->tag->id ? 'selected' : '' }}>
                                                                {{ $tag->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->

                                                <!--end::Input group-->
                                            </div>
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

