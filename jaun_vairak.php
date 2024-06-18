<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilseta</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/style.css" />
    <link rel="stylesheet" href="assets/pilsetas_style.css" />
</head>
<body>
<header>
    <div class="scrollToTop"><i class="fas fa-chevron-up"></i></div>
    <div class="container">
        <nav>
            <div class="nav-container">
                <div class="brand">Apskati Latviju</div>
                <div class="responsive-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            <div class="links">
                <ul>
                    <li><a href="index.html">Uz sakumu</a></li>
                    <li><a href="jaunumi.php">Atpakaļ</a></li>
                    <li><a href="eks.php">Ekskursijas </a></li>
                    <li><a href="guides.php">Musu ceļveži</a></li>
                    <li><a href="Mums.html">Par mums</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<section class="starter">
    <div class="content">
        <p class="subTitleCity"></p>
        <div class="descriptionCity">
            <section class="next-guides">
                <div class="content">
                    <div class="guides-container">
                        <?php
                        require "assets/connect_db.php";

                        
                        $article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                        
                        if ($article_id > 0) {
                            $stmt = $savienojums->prepare("SELECT * FROM apskati_jaunumi WHERE Jaunumi_ID = ?");
                            $stmt->bind_param("i", $article_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $Nosaukums = $row["Nosaukums"];
                                $Title = $row["Apraksts"];

                                echo "
                                <div class='jaunums'>
                                    <h3 class='nosaukums'>$Nosaukums</h3>
                                    <p class='apraksts'>$Title</p>
                                </div>";
                            } else {
                                echo "Informācija par šo rakstu nav pieejama!";
                            }

                            
                            $stmt->close();
                        } else {
                            echo "ID raksta nav norādīts!";
                        }

                        // Закрытие соединения с базой данных
                        mysqli_close($savienojums);
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
</body>
</html>
