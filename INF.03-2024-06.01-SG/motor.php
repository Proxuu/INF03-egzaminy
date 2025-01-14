<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motocykle</title>
    <link rel="stylesheet" type="text/css" href="styl.css">
</head>
<body>
    <img src="motor.png" alt="motocykl">
    
    <header>
        <div id="baner">
            <h1>Motocykle - moja pasja</h1>
        </div>
    </header>
    <main>
        <div id="lewy">
            <h2>Gdzie pojechać?</h2>
            <!-- Skrypt 1-->
             <?php
                $conn = mysqli_connect('localhost', 'root', '', 'motory');
                $sql1 = "SELECT nazwa, opis, poczatek, zrodlo FROM wycieczki JOIN zdjecia ON wycieczki.zdjecia_id = zdjecia.id;";

                $query1 =  mysqli_query($conn, $sql1);

                while($row = mysqli_fetch_row($query1)){
                    echo "<dl><dt>";
                    echo $row[0];
                    echo ", rozpoczyna się w ";
                    echo $row[2]." ";
                    echo "<a href='".$row[3]."'>zobacz zdjęcie</a></dt>";
                    echo "<dd>".$row[1]."</dd>";
                    echo "</dl>";
                }


            ?>
        </div>
    </main>

    <aside>
        <div id="prawy1">
            <h2>Co kupić?</h2>

            <ol>
                <li>Honda CBR125R</li>
                <li>Yamaha YBR125</li>
                <li>Honda VFR800i</li>
                <li>Honda CBR1100XX</li>
                <li>BMW R1200GS LC</li>
            </ol>
        </div>

        <div id="prawy2">
            <h2>Statystyki</h2>
            <p>Wpisanych wycieczek: <!--skrypt 2-->
                <?php

                $sql2 = "SELECT count(*) FROM wycieczki;";
                $query2 = mysqli_query($conn, $sql2);

                while($row = mysqli_fetch_row($query2)){
                    echo $row[0];
                }




                mysqli_close($conn);
                ?>
            </p>
            <p>Użytkowników forum: 200</p>
            <p>Przesłanych zdjęć: 1300</p>
        </div>
            </aside>
    <footer>
        <div id="stopka">
            <p>Stronę wykonał: 00000000</p>
        </div>
    </footer>
    
</body>
</html>