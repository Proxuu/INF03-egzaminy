<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poziomy rzek</title>
    <link rel="stylesheet" type="text/css" href="styl.css">
</head>
<body>
    <header>
        <div id="baner1">
            <img src="obraz1.png" alt="Mapa Polski">
        </div>
        <div id="baner2">
            <h1>Rzeki w województwie dolnośląskim</h1>
        </div>
    </header>
    <nav>
        <div id="menu">
            <form action="poziomRzek.php" method="post">
                <label class="poletext"><input type="radio" name="pole" value="wszystkie">Wszystkie</label>
                <label class="poletext"><input type="radio" name="pole" value="stanOstrzegawczy">Ponad stan ostrzegawczy </label>
                <label class="poletext"><input type="radio" name="pole" value="stanAlarmowy">Ponad stan alarmowy</label>
                <input type="submit" value="pokaż"> 
            </form>
        </div>
    </nav>
    <main>
        <div id="lewy">
            <h3>Stan na dzień 2022-05-05</h3>

            <table>
                <tr>
                    <th>Wodomierz</th>
                    <th>Rzeka</th>
                    <th>Ostrzegawczy</th>
                    <th>Alarmowy</th>
                    <th>Aktualny</th>
                </tr>
                <!-- skrypt1 -->

                <?php

                $conn = mysqli_connect('localhost', 'root', '', 'rzeki');
                $sql1 = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = pomiary.wodowskazy_id WHERE dataPomiaru = '2022-05-05' AND stanWody > stanOstrzegawczy;";
                $sql2 = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = pomiary.wodowskazy_id WHERE dataPomiaru = '2022-05-05';";
                $sql3 = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = pomiary.wodowskazy_id WHERE dataPomiaru = '2022-05-05' AND stanWody > stanAlarmowy;";
                
                if(isset($_POST['pole'])){
                    $pole = $_POST['pole'];
                };
    
                if($pole){

                if($pole === "wszystkie"){
                    $query = mysqli_query($conn, $sql2);
                }
                if($pole === "stanOstrzegawczy"){
                    $query = mysqli_query($conn, $sql1);
                }
                if($pole === "stanAlarmowy"){
                    $query = mysqli_query($conn, $sql3);
                }

                while($row = mysqli_fetch_row($query)){
                    echo '<tr>';
                    echo "<td>".$row[0]."</td>";
                    echo "<td>".$row[1]."</td>";
                    echo "<td>".$row[2]."</td>";
                    echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[4]."</td>";
                    echo '</tr>';
                }
            }
                ?>
            </table>

        </div>
        <div id="prawy">
            <h3>Informacje</h3>
            <ul>
                <li>Brak ostrzeżen o burzach z gradem</li>
                <li>Smog w mieście Wrocław</li>
                <li>Silny wiatr w Karkonoszach</li>
            </ul>

            <h3>Średnie stany wód</h3>

            <!-- skrypt2 -->



            <?php

            $sql2 = "SELECT dataPomiaru, AVG(stanWody) FROM pomiary GROUP BY dataPomiaru;";

            $query2 = mysqli_query($conn, $sql2);

            while($row = mysqli_fetch_row($query2)){
                echo "<p>".$row[0].": ".$row[1]."</p>";
            }




            mysqli_close($conn);
            ?>
            <a href="https://komunikaty.pl">Dowiedz się więcej</a>

            <img src="obraz2.jpg" alt="rzeka">

        </div>
    </main>
    <footer>
        <div id="stopka">
            <p>Stronę wykonał: 00000000000</p>
        </div>
    </footer>
</body>
</html>