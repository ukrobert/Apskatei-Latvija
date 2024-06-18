<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/style.css" />
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Jaunumi</title>
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
              <li><a href="eks.php">Ekskursijas</a></li>
              <li><a href="guides.php">Musu ceļveži</a></li>
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
          require "assets/connect_db.php";

          $jaunumi_SQL = "SELECT * FROM apskati_jaunumi WHERE izdzests = 0";
          $result = mysqli_query($savienojums, $jaunumi_SQL);

          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $ID = $row["Jaunumi_ID"];  
                  $Nosaukums = $row["Nosaukums"];
                  $subTitle = $row["Iss_Apraksts"];
                  $Attels_URL = $row["Attels_URL"];

                  echo "
                  <div class='guides'>
                    <img src='$Attels_URL' alt='' />
                    <h3 class='title'>$Nosaukums</h3>
                    <p class='subTitle'>$subTitle</p>
                    <a href='jaun_vairak.php?id=$ID' class='orange-button'>Uzzinat vairak</a>
                  </div>";
              }
          } else {
              echo "Nav nevienas jaunumiem!";
          }
          
          mysqli_close($savienojums);
          ?>
        </div>
      </div>
    </section>
  </body>
</html>
