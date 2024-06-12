@extends('public')

@section('content')
<main class="categories">
    <h1>Categories</h1>
    <hr>
    <div class="form-group">
        {!! Form::Label('item', 'Category:') !!}
        {!! Form::select('category', $items, null, ['id' => 'categories']) !!}
    </div>
    <table class="display table table-striped table-bordered table-responsive resourceTable" id="tblSubcategory">
        <thead>
            <tr class="colHeaders">
                <th>Subcategory</th>
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

            var table = $('#tblSubcategory').DataTable({
                scrollX: true,
                scrollCollapse: true,
                processing: false,
                serverSide: true,
                'ajax': {
                    'url': "{!! route('getpublicsubcategories') !!}",
                    data: function(d) {
                        d.id = document.getElementById('categories').value
                    }
                },
                widthFixed: false,
                columns: [
                    { data: 'Subcategory', name: 'Subcategory' },
                ]
            });

            $('#categories').change(function() {
                table.ajax.reload();
            } );
        });

    </script>
</main>
@endsection
