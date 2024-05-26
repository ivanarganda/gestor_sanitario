<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Updated Credentials</title>
    <style>
        body {
            background-color: #f7fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 28rem; /* max-w-md */
            background-color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-lg */
            border-radius: 0.5rem; /* rounded-lg */
            overflow: hidden;
        }
        .header {
            background-color: #2d3748; /* bg-gray-800 */
            color: #ffffff;
            text-align: center;
            padding: 1rem 1.5rem; /* py-4 px-6 */
        }
        .header h4 {
            font-size: 1.125rem; /* text-lg */
            font-weight: 600; /* font-semibold */
            margin: 0;
        }
        .header p {
            margin-top: 0.5rem; /* mt-2 */
        }
        .header span {
            display: block;
            margin-top: 0.5rem; /* mt-2 */
            color: #a0aec0; /* text-gray-300 */
        }
        .content {
            background-color: #ffffff;
            padding: 1.5rem; /* p-6 */
        }
        .content ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            border-radius: 0.5rem; /* rounded-lg */
            background-color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-md */
        }
        .content li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem; /* py-4 px-6 */
            border-bottom: 1px solid #e2e8f0; /* divide-y divide-gray-200 */
            transition: background-color 0.2s;
        }
        .content li:hover {
            background-color: #f7fafc; /* hover:bg-gray-50 */
        }
        .content li:last-child {
            border-bottom: none;
        }
        .content .key {
            font-weight: 600; /* font-semibold */
            color: #4a5568; /* text-gray-700 */
        }
        .content .value {
            color: #718096; /* text-gray-600 */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h4>Credenciales del usuario actualizadas</h4>
            <p>Hola {{$data->email}}, bienvenido. Aquí debajo tienes las credenciales actualizadas:</p>
        </div>
        <div class="content">
            <ul>
                @foreach($data->dataUpdated as $key => $credential)
                    <li>
                        <span class="key">{{$key}}</span>:
                        <span class="value">{{$credential}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
