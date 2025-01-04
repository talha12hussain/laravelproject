<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <p>You have requested to reset your password. Click the link below to reset your password:</p>
    <a href="{{ url('reset-password/'.$token) }}">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
</body>
</html>