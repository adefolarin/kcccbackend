<!DOCTYPE html>
<html>
<head>
    <title>KCCC Volunteer</title>
</head>
<body>
     <h4>{{ $mailData['title'] }}</h4>
    <p>Module Type: {{ $mailData['kciles_moduletype'] }}</p>
    <p>Name: {{ $mailData['kciles_name'] }}</p>
    <p>Email: {{ $mailData['kciles_email'] }}</p>
    <p>Phone Number: {{ $mailData['kciles_pnum'] }}</p>
    <p>Gender: {{ $mailData['kciles_gender'] }}</p>
    <p>Address: {{ $mailData['kciles_address'] }}</p>
    <p>Country: {{ $mailData['kciles_country'] }}</p>
    <p>State: {{ $mailData['kciles_state'] }}</p>
    <p>City: {{ $mailData['kciles_city'] }}</p>
    <p>Zipcode: {{ $mailData['kciles_zipcode'] }}</p>
    <p>Courses: {{ $mailData['kciles_coursename'] }}</p>
     
</body>
</html>