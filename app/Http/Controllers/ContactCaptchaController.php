<?php

namespace App\Http\Controllers;

use App\Services\ContactImageCaptcha;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactCaptchaController extends Controller
{
    public function image(Request $request, ContactImageCaptcha $captcha): Response
    {
        $token = $request->query('token');
        $token = is_string($token) ? $token : null;

        $code = $captcha->getChallengeCodeForImage($request->boolean('refresh'), $token);

        return response($captcha->renderPng($code), 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }
}
