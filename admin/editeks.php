<?php
require "header.php";
require '../assets/connect_db.php';
require "../assets/auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['apskatit'])) {
    $eks_id = mysqli_real_escape_string($savienojums, $_POST['apskatit']);

    $sql = "SELECT * FROM apskati_ekskursijas WHERE Ekskursijas_ID = '$eks_id'";
    $result = mysqli_query($savienojums, $sql);
    $eks = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Nosaukums']) && isset($_POST['Apraksts']) && isset($_POST['Attels_URL'])) {
        $new_nosaukums = mysqli_real_escape_string($savienojums, $_POST['Nosaukums']);
        $new_apraksts = mysqli_real_escape_string($savienojums, $_POST['Apraksts']);
        $new_attels = mysqli_real_escape_string($savienojums, $_POST['Attels_URL']);
        $izdzests = isset($_POST['izdzests']) ? $_POST['izdzests'] : 0; // Проверяем, было ли отправлено поле izdzests

        $update_sql = "UPDATE apskati_ekskursijas SET Nosaukums = '$new_nosaukums', Apraksts = '$new_apraksts', Attels_URL = '$new_attels', izdzests = '$izdzests' WHERE Ekskursijas_ID = '$eks_id'";
        
        if (mysqli_query($savienojums, $update_sql)) {
            echo "Dati ir veiksmīgi atjaunoti!";
            echo "<script>setTimeout(function(){ window.location.href = 'ekskursijas.php'; }, 2000);</script>";
        } else {
            echo "Kļūda: " . $update_sql . "<br>" . mysqli_error($savienojums);
        }
    }
}
?>

<head>
    <link rel="stylesheet" href="admin.css">
</head>

<section class="admin">
    <div class="row">
        <div class="info1 defaultBorders">
            <div class="head-info head-top head-color">
                <h3 id="sph3">Rediģēt ceļojumu</h3>
            </div>

            <div class="add-spec-form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="apskatit" value="<?php echo $eks['Ekskursijas_ID']; ?>">
                    <table>
                        <tr>
                            <td>Nosaukums:</td>
                            <td><input type="text" name="Nosaukums" value="<?php echo $eks['Nosaukums']; ?>" placeholder="Ievadi ekskursijas nosaukumu*" required></td>
                        </tr>
                        <tr>
                            <td>Apraksts:</td>
                            <td><textarea name="Apraksts" placeholder="Ievadi ekskursijas aprakstu*" required><?php echo $eks['Apraksts']; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Attēls:</td>
                            <td><input type="text" name="Attels_URL" value="<?php echo $eks['Attels_URL']; ?>" placeholder="Ievadi ekskursijas attēla saiti*" required></td>
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
                            <td colspan="2"><button type="submit" class="addbtn">Saglabāt izmaiņas</button></td>
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
