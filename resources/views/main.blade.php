@include('Layouts/header')
<div class="flex flex-col items-center pt-20 justify-center min-w-[350px]">
    @auth
        @include('home')
    @else
        @include('Form/login')
    @endauth
</div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>
