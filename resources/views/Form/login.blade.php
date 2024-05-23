<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
    <style>
        .access-button {
            width: 100%;
            padding: 1.25rem;
            border-radius: 0.75rem;
            font-size: 1.25rem;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .access-button:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .access-button:active {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .access-button-admin {
            background-color: #f6bb3b;
        }
        .access-button-medats {
            background-color: #10b880;
        }
        .access-button-admin:hover, .access-button-admin:focus {
            background-color: #ee9d08;
        }
        .access-button-medats:hover , .access-button-medats:focus  {
            background-color: #059669;
        }
        .access-button-user {
            background-color: #08728d;
        }
        .access-button-user:hover , .access-button-user:focus {
            background-color: #3d78cf;
        }
        .form-container {
            width: 100%;
            max-width: 640px;
            margin: -1rem auto 0;
            background: rgba(243, 244, 246, 0.8);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }
        .form-container.dark {
            background: rgba(31, 41, 55, 0.8);
        }
        .form-container form {
            display: grid;
            gap: 2rem;
        }
        .form-container label {
            font-size: 1.125rem;
            font-weight: 600;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 0.625rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            background: #f3f4f6;
            transition: border-color 0.3s ease, background 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            
        }
        .form-container input[type="text"]:focus,
        .form-container input[type="password"]:focus {
            border-color: #3b82f6;
            background: #e5e7eb;
            outline: none;
        }
        .form-container input[type="submit"] {
            height: 3rem;
            width: 60%;
            background: #3b82f6;
            color: white;
            font-weight: 700;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-container input[type="submit"]:active {
            background: #1d4ed8;
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-container #inputs_labels__title {
            border-radius: 50%;
        }
        .back-button svg {
            height: 2rem;
            width: 2rem;
            color: #4b5563;
            transition: color 0.3s ease;
        }
        .back-button:hover svg {
            color: #1f2937;
        }
        .hidden {
            display: none;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: -1rem;
        }
    </style>
</head>
<body>
    <div class="form-container p-4 dark:bg-gray-800">
        <form action="{{ url('/login') }}" id="loginForm" method="POST">
            @csrf

            @error('user')
                <span id="message_errors" class="text-red-500 text-center text-lg font-semibold">
                    {{ $message }}
                </span>
            @enderror

            <div id="access_buttons" class="flex flex-col items-center space-y-6">
                <div id="buttonAccessAdmin" data-value="admin" class="cursor-pointer access-button access-button-admin text-white">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Admin Access">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M3 21v-4a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span id="buttonAccessAdmin" data-value="admin">Acceso administradores</span>
                </div>
                <div id="buttonAccessMEDATS" data-value="medats" class="cursor-pointer access-button access-button-medats text-white">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="MEDATS Access">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M10 12l2 -2m0 0l2 -2m-2 2l2 2m-2 -2l-2 2m5 2v4h4a1 1 0 0 0 1 -1v-3a1 1 0 0 0 -1 -1h-4z" />
                        <path d="M14 15v4a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1z" />
                        <path d="M14 8v-2a2 2 0 1 0 -4 0v2" />
                    </svg>
                    <span id="buttonAccessMEDATS" data-value="medats">Acceso Médicos o ATS</span>
                </div>
                <div id="buttonAccessUser" data-value="user" class="cursor-pointer access-button access-button-user text-white">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="User Access">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M5 7a2 2 0 1 1 4 0a2 2 0 1 1 -4 0" />
                        <path d="M5 21v-4a4 4 0 0 1 4 -4h6a4 4 0 0 1 4 4v4" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span id="buttonAccessUser" data-value="user">Acceso empleados</span>
                </div>
            </div>

            @if ( $errors->has('email') || $errors->has('password') )
                <div class="relative w-full h-full m-auto">
            @else
                <div id="input_labels" class="relative w-full h-full m-auto">
            @endif
                <div id="alert" class="alert alert-danger h-auto flex flex-col flex-wrap justify-center items-center space-y-2 pt-6 pb-2 rounded-tl-md rounded-tr-md bg-red-300 text-red-800 w-full {{ $errors->has('email') || $errors->has('password') ? '' : 'hidden' }}">
                    @error('email')
                        <span id="message_errors" class="error-message text-xl">{{ $message }}</span>
                    @enderror
                    @error('password')
                        <span id="message_errors" class="error-message text-xl">{{ $message }}</span>
                    @enderror
                </div>
                @if ( $errors->has('email') || $errors->has('password') )
                    <div class="w-full rounded-tl-md rounded-tr-md {{session('bgImage')}}">
                @else 
                    <div id="input_labels__image" class="w-full rounded-tl-md rounded-tr-md">
                @endif
                @if ( $errors->has('email') || $errors->has('password') )
                    <div class="text-left p-3 pt-5 back-button" role="button" onclick="window.location='/'">
                @else 
                    <div class="text-left p-3 pt-5 back-button" role="button" id="arrow_button_back_access">
                @endif
                        
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Back">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            
                            @if ( $errors->has('email') || $errors->has('password') )
                                <div class="w-24 h-24 m-auto mb-8 {!!session('bgTitle')!!}">
                                    {!!session('svgAccess')!!}
                                </div>
                            @else 
                                <div class="w-28 h-28 m-auto mb-8" id="inputs_labels__title">
                                </div>
                            @endif
                        </div>
                    </div>
                <div class="flex flex-col justify-center items-center p-2">
                    <input type="hidden" name="access" id="access" />
                    <input type="hidden" id="typeForm" value="login" />
                    <input type="hidden" name="svgAccess" id="svgAccess" value="{{session('svgAccess')}}" />
                    <input type="hidden" name="bgTitle" id="bg-title" value="{{session('bgTitle')}}" />
                    <input type="hidden" name="bgImage" id="bg-image" value="{{session('bgImage')}}" />
                    <div class="w-full space-y-2">
                        <label for="email">Email</label>
                        <input id="email" name="email" placeholder="john@example.com" type="text" />
                    </div>
                    <div class="w-full space-y-2">
                        <label for="password">Password</label>
                        <input class="" id="password" name="password" type="password" />
                    </div>
                    <input class="mt-6" type="submit" value="Sign in" />
                </div>
            </div>
        </form>
    </div>
</body>
</html>
