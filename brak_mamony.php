<?php

    session_start();

    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

    if (!isset($_SESSION['brak_mamony']))
    {
        header('Location: wynik.php');
        exit();
    }
    
    unset($_SESSION['brak_mamony']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="zdjecia/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <div class="logo">
        <a href="main_page.php">
            <img src="zdjecia/logo.png" alt="logo">
        </a>
    </div>

    <div class="text-center fs-5 p-4 text-light centrowanie ban">

    <p class="fs-4">
        Nie masz wystarczająco pieniędzy aby zakupić ten karnet. <br><br>
        Doładuj swój portfel i spróbuj ponownie. 
    </p>

    <a href="doladowanie.php" class="text-info" id="cien">Doładuj swój portfel</a>

</div>
</body>
</html>