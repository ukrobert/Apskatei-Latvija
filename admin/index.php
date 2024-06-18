<?php
    require "header.php";
    require '../assets/connect_db.php';
    require "../assets/auth.php";
    
    if (isset($_POST['dzest'])) {
        $eks_id = $_POST['dzest'];
        
        $update_sql = "UPDATE apskati_pieteikumi SET izdzests = 1 WHERE Pieteikums_ID = ?";
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
                <h3 id="sph3">Jaunakie pieteikumi ekskursijās</h3>
                
            </div>
            <table class="adminTable">
                <tr>
                    <th>Vards</th>
                    <th>Uzvards</th>
                    <th>Tālruņa numurs</th>
                    <th>Datums</th>
                    
                    <th></th>
                </tr>

                <?php
                    $eks_SQL = "SELECT * FROM apskati_pieteikumi WHERE izdzests = 0";
                    $atlasa_eks = mysqli_query($savienojums, $eks_SQL);

                    while ($eks = mysqli_fetch_assoc($atlasa_eks)) {
                        echo "
                            <tr>
                                
                                <td>{$eks['Vards']}</td>
                                <td>{$eks['Uzvards']}</td>
                                <td>{$eks['Talrunis']}</td>
                                <td>{$eks['Date1']}</td>
                                <td>
                                    <form method='post' action='index.php' style='display:inline;'>
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
