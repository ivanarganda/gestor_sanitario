@include('../Layouts/header')
@include('../Helpers/commonMethods')

<div class="w-3/4 m-auto pt-20">
    @php
        echo generateTitleSection('Formulario de solicitud');
    @endphp
    @include('../Form/form-request-credentials')
</div>

@include('../Layouts/footer')