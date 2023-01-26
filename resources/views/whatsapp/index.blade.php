@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <button class="btn btn-primary" id="myButton">Envoyer</button>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            $('#myButton').on('click', function () {
                $.ajax({
                    url: '{{route('whatsapp.send-message')}}',
                    type: 'POST',
                    data: {},
                    success: function (response) {
                        console.log('success')
                        console.log(response)
                    },
                    error: function (response) {
                        console.log('error')
                        console.log(response)
                    }
                });
            });
        })
    </script>
@endpush
