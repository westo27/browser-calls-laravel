@extends('layouts.master')

@section('title')
    Support Dashboard
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <h2 class="title">Server Dashboard</h2>
          <div class="form-group row">
              <label for="call-status" class="col-3 col-form-label">Status</label>
              <div class="col-9">
                  <input id="call-status" class="form-control" type="text" placeholder="Connecting to Twilio..." readonly>
              </div>
          </div>
      </div>
    </div>

      <div class="row">
          <div class="col-md-4 offset-md-2 call-card-wrapper">
              <div class="card">
                  <h5 class="card-header">
                      Make an outbound call
                  </h5>
                  <div class="card-body">
                      <div class="form-group row">
                          <label for="outbound-number" class="col-5 col-form-label">Phone Number</label>
                          <div class="col-7">
                              <input id="outbound-number" class="form-control" type="tel" placeholder="+441234567890" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                          </div>
                      </div>
                      <button onclick="callCustomer(getElementById('outbound-number').value)" type="submit" class="btn btn-primary btn-lg call-customer-button">
                          Call customer
                      </button>
                      <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
                  </div>
              </div>
          </div>
          <div class="col-md-4 call-card-wrapper">
              <div class="card">
                  <h5 class="card-header">
                      Receive a call
                  </h5>
                  <div class="card-body">
                      <button class="btn btn-lg btn-success answer-button" disabled>Answer call</button>
                      <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
                  </div>
              </div>
          </div>
      </div>
      </div>

@endsection('content')
