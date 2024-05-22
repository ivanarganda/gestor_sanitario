<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="flex justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white text-center py-4 px-6">
                <h4 class="text-lg font-semibold">User Credentials</h4>
                <p class="mt-2">Hola {{$data->email}}, bienvenido. Aquí debajo tiene las credenciales para poder iniciar sesión en la plataforma:</p>
                <span class="block mt-2 text-gray-300">{{ request()->getSchemeAndHttpHost() }}/login</span>
            </div>
            <div class="bg-white p-6">
                <ul class="divide-y divide-gray-200">
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <strong>Email:</strong> {{ $data->email }}
                        </div>
                        <div>
                            <strong>Password:</strong> {{ $data->password }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
