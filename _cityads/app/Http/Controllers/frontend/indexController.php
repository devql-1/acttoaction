<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdmissionShortForm;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use App\Models\AdmissionFullForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.Home.index');
    }
}