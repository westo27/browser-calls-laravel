@extends('layouts.master')

@section('title')
    Support Dashboard
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <h2 class="title">Support Dashboard</h2>
      </div>
    </div>


    <div class="row">
      <div class="col-md-4 offset-md-4 call-card-wrapper">
        <div class="card">
          <h5 class="card-header">
            Receive a call
          </h5>
          <div class="card-body">
            <div class="form-group row">
              <label for="call-status" class="col-3 col-form-label">Status</label>
              <div class="col-9">
                <input id="call-status" class="form-control" type="text" placeholder="Connecting to Twilio..." readonly>
              </div>
            </div>
            <button class="btn btn-lg btn-success answer-button" disabled>Answer call</button>
            <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection('content')
