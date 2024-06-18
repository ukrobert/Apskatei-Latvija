<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/style.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceļveži</title>
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
                        <li><a href="eks.php">Ekskursijas</a></li>
                        <li><a href="jaunumi.php">Jaunumi</a></li>
                        <li><a href="Mums.html">Par mums</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="next-guides">
        <div class="content">
            <div class="guides-container">
                <?php
                // Include your database connection file
                require "assets/connect_db.php";

                // SQL query to fetch guides
                $guides_SQL = "SELECT * FROM apskati_celvezi WHERE izdzests = 0"; // Adjust table name and column names as per your database schema
                $result = mysqli_query($savienojums, $guides_SQL);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $image_url = $row["Attels_URL"];
                        $title = $row["Vards"];
                        $title2 = $row["Uzvards"];
                        $subtitle = $row["Apraksts"];

                        echo "
                        <div class='guides'>
                            <img src='$image_url' alt='' />
                            <h3 class='title'>$title $title2</h3>
                            <p class='subTitle'>$subtitle</p>
                        </div>";
                    }
                } else {
                    echo "No guides available!";
                }

                // Close the database connection
                mysqli_close($connection);
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
