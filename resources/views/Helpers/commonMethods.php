<?php 

function generateSearch( $url , $search = null ){

    return '<input type="search" class="w-full lg:w-1/2 shadow-md rounded-md" id="value_search" value="'.$search.'" placeholder="Search">
            <input type="hidden" id="url_search" value="'.$url.'">
            <svg id="btn_search" class="mx-2 cursor-pointer rounded-md focus:outline-none focus:shadow-outline text-gray-700 font-bold h-8 w-8"  
            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
            <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="10" cy="10" r="7" />  <line x1="21" y1="21" x2="15" y2="15" />
            </svg>';
            
}

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

function mapearEstadoSolicitud( $status ){

    $status_ = [
        'pendiente' => '<span class="text-yellow-500"><b class="text-yellow-700 px-1 w-5 h-2 border rounded-full">!</b> Pendiente</span>',
        'proceso' => '<span class="text-green-500"><b class="text-green-700 px-1 w-5 h-2 border rounded-full">...</b> En proceso</span>',
        'aprobado' => '<span class="text-green-500"><b class="text-green-700 px-1 w-5 h-2 border rounded-full">&#10003;</b> Aprobado</span>',
        'denegado' => '<span class="text-red-500"><b class="text-red-700 px-1 w-5 h-2 border rounded-full">&#x274c;</b> Denegado</span>'
    ];

    return $status_[$status];
}

function mapearRol( $role ){
    $roles = [
        'user' => 'usuario',
        'staff' => 'administrador',
        'medico' => 'medico',
        'enfermero' => 'enfermero'
    ];
    return $roles[$role];
}

function formatDate( $date ){
    return \Carbon\Carbon::parse($date)->format('d/m/Y H:i:s');
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
    if ( $type == 'cambiar contraseña' ){
        return '<div class="bg-yellow-500 h-12 w-12 rounded-full flex items-center justify-center text-white">
            <svg class="h-8 w-8 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>';
    }
    if ( $type == 'cambiar usuario' ){
        return '<div class="bg-blue-500 h-12 w-12 rounded-full flex items-center justify-center text-white">
            <svg class="h-8 w-8 text-gray-100"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="7" r="4" />  
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            </svg>
        </div>';
    }
    if ( $type == 'cambiar grupo' ){
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