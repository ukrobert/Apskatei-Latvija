<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sakums</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="shortcut icon" href="../assets/images/fav.png" type="image/x-icon">
</head>
<body>
    <?php  
    $page = "sakums";
    require "header.php";
    ?>
    

    <section class="admin">
        <div class="kopsavilkums">
        <?php
            require '../assets/connect_db.php';
            
        ?>
            

            <div class="info-box">
                <span></span>
                <div>
                    <h3>Jaunas ekskursijas</h3>
                    <p>pedejo 24h laika</p>
                </div>
            </div>
            <div class="info-box">
                <span></span>
                <div>
                    <h3>Jaunie ceļveži</h3>
                    <p>pēdējo 5 dienu atpakaļ</p>
                </div>
            </div>
            <div class="info-box">
                <span></span>
                <div>
                    <h3>Pieteikumi</h3>
                    <p>kopš ekskursijas sakuma</p>
                </div>
            </div>
            
            </div>
        </div>

        <div class="row">
            <div class="info1 defaulBorders">
                <div class="head-info">Jaunakie pieteikumi ekskursijās</div>
                <table>
                    <tr>
                        <th>Vards</th>
                        <th>Uzvards</th>
                        <th>Tālruņa numurs</th>
                    </tr>
                    
                    <tr>
                        <td>Jānis</td>
                        <td>Bērziņš</td>
                        <td>+37127312918</td>
                    </tr>
                    <tr>
                        <td>Anna</td>
                        <td>Ozoliņa</td>
                        <td>+37129184258</td>
                    </tr>
                    
                </table>
            </div>

            <div class="info2 defaulBorders">
                <div class="head-info">Pieprasitakas ekskursijās</div>
                <table>
                    <tr>
                        <th>Pilsetas</th>
                        <th>Pieteikumi kopa</th>
                    </tr>
                    
                    <tr>
                        <td>Liepāja</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>Riga</td>
                        <td>20</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </section>

    
    
</body>
</html>
