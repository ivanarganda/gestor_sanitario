@include('../Layouts/header')
@include('../Helpers/commonMethods')

<div class="container mx-auto py-8">
    <div class="flex items-center justify-center p-2 mb-8">
        <a href="{{ url('/') }}" class="flex items-center text-gray-600 hover:text-gray-800">
            <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold ml-4">Sesiones del usuario</h1>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('sessions') }}" class="max-w-lg mx-auto mb-8 bg-white p-6 rounded-lg shadow-md transform transition duration-500 hover:scale-105 hover:shadow-lg">
        <div class="mb-4">
            <label for="user_name" class="block text-lg font-medium text-gray-700">Usuario</label>
            <input type="text" name="user_name" id="user_name" value="{{ request('user_name') }}" class="outline-none mt-1 block text-gray-400 font-bold w-full border-gray-700 rounded-md shadow-md focus:ring-blue-500 focus:border-blue-500 transition duration-300">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                Filtrar
            </button>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Acceso desde</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Fecha de acceso</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Fecha de cierre de sesion</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Total conectado</th>
                    <th class="py-3 px-6 text-left text-md font-medium text-gray-500 uppercase tracking-wider">Estado de la sesión</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr class="transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->ip_address }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ formatDate($user->login_time) }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ formatDate($user->logout_time) }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ calculateTotalTime($user->login_time, $user->logout_time) }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ getStatusSession($user->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-8 flex justify-center space-x-2">
            {!! $pagination !!}
        </div>
    </div>
</div>

@include('../Layouts/footer')

<style>
    /* Estilos para animar la carga de las filas de la tabla */
    tbody tr {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    tbody tr:hover {
        background-color: #f9fafb;
    }
    tbody tr.loaded {
        opacity: 1;
        transform: translateY(0);
    }

    /* Estilos para animar los botones de paginación */
    .pagination a {
        display: inline-block;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 0.375rem;
        background-color: #f3f4f6;
        color: #374151;
        font-weight: 500;
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    .pagination a:hover {
        background-color: #3b82f6;
        color: #ffffff;
    }
    .pagination .active a {
        background-color: #3b82f6;
        color: #ffffff;
    }

    .pagination-link {
        display: inline-block;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 0.375rem;
        background-color: #f3f4f6;
        color: #374151;
        font-weight: 500;
        transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
        text-decoration: none;
    }

    .pagination-link:hover {
        background-color: #3b82f6;
        color: #ffffff;
        transform: scale(1);
    }

    .pagination-link.active {
        background-color: #3b82f6;
        color: #ffffff;
    }

    .pagination-link.disabled {
        background-color: #e5e7eb;
        color: #9ca3af;
        cursor: not-allowed;
    }

</style>

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
