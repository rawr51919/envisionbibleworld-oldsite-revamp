@extends('public')
@section('content')
    <main class="standard">
        <h1>Standard Entries</h1>
        <hr>
        <table class="display table table-striped table-bordered table-responsive resourceTable" id="tblStandard">
            <thead>
            <tr class="colHeaders">
                {{--<th>ID</th>--}}
                <th>Era</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Summary</th>
                <th>Source Type</th>
                <th>Source Name</th>
                <th>Chapter</th>
                <th>BegVerse</th>
                <th>Chapter</th>
                <th>EndVerse</th>
                <th>Explanation</th>
                <th>Quotation</th>
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

                $('#tblStandard').DataTable({
                    scrollX: true,
                    scroll:1,
                    scrollCollapse: true,
                    processing: false,
                    serverSide: true,
                    columns: [
                        { data: 'Era', name: 'Era', width: '10%' },
                        { data: 'Category', name: 'Category', width: '10%', orderData: [2, 1] },
                        { data: 'Subcategory', name: 'Subcategory', width: '10%', orderData: [1, 2] },
                        { data: 'Summary', name: 'Summary', width: '26%' },
                        { data: 'Source_Type_Abbreviation', name: 'SourceType', width: '4%' },
                        { data: 'SourceName', name: 'SourceName', width: '10%' },
                        { data: 'BeginChptrSectionMinute', name: 'Chapter', width: '3%' },
                        { data: 'BeginVersePageSecond', name: 'BegVerse', width: '3%' },
                        { data: 'EndChptrSectionMinute', name: 'Chapter', width: '3%' },
                        { data: 'EndVersePageSecond', name: 'EndVerse', width: '3%' },
                        { data: 'Source_Explanation', name: 'Explanation', width: '3%' },
                        { data: 'Quotation', name: 'Quotation', width: '26%' }
                    ],
                    'ajax': {
                        'url': "{!! route('getpublicstandard') !!}"
                    },
                    widthFixed: false
                });
            });
            $(document).on('mouseenter', "#tblStandard tbody td", function () {
                var $this = $(this);
                if (this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
                    $this.tooltip({
                        container: 'body',
                        title: $this.text(),
                        placement: "bottom"
                    });
                    $this.tooltip('show');
                }
            });
        </script>
    </main>
@endsection
