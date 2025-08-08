@extends('site.layouts.main')

@section('content')
    <style>
        body {
            direction: rtl;
            background-color: #F8F6F6;
            padding: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-control {
            background-color: #F8F6F6;
            padding: 20px;
        }

        .form-control::placeholder {
            color: #888;
        }

        .btn-edit {
            background-color: #FF9149E5;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #ff7722;
        }

        .btn-back {
            background-color: #6C6C6C40;
            color: black;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #c4c4c4;
        }
    </style>
    <div  class="container-fluid col-8">

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

            <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update_password',$customer->id) }}">
                @csrf
                @method('PUT') {{-- مهمة جداً لإعلام Laravel أن هذا الطلب هو تحديث وليس إدخال جديد --}}
                <div class="mb-3">
                    <label for="currentPassword" class="form-label fw-bold">كلمة المرور السابقة</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword"  placeholder="أدخل كلمة المرور السابقة">
                </div>

                <div class="mb-3">
                    <label for="newPassword" class="form-label fw-bold">كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword"  placeholder="أدخل كلمة المرور الجديدة">
                </div>

                <div class="mb-3">
                    <label for="newPassword_confirmation" class="form-label fw-bold">تأكيد كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation" placeholder="أدخل تأكيد كلمة المرور الجديدة">
                </div>



                <div class="d-flex justify-content-between gap-2 mt-4">
                    <button type="submit" class="btn btn-edit fw-bold col-6">حفظ التغييرات</button>
                    <a href="account.html" class="btn btn-back fw-bold col-6 text-center text-decoration-none d-flex align-items-center justify-content-center">عودة</a>
                </div>
            </form>


    </div>

@endsection

<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

