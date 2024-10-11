<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AITS - New Contact Form Submission</title>
</head>
<body>
    <P><strong>Title: </strong>{{ $contact['title'] }}</p>
    <P><strong>Name: </strong>{{ $contact['name'] }}</p>
    <P><strong>Company Name: </strong>{{ $contact['company_name'] }}</p>
    <P><strong>Email: </strong>{{ $contact['email'] }}</p>
    <P><strong>Phone: </strong>{{ $contact['phone'] }}</p>
    <P><strong>Country: </strong>{{ $contact['country'] }}</p>
    <P><strong>City: </strong>{{ $contact['city'] }}</p>
    <P><strong>Industry: </strong>{{ $contact['industry'] }}</p>
    <P><strong>Message: </strong>{{ $contact['message'] }}</p>
</body>
</html>
