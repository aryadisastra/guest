<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="{{ asset('img/icons/logo-menkeu.png') }}" />
    <title>QR CODE</title>
</head>
<body>
    @php
        $undangan = \App\Invitation::all();
    @endphp
    @foreach ($undangan as $item)
        @if(md5(sha1(md5($item->value))) == $id)
        <p style="text-align: center">{{ QrCode::size(500)->generate($item->value) }}</p>
        @endif
    @endforeach
</body>
</html>