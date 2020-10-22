<?php
$url = url('/images/call-arrow.png');
?>
<li class="list-group-item col-md-48">
    <div class="row">
        <div class="col-md-8">
            <?php if ('outgoing' == $record->directionLog) : ?>
            <div> To: {{$record->to}}</div>
            <?php elseif ('incoming' == $record->directionLog) : ?>
            <div> From: {{$record->from}}</div>
            <?php endif; ?>
            <div>{{$record->startTime->format('D jS F Y')}}</div>
            <div>{{$record->startTime->format('H:i:s')}}</div>
            <div>{{$record->duration}}</div>
        </div>
        <div class="col-md-4">
            <div>{{$record->directionLog}}</div>
        </div>
    </div>
</li>
