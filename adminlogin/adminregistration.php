<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registration</title>
</head>
<body>
    <div class="container">
        <form action="registration.php" method="POST">
            <div class="form-group">
                <input type="text" name="fullname" placeholder="full name">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="email">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="password">
            </div>
            <div class="form-group">
                <input type="text" name="repeat_password" placeholder="repeat_password">
            </div>
            <div class="form-group">
                <input type="submit" value="Register" name="submit">
            </div>
        </form>
    </div>
    
</body>
</html>
