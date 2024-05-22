@include('../Layouts/header')
@include('../Helpers/commonMethods')
@php
    function encodeData($user) {
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'password' => $user->password,
            'role' => $user->role,
            'phone' => $user->phone,
            'email' => $user->email,
        ];

        if (in_array($user->role, ['medico', 'enfermero'])) {
            $data['colegiate'] = $user->colegiate;
        }

        return json_encode($data);
    }
@endphp

@foreach (['success', 'error'] as $msg)
    @if(session($msg))
        <div class="bg-{{ $msg == 'success' ? 'green' : 'red' }}-100 border-l-4 border-{{ $msg == 'success' ? 'green' : 'red' }}-500 text-{{ $msg == 'success' ? 'green' : 'red' }}-700 p-4 mb-4" role="alert">
            <div class="flex justify-center items-center">
                <div class="mx-2">
                    <svg class="h-6 w-6 text-{{ $msg == 'success' ? 'green' : 'red' }}-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-lg">
                    {{ session($msg) }}
                </div>
            </div>
        </div>
    @endif
@endforeach

<div class="container mx-auto py-8">
    @php
        echo generateTitleSection('Gestion de usuarios');
    @endphp
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
                @if ($users->isEmpty())
                    <tr>
                        <td colspan="6" class="py-4 px-6 text-center text-gray-500 font-light">No hay usuarios registrados</td>
                    </tr>
                @else
                    @foreach ($users as $user)
                        <tr class="transition {{ $user->role == 'staff' ? 'bg-yellow-100' : '' }} {{ $user->email === Auth::user()->email ? 'bg-yellow-300 shadow-md' : '' }} duration-300 ease-in-out hover:bg-gray-100">
                            <td class="py-4 px-6 {{ $user->role == 'staff' ? 'flex justify-between items-center space-x-2' : '' }} whitespace-nowrap {{ $user->email === Auth::user()->email ? 'text-blue-500' : 'text-gray-500' }} font-light">
                                @if ($user->role === 'staff' && $user->email === Auth::user()->email)
                                    Yo
                                @else
                                    {{ $user->name }}
                                @endif
                                @if ($user->role === 'staff')
                                    <svg class="h-10 w-10 text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap {{ $user->email === Auth::user()->email ? 'text-orange' : 'text-gray-500' }} font-light">{{ $user->role }}</td>
                            <td class="py-4 px-6 whitespace-nowrap {{ $user->email === Auth::user()->email ? 'text-orange' : 'text-gray-500' }} font-light">{{ $user->phone }}</td>
                            <td class="py-4 px-6 whitespace-nowrap {{ $user->email === Auth::user()->email ? 'text-orange' : 'text-gray-500' }} font-light">{{ $user->email }}</td>
                            <td class="py-4 px-6 whitespace-nowrap {{ $user->email === Auth::user()->email ? 'text-orange' : 'text-gray-500' }} font-light">{{ $user->created_at }}</td>
                            <td id="actions" class="py-4 px-6 whitespace-nowrap flex space-x-2 items-center">
                                <a href="/users?edit_user={{ base64_encode(encodeData($user)) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                                    Editar
                                </a>
                                <a href="{{ url('/users/delete/'.$user->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                                    Borrar
                                </a>
                                <div class="toggle-wrapper blue">
                                    <input class="checkbox toggle-checkbox" id="{{ $user->id }}" {{ $user->activated ? 'checked' : '' }} type="checkbox">
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
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('tbody tr').forEach((row, index) => {
            setTimeout(() => {
                row.classList.add('loaded');
            }, index * 100);
        });
    });
</script>
