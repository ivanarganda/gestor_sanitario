<div class="fixed cursor-pointer bottom-0 w-20 h-20 right-10 z-10 h-20 w-20 text-gray-700">
    <div id="myChats" class="absolute bottom-28 h-96 w-80 shadow-lg -right-2 bg-gray-100 z-30 cursor-pointer">
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
    <div id="chatRoom" class="absolute bottom-28 h-96 w-80 shadow-lg right-80 bg-gray-100 z-30 cursor-pointer">
        <div class="h-full w-full overflow-auto rounded-md">
            <div class="w-full h-full container mx-auto">
                <div class="w-full h-full bg-white shadow-lg rounded-tr-lg rounded-tl-lg overflow-hidden">
                    <div class="w-full flex flex-row justify-between p-4 border-b">
                        <h2 id="title_chat_room" class="text-md font-semibold text-gray-800"></h2>
                        <span id='close_chat_room' class="text-xl font-semibold text-gray-800">x</h2>
                        <span hidden id="emisor_chat_room">{{Auth::user()->id}}</span>
                        <span hidden id="name_emisor_chat_room">{{Auth::user()->name}}</span>
                    </div>
                    <div class="shadow-md h-full" id="loadMessagesChatRoom">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full shadow-md">
            <div class="w-full bg-gray-100 shadow-md">
                <textarea placeholder="Escribe mensaje" class="w-full bg-gray-100 shadow-md" id="message_textarea_chat_room"></textarea>
            </div>
            <div class="w-full bg-gray-100 flex flex-row justify-between items-center">
                <ul class="w-full flex flex-row justify-center space-x-2 p-1">
                    <li><svg class="h-6 w-6 text-zinc-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9 l6.5 -6.5" /></svg></li>
                    <li><svg class="h-6 w-6 text-zinc-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>
                    </li>
                </ul>
                <ul class="w-full flex flex-row justify-center space-x-2 p-1">
                    <li>
                        <button id="boton_enviar_mensaje" class="p-1 bg-blue-400 hover:bg-blue-500 text-gray-100 rounded-md">Enviar</button>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    <svg id="boton_chatbox"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
    </svg>  
</div>