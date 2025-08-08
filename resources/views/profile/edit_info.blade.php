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

        <form id="frmNewComplaint" method="POST" enctype="multipart/form-data" action="{{ route('profile.update_customer',$customer->id) }}">
            @csrf
            @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$customer->name}}" placeholder="أدخل الاسم الشخصي">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$customer->email}}" placeholder="أدخل بريدك الإلكتروني">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label fw-bold">رقم الهاتف</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{$customer->phone}}" placeholder="أدخل رقم الهاتف">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label fw-bold">العنوان</label>
            <input type="text" class="form-control" id="address" name="address" value="{{$customer->address}}" placeholder="أدخل العنوان">
        </div>

        <div class="d-flex justify-content-between gap-2">
            <button type="submit" class="btn btn-edit fw-bold col-6">تعديل</button>
            <a href="{{route('site.account')}}" class="btn btn-back fw-bold col-6 text-center text-decoration-none d-flex align-items-center justify-content-center">عودة</a>
        </div>
    </form>


</div>

@endsection

<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script>
    document.getElementById("searchInput").addEventListener("input", function () {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll(".card");

        cards.forEach(card => {
            const title = card.querySelector(".title").textContent.toLowerCase();
            const desc = card.querySelector(".desc").textContent.toLowerCase();

            if (title.includes(query) || desc.includes(query)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
</script>
