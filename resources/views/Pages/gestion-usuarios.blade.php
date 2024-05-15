@include('../Layouts/header')
<div class="container mx-auto py-8">
    <div class="flex space-x-10 justify-center p-2">
        <a href="{{url('/')}}">
            <svg class="h-8 w-8 pt-2 text-center text-zinc-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold mb-8 text-center">Sesiones del usuario</h1>
    </div>
    <div id="modal_gestion_usuarios"></div>
    <!-- Filter Form -->
    <form method="GET" action="{{ route('users') }}" class="w-1/4 mb-8 bg-white p-6 m-auto rounded-lg shadow-md">
        <div class="grid grid-cols-1 w-full">
            <div>
                <label for="user_name" class="block w-full text-sm font-medium text-gray-700">Usuario</label>
                <input type="text" name="user_name" id="user_name" value="{{ request('user_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>
        <div class="flex justify-around space-x-3 mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filtrar
            </button>
            <button type="submit" id="addUser" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Añadir usuario
            </button>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grupo/Rol</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefono</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de creacion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->role }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->phone }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-12">
            {!!$pagination!!}
        </div>
    </div>
</div>
@include('../Layouts/footer')