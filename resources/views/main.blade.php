@include('Layouts/header')
<div class="flex flex-col items-center pt-14 justify-center min-w-[350px] px-4 md:px-8">
    @auth
        @include('home')
    @else
        @include('Form/login')
    @endauth
@include('Layouts/footer')
