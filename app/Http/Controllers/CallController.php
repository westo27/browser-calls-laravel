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
     * @param Request $request
     * @return VoiceResponse
     */
    public function newCall(Request $request)
    {
        $response = new VoiceResponse();
        $callerIdNumber = config('services.twilio')['number'];

        $dial = $response->dial(null, ['callerId' => $callerIdNumber]);
        $phoneNumberToDial = $request->input('phoneNumber');

        if (isset($phoneNumberToDial)) {
            $dial->number($phoneNumberToDial);
        } else {
            $dial->client('support_agent');
        }

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
        $response->say('Hello. Please leave a message after the beep.');

        # Use <Record> to record the caller's message
        $response->record();

        # End the call with <Hangup>
        $response->hangup();
        return $response;
    }
}
