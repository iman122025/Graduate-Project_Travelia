@extends('site.layouts.main')
<style>
    body {
        background-color: #f8f9fa;
    }

    .nav-link {
        color: #333333;
    }

    .nav-link.active,
    .nav-link:hover {
        background-color: #60B5FF;
        border-radius: 10px;
        color: white;
        font-weight: bold;
    }
    .option-card {
        border: 2px solid transparent;
        border-radius: 10px;
        padding: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .option-card:hover {
        border-color: #ffa45b;
        box-shadow: 10px 10px 20x rgba(159, 159, 159, 0.4);
    }
    .option-card img {
        width: 100%;
        max-height: 150px;
        object-fit: contain;
    }
    .option-title {
        text-align: center;
        margin-top: 10px;
        font-weight: bold;
        font-size: 18px;
    }
    .main-btn {
        background-color: #ffa45b;
        color: white !important;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        margin-top: 20px;
        width: 400px;
    }
    .navbar-toggler {
        border-color: #000; /* لون حدود الزر */
    }
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280,0,0,1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
    @media (max-width: 700px) {
        .navbar-collapse {
            text-align: center;
        }

        .navbar-collapse .navbar-nav {
            margin: auto;
            display: flex;
            flex-direction: column;
            /* align-items: center; */
        }
    }
    @media (max-width: 767.98px) {
        .no-bullets-mobile {
            list-style: none;
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media (min-width: 768px) {
        .no-bullets-mobile {
            list-style: disc;
            list-style-position: inside;
        }
    }
    footer ul {
        padding: 0;
    }

    footer ul li {
        margin-bottom: 6px;
    }

    .selectable-card {
        border: 2px solid transparent;
        padding: 10px;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s;
        display: block;
    }

    .selectable-card.selected {
        border-color: #007bff;
        background-color: #e6f0ff;
    }

    .selectable-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
    }

    .option-title {
        margin-top: 10px;
        font-weight: bold;
    }
</style>

@section('content')


    <div class="custom-shadow border-bottom border-2 my-4 container"></div>
    <div class="container py-2">
        <h4 class="text-center mb-4 fw-bold" style="color: #60B5FF;">اختر نوع المكان المناسب</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('site.plan-ready') }}">
            @csrf
            <div class="row g-4 justify-content-center">

                <input type="hidden" name="hotel_id" value="{{$hotel->id}}">

                @foreach($tags as $tag)
                    <div class="col-6 col-md-4">
                        <label class="option-card text-center selectable-card">
                            <input type="checkbox" name="activities[]" value="{{$tag->name}}" class="d-none">
                            <img src="{{ asset('storage/'.$tag->image) }}" alt="{{$tag->name}}">
                            <div class="option-title">{{$tag->name}}</div>
                        </label>
                    </div>
                @endforeach

            </div>

            <div class="text-center mt-4">
                <button type="submit" class="main-btn text-decoration-none d-inline-block text-center fw-bold">هيا نخطط</button>
            </div>
        </form>

{{--        <div class="text-center mt-4">--}}
{{--            <a href="{{route('site/plan-ready')}}" class="main-btn text-decoration-none d-inline-block text-center fw-bold">هيا نخطط</a>--}}
{{--        </div>--}}
    </div>

    <div class="custom-shadow border-bottom border-2 my-5 container"></div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".selectable-card");

        cards.forEach(card => {
            card.addEventListener("click", function () {
                const checkbox = this.querySelector("input[type=checkbox]");
                checkbox.checked = !checkbox.checked;
                this.classList.toggle("selected", checkbox.checked);
            });
        });
    });
</script>
