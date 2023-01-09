<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailVoucher;
use App\Http\Requests\VoucherValidate;
use App\Mail\EmailVoucher as EmailVoucherSend;
use Illuminate\Support\Facades\Mail;

class EmailVoucherController extends Controller
{
    public function index(VoucherValidate $request)
    {
        //$email_voucher = EmailVoucher::insert($request->except('_token'));
        Mail::to($request->email)->send(new EmailVoucherSend($request->email));
        return redirect()->route('home');
    }
}
