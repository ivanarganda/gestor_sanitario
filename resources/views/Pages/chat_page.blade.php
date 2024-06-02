<div class="fixed cursor-pointer -bottom-0 w-20 h-20 right-10 z-10 h-20 w-20 text-gray-700">
    <div id="myChats" class="absolute bottom-20 h-96 w-80 shadow-lg -right-2 bg-gray-100 z-30 cursor-pointer">
        <div class="h-full w-full overflow-auto rounded-md">
            <div class="w-full h-full container mx-auto">
                <div class="w-full h-full bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="w-full flex flex-row justify-between p-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Chats</h2>
                        <span id='close_chat_box' class="text-xl font-semibold text-gray-800">x</h2>
                    </div>
                    <div class="w-full h-full overflow-auto">
                        <div id="loadChatsList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="chatRoom" class="absolute bottom-64 h-96 w-80 rounded-md shadow-lg right-80 bg-gray-100 z-30 cursor-pointer">
        <div class="h-full w-full rounded-md">
            <div class="w-full relative h-full container mx-auto">
                <div class="w-full relative h-full bg-white shadow-lg rounded-tr-lg rounded-tl-lg overflow-auto">
                    <div class="fixed flex z-40 w-80 bg-white flex-row justify-between space-x-2 p-4 border-b">
                        <h2 id="title_chat_room" class="text-md font-semibold text-gray-700"></h2>
                        <span id='close_chat_room' class="text-xl font-semibold text-gray-800">x</h2>
                        <span hidden id="emisor_chat_room">{{Auth::user()->id}}</span>
                        <span hidden id="name_emisor_chat_room">{{Auth::user()->name}}</span>
                        <span hidden id="role_emisor_chat_room">{{Auth::user()->role}}</span>
                    </div>
                    <div class="h-full mt-20" id="loadMessagesChatRoom">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full shadow-md">
            <span id="list_messages_delete"></span>
            <div class="w-full bg-gray-100">
                <textarea placeholder="Escribe mensaje" rows="4" class="w-full overflow-auto resize-none text-gray-700 font-semibold bg-white p-2 rounded-md" id="message_textarea_chat_room"></textarea>
            </div>
            <div class="w-full bg-gray-100 flex flex-row justify-between items-center p-2">
                <ul class="w-full flex flex-row justify-center space-x-2 p-1">
                    <li>
                        <svg class="h-6 w-6 text-zinc-500 cursor-pointer hover:text-zinc-700" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9 l6.5 -6.5" />
                        </svg>
                    </li>
                    <li>
                        <svg class="h-6 w-6 text-zinc-500 cursor-pointer hover:text-zinc-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </li>
                </ul>
                <ul class="w-full flex flex-row justify-center space-x-2 p-1">
                    <li>
                        <button id="boton_enviar_mensaje" class="p-2 text-blue-600 rounded-md hover:bg-gray-200 transition-colors">
                            <svg class="h-8 w-8 text-cyan-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                                <path d="M21 3L14.5 21a.55 .55 0 0 1 -1 0L10 14L3 10.5a.55 .55 0 0 1 0 -1L21 3"/>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>        
    </div>
    <div class="relative" id="boton_chatbox">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        {!!generateBadgetNotification('chat', [
            'width' => '8',
            'height' => '8',
            'right' => '0',
            'text' => 'xs'
        ])!!}
       
    </div>
</div>