<!DOCTYPE html>
<html>
<head>
    <title>KCCC Volunteer</title>
</head>
<body>
     <h4>{{ $mailData['title'] }}</h4>
    <p>Type: {{ $mailData['volunteers_type'] }}</p>
    <p>Name: {{ $mailData['volunteers_name'] }}</p>
    <p>Email: {{ $mailData['volunteers_email'] }}</p>
    <p>Phone Number: {{ $mailData['volunteers_pnum'] }}</p>
    <p>Time of Availability: {{ $mailData['volunteers_time'] }}</p>
     
</body>
</html>