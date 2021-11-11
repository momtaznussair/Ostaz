@if (App::isLocale('en'))
    <a class="dropdown-item" rel="alternate" hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
        <img src="{{ URL::asset('assets/img/flags/egypt-flag.png') }}" alt="العربية" title="العربية">
    </a>
@else
    <a class="dropdown-item" rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
        <img  src="{{ URL::asset('assets/img/flags/us_flag.jpg') }}" style="width: 32px;" alt="English" title="English">
    </a>
@endif