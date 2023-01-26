@extends('errors.layout.app')

@section('title', trans('messages.500'))

@section('content')
    <div class="col-xl-4 text-center">
        <div class="error-500 position-relative">
            <img src="{{asset('assets/images/error500.png')}}" alt="" class="img-fluid error-500-img error-img" />
            <h1 class="title text-muted">500</h1>
        </div>
        <div>
            <h4>{{trans('messages.500_text')}}</h4>
            <p class="text-muted w-75 mx-auto">{{trans('messages.500_hint')}}</p>
            <a href="{{route('dashboard')}}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>
                {{trans('messages.back_to_home')}}
            </a>
        </div>
    </div><!-- end col-->
@endsection
