<?php
$page = "admini";
require "header.php";
require '../assets/connect_db.php';
require "../assets/auth.php";

if (isset($_POST['dzest'])) {
    $eks_id = $_POST['dzest'];
    
    $update_sql = "UPDATE apskati_jaunumi SET izdzests = 1 WHERE Jaunumi_ID = ?";
    if ($dzst = $savienojums->prepare($update_sql)) {
        $dzst->bind_param("i", $eks_id);
        $dzst->execute();
        $dzst->close();
    } else {
        echo "Kļūda: " . $savienojums->error;
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
                <h3 id="sph3">Jaunumiem rediģēšana</h3>
                <form method="post" action="addjaun.php">
                    <button type="submit" name="pievienot" class="btn">Pievienot jaunumi<i class="fas fa-gear"></i></button>
                </form>
            </div>
            <table class="adminTable">
                <tr>
                    <th>Attels</th>
                    <th>Nosaukums</th>
                    <th>Apraksts</th>
                    <th>Iss apraksts</th>
                    <th></th>
                </tr>

                <?php
                $jaun_SQL = "SELECT * FROM apskati_jaunumi WHERE izdzests = 0;";
                $result = mysqli_query($savienojums, $jaun_SQL);

                while ($jaun = mysqli_fetch_assoc($result)) {
                    echo "
                        <tr>
                            <td><img src='{$jaun['Attels_URL']}' alt='Image' style='width:200px; height:auto; border-radius: 2rem;'></td>
                            <td>{$jaun['Nosaukums']}</td>
                            <td>{$jaun['Apraksts']}</td>
                            <td>{$jaun['Iss_Apraksts']}</td>
                            <td>
                                <form method='post' action='editjaun.php' style='display:inline;'>
                                    <button type='submit' name='apskatit' class='btn' value='{$jaun['Jaunumi_ID']}'><i class='fas fa-edit'></i></button>
                                </form>
                                <form method='post' action='jaunumi.php' style='display:inline;'>
                                    <button type='submit' name='dzest' class='btn' value='{$jaun['Jaunumi_ID']}'><i class='fas fa-trash-alt'></i></button>
                                </form>
                            </td>
                        </tr>
                    ";
                }
                ?>
            </table>
        </div>
    </div>
</section>

<?php
require "footer.php";
?>
