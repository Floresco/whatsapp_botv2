@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <x-alert/>
            @if(sizeof($profils) > 0)
                <table
                    class="table table-striped table-bordered table-hover table-responsive-lg is-search-table  align-middle"
                    id="datatable-search" style="width: 100%">
                    <thead>
                    <tr>
                        <th>{{trans('messages.nameProfil')}}</th>
                        <th>{{trans('messages.descriptionProfil')}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($profils as $profil)
                        <tr>
                            <td>{{$profil->name}}</td>
                            <td class="nowrap text-nowrap">{{$profil->description}}</td>
                            <th scope="row" style="width: 1%;">
                                <a href="{{route('profil.edit',['profil'=>$profil->id])}}"
                                   title="{{trans('messages.updatebutton')}}">
                                    <i class="bx bx-edit-alt text-info position-relative text-md"></i>
                                </a>
                            </th>

                            <th scope="row" style="width: 1%;">
                                @if($profil->users->count() > 0)
                                    <a href="javascript:void(0)">
                                        <i class="bx bx-check-double text-muted position-relative text-md"></i>
                                    </a>
                                @else

                                    @if($profil->etat == 1)
                                        <a
                                            href="javascript:void(0)"
                                            title="{{trans('messages.desactive')}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#operationModal"
                                            onclick="desactive_member('{{$profil->id}}')"
                                        >
                                            <i class="bx bx-check-double text-success position-relative text-md"></i>
                                        </a>
                                    @else
                                        <a
                                            href="javascript:void(0)"
                                            title="{{trans('messages.active')}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#operationModal"
                                            onclick="active_member('{{$profil->id}}')"
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

                                    @if($profil->users->count() == 0)
                                        data-bs-toggle="modal"
                                    data-bs-target="#operationModal"
                                    onclick="delete_member('{{$profil->id}}')"
                                    @endif
                                >
                                    <i @class(['bx','bx-trash','text-danger' => $profil->users->count() == 0,'text-muted' => $profil->users->count() > 0,'position-relative','text-md'])></i>
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
            $('#operationModalContent').html('{{trans('messages.info_delete_profil')}}');
            $('#type_operation').val("3");
            $('#id_member').val(id);
            $('#submit_mod').show();
        }

        function active_member(id) {
            $('#operationModalLabel').html('{{trans('messages.confirm_active')}}');
            $('#operationModalContent').html('{{trans('messages.info_active_profil')}}');
            $('#type_operation').val("1");
            $('#id_member').val(id);
            $('#submit_mod').show();
        }

        function desactive_member(id) {
            $('#operationModalLabel').html('{{trans('messages.confirm_desactive')}}');
            $('#operationModalContent').html('{{trans('messages.info_desactive_profil')}}');
            $('#type_operation').val("2");
            $('#id_member').val(id);
            $('#submit_mod').show();
        }


        function do_operation() {

            let url_submit = "{{route('profil.operation',['profil' => ':id'])}}";
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
