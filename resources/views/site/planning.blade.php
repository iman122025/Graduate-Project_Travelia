@extends('site.layouts.main')
@section('content')
    <style>
        .people-option input[type="radio"] {
            display: none;
        }

        .people-option label {
            cursor: pointer;
        }

        .people-option .option-box {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .people-option input[type="radio"]:checked + .option-box {
            border-color: #ff9149;
            background-color: #fff6ef;
        }
    </style>
<div class="custom-shadow border-bottom border-2 my-1 container"></div>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

<img
    src="{{ asset("assets/images/Travelia UI (1).pdf-image-060.png") }}"
    alt="صورة الوجهة"
    class="rounded mt-5 d-block mx-auto"
    style="height: 300px; width: 90%;"
/>

<h2 class="text-center mt-4" style="color: #60b5ff;">أين وجهتك؟</h2>

<div class="container my-3">
    <form class="p-4" method="POST" action="{{ route('site.plan') }}">
        @csrf
        <div class="mb-4">
            <label class="form-label fw-bold">المكان</label>
            <div class="row g-2">
                <div class="col-md-6">
                    {{-- <input type="text" class="form-control text-end" placeholder="من" /> --}}
                    <select  class="form-control text-end" name="from_city_id">
                        <option value="">اختر - من</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->country }} - {{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select  class="form-control text-end" name="to_city_id">
                        <option value="">اختر - الى</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->country }} - {{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">التاريخ</label>
            <div class="row g-2">
                <div class="col-md-6">
                    <input onfocus="this.type='date'" onblur="this.type='text'" name="from_date" class="form-control" placeholder="من" />
                </div>
                <div class="col-md-6">
                    <input onfocus="this.type='date'" onblur="this.type='text'" name="to_date" class="form-control" placeholder="حتى" />
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">
                الميزانية:
                <span id="budget-value" class="text-primary fw-bold">500 $</span>
            </label>
            <input
                type="range" name="budget"
                class="form-range"
                min="0"
                max="3000"
                step="50"
                id="budget-range"
                value="500"
            />
        </div>

        <div class="mb-4 w-100 people-option">
            <label class="form-label fw-bold">عدد الأفراد</label>
            <div class="row text-center mt-3 justify-content-start">
                <div class="col" style="margin-left: 15px">
                    <label>
                        <input type="radio" name="people_count" value="1" checked>
                        <div class="option-box">
                            <i class="fa-solid fa-user mb-1"></i>
                            <div>شخص واحد</div>
                        </div>
                    </label>
                </div>
                <div class="col">
                    <label>
                        <input type="radio" name="people_count" value="2">
                        <div class="option-box">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-user"></i>
                            <div class="mt-2">شخصان</div>
                        </div>
                    </label>
                </div>
                <div class="col">
                    <label>
                        <input type="radio" name="people_count" value="family">
                        <div class="option-box">
                            <i class="fa-solid fa-users mb-1"></i>
                            <div>عائلة</div>
                        </div>
                    </label>
                </div>
            </div>
        </div>




        <div class="text-center mt-4">
            <button type="submit" class="btn px-5 py-2 fw-bold col-9" style="background-color: #ff9149e5; color: white;">
                التالي
            </button>
{{--            <a href="{{ route('site.plan') }}" class="btn px-5 py-2 fw-bold col-9" style="background-color: #ff9149e5; color: white;">التالي</a>--}}
        </div>
    </form>
</div>

<div class="custom-shadow border-bottom border-2 my-5 container"></div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rangeInput = document.getElementById('budget-range');
        const valueDisplay = document.getElementById('budget-value');

        if (rangeInput && valueDisplay) {
            rangeInput.addEventListener('input', function () {
                valueDisplay.textContent = this.value + ' $';
            });
        } else {
            console.error('Element not found: budget-range or budget-value');
        }
    });
</script>

