<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Twilio\TwiML\VoiceResponse;

class CallController extends Controller
{
    /**
     * Process a new call
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newCall(Request $request)
    {
        $response = new VoiceResponse();
        $callerIdNumber = config('services.twilio')['number'];

        $dial = $response->dial(null, ['callerId'=>$callerIdNumber]);
        $phoneNumberToDial = $request->input('phoneNumber');

        if (isset($phoneNumberToDial)) {
            $dial->number($phoneNumberToDial);
        } else {
            $dial->client('support_agent');
        }

        $dial->setTimeout(30);
        $dial->setAction($this->voicemail());

        return $response;
    }

    /**
     * Redirect to voicemail
     *
     * @return VoiceResponse
     */
    public function voicemail()
    {
        // Start our TwiML response
        $response = new VoiceResponse();

        # Use <Say> to give the caller some instructions
        $response->say("Hello you have reached the MessageCloud support desk. We're sorry that we can't take your call at the moment.
         Please leave a message and one of our team will get back to you as soon as possible");

        # Use <Record> to record the caller's message
        $response->record();

        # End the call with <Hangup>
        $response->hangup();
        return $response;
    }
}
