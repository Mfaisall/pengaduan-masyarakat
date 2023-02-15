<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>

<body>
    <section class="form-container">
        <div class="card form-card">
    <form action="{{ route('auth') }}" method="POST">
        @csrf
            <h2 style="text-align: center;">Login Administrator</h2>
            <div class="input-card">
                <strong>Email :</strong>
                <br>
                <input type="text" class="from-control" name="email">
            </div>
            <div class="input-card">
                <strong>Password :</strong>
                <br>
                <input type="password" class="from-control" name="password">
            </div>
                <button type="submit">Kirim</button>
                <a class="button2" href="/">Back</a>
    </form>

</body>

</html>
