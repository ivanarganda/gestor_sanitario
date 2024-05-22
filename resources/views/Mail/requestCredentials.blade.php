<!DOCTYPE html>
<html>
<head>
    <style>
        /* Tailwind CSS CDN */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');

        /* Inline styles for better email client compatibility */
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #1a202c;
            color: #ffffff;
            padding: 5px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #718096;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container">
        <div class="header">
            <h2>{{ $data->title }}</h2>
        </div>
        <div class="content">
            <p>{{ $data->description }}</p>
            <a href="{{ request()->getSchemeAndHttpHost() }}/inbox/in/{{$data->id}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                VER SOLICITUD
            </a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

