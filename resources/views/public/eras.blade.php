@extends('public')
@section('content')
<main class="eras">
    <h1>Eras</h1>
    <hr>
    <table class="display table table-striped table-bordered table-responsive resourceTable" id="tblEra">
        <thead>
        <tr class="colHeaders">
            <th>ID</th>
            <th>Era</th>
        </tr>
        </thead>
    </table>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#tblEra').DataTable({
                scrollX: true,
                scrollCollapse: true,
                processing: false,
                serverSide: true,
                'ajax': {
                    'url': "{!! route('getpubliceras') !!}"
                },
                widthFixed: false,
                columns: [
                    { data: 'EraId', name: 'EraId' },
                    { data: 'Era', name: 'Era' },
                ]
            });
        });
    </script>
</main>
@endsection
