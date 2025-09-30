<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>managementpage</title>
</head>
<body>
    <h1>Management Page</h1>
    @csrf
    <form action="{{route('manual.create')}}" method="POST">
    
<input type="text" name="brand_id" placeholder="Merk">
<input type="text" name="name" placeholder="Model">
<input type="submit" value="Submit">
</form>
</body>
</html>