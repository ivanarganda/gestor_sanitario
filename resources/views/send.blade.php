<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@php
    $jsonData = base64_decode($data);
    $type = json_decode($jsonData)->type;
@endphp
<form id="form">
    <input type="hidden" id="json_data" value="{{$jsonData}}">
</form>
<div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-gray-100 to-gray-300 dark:from-gray-800 dark:to-gray-900">
    <div class="flex flex-col items-center space-y-4">
      <div class="h-20 w-20 animate-spin rounded-full border-4 border-gray-800 border-r-transparent dark:border-gray-300 dark:border-r-transparent"></div>
      @if ( json_decode($jsonData)->type == 'sendCredentials' )
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-300">Registering and sending credentials to user {{json_decode($jsonData)->email}}</h2>
      @endif
      @if ( json_decode($jsonData)->type == 'sendCredentialsUpdated' )
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-300">Updating and sending credentials to user {{json_decode($jsonData)->email}}</h2>       
      @endif
      @if ( json_decode($jsonData)->type == 'requestCredentials' )
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-300">Sending request to admin</h2>
      @endif
    </div>
  </div>
<script>
    const data = document.getElementById('json_data').value;
    var jsonData = new FormData();
    jsonData.append('data', data);
    fetch(window.location.protocol + '/api/sendEmail', {
        method: 'POST',
        body:jsonData
    })
    .then(response => response.json())
    .then(data => {
        if ( @json($type) == 'sendCredentials' ){
            window.location = '/user-registered';
        } else if ( @json($type) == 'requestCredentials' ) {
            window.location = '/request-created';
        } else {
            window.location = '/user-updated';
        }
        console.log(data);
    }).catch(() => {
        if ( @json($type) == 'sendCredentials' ){
            window.location = '/user-registered/error';
        } else if ( @json($type) == 'requestCredentials' ) {
            window.location = '/request-created/error';
        } else {
            window.location = '/user-updated/error';
        }
    });
</script>
