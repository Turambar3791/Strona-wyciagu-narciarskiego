<?php

    session_start();

    $code = 303;

    if (isset($_POST['banowanie']) || isset($_POST['usun']) || isset($_POST['opis']) || isset($_POST['cena']) || isset($_POST['id_usuwanko']))
    {
        header('Location:admin.php', true, $code);
    }

    if (!isset($_SESSION['zalogowany']) || $_SESSION['admin'] != 1)
    {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connect = new mysqli($host,$db_user,$db_password,$db_name);

    $adminowe_zapytanie = "SELECT * FROM uzytkownicy";

    $result = mysqli_query($connect,$adminowe_zapytanie);

    $adminowe_zapytanie_karnety = "SELECT * FROM karnety";

    $result_karnety = mysqli_query($connect,$adminowe_zapytanie_karnety);

    // banowanie użytkowników
    if (isset($_POST['banowanie']))
    {
        $ban = $_POST['banowanie'];

        if ($_POST['ban'] == 'y')
        {
            $query_odban = "UPDATE uzytkownicy SET ban = 0 WHERE id = $ban";
            $connect->query($query_odban);
        }
        else if ($_POST['ban'] == 'n')
        {
            $query_ban = "UPDATE uzytkownicy SET ban = 1 WHERE id = $ban"; 
            $connect->query($query_ban);
        }
    }

    unset($_POST['banowanie']);

    // usuwanie użytkowników
    if (isset($_POST['usun']))
    {
        $usuwanko = $_POST['usun'];

        $query_usun = "DELETE FROM uzytkownicy WHERE id = $usuwanko";
        $connect->query($query_usun);
    }

    unset($_POST['usun']);

    // dodawanie karnetów
    if (isset($_POST['opis']) && isset($_POST['cena']))
    {
        $opis = $_POST['opis'];
        $cena = $_POST['cena'];

        $query_dodaj_ticket = "INSERT INTO karnety(cena, opis) VALUES ('".$cena."', '".$opis."')";
        $connect->query($query_dodaj_ticket);
    }

    unset($_POST['opis']);
    unset($_POST['cena']);

    // usuwanie karnetów
    if (isset($_POST['id_usuwanko']))
    {
        $usun_ticket = $_POST['id_usuwanko'];

        $query_usun_ticket = "DELETE FROM karnety WHERE id= $usun_ticket";
        $connect->query($query_usun_ticket);
    }

    unset($_POST['id_usuwanko']);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="zdjecia/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="guziczki.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Panel admina</title>
</head>
<body class="body_admin">

    <div class="logo">
        <a href="main_page.php">
            <img src="zdjecia/logo.png" alt="logo">
        </a>
    </div>
    
    <div class="bg-dark powrot">

        <h1 class="text-center text-success p-2 admin_napis">Panel admina</h1>

        <p class="text-center p-3">
            <a href="wynik.php" class="text-info fs-5" id="cien">Wróć do swego konta</a>
        </p>
        
    </div>

    <main>
        
        <div class="text-success text-center fs-5 bg-dark guziczki">
            <div class="guziczek1" onclick="pojawianko1()">Zarządzanie użytkownikami</div>
            <div class="guziczek2" onclick="pojawianko2()">Dodawanie karnetów</div>
            <div class="guziczek3" onclick="pojawianko3()">Usuwanie karnetów</div>
        </div>

        <!-- użytkownicy - dodawanie i usuwanie -->
        <div class="text-center bg-dark admin_user" id="div1">

            <table class="table_admin">

                <tr class="text-success tr_admin">
                    <th class="th_admin">Id</th>
                    <th class="th_admin">Login</th>
                    <th class="th_admin">Email</th>
                    <th class="th_admin">Admin</th>
                    <th class="th_admin">Portfel</th>
                    <th class="th_admin">Banowanie</th>
                    <th class="th_admin">Usuwanie</th>
                </tr>

                <?php

                    while ($row = mysqli_fetch_array ($result))
                    {
                        echo '<tr class="tr_admin">
                        <td class="td_admin">'.$row['id'].'</td>
                        <td class="td_admin">'.$row['user'].'</td>
                        <td class="td_admin">'.$row['email'].'</td>
                        <td class="td_admin">'.$row['admin'].'</td>
                        <td class="td_admin">'.$row['portfel'].'</td>
                        <td class="td_admin"><form action="#" method="post">
                        <input name="banowanie" value="'.$row['id'].'" type="hidden">';
                        
                        if ($row['ban'] == 1)
                        {
                            echo '<input type="hidden" name="ban" value="y"><input type="submit" value="Zbanowany">';
                        }
                        else
                        {
                            if ($row['admin'] == 0)
                            {
                                echo '<input type="hidden" name="ban" value="n"><input type="submit" value="Niezbanowany">';
                            }
                            else
                            {
                                echo '<input type="submit" value="Niezbanowany" disabled>';
                            }
                        }
                
                        echo '</form></td>
                        <td><form action="#" method="post">
                        <input type="hidden" value="'.$row['id'].'" name="usun">';
                        
                        if ($row['admin'] == 0)
                        {
                            echo '<input type="submit" value="Usuń">';
                        }
                        else
                        {
                            echo '<input type="submit" value="Usuń" disabled>';
                        }
                        
                        echo '</form></td>
                        </tr>';
                    }

                ?>

            </table>

        </div>

        <!-- dodawanie karnetów -->
        <div class="text-center bg-dark admin_karnety" id="div2">
            
            <table class="table_admin">

                <tr class="text-success tr_admin">
                    <th class="th_admin"></th>
                    <th class="th_admin">Opis biletu</th>
                    <th class="th_admin">Cena biletu w zł</th>
                    <th class="th_admin">Dodawanie</th>
                </tr>

                <tr class="tr_admin">
                    <td class="td_admin td_admin_ticket"><img src="zdjecia/bilet.png" alt="bilet" class="admin_img_ticket"></td>
                    <form action="#" method="post" autocomplete="off">
                        <td class="td_admin"><input type="text" name="opis"></td>
                        <td class="td_admin"><input type="number" min="1" max="1000" name="cena"></td>
                        <td class="td_admin"><input type="submit" value="Dodaj"></td>
                    </form>
                </tr>

            </table>

        </div>

        <!-- usuwanie karnetów -->
        <div class="text-center bg-dark admin_karnety_usuwanie" id="div3">
            
            <table class="table_admin">

                <tr class="text-success tr_admin">
                    <th class="th_admin"></th>
                    <th class="th_admin">Opis biletu</th>
                    <th class="th_admin">Cena biletu</th>
                    <th class="th_admin">Usuwanie</th>
                </tr>

                <?php

                    while ($row = mysqli_fetch_array($result_karnety))
                    {
                        echo '<tr class="tr_admin text-success"><td class="td_admin td_admin_ticket"><img src="zdjecia/bilet.png" alt="bilet" class="admin_img_ticket"></td>
                        <form action="#" method="post" autocomplete="off">
                            <td class="td_admin">'.$row['opis'].'</td>
                            <td class="td_admin">'.$row['cena'].' zł</td>
                            <td class="td_admin"><input type="hidden" value="'.$row['id'].'" name="id_usuwanko"><input type="submit" value="Usuń"></td>
                        </form></tr>';
                    }

                ?>

            </table>

        </div>

    </main>

</body>
</html>