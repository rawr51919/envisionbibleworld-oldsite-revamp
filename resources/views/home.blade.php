@extends('app')

@section('content')
    <h2>Home Menu</h2>

    <ul  class="nav nav-tabs">
        <li class="active">
            <a  href="#double" data-toggle="tab">Double Screens</a>
        </li>
        <li>
            <a href="#narrow" data-toggle="tab">Narrow Topical Search</a>
        </li>
    </ul>

    <div class="tab-content clearfix">
        <div class="tab-pane active" id="double">
            <h3>Choose View</h3>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/home/show') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Start at:</label>
                    <div class="col-sm-10">
                        {{--Later, option data comes from tblSourceField table --}}
                        <select class="form-control" id="startOne" name="firstStart">
                            <option value="Category">Category</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                        {{--Later, option data comes from tblSourceField table --}}
                        <select class="form-control" id="startTwo" name="secondStart">
                            <option value="Subcategory">Subcategory</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="include">Include:</label>
                    <div class="col-sm-10">
                        <label class="radio-inline"><input type="radio" name="include" value="location">Location</label>
                        <label class="radio-inline"><input type="radio" name="include" value="sacrifice">Sacrifice</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="setting">Choose saved setting:</label>
                    <div class="col-sm-10">
                        {{--Later, setting option data comes from tblSourceField table --}}
                        <select class="form-control" id="setting" name="setting">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">OK</button>
                        <button type="button" id="btnCancel" class="btn btn-default">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="tab-pane" id="narrow">
            <h3>Narrow Topical Search</h3>
            <p>Will be added Narrow Topical Search Form</p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#btnCancel').click(function() {
               location.href="/standard/";
            });
        });
    </script>
@endsection
