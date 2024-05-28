@include('../Layouts/header')
@include('../Helpers/commonMethods')
@include('../Layouts/sidebar')
@php 
    echo generateSidebar(['Trash', 'Lupe']);
@endphp
<div class="container mx-auto my-8">
    <div id="modalBackdrop_confirm_deleete_solicitud">
    </div>
    @include('Pages.chat_page')
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="w-full min-w-fit px-2 flex flex-row justify-center space-x-5 items-center">
            <div class="w-1/2 min-w-fit mt-5">
                @php
                    echo generateTitleSection( isset($_GET['trash']) ? 'Papelera de reciclaje' : 'Bandeja de solicitudes');
                @endphp 
            </div>
            <a href='{!!isset($_GET['trash']) ? '/inbox/admin' : '/inbox/admin?trash=true' !!}'   class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex justify-start items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 7v13a2 2 0 002 2h8a2 2 0 002-2V7m-5 0V4a2 2 0 10-4 0v3"></path>
                </svg>
                {!! isset($_GET['trash']) ? '<span class="text-2xl">&larr;</span>' : 'Papelera' !!}               
            </a>
        </div>
        <div class="w-full flex flex-row justify-center">
            {!!generateSearch('/inbox/admin' , $search )!!}
        </div>
        <div class="p-6 space-y-6">
            @if (count($notifications) == 0)
                <div class="w-full bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col justify-center items-center">
                    <svg class="h-40 w-40 text-zinc-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <path d="M4 13h3l3 3h4l3 -3h3" />
                    </svg>
                    <p class="text-center text-gray-500 text-sm">No hay notificaciones</p>
                </div> 
            @else 
                @foreach ($notifications as $notification)
                <label class="flex cursor-pointer items-start" for="icon-request_{{$notification->request_id}}">
                    @if ( isset($_GET['trash']) )
                    <div class="w-full bg-gray-50 p-4 {{$notification->rubbised == 0 ? 'hidden' : ''}} rounded-lg shadow-sm flex flex-col lg:flex-row justify-between items-center space-y-4">
                    @else 
                    <div class="w-full bg-gray-50 p-4 {{$notification->rubbised == 1 ? 'hidden' : ''}} rounded-lg shadow-sm flex flex-col lg:flex-row justify-between items-center space-y-4">
                    @endif
                    
                        <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    {!!getIconAccordingRequest( $notification->request_type )!!}
                                </div>
                                <div class="ml-4">
                                    <p class="text-gray-700 font-medium">
                                        {!! $notification->viewed == '0' ? '<span class="text-red-600">New</span>' : '' !!}
                                        Solicitud del  {{mapearRol($notification->role_user)}}
                                        {{$notification->emisor_user}}
                                    </p>
                                    <p class="text-gray-500 text-sm">{{$notification->emisor_email}}.</p>
                                    <p class="text-gray-500 text-sm">{{$notification->emisor_user}} ha solicitado {{$notification->request_title}}.</p>
                                    <p class="text-gray-400 text-xs mt-1">Hace {{ calculateTotalTime($notification->created_at, now(), 'full') }}</p>
                                </div>
                            <input hidden type="checkbox" class="checkbox_requestes" value="{{$notification->request_id}}" id="icon-request_{{$notification->request_id}}">
                        </div>
                        <div class="text-gray-400 w-1/2 text-xs mt-1 overflow-hidden">
                            <span>{{ cutText($notification->description) }}</span>
                        </div>
                        <div class="flex justify-center space-x-2">
                            <span hidden id="request_id_{{$notification->request_id}}">{{$notification->request_id}}</span>
                            <span hidden id="email_soliciter_{{$notification->request_id}}">{{$user_soliciter}}</span>
                            <span hidden id="email_admin_{{$notification->request_id}}">{{$user_admin}}</span>
                            <span hidden id="title_{{$notification->request_id}}">{{$notification->request_title}}</span>
                            <span hidden id="identity_{{$notification->request_id}}">{{$notification->request_id}}</span>
                            <span hidden id="message_{{$notification->request_id}}">{{$notification->description}}</span>
                            <span hidden id="current_page">{{isset($_GET['page']) ? $_GET['page'] : ''}}</span>
                            @if (isset($_GET['trash']) )
                            <a id="boton_mas_detalles" class="{{$notification->rubbised == '1' ? 'hidden' : ''}} cursor-pointer bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600">Mas detalles</a>
                            <a id="{{$notification->request_id}}" class="botones_restaurar cursor-pointer bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600">Restaurar</a>
                            @else
                              <a id="{{$notification->request_id}}" class="botones_reciclar cursor-pointer bg-red-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-red-600">
                                Borrar
                              </a>
                            <a id="{{$notification->request_id}}" class="flex items-center botones_mas_detalles cursor-pointer bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600">Mas detalles</a>
                            @endif
                        </div>
                    </div>
                </label>
                @endforeach
                @if (isset($_GET['trash']) )
                    <div id="boton_restaure_multiple_requestes" hidden>
                @else
                    <div id="boton_delete_multiple_requestes" hidden>
                @endif
                        <div class="flex flex items-center space-x-3 justify-center">
                                @if (isset($_GET['trash']) )
                                    <button id="boton_delete" class="bg-blue-500 mt-5 text-gray-100 font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                                        Restaurar seleccionados
                                    </button>
                                @else
                                    <button id="boton_delete" class="bg-red-500 mt-5 text-gray-100 font-semibold px-4 py-2 rounded-lg shadow hover:bg-red-600">
                                        Borrar seleccionados
                                    </button>
                                @endif 
                                <div class="mt-5 text-xl text-gray-600">
                                    <span id="items_selected">0</span>/{{count($notifications)}}    
                                </div>
                        </div> 
                    </div>
            @endif
        </div>
        @if (count($notifications) != 0)
            <div class="px-6 py-4 border-t border-gray-200">
                {!! $pagination !!}
            </div>
        @endif
    </div>
</div>
@include('../Layouts/footer')