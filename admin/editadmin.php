<?php
require "header.php";
require '../assets/connect_db.php';
require "../assets/auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['apskatit'])) {
    $admin_id = mysqli_real_escape_string($savienojums, $_POST['apskatit']);

    $sql = "SELECT * FROM apskati_lietotaji WHERE LietotajsID = '$admin_id'";
    $result = mysqli_query($savienojums, $sql);
    $admin = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Vards']) && isset($_POST['Uzvards']) && isset($_POST['Lietotajvards']) && isset($_POST['Parole']) && isset($_POST['statuss']) && isset($_POST['izdzests'])) {
        $new_vards = mysqli_real_escape_string($savienojums, $_POST['Vards']);
        $new_uzvards = mysqli_real_escape_string($savienojums, $_POST['Uzvards']);
        $new_Lietotajvards = mysqli_real_escape_string($savienojums, $_POST['Lietotajvards']);
        $new_Parole = mysqli_real_escape_string($savienojums, $_POST['Parole']);
        $new_statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);
        $new_izdzests = mysqli_real_escape_string($savienojums, $_POST['izdzests']);

        $update_sql = "UPDATE apskati_lietotaji SET Vards = '$new_vards', Uzvards = '$new_uzvards', Lietotajvards = '$new_Lietotajvards', Parole = '$new_Parole', Statuss = '$new_statuss', izdzests = '$new_izdzests' WHERE LietotajsID = '$admin_id'";
        
        if (mysqli_query($savienojums, $update_sql)) {
            echo "Dati ir veiksmīgi atjaunoti!";
            echo "<script>setTimeout(function(){ window.location.href = 'admini.php'; }, 2000);</script>";
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
                <h3 id="sph3">Rediģēt adminu</h3>
            </div>

            <div class="add-spec-form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="apskatit" value="<?php echo $admin_id; ?>">
                    <table>
                        <tr>
                            <td>Vards:</td>
                            <td><input type="text" name="Vards" value="<?php echo $admin['Vards']; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Uzvards:</td>
                            <td><input type="text" name="Uzvards" value="<?php echo $admin['Uzvards']; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Lietotajvards:</td>
                            <td><input type="text" name="Lietotajvards" value="<?php echo $admin['Lietotajvards']; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Parole:</td>
                            <td><input type="password" name="Parole" value="<?php echo $admin['Parole']; ?>" required></td>
                        </tr>
                        <tr>
                            <td>Statuss:</td>
                            <td>
                                <select name="statuss">
                                    <option value="1" <?php if ($admin['Statuss'] == 1) echo 'selected'; ?>>Galvenais admins</option>
                                    <option value="2" <?php if ($admin['Statuss'] == 2) echo 'selected'; ?>>Admins</option>
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
