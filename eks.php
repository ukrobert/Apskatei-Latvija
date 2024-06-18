<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/style.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekskursijas</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
</head>
<body>
    <header>
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
                        <li><a href="jaunumi.php">Jaunumi</a></li>
                        <li><a href="guides.php">Musu ceļveži</a></li>
                        <li><a href="Mums.html">Par mums</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="next-eks">
        <div class="content">
            <div class="eks-container">
                <?php
                // Include your database connection file
                require "assets/connect_db.php";

                // SQL query to fetch excursion data
                $eks_SQL = "SELECT * FROM apskati_ekskursijas WHERE izdzests = 0"; // Adjust table name as per your database schema
                $result = mysqli_query($savienojums, $eks_SQL);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ID = $row["Ekskursijas_ID"];
                        $image_url = $row["Attels_URL"];
                        $title = $row["Nosaukums"];
                        $subtitle = $row["Apraksts"];

                        echo "
                        <div class='eks'>
                            <img src='$image_url' alt='' />
                            <h3 class='title'>$title</h3>
                            <p class='subTitle'>$subtitle</p>
                            <a href='pieteikties.php' class='orange-button' name='pieteikties' value='{$row['Nosaukums']}'>Pieteikties</a>
                        </div>";
                    }
                } else {
                    echo "Nav pieejamu ekskursiju!";
                }

                // Close the database connection
                mysqli_close($savienojums);
                ?>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleButton = document.querySelector('.responsive-toggle');
            var navLinks = document.querySelector('.links ul');

            toggleButton.addEventListener('click', function() {
                navLinks.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
