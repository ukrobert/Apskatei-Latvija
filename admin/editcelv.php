<?php
    require "header.php";
    require '../assets/connect_db.php';
    require "../assets/auth.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['apskatit'])) {
        $celv_id = mysqli_real_escape_string($savienojums, $_POST['apskatit']);

        $sql = "SELECT * FROM apskati_celvezi WHERE Celvezi_ID = '$celv_id'";
        $result = mysqli_query($savienojums, $sql);
        $celv = mysqli_fetch_assoc($result);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Vards']) && isset($_POST['Uzvards']) && isset($_POST['Apraksts']) && isset($_POST['Attels_URL'])) {
            $new_vards = mysqli_real_escape_string($savienojums, $_POST['Vards']);
            $new_uzvards = mysqli_real_escape_string($savienojums, $_POST['Uzvards']);
            $new_apraksts = mysqli_real_escape_string($savienojums, $_POST['Apraksts']);
            $new_attels = mysqli_real_escape_string($savienojums, $_POST['Attels_URL']);
            $izdzests = isset($_POST['izdzests']) ? $_POST['izdzests'] : 0;
            $update_sql = "UPDATE apskati_celvezi SET Vards = '$new_vards', Uzvards = '$new_uzvards', Apraksts = '$new_apraksts', Attels_URL = '$new_attels' WHERE Celvezi_ID = '$celv_id'";
            
            if (mysqli_query($savienojums, $update_sql)) {
                echo "Dati ir veiksmīgi atjaunoti!";
                echo "<script>setTimeout(function(){ window.location.href = 'celvezi.php'; }, 2000);</script>";
            } else {
                echo "Kļūda: " . $update_sql . "<br>" . mysqli_error($savienojums);
            }
        }
    }
?>

<section class="admin">
    <div class="row">
        <div class="info1 defaultBorders">
            <div class="head-info head-top head-color">
                <h3 id="sph3">Rediģēt ceļojumu</h3>
            </div>

            <div class="add-spec-form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="apskatit" value="<?php echo $celv['Celvezi_ID']; ?>">
                    <table>
                        <tr>
                            <td>Vārds:</td>
                            <td><input type="text" name="Vards" value="<?php echo $celv['Vards']; ?>" placeholder="Ievadi vārds*" required></td>
                        </tr>
                        <tr>
                            <td>Uzvārds:</td>
                            <td><input type="text" name="Uzvards" value="<?php echo $celv['Uzvards']; ?>" placeholder="Ievadi uzvārds*" required></td>
                        </tr>
                        <tr>
                            <td>Apraksts:</td>
                            <td><textarea name="Apraksts" placeholder="Ievadi aprakstu*" required><?php echo $celv['Apraksts']; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Attēls:</td>
                            <td><input type="text" name="Attels_URL" value="<?php echo $celv['Attels_URL']; ?>" placeholder="Ievadi attēla saiti*" required></td>
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
