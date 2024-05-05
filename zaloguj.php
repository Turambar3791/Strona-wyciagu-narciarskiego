<?php

    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
    {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {
        $connect = new mysqli($host,$db_user,$db_password,$db_name);

        if ($connect->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
    
            $login = htmlentities($login,ENT_QUOTES,"UTF-8");
            
            // mądry if
            if ($rezultat = @$connect->query(
                sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
                mysqli_real_escape_string($connect,$login))))
            {
                $ilu_userow = $rezultat->num_rows;
                if ($ilu_userow>0)
                {
                    $wiersz = $rezultat->fetch_assoc();

                    // czy hasło == hasło_hash?
                    if (password_verify($haslo, $wiersz['password']))
                    {
                        $_SESSION['zalogowany'] = true;
    
                        // potrzebne zmienne sesyjne
                        $_SESSION['id'] = $wiersz['id'];
                        $_SESSION['user'] = $wiersz['user'];
                        $_SESSION['email'] = $wiersz['email'];
                        $_SESSION['portfel'] = $wiersz['portfel'];
                        $_SESSION['admin'] = $wiersz['admin'];
                        $_SESSION['ban'] = $wiersz['ban'];
    
                        unset($_SESSION['blad']);
                        $rezultat->free_result();
                        header('Location: wynik.php');
                    }
                    else
                    {
                        $_SESSION['blad'] = '<span class="error">Nieprawidłowy login lub hasło!</span>';
                        header('Location: index.php');
                    }
                }
                else
                {
                    $_SESSION['blad'] = '<span class="error">Nieprawidłowy login lub hasło!</span>';
                    header('Location: index.php');
                }
    
            }
            else
            {
                throw new Exception($connect->error);
            }
    
            $connect->close();
        }
    }
    catch(Exception $e)
    {
        echo '<span style="color: red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
        echo '<br> Informacja developerska: '.$e;
    }
?>