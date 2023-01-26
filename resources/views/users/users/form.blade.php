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
                              action="{{ $model != null ? route('user.update',['user' => $model->id]) : route('user.store')}}">
                            @csrf
                            <div class="row">
                                @if($model != null)
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="key" value="{{$model->id}}">
                                @endif
                                <div class="col-6 pb-2">
                                    <div class="form-group is-valid">
                                        <label class="form-label" for="user_profil_id">{{trans('messages.user_profil')}}
                                            <span style="color:red">**</span>:</label>

                                        <select class="form-control select2" name="user_profil_id" id="user_profil_id"
                                                data-placeholder="{{trans('messages.choose')}}">
                                            <option value="">{{trans('messages.select_profil')}}</option>
                                            @foreach($profils as $profil)
                                                <option
                                                    value="{{$profil->id}}" @selected(old('user_profil_id', ) == $profil->id || ($model != null && $model->user_profil_id == $profil->id ))>{{$profil->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 pb-2"></div>
                                <div class="col-6 pb-2">
                                    <div class="form-group is-valid">
                                        <label class="form-label" for="name">{{trans('messages.nom')}} <span
                                                style="color:red">**</span>
                                            :</label>

                                        <input type="text" id="lastname" class="form-control" autocomplete="off"
                                               name="lastname" required="required" aria-required="true"
                                               value="{{$model != null ? $model->lastname : old('lastname')}}">
                                    </div>
                                </div>

                                <div class="col-6 pb-2">
                                    <div class="form-group is-valid">
                                        <label class="form-label" for="name">{{trans('messages.prenoms')}} <span
                                                style="color:red">**</span>
                                            :</label>

                                        <input type="text" id="firstname" class="form-control" autocomplete="off"
                                               name="firstname" required="required" aria-required="true"
                                               value="{{$model != null ? $model->firstname : old('firstname')}}">
                                    </div>
                                </div>

                                <div class="col-6 pb-2">
                                    <div class="form-group is-valid">
                                        <label class="form-label" for="email">{{trans('messages.email_adress')}}
                                            <span
                                                style="color:red">**</span>
                                            :</label>

                                        <input type="email" id="email" class="form-control" autocomplete="off"
                                               name="email" required="required" aria-required="true"
                                               value="{{$model != null ? $model->email : old('email')}}">
                                    </div>
                                </div>

                                <div class="col-6 pb-2">
                                    <div class="form-group is-valid">
                                        <label class="form-label" for="phone">{{trans('messages.phone_number')}}
                                            <span
                                                style="color:red">**</span>
                                            :</label>

                                        <input type="text" id="phone" class="form-control" autocomplete="off"
                                               name="phone" required="required" aria-required="true"
                                               value="{{$model != null ? $model->phone : old('phone')}}"
                                               onkeyup="if(isNaN(this.value)){this.value= this.defaultValue;}else{this.defaultValue=this.value;}">
                                    </div>
                                </div>
                                @if($model == null)
                                    <div class="col-6 pb-2">
                                        <div class="form-group is-valid">
                                            <label class="form-label" for="password">{{trans('messages.user_password')}}
                                                <span
                                                    style="color:red">**</span>
                                                :</label>

                                            <input type="password" id="password" class="form-control" autocomplete="off"
                                                   name="password" required="required" aria-required="true"
                                                   onpaste="return false"
                                                   value="{{old('password')}}">
                                        </div>
                                    </div>

                                    <div class="col-6 pb-2">
                                        <div class="form-group is-valid">
                                            <label class="form-label"
                                                   for="password_confirmation">{{trans('messages.cuser_password')}}
                                                <span
                                                    style="color:red">**</span>
                                                :</label>

                                            <input type="password" id="password_confirmation" class="form-control"
                                                   autocomplete="off" name="password_confirmation" required="required"
                                                   aria-required="true"
                                                   onpaste="return false">
                                        </div>
                                    </div>

                                    <div class="col-6 pb-2">
                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b>
                                            </p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter
                                                (a-z)
                                            </p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b>
                                                letter
                                                (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)
                                            </p>
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
