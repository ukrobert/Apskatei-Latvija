<?php
$page = "admini";
require "header.php";
require '../assets/connect_db.php';
require "../assets/auth.php";

if (isset($_POST['dzest'])) {
    $admini_id = $_POST['dzest'];
    
    $delete_sql = "DELETE FROM apskati_lietotaji WHERE LietotajsID = ?";
    if ($stmt = $savienojums->prepare($delete_sql)) {
        $stmt->bind_param("i", $admini_id);
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
                <h3 id="sph3">Administrācijas rediģēšana</h3>
                <form method="post" action="addadmin.php">
                    <button type="submit" name="pievienot" class="btn">Pievienot adminu<i class="fas fa-gear"></i></button>
                </form>
            </div>
            <table class="adminTable">
                <tr>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Statuss</th>
                    <th></th>
                </tr>

                <?php
                // Выборка данных с учетом соединения с таблицей admini_statuss для вывода названия статуса
                $admin_SQL = "SELECT * FROM apskati_lietotaji a JOIN admini_statuss s ON a.Statuss = s.Statuss_ID;";
                $admin_SQL = mysqli_query($savienojums, $admin_SQL);

                while ($admin = mysqli_fetch_assoc($admin_SQL)) {
                    echo "
                        <tr>
                            <td>{$admin['Vards']}</td>
                            <td>{$admin['Uzvards']}</td>
                            <td>{$admin['Stat_Nosaukums']}</td>
                            <td>
                                <form method='post' action='editadmin.php' style='display:inline;'>
                                    <button type='submit' name='apskatit' class='btn' value='{$admin['LietotajsID']}'><i class='fas fa-edit'></i></button>
                                </form>
                                <form method='post' action='admini.php' style='display:inline;'>
                                    <button type='submit' name='dzest' class='btn' value='{$admin['LietotajsID']}'><i class='fas fa-trash-alt'></i></button>
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
