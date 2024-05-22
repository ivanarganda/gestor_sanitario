<?php 

function generateTitleSection( $title , $url = '' ){

    if ( $url == '' ){
        $url = '/';
    }

    return '<div class="flex items-center justify-center p-2 mb-8">
    <a href="'.$url.'" class="flex items-center text-gray-600 hover:text-gray-800">
        <svg class="h-8 w-8" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
        </svg>
    </a>
    <h1 class="text-3xl font-bold ml-4">'.$title.'</h1>
    </div>';
}

function formatDate( $date ){
    return \Carbon\Carbon::parse($date)->format('d/m/Y H:i:s');
}

function getStatusSession( $status ){
    return $status == '0' ? 'Failed' : 'Success';
}
function calculateTotalTime( $date1 , $date2 , $full = false ){
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

    if ( $full ){
        $format = "$days dias $hours horas $minutes minutos $seconds segundos";
    } else {
        $format = "$days d $hours h $minutes m $seconds s";
    }
    

    return $format;
}

function cutText( $text ){
    return strlen($text) > 400? substr($text, 0, 400).'...' : $text;
}