@include('../Layouts/header')
@include('../Helpers/commonMethods')
@include('../Layouts/sidebar')
@php 
    echo generateSidebar(['Trash','Lupe']);
@endphp
<div class="container mx-auto my-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex flex-row justify-center space-x-5 items-center">
            <div class="mt-5">
               @php
                echo generateTitleSection('Inbox Notifications');
                @endphp 
            </div>
            <button class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 7v13a2 2 0 002 2h8a2 2 0 002-2V7m-5 0V4a2 2 0 10-4 0v3"></path>
                </svg>
                Papelera de reciclaje
            </button>
        </div>
        <div class="p-6 space-y-6">
            <!-- Notification 1 -->
            @foreach ( $notifications as $notification )
                <div class="w-full bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col lg:flex-row lg:justify-between lg:items-start">
                    <div class="w-full justify-center lg:w-1/4 flex  items-start">
                        <div class="flex-shrink-0">
                            <div class="bg-blue-500 h-12 w-12 rounded-full flex items-center justify-center text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12V8m0 0a4 4 0 10-8 0v4m8 0a4 4 0 01-8 0m8 0v6m-8-6v6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-700 font-medium">
                                {!!$notification->viewed == '0' ? '<span class="text-red-600">New</span>' : ''!!}
                                Solicitud de {{$notification->emisor_user}}</p>
                            <p class="text-gray-500 text-sm">{{$notification->emisor_user}} ha solicitado {{$notification->request_title}}.</p>
                            <p class="text-gray-400 text-xs mt-1">Hace {{calculateTotalTime($notification->created_at, now() , 'full')}}</p>
                        </div>
                    </div>
                    <div class="w-2/4 flex items-center m-auto text-gray-400 text-xs mt-1 overflow-hidden">
                        <span class="text-center">{{$notification->description}}</span>
                    </div>
                    <div class="flex pt-2 lg:pt-0 justify-center space-x-2">
                        <a href="{{url('/inbox/in/'.$notification->request_id.'')}}" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600">Mas detalles</a>
                    </div>
                </div>
            @endforeach
            <!-- More notifications can be added similarly -->
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {!!$pagination!!}
        </div>
    </div>
</div>
@include('../Layouts/footer')
