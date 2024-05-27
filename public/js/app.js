// Seccion search
const input_search = document.querySelector('#value_search');

// Selección de elementos
const accessButtons = document.querySelectorAll("#access_buttons div");
const accessButtonsSpan = document.querySelectorAll("#access_buttons div span");
const button_back_access = $("#arrow_button_back_access");

// Inputs form login
const inputsForm = document.querySelector("#input_labels__inputs");

// Filtro de usuario de la tabla de sesiones
const user_input = document.querySelector("#user_name");

// Acciones del modal de formulario crear o editar usuarios
const boton_abrir_modal_crear_usuario = document.querySelector("#addUser");
const boton_cerrar_modal_crear_usuario = document.querySelector("#modal_boton_cancelar");

// Notificaciones badge solicitud credenciales administrador
const badget_notification = document.querySelector("#badget_notification");
const badget_text_notification = document.querySelector("#badget_text_notification");

// Botones de las solicitudes (Mas detalles, aprobar o denegar)
const botones_accion_detalles_notificacion = document.querySelectorAll("#botones_accion_detalles_notificacion");
const botones_mas_detalles = document.querySelectorAll(".botones_mas_detalles");
const botones_restaurar = document.querySelectorAll(".botones_restaurar");
const botones_reciclar = document.querySelectorAll(".botones_reciclar");

// Checkbox de las notificaciones de administrador
const checkbox_requestes = document.querySelectorAll(".checkbox_requestes");

// Todos los checkboxes de las acciones de la tabla de usuarios
const checkboxes = document.querySelectorAll("#table-users tbody tr #actions .checkbox");

// Botones de contacto mis solicitudes
const botones_nuevo_chat_administrador = document.querySelectorAll(".botones_nuevo_chat");

// Chatbox 
const chatBox = document.querySelector("#myChats");

// Animación de carga
const loadAnimation = (type, element, styles) => {
    if (type === "swing") {
        element.animate(styles, {
            duration: 500,
            easing: 'swing',
        });
    }
};

// Enviar correo
const sendEmail = ( type , data ) => {

    const json_data = new FormData();
    json_data.append('data', JSON.stringify(data));

    fetch(window.location.protocol + '/api/sendEmail', {
        method: 'POST',
        body: json_data
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if ( type == 'aprobarODenegar' ) {
            window.location = '/request-changed/' + data.status + '/-1/';
        } else if ( type == 'masDetalles' ) {
            return true;
        } else {
            console.log( data );
            window.location = '/contacted_with_administrator';
        }
    })
    .catch((error) => {
        console.log(error);
        if ( type == 'aprobarODenegar' ) {
            window.location = '/request-changed/' + data.status + '/' + error + '/';
        } else if ( type == 'masDetalles' ) {
            return true;
        } else {
            console.log( data );
            window.location = '/contacted_with_administrator/error';
        }
        
    });
}

const openChatRoom = async( destinatary ) =>{
    try {
        let response = await fetch(`${window.location.protocol}//${window.location.host}/api/requestes/chatroom/in/${destinatary}`, {
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
        return new Promise((resolve) => {
            resolve(data);
        });
        
    } catch (error) {
        console.error('Error loading chatbox' + error);
        return true;    
    }
    
}

// Open chatbox
const openChatBox = async() => {
    try {
        let response = await fetch(`${window.location.protocol}//${window.location.host}/api/requestes/chat/in`, {
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

        return new Promise((resolve) => {
            resolve(data);
        });

    } catch (error) {
        console.error('Error loading chatbox' + error);
        return true;
    }
}

// Cargar notificaciones
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

        new Promise((resolve) => {
            resolve(data);
        }).then((data) => {
            if (badget_text_notification) {
                console.log(data);
                if (data.notifications[0]?.notifications === 0 || data.notifications.length === 0) {
                    $(badget_notification).hide();
                } else {
                    $(badget_notification).show();
                    $(badget_text_notification).html(data.notifications[0]?.notifications);
                }
            } else {
                console.error("Element with ID 'badget_notification' not found.");
            }
        });
    } catch (error) {
        console.error('Error loading notifications:', error);
    }
};

// Iconos y colores de acceso
const svgAccess = {
    "buttonAccessAdmin": `<svg class="h-20 w-20 mx-auto pt-4 text-center" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Admin Access"><path stroke="none" d="M0 0h24v24H0z"/><path d="M3 21v-4a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4" /><circle cx="12" cy="7" r="4" /></svg>`,
    "buttonAccessMEDATS": `<svg class="h-20 w-20 mx-auto pt-4 text-center" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="MEDATS Access"><path stroke="none" d="M0 0h24v24H0z"/><path d="M10 12l2 -2m0 0l2 -2m-2 2l2 2m-2 -2l-2 2m5 2v4h4a1 1 0 0 0 1 -1v-3a1 1 0 0 0 -1 -1h-4z" /><path d="M14 15v4a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1z" /><path d="M14 8v-2a2 2 0 1 0 -4 0v2" /></svg>`,
    "buttonAccessUser": `<svg class="h-20 w-20 mx-auto pt-4 text-center" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="User Access"><path stroke="none" d="M0 0h24v24H0z"/><path d="M5 7a2 2 0 1 1 4 0a2 2 0 1 1 -4 0" /><path d="M5 21v-4a4 4 0 0 1 4 -4h6a4 4 0 0 1 4 4v4" /><circle cx="12" cy="7" r="4" /></svg>`
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

// Cargar botones
const loadButtons = (elements) => {
    $("#input_labels").hide();
    elements.forEach(button => {
        $(button).on('click', (event) => {
            event.preventDefault();
            const buttonId = button.id;

            // Asignar valor del input access
            $("#access").val($(button).data('value'));
            $("#svgAccess").val(svgAccess[buttonId]);
            $("#inputs_labels__title").html(svgAccess[buttonId]).removeClass().addClass(`w-24 h-24 m-auto mb-8 ${iconAccess[buttonId]}`);
            $("#input_labels__image").removeClass().addClass(`w-full ${backgroundAccess[buttonId]}`);
            $("#bg-title").val(iconAccess[buttonId]);
            $("#bg-image").val(backgroundAccess[buttonId]);
            $("#input_labels").slideDown();
            $("#input_labels__image").show();
            $(window).scrollTop($(inputsForm).height() + $(accessButtons).height());
            loadAnimation('swing', $("#form_container"), { "marginTop": '-4rem' });
        });
    });
};

loadButtons(accessButtons);
loadButtons(accessButtonsSpan);

$(button_back_access).on('click', (event) => {
    event.preventDefault();
    $("#access").val('');
    $("#input_labels").slideUp();
    $("#input_labels__image").hide().removeClass();
    $("#access_buttons").show();
    $("#message_errors").hide();
    $("#alert").hide();
    loadAnimation('swing', $("#form_container"), { "marginTop": '10rem' });
    loadButtons(accessButtons);
    loadButtons(accessButtonsSpan);
});

// Validación de email
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

// Cambio de rol en el modal
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

// Cambiar estado de checkboxes
checkboxes.forEach((checkbox) => {
    $(checkbox).on('change', (event) => {
        event.preventDefault();
        let user_id = event.target.id;
        let value_checkbox = event.target.checked ? '1' : '0';
        console.log(value_checkbox);
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

// Cargar notificaciones de administrador
if (badget_notification) {
    let firstLoad = true;
    if ( firstLoad ){
        firstLoad = false;
        loadNotifications()
    } 
    setInterval(() => loadNotifications(), 3500);

    setTimeout(()=>{
        window.location.reload();
    }, 35000)
}

// Mapear acciones de botones de notificaciones
if (botones_accion_detalles_notificacion) {
    botones_accion_detalles_notificacion.forEach((button) => {
        $(button).on('click', (event) => {
            event.preventDefault();
            let status = 'aprobado';
            let request_id = $(`#identity`).text();
            if (event.target.id.includes('boton_notificacion_denegar')) {
                status = 'denegado';
            }
            const data = new FormData();
            data.append('request_id', request_id);
            data.append('status', status);

            fetch(window.location.protocol + '/api/inbox/changeStatus', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {

                var jsonData = {
                    'type': 'messageAboutChangesNotification',
                    'email': $('#email_soliciter').text(),
                    'destinatary': $('#email_soliciter').text(),
                    'emisor': $('#email_admin').text(),
                    'title': $('#title').text(),
                    'message': $('#message').text(),
                    'id': $('#identity').text(),
                    'status': status,
                };

                sendEmail( 'aprobarODenegar' , jsonData );

            })
            .catch((error) => {
                console.log(error);
            });
        });
    });
}
if ( botones_mas_detalles || botones_reciclar || botones_restaurar ){

    let currentPage = document.querySelector("#current_page");

    botones_mas_detalles.forEach(( boton ) =>{
        $(boton).on('click', (event) => {

            var jsonData = {
                'type': 'messageAboutChangesNotification',
                'email': $('#email_soliciter_' + event.target.id ).text(),
                'destinatary': $('#email_soliciter_' + event.target.id ).text(),
                'emisor': $('#email_admin_' + event.target.id ).text(),
                'title': $('#title_' + event.target.id ).text(),
                'message': $('#message_' + event.target.id ).text(),
                'id': $('#identity_' + event.target.id ).text(),
                'status': 'proceso',
            };

            $("#boton_delete_multiple_requestes").hide();
            $("#boton_restaure_multiple_requestes").hide();
    
            sendEmail( 'masDetalles' , jsonData );
            
            window.location = '/inbox/in/'+$("#identity_" + event.target.id).text();
        
        })
    })

    botones_restaurar.forEach(( boton )=>{

        console.log( boton.id );
        $(boton).click('click',(event)=>{
            const data = new FormData();
            data.append('request_id', $('#identity_' + event.target.id ).text());

            fetch(window.location.protocol + '/api/inbox/restaure', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                window.location = '/request-restaured/';
            })
            .catch((error) => {
                window.location = '/request-restaured/error';
            });
        })

    })

    botones_reciclar.forEach(( boton )=>{

        $(boton).click('click',(event)=>{

            let request_id = $('#identity_' + event.target.id).text();

            $("#modalBackdrop_confirm_deleete_solicitud").html(`
                <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <!-- Modal -->
                    <div class="bg-white rounded-lg shadow-lg w-96">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center border-b p-4">
                            <h3 class="text-xl font-semibold">Borrar solicitud ${$("#title_"+event.target.id).text()}</h3>
                            <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                                &times;
                            </button>
                        </div>
                        <!-- Modal Body -->
                        <div class="p-4">
                            <p class="text-gray-600">
                                ¿Seguro que quieres enviarlo a papelera de reciclaje?.
                            </p>
                            <div class="pt-2 flex flex-row items-center">
                                <input class="w-4 h-4 cursor-pointer border-gray-500 p-2" type="checkbox" id="option_delete_permanently" name="option_delete_permanently"/>
                                &nbsp;<label for="option_delete_permanently" class="text-gray-600">Eliminar permanentemente</label>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="flex justify-end border-t p-4">
                            <button id="cancelBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2 hover:bg-gray-600">
                                Cancelar
                            </button>
                            <button id="confirmBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Borrar
                            </button>
                        </div>
                    </div>
                </div>

            `);

            var delete_permanently = 'no';
            const closeModal = ()=>{
                $("#modalBackdrop_confirm_deleete_solicitud").html('');
            }
            $("#option_delete_permanently").on('change',()=>{
                if($("#option_delete_permanently").is(':checked')){
                    delete_permanently = 'si';
                } else {
                    delete_permanently = 'no';
                }
            })

            $("#cancelBtn").on('click',( event )=>{
                event.preventDefault();
                closeModal();
            })

            $("#closeModal").on('click',( event )=>{
                event.preventDefault();
                closeModal();
            })

            $("#confirmBtn").on('click',( event )=>{
                event.preventDefault();
                const data = new FormData();
                data.append('request_id', request_id );
                data.append('delete_permanently', delete_permanently);

                fetch(window.location.protocol + '/api/inbox/recycle', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    window.location = '/request-recycled/';
                })
                .catch((error) => {
                    window.location = '/request-recycled/error';
                });

            })

        })

    })
    
    
}

if ( checkbox_requestes ){
    var checkeds = [];
    var values = [];
    var items_selected = 0;
    checkbox_requestes.forEach((checkbox) => {
        checkeds.push( checkbox.checked );
        values.push( 0 );
    });
    checkbox_requestes.forEach((checkbox, index) => {
        $('#'+checkbox.id).on('change', (event) => {
            $("#boton_delete_multiple_requestes").hide();
            $("#boton_restaure_multiple_requestes").hide();
            if ( event.target.checked ){
                items_selected++;
                checkeds[index] = true;
                values[index] = event.target.value;
                $(event.target).parent().parent().addClass('bg-gray-200');
            } else {
                checkeds[index] = false;
                values[index] = 0;
                items_selected--;
                $(event.target).parent().parent().removeClass('bg-gray-200');
            }
            if ( !checkeds.every((ch) => ch === false) ){
                $("#boton_restaure_multiple_requestes").show();
                $("#boton_delete_multiple_requestes").show();
                $("#items_selected").text(items_selected);
            } 
        });
    });

    $("#boton_delete_multiple_requestes div #boton_delete").on('click', (event) => {
        event.preventDefault();
        const data = new FormData();
        data.append('requestes_id', values );
        fetch(window.location.protocol + '/api/inbox/multipledelete', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            console.log( data );
            window.location = '/requestes-deleted/';
        })
        .catch((error) => {
            window.location = '/requestes-deleted/error';
        });
    });
    $("#boton_restaure_multiple_requestes div #boton_delete").on('click', (event) => {
        event.preventDefault();
        const data = new FormData();
        data.append('requestes_id', values );
        fetch(window.location.protocol + '/api/inbox/multiplerestaure', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            console.log( data );
            window.location = '/requestes-restaured/';
        })
        .catch((error) => {
            window.location = '/requestes-restaured/error';
        });
    });
}

if ( input_search ){

    const url_search = document.querySelector('#url_search');
    const btn_search = document.querySelector('#btn_search');
    const param = window.location.search;

    $(btn_search).on('click',()=>{
        if ( param.includes('?trash=true') ){
            window.location = url_search.value.replace(param,'') + '/' + input_search.value + param;
        } else{
            window.location = url_search.value + '/' + input_search.value;
        }
    })

}

if ( chatBox ){

    $('#myChats').hide();
    $('#chatRoom').hide();

    // $('#myChats').hide();
    const boton_chatbox = document.querySelector('#boton_chatbox');
    $(boton_chatbox).on('click',()=>{
        $('#myChats').fadeToggle();
    });

    openChatBox()
    .then((data) => {
        let json_data = data.data;
        let content = `<div class="h-full w-full overflow-auto rounded-md">
                    <div class="w-full h-full container mx-auto">
            <div class="w-full h-full bg-white shadow-md rounded-lg overflow-hidden">`;
        content+=`<div class="w-full flex flex-row justify-between p-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Chats</h2>
                <span id='close_chat_box' class="text-xl font-semibold text-gray-800">x</h2>
            </div><ul class="chats_li divide-y divide-gray-200">`
        if (json_data.length === 0) {
            content+=`<li class="p-4 hover:bg-gray-100 cursor-pointer flex items-center">No tienes chats</li>
                    </ul>
                    </div>
                </div>
            </div>`;
            $('#myChats').html(`${content}`);
            return false;
        }
        json_data.forEach(( element )=>{
            console.log( element );
            content+=`<li id='${element.destinatary}' class="list_chats p-4 hover:bg-gray-100 cursor-pointer flex items-center">
                <div id='${element.destinatary}' class="flex-shrink-0">
                    <img id='${element.destinatary}' class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="User Avatar">
                </div>
                <div id='${element.destinatary}' class="ml-3">
                    <p id='${element.destinatary}' class="text-sm font-medium text-gray-900">${element.user_destinatary}(${element.email_destinatary})</p>
                    <p id='${element.destinatary}' class="text-sm text-gray-500">${element.last_message}</p>
                </div>
            </li>`;
        })
        content+=`</ul></div>
            </div>
        </div>`;
        $('#myChats').html(`${content}`);

        $("#close_chat_box").on('click', ()=>{
            $('#myChats').fadeOut();
            $('#chatRoom').fadeOut();
        }); 

        const list_chats = document.querySelectorAll(".list_chats");
        console.log( list_chats );
        list_chats.forEach((list)=>{
            $(list).on('click',( event )=>{
                event.preventDefault();
                let destinatary = event.target.id;
                // Open a chat room
                openChatRoom(destinatary)
                .then(( data )=>{
                    console.log( data );

                    let json_data = data.data;
                    let content = ``;
                    let emisor = $("#emisor").text();
                    content = `<div class="h-full w-full overflow-auto rounded-md">
                        <div class="w-full h-full container mx-auto">
                        <div class="w-full h-full bg-white shadow-md rounded-lg overflow-hidden">`;
                    content+=`<div class="w-full flex flex-row justify-between p-4 border-b">
                            <h2 class="text-xl font-semibold text-gray-800">${data.data[0].title}</h2>
                            <span id="close_chat_room" class="text-xl font-semibold text-gray-800">x</h2>
                        </div><ul class="flex flex-col space-y-8 divide-y divide-gray-200">`
                    if (json_data.length === 0) {
                        content+=`<li class="p-4 hover:bg-gray-100 cursor-pointer flex items-center">No tienes chats</li>
                                </ul>
                                </div>
                            </div>
                        </div>`;
                        $('#chatRoom').html(`${content}`).fadeIn();
                        return false;
                    }
                    
                    json_data.forEach(( element )=>{
                        let positionText = 'right';
                        if ( emisor == element.destinatary ){
                            positionText = 'left';
                            element.user_destinatary = 'Yo';
                        }
                        console.log( element );
                        content+=`<li lass="list_chats p-4 hover:bg-gray-100 cursor-pointer flex items-center">
                            <div class="ml-3">
                                <p class="text-${positionText} text-xs p${positionText[0]}-4 font-medium text-gray-500">${element.user_destinatary}</p>
                                <p class="text-${positionText} text-sm p${positionText[0]}-4 font-medium text-gray-900">${element.message}</p>
                            </div>
                        </li>`;
                    })
                    content+=`
                            </ul></div>
                        </div>
                    </div>
                    <div class='w-full bg-white'>
                    <hr />
                        <textarea placeholder='Escribe un mensaje' rows='5' style="background:white" class='w-full rounded-md z-40'></textarea>
                        <div class="flex flex-row justify-end">
                            <span class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Enviar</span>
                        </div>
                    </div>`;

                    $("#chatRoom").html(content).fadeIn();
                    $("#close_chat_room").on('click', ()=>{
                        $('#chatRoom').fadeOut();
                    }); 
                }) 
                .catch(( error )=>{
                    console.log( 'Error opening chat room', error );
                });
            })
        });

    });

}

if ( botones_nuevo_chat_administrador  ){

    botones_nuevo_chat_administrador.forEach(( boton )=>{
        $(boton).on('click',( event )=>{
            event.preventDefault();
            let request_id = event.target.id;
            let title = $(`#title_${request_id}`).text();
            let administrator_email = $(`#administrator_email_${request_id}`).text();
            let administrator_name = $(`#administrator_name_${request_id}`).text();
            let user_email = $(`#user_email_${request_id}`).text();
            let user_name = $(`#user_name_${request_id}`).text();
            let emisor = $(`#user_id_${request_id}`).text();
            let receptor = $(`#admin_id_${request_id}`).text();
            
            $("#modalBackdrop_contact_administrator").html(`
                <div class="fixed inset-0 bg-gray-800 z-10 bg-opacity-50 flex items-center justify-center">
                    <!-- Modal -->
                    <div class="bg-white rounded-lg shadow-lg p-2 w-2/3">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center border-b p-4">
                            <h3 class="text-xl font-semibold">Enviar mensaje a ${administrator_name}(${administrator_email})</h3>
                            <span id="closeModal" class="text-gray-400 hover:text-gray-600">
                                &times;
                            </span>
                        </div>
                        <!-- Modal Body -->
                        <div class="p-4 mb-4 w-full">
                            <div class="w-full flex flex-row items-center">
                                <h2 class="w-full text-gray-900 font-semibold" for="message_admin">Escribe un mensaje</h2>
                            </div>
                        
                            <div class="w-full flex flex-row items-center">
                                <textarea rows="5" required placeholder="Escribe un mensaje" id="message_admin" class="p-0 mt-2 block w-full shadow-lg text-gray-600 border-gray-300 rounded-md shadow-sm focus:border-blue-500 transition">
                                </textarea>
                            </div>
                        </div>
                        <div class="p-4 mb-4 w-full">
                            <span class="bg-blue-500 hover:bg-blue-600 transition transform duration-300 p-2 text-gray-100 rounded-md" id="enviar_correo_administrador">Enviar</span>
                        </div>
                    </div>
                </div>`);

            $("#closeModal").on('click',( event )=>{
                event.preventDefault();
                $("#modalBackdrop_contact_administrator").html('');
            })

            $("#enviar_correo_administrador").on('click',( event )=>{
                event.preventDefault();
                let jsonData = {
                    request_id: request_id,
                    type: 'contactWithAdministrator',
                    email: administrator_email,
                    title: title,
                    administrator_email: administrator_email,
                    administrator_name: administrator_name,
                    user_email: user_email,
                    user_name: user_name,
                    emisor: emisor,
                    receptor: receptor,
                    message: $("#message_admin").val()
                }

                const data = new FormData();
                data.append('data', JSON.stringify(jsonData) );
                fetch(window.location.protocol + '/api/myinbox/chat/create', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    console.log( data );
                    sendEmail('contact', jsonData );
                })
                .catch((error) => {
                    console.log( error );
                    window.location = '/contacted_with_administrator/error';
                });  
            
            });

        });
    });
    
}