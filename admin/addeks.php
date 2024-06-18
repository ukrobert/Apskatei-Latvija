<?php
    require "header.php";
    require '../assets/connect_db.php';
    require "../assets/auth.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nosaukums = mysqli_real_escape_string($savienojums, $_POST['Nosaukums']);
        $apraksts = mysqli_real_escape_string($savienojums, $_POST['Apraksts']);
        $attels = mysqli_real_escape_string($savienojums, $_POST['Attels_URL']);
        $izdzests = isset($_POST['izdzests']) ? $_POST['izdzests'] : 0;
        $sql = "INSERT INTO apskati_ekskursijas (Nosaukums, Apraksts, Attels_URL) VALUES ('$nosaukums', '$apraksts', '$attels')";

        $result = mysqli_query($savienojums, $sql);

        
        if ($result) {
            echo "Ekskursija veiksmīgi pievienota.";
        } else {
            echo "Kļūda: " . mysqli_error($savienojums);
        }
    }
?>

<section class="admin">
    <div class="row">
        <div class="info1 defaultBorders">
            <div class="head-info head-top head-color">
                <h3 id="sph3">Pievienot jaunu ekskursiju</h3>
            </div>

            <div class="add-spec-form">
                <form method="post" action="addeks.php">
                    <table>
                        <tr>
                            <td>Nosaukums:</td>
                            <td><input type="text" name="Nosaukums" placeholder="Ievadi ceļojumu nosaukumu*" required></td>
                        </tr>
                        <tr>
                            <td>Apraksts:</td>
                            <td><textarea name="Apraksts" placeholder="Ievadi ceļojumu aprakstu*" required></textarea></td>
                        </tr>
                        <tr>
                            <td>Attēls:</td>
                            <td><input type="text" name="Attels_URL" placeholder="Ievadi ceļojuma attēla saiti*" required></td>
                        </tr>
                        </tr>
                        <tr>
                         <td>Izdzēsts:</td>
                        <td>
                        <select name="izdzests">
                            <option value="0" <?php if ($eks['izdzests'] == 0) echo 'selected'; ?>>Nē</option>
                            <option value="1" <?php if ($eks['izdzests'] == 1) echo 'selected'; ?>>Jā</option>
                        </select>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2"><button type="submit" class="addbtn">Pievienot</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    require "footer.php";
?>
