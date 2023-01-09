<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailGift;
use App\Http\Requests\GiftValidate;
use App\Mail\EmailGift as EmailGiftSend;
use Illuminate\Support\Facades\Mail;

class EmailGiftController extends Controller
{
    // public function index(GiftValidate $request)
    // {
    //     //$email_gift = EmailGift::insert($request->except('_token'));
    //     Mail::to($request->email)->send(new EmailGiftSend($request->name));
    //     return redirect()->route('home');
    // }

    public function index(GiftValidate $request){

        /************ Linh dong doan code dang ky nhan sach tu dong 28/01/2021

        //$email_gift = EmailGift::insert($request->except('_token'));
    	
        $data = [
    		'email' => $request->email,
    		'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
    	];
    	$emailgift = EmailGift::create($data);

        Mail::send('mail.gift', ['username' => $emailgift->name], function ($message) use ($emailgift) {
            $message->from('rbookscorp@gmail.com', 'RBooks.vn');

            $message->to($emailgift->email)->subject('FREE SÁCH GIẤY "14 Bí mật gia tăng tài chính mỗi ngày"')->cc('chaupham@lamians.com')->bcc('sales1@lamians.com')->bcc('sales2@lamians.com');
        });

        ****************/


        // $this->contentMail($emailgift);
        return view('pages.homecontroller.notification');
    }

    // public function contentMail($emailgift)
    // {
    // 	Mail::send('mail.giftcontent', ['emailgift' => $emailgift], function ($message) use ($emailgift) {
    //         $message->from('rbookscorp@gmail.com', 'RBooks.vn');

    //         $message->to($emailgift->email)->subject('14 Bí mật gia tăng tài chính mỗi ngày')->cc('chauptn@rbookscorp.com')->bcc('it4@lamians.com')->bcc('it3@lamians.com');
    //     });
    // }
}
