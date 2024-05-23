<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style.css" />
    <link rel="shortcut icon" href="../assets/images/fav.png" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Apskati Latviju</title>
  </head>
  <body>
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

            <li><a href="./" class="<?php echo($page == 'sakums' ? 'current' : '') ?>">Sakumlapa</a></li>
            <li><a href="ekskursijas.php">Rediģēt ekskursijas</a></li>
            <li><a href="celvezi.php">Rediģēt ceļvežus</a></li>
            <li><a href="jaunumi.php">Rediģēt sadaļa “Jaunums”</a></li>
            <li><a href="../" target="_blank">Uz galveno vietni</a></li>


          </ul>
        </div>
      </nav>