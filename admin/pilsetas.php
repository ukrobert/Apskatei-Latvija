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
                <h3 id="sph3">Pilsetas administrēšana</h3>
                <form method='post' action='addpilsetas.php'>
                    <button type='submit' name='pievienot' class='btn' value=''>Pievienot jaunas pilsetas <i class='fas fa-gear'></i></button>
                </form>
            </div>
            <table class="adminTable">
                <tr>
                    <th>Attēls</th>
                    <th>Nosaukums</th>
                    <th>Apraksts</th>
                    <th></th>
                </tr>
              
                <?php
                    $jaun_pils_SQL = "SELECT * FROM apskati_pilsetas WHERE izdzests = 0";
                    $atlasa_jaun_pils = mysqli_query($savienojums, $jaun_pils_SQL);

                    while($pils = mysqli_fetch_assoc($atlasa_jaun_pils)) {
                        echo "
                            <tr>
                                <td><img src='{$pils['Attels_URL']}' alt='Image' style='width:200px; height:auto; border-radius: 2rem;'></td>
                                <td>{$pils['Nosaukums']}</td>
                                <td>{$pils['Apraksts']}</td>
                                
                                <td>
                                    <form method='post' action='editpilsetas.php' style='display:inline;'>
                                        <button type='submit' name='apskatit' class='btn' value='{$pils['Celvezi_ID']}'><i class='fas fa-edit'></i></button>
                                    </form>
                                    <form method='post' action='pilsetas.php' style='display:inline;'>
                                        <button type='submit' name='dzest' class='btn' value='{$pils['Celvezi_ID']}'><i class='fas fa-trash-alt'></i></button>
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
