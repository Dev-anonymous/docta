<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\AppMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ],
            [
                'g-recaptcha-response.required' => 'Veuillez cocher la case “Je ne suis pas un robot”',
                'g-recaptcha-response.captcha' => "captcha non valide, actualisez la page et réessayez."
            ]
        );

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();

        $text = strtolower(request('message'));
        $subject = strtolower(request('subject'));

        if (
            strpos($text, ' seo') != false  || strpos($text, ' rank') != false || strpos($text, ' ranks') != false ||
            strpos($text, ' online') != false || strpos($text, ' optimization') != false || strpos($text, ' improve') != false || strpos($text, ' visibility') != false
            || strpos($text, ' software') != false || strpos($text, ' backlinks') != false || strpos($text, ' backlink') != false || strpos($text, ' digital') != false || strpos($text, 'https://') != false ||

            strpos($subject, ' seo') != false  || strpos($subject, ' rank') != false || strpos($subject, ' ranks') != false ||
            strpos($subject, ' online') != false || strpos($subject, ' optimization') != false || strpos($subject, ' improve') != false || strpos($subject, ' visibility') != false
            || strpos($subject, ' software') != false || strpos($subject, ' backlinks') != false || strpos($subject, ' backlink') != false || strpos($subject, ' digital') != false || strpos($subject, 'https://') != false

        ) {
            return response([
                'message' => "We can't accept this message."
            ]);
        }

        try {
            $email = $data['email'];
            $m['user'] = "{$data['name']} $email";
            $m['msg'] = "{$data['message']}\n\n\n";
            $m['subject'] = "[CONTACT] " . $data['subject'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $m['replyTo'] = [$email, $data['name']];
            }
            Mail::to('contact@docta-tam.com')->send(new AppMail((object)$m));

            $data['date'] = now('Africa/Lubumbashi');
            Contact::create($data);
        } catch (\Throwable $th) {
            return response([
                'message' => "Oops, please try again."
            ]);
        }

        return response([
            'success' => true,
            'message' => "Thank you for contacting us."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
