<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index($lang)
    {
        $contact = Contact::where('lang', $lang)->firstOrFail();
        $metaTitle=trans('name');
        $metaDescription='Description';
        return view('pages.contact', compact('contact', 'metaTitle', 'metaDescription'));
    }

    public function submit(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $company = $request->input('company');
        $job = $request->input('job');
        $subject = $request->input('subject');
        $whom = $request->input('whom');
        $product = $request->input('product');
        $formtype = $request->input('formType');
        $message = $request->input('message');

        $botToken = '7437257105:AAGSmXxsiP0fWwde3-NrGmLGd8MZt9Qi1IM';
        $chatId = '-4523701002';

        // Matnni tayyorlash
        $text = "Foydalanuvchidan yangi xabar:\n" .
            "Xabar turi: $formtype\n\n".
            "Ismi: $name\n" .
            "Email manzili: $email\n" .
            "Telefon  raqami: $phone\n" .
            "Kompaniya: $company\n" .
            "Lavozim: $job\n" .
            "Mavzu: $subject\n" .
            "Kimga: $whom\n" .
            "Mahsulot: $product\n" .
            "Xabar: $message";

        // Telegram API URL
        $apiURL = "https://api.telegram.org/bot$botToken/sendMessage";

        // Curl orqali so'rov yuborish
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        // Xato xabarini tekshirish
        if ($result === FALSE) {
            // Xato xabarini ko'rsatish
            return redirect()->back()->with('error', 'Error sending message');
        } else {
            return redirect()->back()->with('success', 'Your message has been sent!');
        }
    }
}
