<html>
<head>
    <title>Estado user Querry</title>
</head>
<body>
    <p><strong>Name:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Phone:{{$contact->phone}}</strong>

        <p>Message: {{$contact->message}}</p>
</body>
</html>