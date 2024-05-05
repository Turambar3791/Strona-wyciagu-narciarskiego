<?php

    session_start();

    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
    {
        header('Location: wynik.php');
        exit();
    }

	if (isset($_POST['email']))
	{
		// na początek walidacja = tak
		$wszystko_OK = true;
		
		// sprawdzamy login
		$nick = $_POST['nick'];
		
		// sprawdzamy długość loginu
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick'] = "Login musi posiadać od 3 do 20 znaków!";
		}

        if (ctype_alnum($nick)==false)
        {
            $wszystko_OK=false;
            $_SESSION['e_nick']='Login może składać się tylko z liter i cyfr (bez polskich znaków)!';
        }

        // sprawdzamy adres email
        $email = $_POST['email'];
        $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);

        if ((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
        {
            $wszystko_OK=false;
            $_SESSION['e_email']="Podaj poprawny email!";
        }

        // sprawdzamy hasło
        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];

        if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']='Hasło musi posiadać od 8 do 20 znaków!';
        }

        if ($haslo1!=$haslo2)
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
        }

        $haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);

        // akceptujesz regulamin?
        if (!isset($_POST['regulamin']))
        {
            $wszystko_OK=false;
            $_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
        }

        // zapamiętujemy dane

        $_SESSION['fr_nick']=$nick;
        $_SESSION['fr_email']=$email;
        $_SESSION['fr_haslo1']=$haslo1;
        $_SESSION['fr_haslo2']=$haslo2;
        if(isset($_POST['regulamin'])) $_SESSION['fr_regulamin']=true;

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
                // czy jest już taki email?
                $rezultat = $connect->query("SELECT id FROM uzytkownicy WHERE email='$email'");

                if (!$rezultat) throw new Exception($connect->error);

                $ile_takich_maili = $rezultat->num_rows;
                if ($ile_takich_maili>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
                }

                // czy jest już taki login?
                $rezultat = $connect->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

                if (!$rezultat) throw new Exception($connect->error);

                $ile_takich_nickow = $rezultat->num_rows;
                if ($ile_takich_nickow>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_nick']="Istnieje już konto z takim loginem!";
                }

                if ($wszystko_OK==true)
                {
                    // wszystko działa
                    
                    if ($connect->query("INSERT INTO uzytkownicy(user,password,email) VALUES ('$nick','$haslo_hash','$email')"))
                    {
                        $_SESSION['udanarejestracja']=true;
                        header('Location: witamy.php');
                    }
                    else
                    {
                        throw new Exception($connect->error);
                    }
                    
                }

                $connect->close();
            }
        }
        catch (Exception $e)
        {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodoności i prosimy o rejestrację w innym terminie!</span>';
            //echo '<br>Infromacja developerska: '.$e;
        }
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
    <title>Rejestracja</title>
</head>
<body>

    <div class="logo">
        <a href="main_page.php">
            <img src="zdjecia/logo.png" alt="logo">
        </a>
    </div>

    <div class="text-center fs-5 text-light p-4 centrowanie rejestracja">

        <form method="post" autocomplete="off">
            <p>
                Login <br> <input type="text" value="<?php 
                    if(isset($_SESSION['fr_nick']))
                    {
                        echo $_SESSION['fr_nick'];
                        unset($_SESSION['fr_nick']);
                    }

                ?>" name="nick"> 
            </p>

            <?php
                if (isset($_SESSION['e_nick']))
                {
                    echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                    unset($_SESSION['e_nick']);
                }
            ?>

            <p>
                E-mail <br> <input type="text" value="<?php 
                    if(isset($_SESSION['fr_email']))
                    {
                        echo $_SESSION['fr_email'];
                        unset($_SESSION['fr_email']);
                    }

                ?>" name="email">
            </p>

            <?php
                if (isset($_SESSION['e_email']))
                {
                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
                }
            ?>

            <p>
                Hasło <br> <input type="password" value="<?php 
                    if(isset($_SESSION['fr_haslo1']))
                    {
                        echo $_SESSION['fr_haslo1'];
                        unset($_SESSION['fr_haslo1']);
                    }

                ?>" name="haslo1">
            </p>

            <?php
                if (isset($_SESSION['e_haslo']))
                {
                    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                    unset($_SESSION['e_haslo']);
                }
            ?>

            <p>
                Powtórz hasło <br> <input type="password" value="<?php 
                    if(isset($_SESSION['fr_haslo2']))
                    {
                        echo $_SESSION['fr_haslo2'];
                        unset($_SESSION['fr_haslo2']);
                    }

                ?>" name="haslo2"> 
            </p>

            <p>
                <label>
                    <input type="checkbox" name="regulamin" <?php 
                        if (isset($_SESSION['fr_regulamin']))
                        {
                            echo "checked";
                            unset($_SESSION['fr_regulamin']);
                        }
                    
                    ?>> Akceptuję regulamin
                </label>
            </p>

            <?php
                if (isset($_SESSION['e_regulamin']))
                {
                    echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                    unset($_SESSION['e_regulamin']);
                }
            ?>

            <p>
                <input type="submit" value="Zarejestruj się">
            </p>

        </form>

        <a href="index.php" class="text-info" id="cien">Wróć do logowania</a>

    </div>



</body>
</html>