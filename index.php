<?php

    session_start();

    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
    {
        header('Location: wynik.php');
        exit();
    }

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
    <title>Logowanie</title>
</head>
<body>

    <div class="logo">
        <a href="main_page.php">
            <img src="zdjecia/logo.png" alt="logo">
        </a>
    </div>

    <div class="text-center fs-5 text-light p-4 centrowanie logowanie">

        <form action="zaloguj.php" method="post" autocomplete="off">

            <p>
                Login <br> <input type="text" name="login"> 
            </p>

            <p>
                Hasło <br> <input type="password" name="haslo"> 
            </p>

            <p>
                <input type="submit" value="Zaloguj się">
            </p>
                
            <?php

                if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

            ?>
                
        </form>

        <a href="rejestracja.php" class="text-info" id="cien">Nie masz konta? Zarejestruj się!</a>

    </div>

</body>
</html>