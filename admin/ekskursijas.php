<?php
    require "header.php";
    require '../assets/connect_db.php';
    require "../assets/auth.php";
    
    if (isset($_POST['dzest'])) {
        $eks_id = $_POST['dzest'];
        
        $update_sql = "UPDATE apskati_ekskursijas SET izdzests = 1 WHERE Ekskursijas_ID = ?";
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
                <h3 id="sph3">Ekskursijas administrēšana</h3>
                <form method='post' action='addeks.php'>
                    <button type='submit' name='pievienot' class='btn'><i class='fas fa-gear'></i> Pievienot ekskursiju</button>
                </form>
            </div>
            <table class="adminTable">
                <tr>
                    <th>Attēls</th>
                    <th>Pilseta</th>
                    <th>Apraksts</th>
                    <th></th>
                </tr>

                <?php
                    $eks_SQL = "SELECT * FROM apskati_ekskursijas WHERE izdzests = 0";
                    $atlasa_eks = mysqli_query($savienojums, $eks_SQL);

                    while ($eks = mysqli_fetch_assoc($atlasa_eks)) {
                        echo "
                            <tr>
                                <td><img src='{$eks['Attels_URL']}' alt='Image' style='width:200px; height:150px;margin: 20px 0; border-radius: 2rem;'></td>
                                <td>{$eks['Nosaukums']}</td>
                                <td>{$eks['Apraksts']}</td>
                                <td>
                                    <form method='post' action='editeks.php' style='display:inline;'>
                                        <button type='submit' name='apskatit' class='btn' value='{$eks['Ekskursijas_ID']}'><i class='fas fa-edit'></i></button>
                                    </form>
                                    <form method='post' action='ekskursijas.php' style='display:inline;'>
                                        <button type='submit' name='dzest' class='btn' value='{$eks['Ekskursijas_ID']}'><i class='fas fa-trash-alt'></i></button>
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
    // require "footer.php";
?>
