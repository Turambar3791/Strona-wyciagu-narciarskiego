<?php

    session_start();

    $code = 303;

    if (isset($_POST['karnet_id']) || isset($_POST['ile']) || isset($_POST['zwrot']))
    {
        header('Location:wynik.php', true, $code);
    }
    
    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connect = new mysqli($host,$db_user,$db_password,$db_name);

    if (isset($_POST['karnet_id']))
    {

        // losowanie numeru karnetu
        for($i = 0; $i == 0;) 
        {
            $kod = rand(100000,999999);

            $kodowe_zapytanie = $connect->query("SELECT id FROM paragon WHERE kod='$kod'");

            $ile_takich_kodow = $kodowe_zapytanie->num_rows;

            if($ile_takich_kodow<1) {
                $i++;
            }
        }

        $kupiony_karnet = $_POST['karnet_id'];

        $kupowanie_sql = 'INSERT INTO paragon(klient,karnet,kod) VALUES ('.$_SESSION['id'].','.$kupiony_karnet.','.$kod.')';
    
        $cena_karnetu = $_POST['karnet_cena'];

        // kupowanie karnetu (zmiana portfela i dodanie karnetu do konta)
        if ($_SESSION['portfel']>=$cena_karnetu)
        {
            $connect->query($kupowanie_sql);
            $_SESSION['portfel'] = $_SESSION['portfel']-$cena_karnetu;
            $wydawanie_sql = "UPDATE uzytkownicy SET portfel='$_SESSION[portfel]-$cena_karnetu' WHERE id=$_SESSION[id]";
            $connect->query($wydawanie_sql);
        }
        else
        {
            //jak nie ma pienionżków
            $_SESSION['brak_mamony'] = 'brak';
            header('Location: brak_mamony.php');
            exit();
        }
    }

    unset($_POST['karnet_id']);

    // doładowanie portfela
    if (isset($_POST['ile']))
    {
        $doladowanie = $_POST['ile'];

        $_SESSION['portfel'] = $_SESSION['portfel']+$doladowanie;
        $doladowanie_sql = "UPDATE uzytkownicy SET portfel=$_SESSION[portfel] WHERE id=$_SESSION[id]";
        $connect->query($doladowanie_sql);
    }

    unset($_POST['ile']);

    // zwracanie karnetu
    if (isset($_POST['zwrot']))
    {
        $zwrot = $_POST['zwrot'];
        $cena_zwrotu = $_POST['cena_zwrotu'];

        $query_delete = "DELETE FROM paragon WHERE id = $zwrot";
        $_SESSION['portfel'] = $_SESSION['portfel']+$cena_zwrotu;
        $query_gimme_money = "UPDATE uzytkownicy SET portfel=$_SESSION[portfel] WHERE id=$_SESSION[id]";
        $connect->query($query_delete);
        $connect->query($query_gimme_money);
    }

    unset($_POST['zwrot']);

    $zapytanie_karnety = "SELECT paragon.id AS p_id, paragon.*, karnety.* from paragon JOIN karnety ON paragon.karnet=karnety.id WHERE klient=$_SESSION[id]";

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
    <title>Dane o koncie</title>
</head>
<body class="bg-danger-subtle">

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

        <!-- karnety, które masz -->
        <div class="text-center text-light twoje_karnety">

            <table class="table_twoje_karnety">

                <tr class="text-warning">
                    <th class="tr_twoje_karnety"></th>
                    <th class="tr_twoje_karnety">Typ karnetu</th>
                    <th class="tr_twoje_karnety">Cena</th>
                    <th class="tr_twoje_karnety">Data zakupu</th>
                    <th class="tr_twoje_karnety">Kod QR</th>
                    <th class="tr_twoje_karnety">Zwróć bilet</th>
                </tr>
            
                <?php

                    //jak nie działa to zrób to -> https://stackoverflow.com/questions/68194770/why-is-my-png-img-of-qr-not-displaying-in-php

                    include 'phpqrcode/qrlib.php';

                    $ecc = 'L';
                    $pixel_Size = 10;
                    $frame_Size = 3;
                    
                    while ($row = mysqli_fetch_array ($result))
                    {

                        $kodzik = $row['kod'];

                        $path = 'zdjecia/qr/';
                        $file = $path.uniqid().'.png';

                        QRcode::png($kodzik, $file, $ecc, $pixel_Size, $frame_Size);
                        
                        echo '<tr class="tr_twoje_karnety">
                        <td class="td_twoje_karnety zdj_twoje"><img src="zdjecia/bilet.png" alt="bilet" class="twoj_bilet"></td>
                        <td class="td_twoje_karnety">'.$row['opis'].'</td>
                        <td class="td_twoje_karnety">'.$row['cena'].' zł</td>
                        <td class="td_twoje_karnety">'.$row['data'].'</td>
                        <td class="td_twoje_karnety"><a href="'.$file.'" download class="text-info" id="cien">Pobierz kod qr do okazania w kasie</a></td>
                        <td class="td_twoje_karnety">
                        <form action="#" method="post"><input name="zwrot" value="'.$row['p_id'].'" type="hidden"><input name="cena_zwrotu" value="'.$row['cena'].'" type="hidden"><input type="submit" value="Zwróć bilet"></form>
                        </td>
                        </tr>';
                    }
                    echo '</p>';

                ?>

            </table>
            
        </div>

        <!-- dane osobowe -->
        <div class="p-2 text-center dane_osobowe">

            <p class="fs-4"><b>Dane osobowe</b></p>

            <?php

                echo '<p><b>Login</b>: '.$_SESSION['user'].'</p>
                <p><b>Email</b>: '.$_SESSION['email'].'</p>
                <p><b>Twój portfel</b>: '.$_SESSION['portfel'].' zł</p>
                <p><a href="logout.php" class="text-info" id="cien">Wyloguj się</a></p>
                ';

            ?>

        </div>

        <div class="p-2 text-center dodatkowe_info">
            <p><a href="doladowanie.php" class="text-info" id="cien">Doładuj swój portfel</a></p>
            <p><a href="karnety.php" class="text-info" id="cien">Kup karnety</a></p>
            
            <?php

                if($_SESSION['admin'] == true)
                {
                    echo '<p><a href="admin.php" class="text-info" id="cien">Panel admina</a></p>';
                }
                
            ?>


        </div>

    <?php
        }
    ?>

</body>
</html>