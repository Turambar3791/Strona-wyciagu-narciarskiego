<?php

    session_start();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="zdjecia/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="slider.js"></script>
    <link rel="stylesheet" href="main_page.css">
    <title>Wyciąg narciarski | Złoty Groń</title>
</head>
<body>

    <nav>

        <div class="row">

            <div class="col-3">

                <a href="main_page.php"><img src="zdjecia/logo.png" alt="logo" class="logo"></a>

            </div>
            
            <div class="col-7">

                <div class="menu">
                    <a href="#galeria" class="kotwiczki">Galeria</a>
                    <a href="#info" class="kotwiczki">Informacje</a>
                    <a href="#bilety" class="kotwiczki">Bilety</a>
                    <a href="#godziny" class="kotwiczki">Godziny otwarcia</a>
                </div>

            </div>

            <div class="col-2">

                <div class="logowane_div">
                    <a href="index.php" class="logowanie_link">
                        <img src="zdjecia/logowanie.png" alt="avatar" class="avatar">
                        <?php

                            if (!isset($_SESSION['zalogowany']))
                            {
                                echo 'Zaloguj się';
                            }
                            else
                            {
                                echo 'Witaj '.$_SESSION['user'].'!';
                            }

                        ?>
                    </a>
                </div>

            </div>

        </div>

    </nav>

    <div class="zapychacz"></div>

    <main>

        <section id="galeria">
            
            <div class="row">
                            
                <div class="col-1">

                    <div class="strzałka_lewa" onclick="left()">
                    <!-- <div class="strzałka_lewa" onclick="plusSlides(-1)"> -->
                        &#10094;
                    </div>

                </div>

                <div class="col-10">

                    <div class="slajdy">
                        <div class="slajd" id="slajd1"><img src="zdjecia/slajd1.jpg" alt="slajd1"></div>
                        <div class="slajd" id="slajd2"><img src="zdjecia/slajd2.jpg" alt="slajd2"></div>
                        <div class="slajd" id="slajd3"><img src="zdjecia/slajd3.jpg" alt="slajd3"></div>
                    </div>

                </div>

                <div class="col-1">

                    <div class="strzałka_prawa" onclick="right()">
                    <!-- <div class="strzałka_prawa" onclick="plusSlides(1)"> -->
                        &#10095;
                    </div> 

                </div>

            </div>

        </section>

        <section id="info">

            <div class="row">
                
                <div class="col-1"></div>

                <div class="col-4">

                    <div class="mapa">
                        
                        <h1>Informacje</h1>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2587.3658917586554!2d18.915738256783975!3d49.571986729286394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47143d943afe6299%3A0x852ca50e40018449!2sStacja%20narciarska%20Z%C5%82oty%20Gro%C5%84!5e0!3m2!1spl!2spl!4v1681647524367!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>
                    

                </div>

                <div class="col-6">

                    <div class="opis_wyciagi">
    
                        <p>
                            Ośrodek Narciarski Złoty Groń położony jest w malowniczej wsi Istebna, w dorzeczu Olzy. Wyjątkowy mikroklimat sprawia, że śnieg utrzymuje się od listopada do kwietnia, a temperatura jest o kilka stopni niższa, niż w pobliskich miejscowościach. Miłośnicy sportów zimowych mają do dyspozycji bardzo dobrze przygotowane i szerokie trasy o zróżnicowanym stopniu trudności.
                        </p>

                        <table class="table_wyciagi">
                            <tr class="tr_wyciagi">
                                <th class="th_wyciagi">Wyciąg</th>
                                <th class="th_wyciagi">Długość</th>
                                <th class="th_wyciagi">Przepustowść</th>
                                <th class="th_wyciagi">Czas wyjazdu</th>
                            </tr>
                            <tr class="tr_wyciagi">
                                <td class="td_wyciagi">6 os. kolej linowa wyprzęgana</td>
                                <td class="td_wyciagi">800 m</td>
                                <td class="td_wyciagi">	2550os/h</td>
                                <td class="td_wyciagi">2,6 min</td>
                            </tr>
                            <tr class="tr_wyciagi">
                                <td class="td_wyciagi">Wyciąg teleskopowy "Gronik"</td>
                                <td class="td_wyciagi">290 m</td>
                                <td class="td_wyciagi">	900os/h</td>
                                <td class="td_wyciagi">2,2 min</td>
                            </tr>
                            <tr class="tr_wyciagi">
                                <td class="td_wyciagi">Strefa dla dzieci (taśma, tubing) wyciąg dla dzieci</td>
                                <td class="td_wyciagi">40 m</td>
                                <td class="td_wyciagi">	400os/h</td>
                                <td class="td_wyciagi">0,5 min</td>
                            </tr>
                        </table>

                        <ul class="lista_zasady">
                            <li>wyciąg krzesełkowy 6-osobowy, szwajcarskiej firmy BMF, o długości 800 m, przepustowość 2550 os/h, prędkość 5 m/s</li>
                            <li>wyciąg talerzykowy "Gronik" o długości 290 m, przepustowość 900 os/h</li>
                            <li>Strefa dla dzieci a w niej karuzela, wyciąg taśmowy i dużo radości</li>
                            <li>oświetlenie, nowoczesny system naśnieżania</li>
                            <li>trasa treningowa z elektronicznym pomiarem czasu</li>
                            <li>Szkoła Narciarska SITN-PZN</li>
                            <li>Szkoła Snowboardu SITS-PZS</li>
                            <li>4 punkty gastronomiczne</li>
                            <li>bezpłatny parking</li>
                            <li>parkowanie pojazdów typu kamper jest możliwe po wcześniejszym uzgodnieniu z Biurem Obsługi Klienta ON Złoty Groń i podlega opłacie: 50,00 zł, z podłączeniem do prądu 70,00 zł. Płatne po zakończeniu pobytu w BOK. </li>
                        </ul>

                    </div>

                </div>

                <div class="col-1"></div>

            </div>

        </section>
        
        <section id="bilety">

            <div class="row">

                <div class="col-1"></div>

                <div class="col-4">

                    <div class="bilety_tableka">

                        <h1>Bilety</h1>

                        <table class="table_bilety">
                            <tr class="tr_bilety">
                                <th class="th_bilety">Rodzaj biletu</th>
                                <th class="th_bilety">Cena</th>
                            </tr>
                            <tr class="tr_bilety">
                                <td class="td_bilety">godzinny</td>
                                <td class="td_bilety">25 zł</td>
                            </tr>
                            <tr class="tr_bilety">
                                <td class="td_bilety">2-godzinny</td>
                                <td class="td_bilety">45 zł</td>
                            </tr>
                            <tr class="tr_bilety">
                                <td class="td_bilety">4-godzinny</td>
                                <td class="td_bilety">80 zł</td>
                            </tr>
                        </table>

                    </div>
                
                </div>

                <div class="col-6">

                    <div class="bilety_info">

                        <ul>
                            <li>czas liczony od pierwszego odbicia</li>
                            <li>karnety kilkudniowe dotyczą KOLEJNYCH dni</li>
                            <li>przerwa techniczna 16:00-17:00 Ratrakowanie stoku</li>
                            <li>bilety można kupić wyłącznie w kasie, a karnety poprzez stronę internetową</li>
                        </ul>

                    </div>

                </div>

                <div class="col-1"></div>

            </div>

        </section>

        <section id="godziny">

            <div class="row">
                
                <div class="col-1"></div>

                <div class="col-10">

                    <div class="godziny_info">

                        <h1>Godziny otwarcia</h1>

                        <p>
                            Ośrodek Narciarski Złoty Groń w Istebnej jest uruchamiany od „pierwszego śniegu” i jest czynny do „ostatniego śniegu” – chyba, że ogólne warunki eksploatacyjne zmuszą do zmian (komunikat). Ośrodek Narciarski Złoty Groń zastrzega sobie prawo do zmian godzin otwarcia w wyjątkowych sytuacjach pogodowych (np. silny wiatr) i z powodu awarii technicznych. Przypominamy, że jazda poza trasami może być niezgodna z warunkami indywidualnych ubezpieczeń. Przypominamy również, że jazda po spożyciu alkoholu jest niedozwolona.
                        </p>

                    </div>

                </div>

                <div class="col-1"></div>

            </div>

        </section>

    </main>

    <footer>
        
    </footer>
</body>
</html>