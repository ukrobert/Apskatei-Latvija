<?php
require "header.php";
require '../assets/connect_db.php';
require "../assets/auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vards = mysqli_real_escape_string($savienojums, $_POST['Vards']);
    $uzvards = mysqli_real_escape_string($savienojums, $_POST['Uzvards']);
    $lietotajvards = mysqli_real_escape_string($savienojums, $_POST['Lietotajvards']);
    $parole = mysqli_real_escape_string($savienojums, $_POST['Parole']);
    $izdzests = isset($_POST['izdzests']) ? $_POST['izdzests'] : 0;
    $statuss = isset($_POST['statuss']) ? $_POST['statuss'] : 1;

    $sql = "INSERT INTO apskati_lietotaji (Vards, Uzvards, Lietotajvards, Parole, izdzests, statuss) 
            VALUES ('$vards', '$uzvards', '$lietotajvards', '$parole', '$izdzests', '$statuss')";

    $result = mysqli_query($savienojums, $sql);

    if ($result) {
        echo "<div class='paz'><p>Admins veiksmīgi pievienots.</p></div>";
    } else {
        echo "Kļūda: " . mysqli_error($savienojums);
    }
}
?>

<section class="admin">
    <div class="row">
        <div class="info1 defaultBorders">
            <div class="head-info head-top head-color">
                <h3 id="sph3">Pievienoties  jaunu adminu</h3>
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
                            <td>Lietotajvards:</td>
                            <td><input type="text" name="Lietotajvards" placeholder="Ievadi lietotajvardu*" required></td>
                        </tr>
                        <tr>
                            <td>Parole:</td>
                            <td><input type="password" name="Parole" placeholder="Ievadi paroli*" required></td>
                        </tr>
                        <tr>
                            <td>Statuss:</td>
                            <td>
                                <select name="statuss">
                                    <option value="1">Galvenais admins</option>
                                    <option value="2">Admins</option>
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
