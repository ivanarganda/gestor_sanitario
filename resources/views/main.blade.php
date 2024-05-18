@include('Layouts/header')
<div class="flex flex-col items-center pt-20 justify-center min-w-[350px]">
    @auth
        @include('home')
    @else
        @include('Form/login')
    @endauth
@include('Layouts/footer')
