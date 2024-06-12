@extends('public')

@section('content')
<main class="sources">
    <h1>Sources</h1>
    <hr>
    <table class="display table table-striped table-bordered table-responsive resourceTable" id="tblSource">
        <thead>
        <tr class="colHeaders">
            {{--<th>ID</th>--}}
            <th>Source</th>
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

            $('#tblSource').DataTable({
                scrollX: true,
                scrollCollapse: true,
                processing: false,
                serverSide: true,
                'ajax': {
                    'url': "{!! route('getpublicsources') !!}"
                },
                widthFixed: false,
                columns: [
//                    { data: 'SourceId', name: 'SourceId' },
                    { data: 'SourceName', name: 'SourceName', sortable:false }
                ]
            });
        });
    </script>
</main>
@endsection
