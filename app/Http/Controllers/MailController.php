<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\NoteMail;

class MailController extends Controller
{
    public function index()
    {
        Mail::to('zach.frechin@gmail.com')->send(new NoteMail([
            'title' => 'The Title',
            'body' => 'The Body',
        ]));
    }
}