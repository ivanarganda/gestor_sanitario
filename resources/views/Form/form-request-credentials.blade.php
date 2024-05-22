<form method="POST" action="/form_request_credentials/create" class="bg-white p-8 rounded-lg shadow-md transition transform">
    @csrf
    <input type="hidden" id="typeForm" value="register" />
    <div class="grid grid-cols-1 gap-6">
        <input type="hidden" name="emisor" value="{{Auth::user()->id}}">
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Tipo de solicitud</label>
            <select required id="modal_select_rol" name="request_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-md focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                <option value=""></option>
                <option value="change_password">Cambio de contraseña</option>
                <option value="change_name_user">Cambio de nombre de usuario</option>
                <option value="change_role">Cambio de grupo</option>
            </select>
        </div>
        <div>
            <label for="request_email" class="block text-sm font-medium text-gray-700">Administrador</label>
            <select required id="modal_select_rol" name="destinatary" class="mt-1 block w-full border-gray-300 rounded-md shadow-md focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                <option value=""></option>
                @foreach ( $resultsAdmin as $result )
                    <option value="{{$result->id}}">{{$result->email}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="request_content" class="block text-sm font-medium text-gray-700">Titulo</label>
            <input type="text" name="title" required placeholder="Describe your request here" class="mt-1 block w-full border-gray-300 rounded-md shadow-md focus:border-blue-500 focus:ring focus:ring-blue-200 transition"></textarea>
        </div>
        <div>
            <label for="request_content" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" rows="10" required placeholder="Describe your request here" class="mt-1 block w-full border-gray-300 rounded-md shadow-md focus:border-blue-500 focus:ring focus:ring-blue-200 transition"></textarea>
        </div>
    </div>
    <div class="flex justify-around mt-8">
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow transition transform hover:scale-105">Enviar solicitud</button>
    </div>
</form>