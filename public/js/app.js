
// Botones de acceso tanto de administrador como de medicos o enfermeros

const accessButtons = document.querySelectorAll("#access_buttons div button");
const button_back_access = $("#arrow_button_back_access");

// Filtro de usuario de la tabla de sesiones
const user_input = document.querySelector("#user_name");

// Boton agregar usuario que crea el modal
const boton_crear_usuario = document.querySelector("#addUser");

accessButtons.forEach(button => {
    $(button).on('click',(event)=>{
        event.preventDefault();
        // Le asignamos el valor del input access
        $("#access").val( $("#"+event.target.id).data('value') );
        $("#input_labels").show();
        $("#access_buttons").hide();
    })
});

$(button_back_access).on('click',(event)=>{
    event.preventDefault();
    $("#access").val('');
    $("#input_labels").hide();
    $("#access_buttons").show();
    $("#message_errors").hide();
})

$(boton_crear_usuario).on('click',( event )=>{
    event.preventDefault();
    // Retrieve the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Generate the form HTML with the CSRF token
    $("#modal_gestion_usuarios").html(`
        <form method="POST" action="/users/create" class="w-1/4 mb-8 bg-white p-6 m-auto rounded-lg shadow-md">
            <input type="hidden" name="_token" value="${csrfToken}">
            <div class="grid grid-cols-1 flex flex-col space-y-4 w-full">
                <div>
                    <label for="name" class="block w-full text-sm font-medium text-gray-700">Asignar grupo/rol</label>
                    <select required id="modal_select_rol" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value=""></option>
                        <option value="user">Usuario</option>
                        <option value="enfermero">Enfermero</option>
                        <option value="medico">Médico</option>
                    </select>
                </div>
                <div>
                    <label for="name" class="block w-full text-sm font-medium text-gray-700">Usuario</label>
                    <input required type="text" name="name" id="name" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="password" class="block w-full text-sm font-medium text-gray-700">Contraseña</label>
                    <input required type="password" name="password" id="password" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="email" class="block w-full text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" id="email" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="phone" class="block w-full text-sm font-medium text-gray-700">Phone number</label>
                    <input type="text" name="phone" id="phone" pattern="^(\(\d{3}\)\s?|\d{3}[-.\s]?)?\d{3}[-.\s]?\d{4}$" title="Please enter a valid phone number" id="email" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div id="input_label_colegiate" hidden>
                    <label for="colegiate" class="block w-full text-sm font-medium text-gray-700">NºColegiado</label>
                    <input type="text" name="colegiate" id="colegiate" class="pr-2 outline-none mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>
            <div class="flex justify-around space-x-3 mt-10">
                <button id="modal_boton_cancelar" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
                <button id="modal_boton_crear_usuario" type="submit" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Crear
                </button>
            </div>
        </form>
    `);

    const input_email = document.querySelector('input[name="email"]');

    input_email.addEventListener('input', (event) => {
        let data = new FormData();
        data.append('email', event.target.value);
    
        fetch( window.location.protocol + '://' + window.location.host + '/api/users', {
            method: 'POST',
            mode: 'cors',
            body: data,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(res => {
            if (res.exist) {
                $(input_email).css('border', '1px solid red');
            } else {
                $(input_email).css('border', '0.5px solid #F5F5F5').css('box-shadow', '0 0 2px 0 #F5F5F5');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    $("#modal_select_rol").on('change',( event )=>{
        if ( event.target.value === 'enfermero' || event.target.value === 'medico' ){
            $("#input_label_colegiate").prop('hidden',false);
        } else {
            $("#input_label_colegiate").prop('hidden',true);
        }
    })

    $("#modal_boton_cancelar").on('click', ()=>{
        $("#modal_gestion_usuarios").html('');
    }); 

})