@extends('errors.layout.app')

@section('title', trans('messages.404'))

@section('content')
    <div class="col-xl-7 col-lg-8">
        <div class="text-center">
            <img src="{{asset('assets/images/error400-cover.png')}}" alt="error img" class="img-fluid">
            <div class="mt-3">
                <h3 class="text-uppercase">{{trans('messages.404_text')}}</h3>
                <p class="text-muted mb-4">{{trans('messages.404_hint')}}</p>
                <a href="{{route('dashboard')}}" class="btn btn-success">
                    <i class="mdi mdi-home me-1"></i>
                    {{trans('messages.back_to_home')}}
                </a>
            </div>
        </div>
    </div><!-- end col -->
@endsection
