<?php 

function formatDate( $date ){
    return \Carbon\Carbon::parse($date)->format('d/m/Y H:i:s');
}

function getStatusSession( $status ){
    return $status == '0' ? 'Failed' : 'Success';
}
function calculateTotalTime( $date1 , $date2){
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime1->diff($datetime2);

    // Calculate the total difference in seconds, minutes, and hours
    $seconds = ($interval->days * 24 * 60 * 60) + ($interval->h * 60 * 60) + ($interval->i * 60) + $interval->s;
    $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i + ($interval->s / 60);
    $hours = ($interval->days * 24) + $interval->h + ($interval->i / 60) + ($interval->s / 3600);

    // Prepare the result
    $result = [
        'days' => $interval->days,
        'hours' => $interval->h,
        'minutes' => $interval->i,
        'seconds' => $interval->s,
        'total_hours' => $hours,
        'total_minutes' => $minutes,
        'total_seconds' => $seconds,
    ];

    $days = $result['days'];
    $hours = $result['hours'];
    $minutes = $result['minutes'];
    $seconds = $result['seconds'];
    $total_hours = $result['total_hours'];
    $total_minutes = $result['total_minutes'];
    $total_seconds = $result['total_seconds'];

    $format = "$days d $hours h $minutes m $seconds s";

    return $format;
}