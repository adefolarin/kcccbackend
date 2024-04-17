<!DOCTYPE html>
<html>
<head>
    <title>AAM Verification Code</title>
</head>
<body>
    <h4>{{ $mailData['title'] }}</h4>
    <h4>Verification Code: {{ $mailData['code'] }}</h4>
    <p>{{ $mailData['body'] }}</p>
    <p>Thank you</p>
</body>
</html>