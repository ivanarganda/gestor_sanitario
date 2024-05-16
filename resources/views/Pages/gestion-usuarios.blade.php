@include('../Layouts/header')
<style>
    .toggle-wrapper {
        display: inline-block;
        position: relative;
        border-radius: 3.125em;
        overflow: hidden;
    }
    .toggle-checkbox {
        -webkit-appearance: none;
        appearance: none;
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        border-radius: inherit;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    .toggle-container {
        display: flex;
        position: relative;
        border-radius: inherit;
        width: 2.5em;
        height: 1.25em;
        background-color: #d1d4dc;
        /* box-shadow:
            inset .0625em 0 0 #d4d2de,
            inset -.0625em 0 0 #d4d2de,
            inset .125em .25em .125em .25em #ffffff; */
        mask-image: radial-gradient(#fff, #000);
        transition: all .4s;
        
        .toggle-wrapper.blue > .toggle-checkbox:checked + & {
            background-color: #4588ff;
            box-shadow:
            inset .0625em 0 0 #4588ff,
            inset -.0625em 0 0 #4588ff,
            inset .125em .25em .125em .25em #3952f3;
        }
    }
    .toggle-ball {
        position: relative;
        border-radius: 50%;  
        width: 1.25em;
        height: 1.25em;
        background-image:
            radial-gradient(rgba(#fff, .6), rgba(#fff, 0) 16%),
            radial-gradient(#d2d4dc, #babac2);
        background-position: -.25em -.25em;
        background-size: auto, calc(100% + .25em) calc(100% + .25em);
        background-repeat: no-repeat;
        box-shadow:
            .25em .25em .25em #8d889e,
            inset .0625em .0625em .25em #d1d1d6,
            inset -.0625em -.0625em .25em #8c869e;
        transition: transform .4s, box-shadow .4s;
    
        &::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            background-position: -.25em -.25em;
            background-size: auto, calc(100% + .25em) calc(100% + .25em);
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity .4s;
        }
    
        .toggle-wrapper > .toggle-checkbox:checked + .toggle-container > &::after {
            opacity: 1;
        }
        
        .toggle-checkbox:checked + .toggle-container > & {
            transform: translateX(100%);
        }
    }
</style>
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
    <div id="modal_usuarios">
        @include('../Form/modal-usuario')
    </div>
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
            <input type="button" onclick="window.location='/users?create_user=true'" id="addUser" value="Añadir usuario" class="cursor-pointer bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">    
            </input>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table id="table-users" class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr rowspan=6>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grupo/Rol</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefono</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de creacion</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $key => $user)
                    @if($user->role === 'staff')
                        @continue
                    @endif
                    <tr>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->role }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->phone }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->created_at }}</td>
                        <td rowspan="1" id="actions" class="py-4 px-6 whitespace-nowrap space-x-5 flex flex-row justify-start items-center">
                            <a href="/users?edit_user={{base64_encode(encodeData($user))}}">
                                <span class="cursor-pointer bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</span>
                            </a>
                            <span class="cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</span>
                            <div class="toggle-wrapper blue">  
                                <input class="checkbox toggle-checkbox" id="{{$user->id}}" {{$user->activated == '0' ? '' : 'checked'}} value="{{$user->activated}}" type="checkbox">
                                <div class="toggle-container">
                                    <div class="toggle-ball"></div>
                                </div>
                            </div>
                        </td>
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