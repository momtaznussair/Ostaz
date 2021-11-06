@if (App::isLocale('en'))
    <a  hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
        <img src="{{ URL::asset('assets/img/flags/egypt-flag.png') }}" style="width: 32px;"  alt="العربية" title="العربية">
    </a>
@else
    <a  hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
        <img  src="{{ URL::asset('assets/img/flags/us_flag.jpg') }}" style="width: 32px;" alt="English" title="English">
    </a>
@endif