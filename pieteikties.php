<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/style.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pievienotas ekskursijas</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="nav-container">
                    <div class="brand">Apskati Latviju</div>
                    <div class="responsive-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
                <div class="links">
                    <ul>
                        <li><a href="index.html">Uz sākumu</a></li>
                        <li><a href="jaunumi.php">Jaunumi</a></li>
                        <li><a href="eks.php">Atpakaļ</a></li>
                        <li><a href="guides.php">Mūsu ceļveži</a></li>
                        <li><a href="Mums.html">Par mums</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="next-eks">
        <div class="content">
            <div class="eks-container">
            <?php
           
            

           
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['iesniegt'])) {
                require 'assets/connect_db.php';  

                $required_fields = ['Vards', 'Uzvards', 'Talrunis', 'Datums'];
                $missing_fields = [];

              
                foreach ($required_fields as $field) {
                    if (empty($_POST[$field])) {
                        $missing_fields[] = $field;
                    }
                }

                if (!empty($missing_fields)) {
                    echo "<div class='paz'><p>Lūdzu aizpildiet visus obligātos laukus!</p></div>";
                } else {
                    // Sanitize and escape the input data
                    $vards_ievade = mysqli_real_escape_string($savienojums, $_POST['Vards']);
                    $uzvards_ievade = mysqli_real_escape_string($savienojums, $_POST['Uzvards']);
                    $talrunis_ievade = mysqli_real_escape_string($savienojums, $_POST['Talrunis']);
                    $datums_ievade = mysqli_real_escape_string($savienojums, $_POST['Datums']);

                    // Check how many times the phone number has been used
                    $pazinot_reizes_SQL = "SELECT COUNT(*) AS reizes FROM apskati_pieteikumi WHERE Talrunis = '$talrunis_ievade'";
                    $rezultats = mysqli_query($savienojums, $pazinot_reizes_SQL);
                    
                    if ($rezultats) {
                        $rinda = mysqli_fetch_assoc($rezultats);
                        $reizes = $rinda['reizes'];

                        if ($reizes >= 3) {
                            echo "<div class='paz'><p>Jūs nevarat pieteikties vairāk kā 3 reizes no viena un tā paša telefona numura!<p></div>";
                        } else {
                            // Insert the form data into the database
                            $pieteiksanas_SQL = "INSERT INTO apskati_pieteikumi (Vards, Uzvards, Talrunis, Date1) VALUES ('$vards_ievade', '$uzvards_ievade', '$talrunis_ievade', '$datums_ievade')";

                            if (mysqli_query($savienojums, $pieteiksanas_SQL)) {
                                echo "<div class='paz'><p>Pieteikšanās notikusi veiksmīgi! Sazināsimies ar Jums pavisam drīz!<p></div>";
                            } else {
                                echo "<div class='paz'>Pieteikšanās nav izdevusies! Mēģiniet vēlreiz! Kļūda: " . mysqli_error($savienojums) . "<p></div>";
                            }
                        }
                    } else {
                        echo "<div class='notif red'>Neizdevās pārbaudīt reģistrāciju skaitu. Kļūda: " . mysqli_error($savienojums) . "</div>";
                    }
                }
            }
            ?>
            </div>
        </div>
    </section>
    <section class="admin">
        <div class="row">
            <div class="info1 defaultBorders">
                <div class="head-info head-top head-color">
                    <h3 id="sph3">Pievienoties ekskursijai</h3>
                </div>

                <div class="add-spec-form">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <table>
                            <tr>
                                <td>Vards:</td>
                                <td><input type="text" name="Vards" placeholder="Ievadi vardu*" required></td>
                            </tr>
                            <tr>
                                <td>Uzvards:</td>
                                <td><input type="text" name="Uzvards" placeholder="Ievadi uzvardu*" required></td>
                            </tr>
                            <tr>
                                <td>Tālrunis:</td>
                                <td><input type="text" name="Talrunis" placeholder="Ievadi tālruņa numuru*" required></td>
                            </tr>
                            <tr>
                                <td>Datums:</td>
                                <td>
                                    <select name="Datums" required>
                                        <option value="">Izvēlieties datumu</option>
                                        <?php
                                        require 'assets/connect_db.php';
                                        $sql = "SELECT Date1 FROM Datums";
                                        $result = mysqli_query($savienojums, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['Date1'] . "'>" . $row['Date1'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button type="submit" name="iesniegt" class="addbtn">Pievienoties</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
