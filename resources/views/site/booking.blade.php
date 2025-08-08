@extends('site.layouts.main')
<style>
    body {
        background-color: #f2f2f2;
        padding: 30px;
    }

    .booking-form {
        background-color: #ffffff;
        max-width: 600px;
        margin: auto;
        padding: 30px 20px;
        border-radius: 8px;
        box-shadow: 0 0 5px #ccc;
    }

    .booking-form h2 {
        text-align: center;
        color: #60B5FF;
        margin-bottom: 20px;
        font-size: 30px;
    }

    .room-options {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }

    .room-options span {
        flex: 1;
        text-align: center;
        font-weight: bold;
        color: #333;
    }

    .form-row {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    .form-row.full {
        width: 100%;
    }

    .form-row label {
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .form-row input,
    .form-row textarea {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .submit-button {
        width: 100%;
        background-color: #ffa155;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 7px;
        margin-top: 15px;
        cursor: pointer;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .room-selection {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .room-selection div {
        width: 25%;
        text-align: center;
        font-weight: bold;
        color: #333;
    }
    .di1{
        font-size:18px ;
        font-weight: bold;
    }
    /* .row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
    }*/

    .row .form-group {
        flex: 1;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        width: 100%;
        margin-bottom: 20px;
    }

    .form-group label {
        margin-bottom: 5px;
        font-weight: bold;
        color: #444;
    }
    .form-group input,
    .form-group textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .confirm-btn {
        width: 80%;
        background-color: #ffa155;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 19px;
        font-weight: bold;
        margin-top: 20px;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-right: 60px;

    }

    .confirm-btn:hover {
        background-color: #ff8c33;
    }
</style>
@section('content')

    <div class="custom-shadow border-bottom border-2 my-1 container"></div>



    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form id="frmNewComplaint" method="POST" action="{{ route('site.save_booking') }}">
        @csrf
    <div class="booking-form">
        <h2>حجز فندق</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="di1">
            <tr>
                <th >عدد الغرف</th>
            </tr>
        </div>

        {{-- عند ظهور رسائل الخطأ في التحقق يفقد البيانات عند التحويل لنفس الصفححة / تم الحل --}}

         @php
            // $planIds = old('plan_id', session('planIds', []));
            // $planIds = is_array(old('plan_id')) ? old('plan_id') : session('planIds', []);

            // $planIds = old('plan_id') !== null ? old('plan_id') : (session('planIds') ?? []);

            $daysIds = old('day_id') !== null ? old('day_id') : $daysIds;


            // $hotel_id = old('hotel_id', session('hotel_id'));
         @endphp

        {{-- <input type="hidden" name="hotel_id" value="{{ $hotel_id }}"> --}}
        <input type="hidden" name="hotel_id" value="{{ old('hotel_id', $hotel_id) }}">



        {{-- @foreach ($planIds as $plan)
          <input type="hidden" value="{{$plan}}"  name="plan_id[]" />
        @endforeach --}}

        @if(!empty($daysIds) && is_array($daysIds))
            @foreach ($daysIds as $day)
                <input type="hidden" value="{{ $day }}" name="day_id[]" />
            @endforeach
        @endif



        <div class="room-selection">
            <label>
                <input type="radio" name="rooms_no" value="1" {{ old('rooms_no') == '1' ? 'checked' : '' }} />
                غرفة
            </label>
            <label>
                <input type="radio" name="rooms_no" value="2" {{ old('rooms_no') == '2' ? 'checked' : '' }} />
                غرفتان
            </label>
            <label>
                <input type="radio" name="rooms_no" value="3" {{ old('rooms_no') == '3' ? 'checked' : '' }} />
                3 غرف
            </label>
            <label>
                <input type="radio" name="rooms_no" value="4" {{ old('rooms_no') == '4' ? 'checked' : '' }} />
                4 غرف
            </label>
        </div>


        <div class="row">
            <div class="form-group">
                <label>عدد البالغين</label>
                <input type="number" name="adults_no" value="{{ old('adults_no') }}" />
            </div>
            <div class="form-group">
                <label>عدد الأطفال</label>
                <input type="number" name="children_no" value="{{ old('children_no') }}"/>
            </div>
        </div>
        <div class="custom-shadow border-bottom border-2 my-4 container"></div>

        <div class="row">
            <div class="form-group">
                <label>تاريخ الوصول</label>
                <input type="date" name="arrival_date" value="{{ old('arrival_date') }}" />
            </div>
            <div class="form-group">
                <label>تاريخ المغادرة</label>
                <input type="date" name="departure_date" value="{{ old('departure_date') }}" />
            </div>
        </div>
        <div class="custom-shadow border-bottom border-2 my-4 container"></div>
        <div class="form-group full-width">
            <label>ملاحظات إضافية</label>
            <textarea rows="4" name="notes">{{ old('notes') }}</textarea>
        </div>

        <input type="submit" class="confirm-btn" value="تأكيد الحجز" />
    </div>
    </form>



    <div class="custom-shadow border-bottom border-2 my-5 container"></div>
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
