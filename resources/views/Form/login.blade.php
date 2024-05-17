<style>
    .access-button {
        width: 100%;
        padding: 1.25rem;
        border-radius: 0.75rem;
        font-size: 1.25rem;
        font-weight: 600;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .access-button:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .access-button:active {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="w-full md:w-2/4 lg:w-2/3 xl:w-2/4 mx-auto mt-40 transition-all duration-500 ease-in-out">
    <div class="w-full bg-gray-100 dark:bg-gray-800 bg-opacity-80 p-8 rounded-lg shadow-md transition-all duration-500 ease-in-out">
        <form action="{{ url('/login') }}" method="post" class="grid gap-8 w-full transition-all duration-500 ease-in-out">
            @csrf

            @error('user')
                <span id="message_errors" class="text-red-500 text-center text-lg font-semibold transition-all duration-500 ease-in-out">
                    {{ $message }}
                </span>
            @enderror

            <div id="access_buttons" class="flex flex-col items-center space-y-6 {{ $errors->has('email') || $errors->has('password') ? 'hidden' : '' }}">
                <button id="buttonAccessAdmin" data-value="admin" class="access-button bg-blue-500 text-white flex items-center justify-center space-x-2">
                    <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Admin Access">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M3 21v-4a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span>Acceso administradores</span>
                </button>
                <button id="buttonAccessMEDATS" data-value="medats" class="access-button bg-green-500 text-white flex items-center justify-center space-x-2">
                    <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="MEDATS Access">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M10 12l2 -2m0 0l2 -2m-2 2l2 2m-2 -2l-2 2m5 2v4h4a1 1 0 0 0 1 -1v-3a1 1 0 0 0 -1 -1h-4z" />
                        <path d="M14 15v4a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1z" />
                        <path d="M14 8v-2a2 2 0 1 0 -4 0v2" />
                    </svg>
                    <span>Acceso Médicos o ATS</span>
                </button>
                <button id="buttonAccessUser" data-value="user" class="access-button bg-green-500 text-white flex items-center justify-center space-x-2">
                    <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="User Access">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M5 7a2 2 0 1 1 4 0a2 2 0 1 1 -4 0" />
                        <path d="M5 21v-4a4 4 0 0 1 4 -4h6a4 4 0 0 1 4 4v4" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span>Acceso empleados</span>
                </button>
            </div>

            <div id="input_labels" class="{{ $errors->has('email') || $errors->has('password') ? '' : 'hidden' }}">
                @error('email')
                    <span id="message_errors" class="text-red-500">{{ $message }}</span>
                @enderror
                @error('password')
                    <span id="message_errors" class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="text-left p-3 pt-5" role="button" id="arrow_button_back_access">
                    <svg class="h-8 w-8 text-zinc-600 transition-colors hover:text-zinc-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Back">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                    </svg>
                </div>

                <input type="hidden" name="access" id="access" />
                <input type="hidden" id="typeForm" value="login" />

                <div class="space-y-2">
                    <label class="text-lg font-semibold" for="email">Email</label>
                    <input class="h-10 w-full border rounded-lg p-2 text-sm bg-gray-100 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-500 ease-in-out" id="email" name="email" placeholder="john@example.com" type="email" />
                </div>

                <div class="space-y-2">
                    <label class="text-lg font-semibold" for="password">Password</label>
                    <input class="h-10 w-full border rounded-lg p-2 text-sm bg-gray-100 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-500 ease-in-out" id="password" name="password" type="password" />
                </div>

                <input type="submit" value="Sign in" class="mt-5 h-12 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all duration-500 ease-in-out cursor-pointer" />
            </div>
        </form>
    </div>
</div>

