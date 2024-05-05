<?php

    session_start();

    if ((!isset($_SESSION['udanarejestracja'])))
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        unset($_SESSION['udanarejestracja']);
    }

    //usuwamy zmienne tymczasowe z rejestracji
    if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
    if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
    if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
    if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
    if (isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);

    //usuwamy błędy
    if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
    if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
    if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
    if (isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="zdjecia/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Witamy</title>
</head>
<body>

    <div class="logo">
        <a href="main_page.php">
            <img src="zdjecia/logo.png" alt="logo">
        </a>
    </div>

    <div class="text-center fs-5 p-4 text-light centrowanie witamy">

        <p>
            Dziękujemy za rejestrację w serwisie! Możesz już zalogować się na swoje konto!
        </p>

        <a href="index.php" class="text-info" id="cien">Zaloguj się na swoje konto!</a>

    </div>

</body>
</html>