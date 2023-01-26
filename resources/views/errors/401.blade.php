@extends('errors.layout.app')

@section('title', trans('messages.401'))

@section('content')
    <div class="col-xl-4 text-center">
        <div class="error-500 position-relative">
            <img src="{{asset('assets/images/error500.png')}}" alt="" class="img-fluid error-500-img error-img" />
            <h1 class="title text-muted">401</h1>
        </div>
        <div>
            <h4>{{trans('messages.401_text')}}</h4>
            <p class="text-muted w-75 mx-auto">{{trans('messages.401_hint')}}</p>
            <a href="{{route('dashboard')}}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>
                {{trans('messages.back_to_home')}}
            </a>
        </div>
    </div><!-- end col-->
@endsection
