<?php
    $page = "ekskursijas";
    require "header.php";
    require '../assets/connect_db.php';
?>

<section class="admin">
    <div class="row">
        <div class="info1 defaultBorders">
            <div class="head-info head-top head-color"><h3 id="sph3">Ekskursijas administrēšana</h3>

            <?php
           echo " <form method='post' action='ekskursijas.php'>
            <button type='submit' name='pievienot' class='btn' value='{$spec['[Ekskursijas_ID']}'>Pievienot ekskursiju<i class='fas fa-gear'></i></button>
            "
            ?>
            
            </div>
            <table class="adminTable">
                <tr>
                    <th>Attēls</th>
                    <th>Pilseta</th>
                    <th>Apraksts</th>
                    <th></th>
                    
                </tr>

                <?php
                    $eks_SQL = "SELECT * FROM apskati_ekskursijas";
                    $atlasa_eks = mysqli_query($savienojums, $eks_SQL);

                    while ($eks = mysqli_fetch_assoc($atlasa_eks)) {
                        echo "
                            <tr>
                                <td><img src='{$eks['Attels_URL']}' alt='Image' style='width:200px; height:150px;margin: 20px 0; border-radius: 2rem;'></td>
                                <td>{$eks['Nosaukums']}</td>
                                <td>{$eks['Apraksts']}</td>
                                <td>
                                
                                    <form method='post' action='ekskursijas.php'>
                                        <button type='submit' name='apskatit' class='btn' value='{$eks['Ekskursijas_ID']}'><i class='fas fa-edit'></i></button>
                                    
                                    <form method='post' action='ekskursijas.php'>
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
