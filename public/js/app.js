const accessButtons = document.querySelectorAll("#access_buttons div");
const accessButtonsSpan = document.querySelectorAll("#access_buttons div span");
const button_back_access = $("#arrow_button_back_access");

// Filtro de usuario de la tabla de sesiones
const user_input = document.querySelector("#user_name");

// Acciones del modal de formulario crear o editar usuarios
const boton_abrir_modal_crear_usuario = document.querySelector("#addUser");
const boton_cerrar_modal_crear_usuario = document.querySelector("#modal_boton_cancelar");

// Notificaciones badget solicitud credenciales administrador
const badget_notification = document.querySelector("#badget_notification");
const badget_text_notification = document.querySelector("#badget_text_notification");

// Botones de las solicitudes ( Mas detalles , aprobar o denegar )
const botones_accion_detalles_notificacion = document.querySelectorAll("#botones_accion_detalles_notificacion");

// Coger todos los checkboxes de las acciones de la tabla de usuarios
const checkboxes = document.querySelectorAll("#table-users tbody tr #actions .checkbox");
const loadNotifications = async () => {
    try {
        let response = await fetch(`${window.location.protocol}//${window.location.host}/api/notifications/${$("#badget_id_admin").text()}`, {
            method: 'GET',
            mode: 'cors',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        let data = await response.json();

        new Promise((resolve, reject) => {
            resolve(data);
        }).then( (data) =>{
            if (badget_text_notification) {
                console.log( data );
                if ( data.notifications[0]?.notifications === 0 || data.notifications.length === 0 ) {
                    $(badget_notification).hide();
                } else {
                    $(badget_notification).show();
                    $(badget_text_notification).html(data.notifications[0]?.notifications); 
                }
                
            } else {
                console.error("Element with ID 'badget_notification' not found.");
            }
        })
    } catch (error) {
        console.error('Error loading notifications:', error);
    }
}

const svgAccess = {
    "buttonAccessAdmin": `<svg class="h-20 w-20 mx-auto pt-4 text-center" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Admin Access">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M3 21v-4a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4" />
                            <circle cx="12" cy="7" r="4" />
                          </svg>`,
    "buttonAccessMEDATS": `<svg class="h-20 w-20 mx-auto pt-4 text-center" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="MEDATS Access">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M10 12l2 -2m0 0l2 -2m-2 2l2 2m-2 -2l-2 2m5 2v4h4a1 1 0 0 0 1 -1v-3a1 1 0 0 0 -1 -1h-4z" />
                            <path d="M14 15v4a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1z" />
                            <path d="M14 8v-2a2 2 0 1 0 -4 0v2" />
                          </svg>`,
    "buttonAccessUser": `<svg class="h-20 w-20 mx-auto pt-4 text-center" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="User Access">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M5 7a2 2 0 1 1 4 0a2 2 0 1 1 -4 0" />
                            <path d="M5 21v-4a4 4 0 0 1 4 -4h6a4 4 0 0 1 4 4v4" />
                            <circle cx="12" cy="7" r="4" />
                          </svg>`
};

const backgroundAccess = {
    "buttonAccessAdmin": "bg-yellow-400",
    "buttonAccessMEDATS": "bg-green-400",
    "buttonAccessUser": "bg-blue-400"
};

const iconAccess = {
    "buttonAccessAdmin": "bg-yellow-600",
    "buttonAccessMEDATS": "bg-green-600",
    "buttonAccessUser": "bg-blue-600"
};

const loadButtons = (elements) => {
    $("#input_labels").hide();
    elements.forEach(button => {
        $(button).on('click', (event) => {
            event.preventDefault();
            const buttonId = button.id;
            
            // Assign the value of the input access
            $("#access").val($(button).data('value'));
            $("#svgAccess").val(svgAccess[buttonId]);
            $("#inputs_labels__title").html(svgAccess[buttonId]).removeClass().addClass(`w-24 h-24 m-auto mb-8 ${iconAccess[buttonId]}`);
            $("#input_labels__image").removeClass().addClass(`w-full ${backgroundAccess[buttonId]}`);
            $("#bg-title").val(iconAccess[buttonId]);
            $("#bg-image").val(backgroundAccess[buttonId]);
            $("#input_labels").slideDown();
            $("#input_labels__image").show();
            // $("#access_buttons").hide();
        });
    });
}

loadButtons( accessButtons );
loadButtons( accessButtonsSpan );

$(button_back_access).on('click', (event) => {
    event.preventDefault();
    $("#access").val('');
    $("#input_labels").slideUp();
    $("#input_labels__image").hide().removeClass();
    $("#access_buttons").show();
    $("#message_errors").hide();
    $("#alert").hide();
    loadButtons( accessButtons );
    loadButtons( accessButtonsSpan );
    
});

const input_email = document.querySelector('#email');

if (input_email) {
    input_email.addEventListener('keyup', (event) => {
        let typeForm = document.querySelector("#typeForm").value;
        let data = new FormData();
        data.append('email', event.target.value);

        fetch(`${window.location.protocol}/api/users`, {
            method: 'POST',
            mode: 'cors',
            body: data,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(res => {
            if (!res.exist && typeForm == 'register') {
                $(input_email).css('border', '0.5px solid #F5F5F5').css('box-shadow', '0 0 2px 0 #F5F5F5');
            } else if (res.exist && typeForm == 'login') {
                $(input_email).css('border', '0.5px solid #F5F5F5').css('box-shadow', '0 0 2px 0 #F5F5F5');
            } else if (res.exist && typeForm == 'register') {
                $(input_email).css('border', '1px solid red');
            } else if (!res.exist && typeForm == 'login') {
                $(input_email).css('border', '1px solid red');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
}

$("#modal_select_rol").on('change', (event) => {
    if (event.target.value === 'enfermero' || event.target.value === 'medico') {
        $("#input_label_colegiate").prop('hidden', false);
    } else {
        $("#input_label_colegiate").prop('hidden', true);
    }
});

$(boton_cerrar_modal_crear_usuario).on('click', (event) => {
    event.preventDefault();
    $("#modal_crear_usuarios").prop('hidden', true);
});

$(boton_abrir_modal_crear_usuario).on('click', (event) => {
    event.preventDefault();
    window.location = '/users?create_user=true';
});

checkboxes.forEach((checkbox, pos) => {
    $(checkbox).on('change', (event) => {
        event.preventDefault();
        let user_id = event.target.id;
        let value_checkbox = '0';
        if (event.target.checked) {
            value_checkbox = '1';
        }
        console.log( value_checkbox );
        let data = new FormData();
        data.append('id', user_id);
        data.append('value_checkbox', value_checkbox);
        fetch(`${window.location.protocol}/api/users/changeStatus`, {
            method: 'POST',
            mode: 'cors',
            body: data,
            headers: {
                'Accept': 'application/json'
            }
        });
    });
});

// Load notifications from administrator
if ( badget_notification ) {
    setInterval(()=>loadNotifications(),1500);
}

// Map all actions notifications buttons
if ( botones_accion_detalles_notificacion ){
    botones_accion_detalles_notificacion.forEach((button, pos) => {
        $(button).on('click', (event) => {
            event.preventDefault();
            let status = 'aprobado';
            let request_id = $(`#${event.target.id}`).data('value');
            if ( event.target.id.includes('boton_notificacion_denegar') ){
                status = 'denegado';
            }
            const data = new FormData();
            data.append('request_id', request_id);
            data.append('status', status);
            
            fetch(window.location.protocol + '/api/inbox/changeStatus', {
                method: 'POST',
                body:data
            })
            .then(response => response.json())
            .then(data => {
                // Una vez cambiado, se le envia un correo al solicitante sobre el estado de la solicitud
                var jsonData = {
                    'type':'messageAboutChangesNotification',
                    'email':$('#email_soliciter').text(),
                    'destinatary':$('#email_soliciter').text(),
                    'emisor':$('#email_admin').text(),
                    'title':$('#title').text(),
                    'message':$('#message').text(),
                    'id':$('#identity').text(),
                    'status':status,
                };
            
                const json_data = new FormData();
                json_data.append('data', JSON.stringify(jsonData));  // Serialize the JSON data to a string
            
                fetch(window.location.protocol + '/api/sendEmail', {
                    method: 'POST',
                    body: json_data
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    window.location = '/request-changed/' + status + '//';
                })
                .catch((error) => {
                    console.log(error);
                    window.location = '/request-changed/' + status + '/'+error+'/';
                });
            }).catch(( error ) => {
                console.log( error );
            });
        });
    });
}