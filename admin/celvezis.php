<?php
    $page = "audzekni";
    require "header.php";
    require  '../assets/connect_db.php';
?>


<section class="admin">
    <div class="row">
        <div class="info1 defaulBorders">
            <div class="head-info head-color">Pieteikums</div>
           
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){


                    $Celvezi_ID = $_POST['apskatit'];
                    $atlasit_celvezi_SQL = "SELECT * FROM apskati_celvezi
                    WHERE Celvezi_ID = $Celvezi_ID";
                    $atlasit_celvezi = mysqli_query($savienojums, $atlasit_celvezi_SQL);


                    $celvezis = mysqli_fetch_array($atlasit_celvezi );

                    $statusi_SQL = "SELECT * FROM apskati_statuss";

                    $atlasa_statuss = mysqli_query($savienojums, $statusi_SQL);
                    $statusi = "";

                    while($statuss = mysqli_fetch_array($atlasa_statuss)){
                        $statusi = $statusi ."<option value='{$statuss['Statuss_ID']}'>{$statuss['Stat_Nosaukums']}</option>";

                    }
            ?>
           
            <table>
                <tr>
                    <td>Vards: </td>
                    <td class="value"><?php echo $celvezis['Vards']; ?></td>
                </tr>
                <tr>
                    <td>Uzvards </td>
                    <td class="value"><?php echo $celvezis['Uzvards']; ?></td>
                </tr>
                <tr>
                    <td>Apraksts </td>
                    <td class="value"><?php echo $celvezis['Apraksts']; ?></td>
                </tr>
                <tr>
                    <td>Attels(URL) </td>
                    <td class="value"><?php echo $audzeknis['Epasts']; ?></td>
                </tr>
                
                <tr>
                    <td>Uznemsanas satuss:</td>
                   <td class = "value">
                        <form method="post">
                            <select name="Statuss" required>
                                <?php echo $statusi; ?>
                            </select>
                            <button type="submit" class="btn" name="rediget" value="<?php echo $celvezis['Celvezi_ID']; ?>">Saglabat</button>
                        </form>

                   </td>
                </tr>
            </table>


            <?php
                }else{
                    header("Refresh:0; url=audzekni.php");
                }
            ?>
        </div>
    </div>
</section>


<?php
    require "footer.php";
?>


