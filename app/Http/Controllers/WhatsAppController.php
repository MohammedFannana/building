<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class WhatsAppController extends Controller
{
    public function sendWhatsApp(Request $request, $phone, $message)
    {
        $whatsappUrl = "https://api.whatsapp.com/send?phone=$phone&text=" . urlencode($message);

        return Redirect::to($whatsappUrl);
    }
}
