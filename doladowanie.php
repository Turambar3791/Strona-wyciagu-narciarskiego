<?php

    session_start();

    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connect = new mysqli($host,$db_user,$db_password,$db_name);

    $adminowe_zapytanie = "SELECT * FROM uzytkownicy";

    $result = mysqli_query($connect,$adminowe_zapytanie);

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
    <title>Doładowanie</title>
</head>
<body>

    <div class="logo">
        <a href="main_page.php">
            <img src="zdjecia/logo.png" alt="logo">
        </a>
    </div>

    <?php

        if ($_SESSION['ban'] == 1)
        {
            ?>
               
                <div class="text-center fs-5 p-4 text-light centrowanie ban">

                    <p class="fs-4">
                        Jesteś zbanowany
                    </p>

                    <a href="logout.php" class="text-info" id="cien">Wyloguj się</a>
                
                </div>
                
            <?php
        }
        else
        {
    ?>
    
        <div class="text-center text-light fs-5 p-4 centrowanie doladowanie">

            <p>
                <a href="wynik.php" class="text-info" id="cien">Wróć do swego konta</a>
            </p>

            <p>
                Tu możesz doładować swój portfel
            </p>

            <form action="wynik.php" method="post" autocomplete="off">

                <p>
                    <input name="ile" type="number" min="1" max="1000" required>
                </p>

                <p>
                    <input type="submit" value="Doładuj"></input>
                </p>

            </form>

        </div>

    <?php
        }
    ?>

</body>
</html>