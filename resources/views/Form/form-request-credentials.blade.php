<form method="POST" action="/form_request_credentials/create" class="max-w-lg mx-auto bg-white p-10 rounded-lg shadow-lg">
    @csrf
    <input type="hidden" id="typeForm" value="register" />
    <input type="hidden" name="emisor" value="{{Auth::user()->id}}">

    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Solicitud de Credenciales</h2>

    <div class="mb-4">
        <label for="role" class="block text-sm font-medium text-gray-700">Tipo de solicitud</label>
        <select required id="modal_select_rol" name="request_type" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
            <option value=""></option>
            <option value="change_password">Cambio de contraseña</option>
            <option value="change_name_user">Cambio de nombre de usuario</option>
            <option value="change_role">Cambio de grupo</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="request_email" class="block text-sm font-medium text-gray-700">Administrador</label>
        <select required id="modal_select_destinatary" name="destinatary" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
            <option value=""></option>
            @foreach ($resultsAdmin as $result)
                <option value="{{$result->id}}">{{$result->email}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" name="title" required placeholder="Describe your request here" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
    </div>

    <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea name="description" rows="5" required placeholder="Describe your request here" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition"></textarea>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Enviar solicitud</button>
    </div>
</form>
