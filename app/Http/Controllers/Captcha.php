<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Captcha extends Controller
{
    public function createCaptcha(){
        return view('captcha');
    }
    function captchaCheck()
    {
        if ($_POST['g-recaptcha-response'])
        {
            header('Location: /upload');
            die();
        }

        return back()
            ->with('fail','Captcha is failed');
    }
}
