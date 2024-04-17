<!DOCTYPE html>
<html>
<head>
    <title>KCCC</title>
</head>
<body>
    <h4>{{ $mailData['title'] }}</h4>
    <p>Date: {{ $mailData['contact_date'] }}</p>
    <p>Email: {{ $mailData['contact_email'] }}</p>
    <p>Phone Number: {{ $mailData['contact_pnum'] }}</p>
    <p>Subject: {{ $mailData['contact_subject'] }}</p>
    <p>Message: {{ $mailData['contact_message'] }}</p>
  
     
    <p>Thank you</p>
</body>
</html>