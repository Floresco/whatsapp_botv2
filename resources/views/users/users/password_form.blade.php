@extends('layout.app')
@php
    $required = \App\Helpers\Utils::required();
    /** @var $model \App\Models\users\User */

@endphp
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12 mt-lg-0 mt-4">
                <x-alert/>
                <div class="card">
                    <div class="card-body pt-0" id="page_content1"></div>
                    <div class="card-body pt-0" id="page_content2">
                        <form id="contact-form" onsubmit="return submit_form()" method="POST" autocomplete="off"
                              action="{{ route('user.password-reset',['user' => $model->id])}}">
                            @csrf
                            <div class="row">
                                @if($model != null)
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="col-6 pb-2">
                                        <div class="form-group is-valid">
                                            <label class="form-label" for="password">{{trans('messages.user_password')}}
                                                <span
                                                    style="color:red">**</span>
                                                :</label>

                                            <input type="password" id="password" class="form-control" autocomplete="off"
                                                   name="password" required="required" aria-required="true">
                                        </div>
                                    </div>

                                    <div class="col-6 pb-2">
                                        <div class="form-group is-valid">
                                            <label class="form-label"
                                                   for="password_confirmation">{{trans('messages.cuser_password')}}{!! $required !!}
                                                :</label>

                                            <input type="password" id="password_confirmation" class="form-control"
                                                   autocomplete="off" name="password_confirmation" required="required"
                                                   aria-required="true">
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-lg-12">
                                {!! \App\Helpers\Utils::submit_btn() !!}
                                @if($model && $model->id)
                                    {!! \App\Helpers\Utils::back_btn('user.index') !!}
                                @else
                                    {!! \App\Helpers\Utils::reset_btn() !!}
                                @endif()

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

        @endsection
        @push('js')
            <script type="application/javascript">
                function submit_form() {
                    const img = '</br></br><center><img  src="{!! asset('assets/images/loader.gif') !!}"  style="width:200px;border-radius: 5px;border:1px solid #DADADA" /></center></br></br>';
                    $('#page_content2').hide();
                    $('#page_content1').html(img);

                    return true;
                }

                window.onload = function () {

                    $(document).ready(function () {

                    })
                }
            </script>
    @endpush
