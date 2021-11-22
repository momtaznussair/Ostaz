@component('mail::message')
# {{__('Welcome!')}}

### Dear, {{$name}}
{{$message}}

---
## {{__('Thank you for using Ostaz!')}}<br> <br>
{{ auth('admin')->user()->name }}
@endcomponent
