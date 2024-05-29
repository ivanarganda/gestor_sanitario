@include('../Layouts/header')
@include('../Helpers/commonMethods')
@include('../Layouts/sidebar')
@php 
    echo generateSidebar(['Trash','Lupe']);
@endphp
<div class="container pt-40 mx-auto my-8">
    <div class="bg-white shadow-md rounded-lg">
        <div class="flex flex-row justify-center space-x-5 items-center">
            <div class="mt-5">
                @php
                    echo generateTitleSection('Detalles solicitud' , '/inbox/admin');
                @endphp 
            </div>
        </div>
        <div class="p-6 space-y-6">
            <!-- Notification 1 -->
            @foreach ( $notification as $details )
                <div class="w-full bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col">
                    <div class="w-full justify-center pb-5 flex items-start">
                        <div class="flex-shrink-0">
                            {!!getIconAccordingRequest( $details->request_type )!!}
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-700 font-medium">Solicitud de {{$details->emisor_user}}</p>
                            <p class="text-gray-500 text-sm">{{$details->emisor_user}} ha solicitado {{$details->request_title}}.</p>
                            <p class="text-gray-400 text-xs mt-1">Hace {{calculateTotalTime($details->created_at, now() , 'full')}}</p>
                        </div>
                    </div>
                    <div class="w-full pb-5 flex justify-center items-center m-auto text-gray-400 text-xs mt-1">
                        <span class="text-center">{{$details->description}}</span>
                    </div>
                    <div id="botones_accion_detalles_notificacion" class="flex pt-2 justify-center space-x-2">
                        <span hidden id="email_soliciter">{{$user_soliciter}}</span>
                        <span hidden id="email_admin">{{$user_admin}}</span>
                        <span hidden id="title">{{$details->request_title}}</span>
                        <span hidden id="identity">{{$details->request_id}}</span>
                        <span hidden id="message">{{$details->description}}</span>
                        <a id="boton_notificacion_aprobar_{{$details->request_id}}" data-value="{{$details->request_id}}" class="cursor-pointer bg-green-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-green-600">Aprobar</a>
                        <a id="boton_notificacion_denegar_{{$details->request_id}}" data-value="{{$details->request_id}}" class="cursor-pointer bg-red-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-red-600">Denegar</a>
                    </div>
                    
                </div>
            @endforeach
            <!-- More notifications can be added similarly -->
        </div>
    </div>
</div>

@include('../Layouts/footer')
