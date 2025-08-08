@extends('site.layouts.main')
<style>
    body {
        background-color: #F8F6F6;
        font-family: 'Tajawal', sans-serif;
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

    h5 {
        color: #60B5FF;
    }

    .navbar-toggler {
        border: none;
        background: transparent;
        outline: none;
        padding: 0.25rem 0.75rem;
    }

    .navbar-toggler-icon {
        display: inline-block;
        width: 1.5em;
        height: 1.5em;
        vertical-align: middle;
        content: "";
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280, 0, 0, 0.7%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% 100%;
    }
    ul {
        padding-right: 0;
        list-style-position: inside;
    }
.what-we-offer {
    list-style-position: outside;
    padding-right: 50px;
    margin: 0 auto;
    text-align: right;
    display: inline-block;
}

.what-we-offer li {
    margin-bottom: 10px;
}


.what-we-offer li {
    margin-bottom: 10px;
}



    .what-we-offer li::marker {
        color: #000;
    }

    @media (max-width: 576px) {
        .what-we-offer {
            font-size: 0.95rem;
            line-height: 1.8;
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
</style>
@section('content')

    <div class="custom-shadow border-bottom border-2 my-5 container"></div>

    <div class="text-center mt-5 container col-9">
        <h5 class="fw-bold">من نحن ؟</h5>
        <p>
            نحن في ترافليا (Travelia) نؤمن بأن السفر تجربة تبدأ قبل حزم الحقائب، من لحظة الحجز وحتى العودة. لذلك أنشأنا منصة إلكترونية ذكية وسهلة الاستخدام، تساعدك على حجز تذاكر الطيران والفنادق حول العالم بكل سهولة، أمان وشفافية.
        </p>
    </div>
    <div class="text-center mt-5 container col-6">
        <h5 class="fw-bold">رؤيتنا</h5>
        <p>
            ان نكون المنصة العربية الأولى في مجال السفر والحجوزات الإلكترونية، عبر تقديم خدمات مبتكرة، موثوقة، وسهلة تلبي احتياجات المسافرين في العالم العربي وخارجه.
        </p>
    </div>
   <div class="mt-5 container text-center">
    <h5 class="fw-bold">ماذا نقدم؟</h5>
   <ul class="what-we-offer">
    <li>خطط رحلات جاهزة ومخصصة</li>
    <li>اقتراحات لأفضل وجهات والمعالم</li>
    <li>دليل شامل للفنادق</li>
    <li>دعم فني واستشارات للسفر</li>
</ul>
</div>


    <section class="container text-center mt-5">

        <h5 class="mb-4 fw-bold">تواصل معنا عبر مواقع التواصل الاجتماعي</h5>
        <div class="d-flex justify-content-center gap-5">
            <!-- Twitter/X -->
            <a href="#" target="_blank">
                <img src="{{ asset("assets/images/Twitter_X_1.png") }}" alt="X" width="40px" />
            </a>
            <!-- Facebook -->
            <a href="#" target="_blank">
                <img src="{{ asset("assets/images/facebook.png") }}" alt="Facebook" width="40px" />
            </a>

            <!-- Instagram -->
            <a href="#" target="_blank">
                <img src="{{ asset("assets/images/Instagram.png") }}" alt="Instagram" width="40px" />
            </a>

            <!-- Google -->
            <a href="#" target="_blank">
                <img src="{{ asset("assets/images/Google.png") }}" alt="Google" width="40px" />
            </a>
        </div>
    </section>

    <div class="text-center mt-5 container col-8 fw-bold">
        <h4 class="fw-bold">
            في <span style="color: #60B5FF;">ترافليا</span> نؤمن أن كل رحلة تبدأ بحلم، ونحن هنا لنساعدك في تحقيقه
        </h4>
    </div>

    <div class="custom-shadow border-bottom border-2 my-5 container"></div>
@endsection
