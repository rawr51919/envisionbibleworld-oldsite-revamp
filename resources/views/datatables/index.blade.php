

@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="tblCategory">
        <thead>
        <tr>
            <th>CategoryId</th>
            <th>Category</th>
            <th>Explanation</th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#tblCategory').DataTable({
            processing: true,
            serverSide: true,
            {{--ajax: '{{ route('datatables.data') }}'--}}
            'ajax': {
                'url': "{!!route('datatables.data') !!}"
            },

            columns: [
                { data: 'CategoryId', name: 'CategoryId' },
                { data: 'Category', name: 'Category' },
                { data: 'Explanation', name: 'Explanation' }
            ]
        });
    });
</script>
@endpush