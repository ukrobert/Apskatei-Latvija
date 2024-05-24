<?php
    $page = "celvezi";
    require "header.php";
    require '../assets/connect_db.php';
?>


<section class="admin">
   
    <div class="row">
        <div class="info1 defaultBorders">
            <div class="head-info head-color">Ceļvežus administrēšana</div>
            <table class="adminTable">
                <tr>
                    <th>Attels</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Apraksts</th>
                    <th>Statuss</th>
                    <th></th>
                </tr>
              
                <?php
                    $jaun_celv_SQL = "SELECT * FROM apskati_celvezi a JOIN apskati_statuss s ON a.Statuss=s.Statuss_ID;";
                    $atlasa_jaun_celv = mysqli_query($savienojums, $jaun_celv_SQL);


                    while($celv = mysqli_fetch_assoc($atlasa_jaun_celv)){


                    
                        echo "
                            <tr>
                                <td><img src='{$celv['Attels_URL']}' alt='Image' style='width:200px; height:auto; border-radius: 2rem;'></td>
                                <td>{$celv['Vards']}</td>
                                <td>{$celv['Uzvards']}</td>
                                <td>{$celv['Apraksts']}</td>
                                <td>{$celv['Stat_Nosaukums']}</td>
                                <td>
                                    <form method='post' action='celvezis.php'>
                                        <button type='submit' name='apskatit' class='btn' value='{$celv['Celvezi_ID']}'><i class='fas fa-edit'></i></button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                ?>

            </table>
        </div>
       
    
</section>


<?php
    require "footer.php";
?>


