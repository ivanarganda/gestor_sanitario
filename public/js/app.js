
// Botones de acceso tanto de administrador como de medicos o enfermeros

const accessButtons = document.querySelectorAll("#access_buttons div button");
const button_back_access = $("#arrow_button_back_access");

// Filtro de usuario de la tabla de sesiones
const user_input = document.querySelector("#user_name");

// Acciones del modal de formulario crear o editar usuarios
const boton_abrir_modal_crear_usuario = document.querySelector("#addUser");
const boton_cerrar_modal_crear_usuario = document.querySelector("#modal_boton_cancelar");

accessButtons.forEach(button => {
    $(button).on('click', (event) => {
        event.preventDefault();
        // Le asignamos el valor del input access
        $("#access").val($("#" + event.target.id).data('value'));
        $("#input_labels").show();
        $("#access_buttons").hide();
    })
});

$(button_back_access).on('click', (event) => {
    event.preventDefault();
    $("#access").val('');
    $("#input_labels").hide();
    $("#access_buttons").show();
    $("#message_errors").hide();
})

const input_email = document.querySelector('input[name="email"]');

input_email.addEventListener('input', (event) => {
    let data = new FormData();
    data.append('email', event.target.value);

    if ( window.location.host.includes('localhost') ){
        window.location.host = window.location.host.replace('localhost', '127.0.0.1');
    }

    fetch('http://localhost:8000/api/users', {
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

$("#modal_select_rol").on('change', (event) => {
    if (event.target.value === 'enfermero' || event.target.value === 'medico') {
        $("#input_label_colegiate").prop('hidden', false);
    } else {
        $("#input_label_colegiate").prop('hidden', true);
    }
})

$(boton_cerrar_modal_crear_usuario).on('click', (event) => {
    event.preventDefault();
    $("#modal_crear_usuarios").prop('hidden', true);
});

$(boton_abrir_modal_crear_usuario).on('click', (event) => {
    event.preventDefault();
    window.location='/users?create_user=true';
    
})