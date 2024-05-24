<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorizācija</title>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css>
    <link rel="stylesheet" href="login.css">
</head>

<?php
    require '../assets/connect_db.php';
?>
<body>
   
    <div class="container">
        
        <div class="form">
       
        <div class="dosUz">
            <h2>Apskati Latviju</h2>
            <p>
            Apskati Latviju ir tūrisma aģentūra, kas piedāvā aizraujošus ekskursiju maršrutus visā Latvijā. Ar mums jūs varēsiet atklāt skaistākās un vēsturiski nozīmīgākās vietas šajā pārsteidzošajā valstī. Mūsu tūres aptver visu, sākot no senām pilīm un burvīgām pilsētām līdz gleznainiem dabas rezervātiem un Baltijas jūras piekrastēm. Apskati Latviju pieredzējušie gidi palīdzēs jums iepazīt Latvijas bagāto kultūru un tradīcijas, padarot katru ceļojumu aizraujošu un izzinošu. Ar Apskati Latviju jūsu ceļojums kļūs par neaizmirstamu piedzīvojumu!
            </p>
            
            <div class="points">
                <p><i class="fas fa-check"></i>vairāk nekā 25 ekskursiju vietas</p>
                <p><i class="fas fa-check"></i>9+ ceļvežus</p>
            </div>
            <button><a href="../index.html">Doties uz galveno lapu <i class="fas fa-external-link"></i></a>
            <form action="login.php" method="post">
            </form>
            </button>
            </div>
       
        <div class="log">
            <h2>Esi sveicināts "Apskati Latviju"!</h2>
            <div class="form-group">
            <label for="username"></label>
            <input type="text" id="username" name="username" placeholder="Lietotājvārds:" required>
            
            </div>
            <br>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Parole:" required>
            </div>
            <br>
            <button type="submit">IELOGOTIES</button>
        </div>
            
       
        </div>
        </div>
        
        
        <?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM apskati_lietotaji WHERE Lietotajvards='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        $row = $result->fetch_assoc();
        $db_password = $row['Parole'];
       
        if ($password === $db_password) { 
            $_SESSION['Lietotajvards'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "neparaizi parole";
        }
    } else {
        echo "nav ";
    }

    
    $conn->close();
}
?>




</body>
</html>
