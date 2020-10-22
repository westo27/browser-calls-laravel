@extends('layouts.master')

@section('title')
    Server Dashboard
@endsection

@section('content')

    <?php
    require_once '../vendor/autoload.php';
    use Twilio\Rest\Client;

    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();

    $sid = env('TWILIO_ACCOUNT_SID');
    $token = env('Auth_Token');
    $twilio = new Client($sid, $token);

    //Get all incoming and outgoing call logs
    $outgoingCalls = $twilio->calls->read(['from' => '+441245209623', 'direction' => 'outgoing-dial']);
    $incomingCalls = $twilio->calls->read(['to' => '+441245209623']);

    //Prepare arrays to be used
    foreach ($outgoingCalls as $key => $call) {
        $call->directionLog = 'outgoing';
        if ('client:support_agent' == $call->to) {
            unset($outgoingCalls[$key]);
        }
    }

    foreach ($incomingCalls as $call) {
        $call->directionLog = 'incoming';
    }

    ?>

    <div class="modal" id="incomingCallModal">
        <div class="offset-md-4 col-md-4 call-card-wrapper">
            <div class="card">
                <h5 id="incomingCallHeader" class="card-header"></h5>
                <div class="card-body">
                    <button class="btn btn-lg btn-success answer-button" disabled>Answer call</button>
                    <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-4 offset-md-5">
            <h2 class="title">Server Dashboard</h2>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-2">
                <div class="form-group row">
                    <label for="call-status" class="col-3 col-form-label">Status</label>
                    <div class="col-9">
                        <input id="call-status" class="form-control" type   ="text" placeholder="Connecting to Twilio..." readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-3 call-card-wrapper">
                <div class="card">
                    <h5 class="card-header">Make a call to a client</h5>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="outbound-number" class="col-5 col-form-label">Phone Number</label>
                            <div class="col-7">
                                <input id="outbound-number" class="form-control" type="tel" placeholder="+441234567890" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                            </div>
                        </div>
                        <button onclick="callCustomer(getElementById('outbound-number').value)" type="submit" class="btn btn-primary btn-lg call-customer-button">Call a client</button>
                        <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-2">
                <div class="card call-card-wrapper">
                    <h5 class="card-header">
                        Incoming Calls
                        <img src="/images/call-arrow.png" class="arrow incoming" alt="incoming-call-arrow"/>
                    </h5>
                    <ul class="list-group list-group-flush">
                        @each('_callLog', $incomingCalls, 'record')
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card call-card-wrapper">
                    <h5 class="card-header">
                        Outgoing Calls
                        <img src="/images/call-arrow.png" class="arrow outgoing" alt="outgoing-call-arrow"/>
                    </h5>
                    <ul class="list-group list-group-flush">
                        @each('_callLog', $outgoingCalls, 'record')
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
