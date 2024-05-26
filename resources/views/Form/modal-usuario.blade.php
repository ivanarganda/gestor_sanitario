@if (isset($_GET['create_user']))
    <form method="POST" action="/users/create" class="max-w-lg mx-auto mb-8 bg-white p-6 rounded-lg shadow-md transition">
        @csrf
        <div class="grid grid-cols-1 gap-4 w-full">
            <input type="hidden" id="typeForm" value="register" />
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Asignar grupo/rol</label>
                <select required id="modal_select_rol" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value=""></option>
                    <option value="user">Empleado</option>
                    <option value="enfermero">Enfermero</option>
                    <option value="medico">Médico</option>
                    <option value="staff">Administrador</option>
                </select>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Usuario</label>
                <input required type="text" name="name" id="name" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input required type="password" name="password" id="password" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="phone" id="phone" pattern="^(\(\d{3}\)\s?|\d{3}[-.\s]?)?\d{3}[-.\s]?\d{4}$" title="Please enter a valid phone number" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div id="input_label_colegiate" hidden>
                <label for="colegiate" class="block text-sm font-medium text-gray-700">Nº Colegiado</label>
                <input type="text" name="colegiate" id="colegiate" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>
        <div class="flex justify-around space-x-3 mt-10">
            <input onclick="window.location='/users'" value="Cancelar" type="button" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
            </input>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                Crear
            </button>
        </div>
    </form>
    @endif

    @if (isset($_GET['edit_user']))
        @php 
            $data_user = json_decode(base64_decode($_GET['edit_user']));
        @endphp
        <form method="POST" action="/users/update/{{$data_user->id}}" class="max-w-lg mx-auto mb-8 bg-white p-6 rounded-lg shadow-md transition">
            @csrf
            <div class="grid grid-cols-1 gap-4 w-full">
                <input type="hidden" id="typeForm" value="edit" />
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Asignar grupo/rol</label>
                    <select required id="modal_select_rol" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value=""></option>
                        <option value="user" {{$data_user->role == "user" ? 'selected' : ''}}>Empleado</option>
                        <option value="enfermero" {{$data_user->role == "enfermero" ? 'selected' : ''}}>Enfermero</option>
                        <option value="medico" {{$data_user->role == "medico" ? 'selected' : ''}}>Médico</option>
                        <option value="staff" {{$data_user->role == "staff" ? 'selected' : ''}}>Administrador</option>
                    </select>
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Usuario</label>
                    <input required type="text" name="name" value="{{$data_user->name}}" id="name" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input required type="password" value="{{base64_decode($data_user->password)}}" name="password" id="password" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{$data_user->email}}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{$data_user->phone}}" pattern="^(\(\d{3}\)\s?|\d{3}[-.\s]?)?\d{3}[-.\s]?\d{4}$" title="Please enter a valid phone number" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div id="input_label_colegiate" hidden>
                    <label for="colegiate" class="block text-sm font-medium text-gray-700">Nº Colegiado</label>
                    <input type="text" name="colegiate" id="colegiate" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>
            <div class="flex justify-around space-x-3 mt-10">
                <input onclick="window.location='/users'" value="Cancelar" type="button" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                </input>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300 transform hover:scale-105">
                    Guardar
                </button>
            </div>
        </form>
    @endif

