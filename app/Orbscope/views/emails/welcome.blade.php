@component('emails.mail.html.layout')
    {{-- Header --}}
    @slot('header')
        @component('emails.mail.html.header', ['url' => config('app.url')])
            Header Title
        @endcomponent
    @endslot

    {{-- Body --}}
    {!!  $mesage !!}

    {{-- Subcopy --}}
    @isset($subcopy)
    @slot('subcopy')
        @component('mail::subcopy')
            {{ $subcopy }}
        @endcomponent
    @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('emails.mail.html.footer')
            © {{ date('Y') }} {{ config('app.name') }}. Super FOOTER!
        @endcomponent
    @endslot
@endcomponent