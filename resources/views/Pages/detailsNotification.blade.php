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
                    echo generateTitleSection('Detalles solicitud' , '/inbox');
                @endphp 
            </div>
        </div>
        <div class="p-6 space-y-6">
            <!-- Notification 1 -->
            @foreach ( $notification as $details )
                <div class="w-full bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col">
                    <div class="w-full justify-center pb-5 flex items-start">
                        <div class="flex-shrink-0">
                            <div class="bg-blue-500 h-12 w-12 rounded-full flex items-center justify-center text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12V8m0 0a4 4 0 10-8 0v4m8 0a4 4 0 01-8 0m8 0v6m-8-6v6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-700 font-medium">Solicitud de {{$details->emisor_user}}</p>
                            <p class="text-gray-500 text-sm">{{$details->emisor_user}} ha solicitado {{$details->request_title}}.</p>
                            <p class="text-gray-400 text-xs mt-1">Hace {{calculateTotalTime($details->created_at, now() , 'full')}}</p>
                        </div>
                    </div>
                    <div class="w-full pb-5 flex items-center m-auto text-gray-400 text-xs mt-1">
                        <span class="text-center">{{$details->description}}</span>
                    </div>
                    <div class="flex pt-2 justify-center space-x-2">
                        <a class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600">Aprobar</a>
                        <a class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-blue-600">Denegar</a>
                    </div>
                </div>
            @endforeach
            <!-- More notifications can be added similarly -->
        </div>
    </div>
</div>
@include('../Layouts/footer')
