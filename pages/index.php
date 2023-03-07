<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SETEC FILM</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../css/stylee.css">


  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="../AdminLTE/login.php" class="logo">
        <img src="../image/bird-logo.png" alt="Filmlane logo">
      </a>

      <div class="header-actions">

        <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button>

        <div class="lang-wrapper">
          <label for="language">
            <ion-icon name="globe-outline"></ion-icon>
          </label>

          <select name="language" id="language">
            <option value="en">EN</option>
            <option value="au">KH</option>
            <option value="ar">CH</option>
          </select>
        </div>

        <!--<button class="btn btn-primary">Sign in</button>
        -->
      </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="../pages/index.php" class="logo">
            <img src="./assets/images/logo.svg" alt="Filmlane logo">
          </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li>
            <a href="./index.html" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Movie</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Web Series</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Pricing</a>
          </li>

        </ul>

        <ul class="navbar-social-list">

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

    </div>
  </header>
  <main>
    <article>
      <!--
        - #UPCOMING

      -->
      <section class="upcoming">
        <div class="container">

          <div class="title-wrapper">
            <p class="section-subtitle">In SS11 Cinema</p>

            <h2 class="h2 section-title">UPCOMING MOVIES</h2>
          </div>
          <ul class="filter-list">

            <li>
              <button class="filter-btn">Action</button>
            </li>

            <li>
              <button class="filter-btn">Horror</button>
            </li>

            <li>
              <button class="filter-btn">Documentary</button>
            </li>

            <li>
              <button class="filter-btn">Science-Fiction</button>
            </li>

          </ul>
          <ul class="movies-list">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_movies";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = 'SELECT * FROM movies WHERE movie_status="up coming"';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
            ?>
                <!-- Bumble bee starts here -->
                <li>
                  <div class="movie-card">

                    <?php

                    ?>
                    <a href="movie-detail.php?movie_id=<?php echo $row['movie_id'] ?>">
                      <figure class="card-banner">
                        <img src="../image/<?php echo $row['movie_image']; ?>">
                      </figure>
                    </a>

                    <div class="title-wrapper">
                      <a href="./movie-detail.html">
                        <h3 class="card-title"><?php echo $row['movie_title'] ?></h3>
                      </a>

                      <time datetime="2022"><?php $release_date = $row['release_date'];
                                            echo date('Y',strtotime($release_date))  ?></time>
                    </div>

                    <div class="card-meta">
                      <div class="badge badge-outline">Up to IMAX</div>

                      <div class="duration">
                        <ion-icon name="time-outline"></ion-icon>

                        <time datetime="PT122M"><?php $du = $row['durations'];
                                                echo $du ?></time>
                      </div>

                      <div class="rating">
                        <ion-icon name="star"></ion-icon>
                        <data><?php $rating = $row['rating'];
                              if ($rating == "") {
                                echo "N/A";
                              } else {
                                echo $rating;
                              } ?></data>
                      </div>
                    </div>
                  </div>
                </li>
            <?php }
            } ?>

          </ul>

        </div>
      </section>
    </article>

    <!-- 
        - #NOW SHOWING
      -->

    <section class="top-rated">
      <div class="container">

        <p class="section-subtitle">In Cinema</p>

        <h2 class="h2 section-title">NOW SHOWING</h2>

        <ul class="filter-list">

          <li>
            <button class="filter-btn">Action</button>
          </li>

          <li>
            <button class="filter-btn">Horror</button>
          </li>

          <li>
            <button class="filter-btn">Documentary</button>
          </li>

          <li>
            <button class="filter-btn">Science-Fiction</button>
          </li>

        </ul>
        <!-- online streams ends here -->

        <ul class="movies-list">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "db_movies";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql = 'SELECT * FROM movies WHERE movie_status="now showing"';
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
          ?>
              <!-- Bumble bee starts here -->
              <li>
                <div class="movie-card">

                  <?php

                  ?>

                  <a href="movie-detail.php?movie_id=<?php echo $row['movie_id'] ?>">
                    <figure class="card-banner">
                      <img src="../image/<?php echo $row['movie_image']; ?>">
                    </figure>
                  </a>

                  <div class="title-wrapper">
                    <a href="./movie-detail.html">
                      <h3 class="card-title"><?php echo $row['movie_title'] ?></h3>
                    </a>

                    <time datetime="2022"><?php $release_date = $row['release_date'];
                                          echo date('Y',strtotime($release_date))  ?></time>
                  </div>

                  <div class="card-meta">
                    <div class="badge badge-outline">Up to IMAX</div>

                    <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="PT122M"><?php $du = $row['durations'];
                                              echo $du ?></time>
                    </div>

                    <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data><?php $rating = $row['rating'];
                            echo $rating ?></data>
                    </div>
                  </div>

                </div>
              </li>
          <?php }
          } ?>

        </ul>

      </div>
    </section>
    </article>
  </main>
  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand-wrapper">

          <a href="./index.html" class="logo">
            <img src="./assets/images/logo.svg" alt="Filmlane logo">
          </a>

          <ul class="footer-list">

            <li>
              <a href="./index.html" class="footer-link">Home</a>
            </li>

            <li>
              <a href="#upcomming" class="footer-link">Upcoming</a>
            </li>

            <li>
              <a href="#" class="footer-link">Now Showing</a>
            </li>

            <li>
              <a href="#" class="footer-link">Pricing</a>
            </li>

          </ul>

        </div>

        <div class="divider"></div>

        <div class="quicklink-wrapper">

          <ul class="quicklink-list">

            <li>
              <a href="#" class="quicklink-link">Faq</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Help center</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Terms of use</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Privacy</a>
            </li>

          </ul>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2022 <a href="#">codewithsadee</a>. All Rights Reserved
        </p>

        <img src="./assets/images/footer-bottom-img.png" alt="Online banking companies logo" class="footer-bottom-img">

      </div>
    </div>

  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="script.js"></script>
</body>

</html>