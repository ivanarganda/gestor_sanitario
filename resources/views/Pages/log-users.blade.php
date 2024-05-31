@include('../Layouts/header')
@include('../Helpers/commonMethods')
<div class="container mx-auto py-8">
    @php
        echo generateTitleSection('Sesiones de usuarios');
    @endphp
    <!-- Filter Form -->
    <div class="flex w-full flex-col lg:items-center lg:ml-16 lg:flex-row lg:justify-center space-y-3 lg:space-y-0 space-x-3 mt-4 mb-5">
        <div class="lg:m-auto flex flex-row pl-3 lg:pl-0 justify-center w-full lg:w-full">
            {!!generateSearch('/sessions' , $search)!!}
        </div>
    </div>

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
                @foreach($sessions as $session)
                    <tr class="transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="py-4 px-6 whitespace-nowrap capitalize">{{ $session->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $session->ip_address }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ formatDate($session->login_time) }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ formatDate($session->logout_time) }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ calculateTotalTime($session->login_time, $session->logout_time) }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $session->status }}</td>
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
