@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <x-alert/>
            @if(sizeof($users) > 0)
                <table
                    class="table table-striped table-bordered table-hover table-responsive-lg is-search-table  align-middle"
                    id="datatable-search" style="width: 100%">
                    <thead>
                    <tr>
                        <th>{{trans('messages.full_name')}}</th>
                        <th>{{trans('messages.email_adress')}}</th>
                        <th>{{trans('messages.username')}}</th>
                        <th>{{trans('messages.user_profil')}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->firstname." ".$user->lastname}}</td>
                            <td class="nowrap text-nowrap">{{$user->email}}</td>
                            <td class="nowrap text-nowrap">{{$user->phone}}</td>
                            <td class="nowrap text-nowrap">{{$user->userProfil?->name ?? '-'}}</td>

                            <th scope="row" style="width: 1%;">
                                <a href="{{$user->user_parent_id != 0 ? route('user.edit',['user'=>$user->id]) : "javascript:void(0)" }}"
                                   title="{{trans('messages.updatebutton')}}">
                                    <i @class(["bx", "bx-edit-alt", "text-info" => $user->user_parent_id != 0,'text-muted' => $user->user_parent_id  == 0, "position-relative", "text-md"])></i>
                                </a>
                            </th>

                            <th scope="row" style="width: 1%;">
                                @if($user->user_parent_id == 0)
                                    <a
                                        href="javascript:void(0)"
                                    >
                                        <i class="bx bx-check-double text-muted position-relative text-md"></i>
                                    </a>
                                @else

                                    @if($user->etat == 1)
                                        <a
                                            href="javascript:void(0)"
                                            title="{{trans('messages.desactive')}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#operationModal"
                                            onclick="desactive_member('{{$user->id}}')"
                                        >
                                            <i class="bx bx-check-double text-success position-relative text-md"></i>
                                        </a>
                                    @else
                                        <a
                                            href="javascript:void(0)"
                                            title="{{trans('messages.active')}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#operationModal"
                                            onclick="active_member('{{$user->id}}')"

                                        >
                                            <i class="bx bx-check-double text-warning position-relative text-md"></i>
                                        </a>
                                    @endif
                                @endif

                            </th>

                            <th scope="row" style="width: 1%;">

                                <a
                                    href="javascript:void(0)"
                                    title="{{trans('messages.delete')}}"

                                    @if($user->user_parent_id != 0)
                                        data-bs-toggle="modal"
                                    data-bs-target="#operationModal"
                                    onclick="delete_member('{{$user->id}}')"
                                    @endif
                                >
                                    <i @class(['bx','bx-trash','text-danger' => $user->user_parent_id != 0,'text-muted' => $user->user_parent_id  == 0,'position-relative','text-md'])></i>
                                </a>

                            </th>
                            <th scope="row" style="width: 1%;">
                                <a href="{{$user->user_parent_id != 0 ? route('user.edit-password',['user'=>$user->id]) : "javascript:void(0)" }}"
                                   title="{{trans('messages.reset_password')}}">
                                    <i @class(["bx", "bx-lock", "text-secondary" => $user->user_parent_id != 0,'text-muted' => $user->user_parent_id  == 0, "position-relative", "text-md"])></i>
                                </a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {!! \App\Helpers\Utils::emptyContent() !!}
            @endif
        </div>
    </div>
@endsection

@section('modals')
    @include('users._modal');
@endsection

@push('js')
    <script type="application/javascript">
        function delete_member(id) {
            $('#operationModalLabel').html('{{trans('messages.confirm_delete')}}');
            $('#operationModalContent').html('{{trans('messages.info_delete_user')}}');
            $('#type_operation').val("3");
            $('#id_member').val(id);
            $('#submit_mod').show();
        }

        function active_member(id) {
            $('#operationModalLabel').html('{{trans('messages.confirm_active')}}');
            $('#operationModalContent').html('{{trans('messages.info_active_user')}}');
            $('#type_operation').val("1");
            $('#id_member').val(id);
            $('#submit_mod').show();
        }

        function desactive_member(id) {
            $('#operationModalLabel').html('{{trans('messages.confirm_desactive')}}');
            $('#operationModalContent').html('{{trans('messages.info_desactive_user')}}');
            $('#type_operation').val("2");
            $('#id_member').val(id);
            $('#submit_mod').show();
        }


        function do_operation() {

            let url_submit = "{{route('user.operation',['user' => ':id'])}}";
            url_submit = url_submit.replace(':id', $('#id_member').val());


            $('#submit_mod').hide();
            $('#operationModalContent').html('<center><img style="height:150px" src="{!! asset('assets/images/loader.gif') !!}"></center>');

            $.ajax({
                url: url_submit,
                type: "POST",
                data: {
                    operation: encodeURIComponent($('#type_operation').val()),
                    id: encodeURIComponent($('#id_member').val()),
                },
                success: function (data) {
                    document.location.href = location.href;
                }
            });

        }
    </script>
@endpush
