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

function getIconAccordingRequest( $type ){
    if ( $type == 'change_password' ){
        return '<div class="bg-yellow-500 h-12 w-12 rounded-full flex items-center justify-center text-white">
            <svg class="h-8 w-8 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>';
    }
    if ( $type == 'change_name_user' ){
        return '<div class="bg-blue-500 h-12 w-12 rounded-full flex items-center justify-center text-white">
            <svg class="h-8 w-8 text-gray-100"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="7" r="4" />  
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            </svg>
        </div>';
    }
    if ( $type == 'change_role' ){
        return '<div class="bg-green-500 h-12 w-12 rounded-full flex items-center justify-center text-white">
            <svg class="h-8 w-8 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>                                          
        </div>';
    }
}

function cutText( $text ){
    return strlen($text) > 400? substr($text, 0, 400).'...' : $text;
}