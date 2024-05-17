@include('../Layouts/header')
@php 

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
@endphp
<div class="container mt-20 mx-auto py-8">
    <div class="flex space-x-10 justify-center p-2">
        <a href="{{url('/')}}">
            <svg class="h-8 w-8 pt-2 text-center text-zinc-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold mb-8 text-center">Sesiones del usuario</h1>
    </div>
    <!-- Filter Form -->
    <form method="GET" action="{{ route('sessions') }}" class="w-1/4 mb-8 bg-white p-6 m-auto rounded-lg shadow-md">
        <div class="grid grid-cols-1 w-full">
            <div>
                <label for="user_name" class="block w-full text-sm font-medium text-gray-700">Usuario</label>
                <input type="text" name="user_name" id="user_name" value="{{ request('user_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filtrar
            </button>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acceso desde</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de acceso</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de cierre de sesion</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total conectado</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado de la sesión</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                        <tr>
                            <td class="py-4 px-6 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ $user->ip_address }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ $user->login_time }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ $user->logout_time }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ calculateTotalTime($user->login_time, $user->logout_time) }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ getStatusSession($user->status) }}</td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-12">
            <!-- Manual Pagination Links -->
            {!!$pagination!!}
        </div>
    </div>
    
    
</div>
@include('../Layouts/footer')