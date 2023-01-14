@extends('front.layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="text-bg">
                {!! VarByLang(GetSettings()->How_does_work,GetLanguage()) !!}
            </div>
        </div>
    </div>

@endsection