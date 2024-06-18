<?php
    $page = "celvezi";
    require "header.php";
    require '../assets/connect_db.php';
    require "../assets/auth.php";
    
    // Обработка удаления
    if (isset($_POST['dzest'])) {
        $celvezi_id = $_POST['dzest'];
        
        $delete_sql = "DELETE FROM apskati_celvezi WHERE Celvezi_ID = ?";
        if ($stmt = $savienojums->prepare($delete_sql)) {
            $stmt->bind_param("i", $celvezi_id);
            $stmt->execute();
            $stmt->close();
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
                <h3 id="sph3">Ceļvežus administrēšana</h3>
                <form method='post' action='addcelv.php'>
                    <button type='submit' name='pievienot' class='btn' value=''>Pievienot ceļvežu <i class='fas fa-gear'></i></button>
                </form>
            </div>
            <table class="adminTable">
                <tr>
                    <th>Attēls</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Apraksts</th>
                    <th>Statuss</th>
                    <th></th>
                </tr>
              
                <?php
                    $jaun_celv_SQL = "SELECT * FROM apskati_celvezi a JOIN apskati_statuss s ON a.Statuss=s.Statuss_ID WHERE izdzests = 0";
                    $atlasa_jaun_celv = mysqli_query($savienojums, $jaun_celv_SQL);

                    while($celv = mysqli_fetch_assoc($atlasa_jaun_celv)) {
                        echo "
                            <tr>
                                <td><img src='{$celv['Attels_URL']}' alt='Image' style='width:200px; height:auto; border-radius: 2rem;'></td>
                                <td>{$celv['Vards']}</td>
                                <td>{$celv['Uzvards']}</td>
                                <td>{$celv['Apraksts']}</td>
                                <td>{$celv['Stat_Nosaukums']}</td>
                                <td>
                                    <form method='post' action='editcelv.php' style='display:inline;'>
                                        <button type='submit' name='apskatit' class='btn' value='{$celv['Celvezi_ID']}'><i class='fas fa-edit'></i></button>
                                    </form>
                                    <form method='post' action='celvezi.php' style='display:inline;'>
                                        <button type='submit' name='dzest' class='btn' value='{$celv['Celvezi_ID']}'><i class='fas fa-trash-alt'></i></button>
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
