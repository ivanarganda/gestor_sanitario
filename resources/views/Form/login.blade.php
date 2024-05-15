<div class="w-full md:w-2/4 lg:w-2/3 xl:w-2/4 place-content-center mx-auto min-w-fit mt-40 transition-all duration-500 ease-in-out">
    <div class="w-full bg-gray-100 bg-opacity-80 dark:bg-gray-800 p-6 rounded-lg shadow-md transition-all duration-500 ease-in-out">
        <form action="{{ url('/login') }}" method="post" class="grid gap-8 w-full transition-all duration-500 ease-in-out">
            @csrf

            @error('user')
                <span id="message_errors" class="text-red-500 text-center peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-lg font-semibold transition-all duration-500 ease-in-out">
                    {{ $message }}
                </span>
            @enderror

            <div id="access_buttons" class="flex flex-col items-center space-y-3 {{ $errors->has('email') || $errors->has('password')  ? 'hidden' : '' }}">
                <div class="bg-blue-300 p-4 w-full text-center rounded-lg text-gray-700 shadow-lg active:bg-blue-500 hover:bg-blue-500 transition-all">
                    <button id="buttonAccessAdmin" data-value="admin">Acceso como administrador</button>
                </div>
                <div class="bg-green-300 p-4 w-full text-center rounded-lg text-gray-700 shadow-lg active:bg-green-500 hover:bg-green-500 transition-all">
                    <button id="buttonAccessMEDATS" data-value="medats">Acceso como Medico o ats</button>
                </div>
                <div class="bg-green-300 p-4 w-full text-center rounded-lg text-gray-700 shadow-lg active:bg-green-500 hover:bg-green-500 transition-all">
                    <button id="buttonAccessUser" data-value="user">Acceso como paciente</button>
                </div>
            </div>

            <div id="input_labels" class="{{ $errors->has('email') || $errors->has('password') ? '' : 'hidden' }}">
                @error('email')
                    <span id="message_errors" class="text-red-500">{{ $message }}</span>
                @enderror
                @error('password')
                    <span id="message_errors" class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="text-left p-3 pt-5" role="button" id="arrow_button_back_access">
                    <svg class="h-8 w-8 text-zinc-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                    </svg>
                </div>
                <input hidden type="text" name="access" id="access" />
                <div class="space-y-2">
                    <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-lg font-semibold transition-all duration-500 ease-in-out" for="email">Email</label>
                    <input class="flex h-10 w-full border-input bg-background text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border rounded-lg p-2 transition-all duration-500 ease-in-out" id="email" name="email" placeholder="john@example.com" type="email" />
                </div>
                <div class="space-y-2">
                    <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-lg font-semibold transition-all duration-500 ease-in-out" for="password">Password</label>
                    <input class="flex h-10 w-full border-input bg-background text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border rounded-lg p-2 transition-all duration-500 ease-in-out" id="password" name="password" type="password" />
                </div>
                <input type="submit" value="Sign in" class="mt-5 space-y-2 inline-flex items-center justify-center whitespace-nowrap text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-500 ease-in-out" />
            </div>
        </form>
    </div>
</div>