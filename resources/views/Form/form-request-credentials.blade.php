<form method="POST" action="/users/create" class="m-auto mb-8 bg-white p-6 rounded-lg shadow-md transition">
    @csrf
    <div class="grid grid-cols-1 gap-4 w-full">
        <input type="hidden" id="typeForm" value="register" />
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Seleccione el tipo de solicitud</label>
            <select required id="modal_select_rol" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value=""></option>
                <option value="change_pass">Cambio contraseña</option>
                <option value="change_user">Cambio de usuario</option>
                <option value="change_group">Cambio de grupo</option>
            </select>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Usuario</label>
            <input required type="text" name="name" id="name" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
            <label for="request_email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="request_email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div>
            <label for="request_content" class="block text-sm font-medium text-gray-700">Describe la solicitud</label>
            <textarea name="message" id="request_change_content" required class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm" ></textarea>
        </div>
    </div>
    <div class="flex justify-around space-x-3 mt-10">
        <input type="submit" value="Enviar solicitud" class="cursor-pointer bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
        </input>
    </div>
</form>