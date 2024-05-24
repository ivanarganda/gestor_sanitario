@include('../Layouts/header')
@include('../Helpers/commonMethods')
@include('../Layouts/sidebar')
@php 
    echo generateSidebar(['Trash', 'Lupe']);
@endphp
<div class="container mx-auto my-8">
    <div id="modalBackdrop_confirm_deleete_solicitud">
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex flex-row justify-center space-x-5 items-center">
            <div class="mt-5">
                @php
                    echo generateTitleSection( isset($_GET['trash']) ? 'Papelera de reciclaje' : 'Bandeja de solicitudes');
                @endphp 
            </div>
            <a href='{!!isset($_GET['trash']) ? '/inbox' : '/inbox?trash=true' !!}'   class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 7v13a2 2 0 002 2h8a2 2 0 002-2V7m-5 0V4a2 2 0 10-4 0v3"></path>
                </svg>
                {!!isset($_GET['trash']) ? '<span class="text-2xl">&larr;</span>' : 'Papelera de reciclaje' !!}
                
            </a>
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
                                    Solicitud de {{$notification->emisor_user}}
                                </p>
                                <p class="text-gray-500 text-sm">{{$notification->emisor_user}} ha solicitado {{$notification->request_title}}.</p>
                                <p class="text-gray-400 text-xs mt-1">Hace {{ calculateTotalTime($notification->created_at, now(), 'full') }}</p>
                            </div>
                        </div>
                        <div class="text-gray-400 text-xs mt-1 overflow-hidden">
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
                @endforeach
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
