@include('../Layouts/header')

<div class="w-3/4 m-auto pt-20">
    <div class="flex items-center justify-center p-2 mb-8">
        <a href="{{ url('/') }}" class="flex items-center text-gray-600 hover:text-gray-800">
            <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold ml-4">Sesiones del usuario</h1>
    </div>
    @include('../Form/form-request-credentials')
</div>

@include('../Layouts/footer')