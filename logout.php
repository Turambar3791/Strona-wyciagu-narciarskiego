<?php

    session_start();

    $kasowanko =  array_map('unlink', glob("zdjecia/qr/*.png")); // tu się zdjęcią kodów QR kasują

    session_unset();

    header('Location: index.php');

?>