<?php
$url = url("/images/call-arrow.png");
?>
<li class="list-group-item col-md-48">
    <div class="row">
<div class="col-md-10">
        <div>{{$record->startTime->format('D jS F Y')}}</div>
        <div>{{$record->startTime->format('H:i:s')}}</div>
        <div> From: {{$record->from}}</div>
        <div> To: {{$record->to}}</div>
</div>
    <div class="col-md-2">

        <img src=<?= $url ?> style="width:40%;" alt= "call-arrow" />
    </div>
    </div>

</li>
