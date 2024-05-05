<?php

    session_start();

    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connect = new mysqli($host,$db_user,$db_password,$db_name);

    $zapytanie_karnety = "SELECT karnety.* from karnety";

    $result = mysqli_query($connect,$zapytanie_karnety);

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
    <title>Karnety</title>
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

        <div class="text-center text-light p-3 karnety_nav">
        
            <p>
                <a href="wynik.php" class="text-info" id="cien">Wróć do swego konta</a>
            </p>

            <p>
                Tutaj możesz kupić karnety
            </p>
                
        </div>

        <div class="table-responsive text-center text-light karnety">

            <table class="table_karnety">

            <tr class="tr_karnety text-warning">
                <th class="th_karnety"></th>
                <th class="th_karnety">Typ karnetu</th>
                <th class="th_karnety">Cena</th>
                <th class="th_karnety">Zakup</th>
            </tr>

            <?php

                while ($row = mysqli_fetch_array ($result))
                {

                    echo '<tr class="tr_karnety">
                    <td class="td_karnety zdj_karnety"><img src="zdjecia/bilet.png" alt="bilet" class="bilet"></td>
                    <td class="td_karnety">'.$row['opis'].'</td>
                    <td class="td_karnety">'.$row['cena'].' zł</td>
                    <td class="td_karnety">
                    <form action="wynik.php" method="post">
                    <input name="karnet_id" value="'.$row['id'].'" style="display:none;">
                    <input name="karnet_cena" value="'.$row['cena'].'" style="display:none;">
                    <input type="submit" value="Kup">
                    </form>
                    </td>
                    </tr>
                    ';

                }

            ?>

            </table>

        </div>
        
    <?php
        }
    ?>

</body>
</html>