@include('../Layouts/header')
@include('../Helpers/commonMethods')
@include('../Layouts/sidebar')
@php 
    echo generateSidebar(['Trash', 'Lupe']);
@endphp
<div class="relative container pt-20 mx-auto my-8">
    <div id="modalBackdrop_contact_administrator">
    </div>
    @include('Pages.chat_page')
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex flex-row justify-center space-x-5 items-center">
            <div class="mt-5">
                @php
                    echo generateTitleSection('Mis solicitudes');
                @endphp 
            </div>
        </div>
        <div>
            <div class="flex flex-row justify-center space-x-5 items-center">
                <div class="w-full lg:w-1/2 mt-5 flex flex-row justify-center mb-5">
                    @php
                        echo generateSearch('/requestes', $search);
                    @endphp 
                </div>
            </div>
        </div>
        </div>
        <div class="p-6 space-y-6">
            @if (count($notifications) == 0)
                <div class="w-full bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col justify-center items-center">
                    <svg class="h-40 w-40 text-zinc-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <path d="M4 13h3l3 3h4l3 -3h3" />
                    </svg>
                    <p class="text-center text-gray-500 text-sm">No hay solicitudes</p>
                </div> 
            @else 
                @foreach ($notifications as $notification)
                <label class="flex items-start" for="icon-request_{{$notification->request_id}}">
                    <div class="w-full bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col lg:flex-row justify-between items-center space-y-4"> 
                        <div class="w-full lg:w-1/3 flex flex-col justify-center lg:justify-start lg:flex-row lg:items-start">
                                <div class="flex-shrink-0">
                                    {!!getIconAccordingRequest( $notification->request_type )!!}
                                </div>
                                <div class="ml-4">
                                    <p class="text-gray-700 font-medium">
                                        Solicitud para el administrador {{$notification->administrator_name}}
                                    </p>
                                    <p class="text-gray-700 font-medium">
                                        ({{$notification->administrator_email}})
                                    </p>
                                    <p class="text-gray-500 text-sm">{{$notification->request_title}}</p>
                                    <p class="text-gray-400 text-xs mt-1">Enviado: Hace {{ calculateTotalTime($notification->created_at, now(), 'full') }}</p>
                                    <p class="text-gray-400 text-xs mt-1">Estado: {!!mapearEstadoSolicitud($notification->status)!!}</p>
                                </div>
                        </div>
                        <div class="text-gray-400 w-full lg:w-1/3 flex flex-col lg:flex-row lg:items-start lg:justify-start text-left text-xs mt-1 overflow-hidden">
                            <span>{{ cutText($notification->description) }}</span>
                        </div>
                        <div class="flex flex-col w-full justify-center lg:w-1/3 lg:flex-row lg:justify-end space-x-2">
                            <span hidden id="request_id_{{$notification->request_id}}">{{$notification->request_id}}</span>
                            <span hidden id="title_{{$notification->request_id}}">{{$notification->request_title}}</span>
                            <span hidden id="identity_{{$notification->request_id}}">{{$notification->request_id}}</span>
                            <span hidden id="message_{{$notification->request_id}}">{{$notification->description}}</span>
                            <span hidden id="user_email_{{$notification->request_id}}">{{Auth::user()->email}}</span>
                            <span hidden id="user_id_{{$notification->request_id}}">{{Auth::user()->id}}</span>
                            <span hidden id="admin_id_{{$notification->request_id}}">{{$notification->destinatary}}</span>
                            <span hidden id="user_name_{{$notification->request_id}}">{{Auth::user()->name}}</span>
                            <span hidden id="administrator_email_{{$notification->request_id}}">{{$notification->administrator_email}}</span>
                            <span hidden id="administrator_name_{{$notification->request_id}}">{{$notification->administrator_name}}</span>
                            <a class="flex flex-row space-x-2 bg-blue-500 hover:bg-blue-600 transition transform duration-300 p-2 items-center rounded-md">
                                <svg id="{{$notification->request_id}}" class="flex items-center botones_contact_administrator cursor-pointer text-gray-100 font-semibold rounded-lg h-8 w-8"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />  
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                                @if ( $notification->messages_chat > 0 )
                                    <span id="{{$notification->request_id}}" class="cursor-pointer botones_contacto text-gray-100 font-semibold">
                                        Seguir conversando
                                    </span>
                                @else
                                    <span id="{{$notification->request_id}}" class="cursor-pointer botones_nuevo_chat text-gray-100 font-semibold">
                                        Iniciar nueva conversacion
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                </label>
                @endforeach
            @endif
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {!! $pagination !!}
        </div>
    </div>
</div>
@include('../Layouts/footer')
