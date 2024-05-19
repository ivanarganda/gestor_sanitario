<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h4>User Credentials</h4>
                Hola {{$data->email}} bienvenido. Aquí debajo tiene las credenciales para poder iniciar sesion en la plataforma
                <span>{{ request()->getSchemeAndHttpHost() }}/login</span>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Email:</strong> {{ $data->email }}
                        </div>
                        <div>
                            <strong>Password:</strong> {{ $data->password }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>