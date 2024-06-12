<?php

namespace App\Http\Controllers;

use App\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class EnquiryController extends Controller
{
    public function index()
    {
        $request = new Request();
        $data = $request->all();
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::to('/contact')->withInput()->withErrors($validator);
        } else {
            $request = new Request();
            $userfeedback = new UserFeedback;
            $userfeedback->UserName = $request->get('name');
            $userfeedback->UserEmail = $request->get('email');
            $userfeedback->UserFeedbackCategory = $request->get('subject');
            $userfeedback->UserFeedback = $request->get('message');
            $userfeedback->save();
            return redirect()->back()->with('success', [1]);
        }
    }
}
