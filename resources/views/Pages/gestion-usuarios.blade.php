@include('../Layouts/header')
@php 
    function encodeData($user){
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'password' => $user->password,
            'role' => $user->role,
            'phone' => $user->phone,
            'email' => $user->email,
        ];

        if ( $user->role === 'medico' || $user->role === 'enfermero'){
            $data['colegiate'] = $user->colegiate;
        }

        return json_encode($data);
    }
@endphp
@if(session('success'))

    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <div class="flex justify-center items-center">
            <div class="mx-2">
                <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-lg">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <div class="flex justify-center items-center">
            <div class="mx-2">
                <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-lg">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif
<div class="container mx-auto py-8">
    <div class="flex items-center justify-center p-2 mb-8">
        <a href="{{url('/')}}" class="flex items-center text-gray-600 hover:text-gray-800">
            <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold ml-4">Gestión de usuarios</h1>
    </div>
    <div id="modal_usuarios">
        @include('../Form/modal-usuario')
    </div>
    <!-- Filter Form -->
    <form method="GET" action="{{ route('users') }}" class="max-w-lg mx-auto mb-8 bg-white p-6 rounded-lg shadow-md transition">
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="user_name" class="block text-lg font-medium text-gray-700">Usuario</label>
                <input type="text" name="user_name" id="user_name" value="{{ request('user_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-md focus:ring-blue-500 focus:border-blue-500 transition duration-300">
            </div>
        </div>
        <div class="flex justify-around space-x-3 mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                Filtrar
            </button>
            <input type="button" onclick="window.location='/users?create_user=true'" id="addUser" value="Añadir usuario" class="cursor-pointer bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
        </div>
    </form>

    <div class="overflow-x-auto">
        <table id="table-users" class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Grupo/Rol</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Fecha de creación</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ( count( $users ) === 1 )
                    <tr colspan="6" class="transition duration-300 ease-in-out hover:bg-gray-100">
                        <td colspan="6" class="py-4 px-6 whitespace-nowrap text-center text-gray-500 font-weight-light">No hay usuarios registrados</td>
                    </tr>
                @else
                    @foreach($users as $key => $user)
                        @if($user->role === 'staff')
                            @continue
                        @endif
                        <tr class="transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="py-4 px-6 whitespace-nowrap text-gray-500 font-weight-light">{{ $user->name }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-500 font-weight-light">{{ $user->role }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-500 font-weight-light">{{ $user->phone }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-500 font-weight-light">{{ $user->email }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-500 font-weight-light">{{ $user->created_at }}</td>
                            <td id="actions" class="py-4 px-6 whitespace-nowrap flex space-x-2 items-center">
                                <a href="/users?edit_user={{base64_encode(encodeData($user))}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                                    Editar
                                </a>
                                <a href="{{url('/users/delete/'.$user->id.'')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                                    Borrar
                                </a>
                                <div class="toggle-wrapper blue">  
                                    <input class="checkbox toggle-checkbox" id="{{$user->id}}" {{$user->activated == '0' ? '' : 'checked'}} value="{{$user->activated}}" type="checkbox">
                                    <div class="toggle-container">
                                        <div class="toggle-ball"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="mt-8 flex justify-center space-x-2">
            {!! $pagination !!}
        </div>
    </div>
</div>
@include('../Layouts/footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            setTimeout(() => {
                row.classList.add('loaded');
            }, index * 100); // Delay para cada fila
        });
    });
</script>
