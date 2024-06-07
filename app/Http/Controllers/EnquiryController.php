<?php namespace App\Http\Controllers;

use App\UserFeedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class EnquiryController extends Controller {
    public function index()
    {
        $data = Input::all();
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return Redirect::to('/contact')->withInput()->withErrors($validator);
        }
        else{
            $userfeedback = new UserFeedback;
            $userfeedback->UserName = Input::get('name');
            $userfeedback->UserEmail = Input::get('email');
            $userfeedback->UserFeedbackCategory = Input::get('subject');
            $userfeedback->UserFeedback = Input::get('message');
            $userfeedback->save();
            return redirect()->back()->with('success', [1]);
        }
    }
}