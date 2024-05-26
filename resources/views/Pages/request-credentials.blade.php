@include('../Layouts/header')
@include('../Helpers/commonMethods')

<div class="w-3/4 m-auto pt-20">
    <div class="bg-gray-100 space-x-2 rounded-md w-full flex flex-row justify-center">
        <div>
           @php
            echo generateTitleSection('Formulario de solicitud');
            @endphp  
        </div>
        <div class="mt-4">
            <a href="{{ url('requestes') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow transition transform hover:scale-105">Mis solicitudes</a>
        </div>  
    </div>
    
    @include('../Form/form-request-credentials')
</div>

@include('../Layouts/footer')