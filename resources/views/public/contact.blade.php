@extends('public')

@section('content')
<main class="contact">
  <h2>Contact Us</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Please review, your input was not received for some reason.<br /><br />
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success">
                                <strong>Success!</strong> Your message was sent.<br />
                            </div>
                        @endif

                        {!! Form::open(array('url'=>'contact','method'=>'POST', 'id'=>'myform')) !!}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                {!! Form::text('name','',array('id'=>'','class'=>'form-control span6','placeholder' => 'Your Name')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                {!! Form::text('email','',array('id'=>'','class'=>'form-control span6','placeholder' => 'Your Email')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="col-md-4 control-label">Subject</label>
                            <div class="col-md-6">
                                {!! Form::select('subject', array('' => 'Select Subject', 'Receive blog' => 'Receive blog', 'Technical Issue' => 'Technical Issue', 'Comment' => 'Comment', 'Question' => 'Question'), null, ['id' => 'subject', 'class'=>'form-control span6', 'placeholder' => 'choose']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-md-4 control-label">Message</label>
                            <div class="col-md-6">
                                {!! Form::textarea('message','',array('id'=>'','class'=>'form-control span6','placeholder' => 'Your Message')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="captcha" class="col-md-4 control-label">Captcha</label>
                            <div class="col-md-6">
                                {!! app('captcha')->display() !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
