<?php include("db_connect.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/movie-detail.css" />
  <title>Movie Details</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Heebo&family=Outfit:wght@300&family=Righteous&family=Squada+One&family=Staatliches&display=swap");
  </style>
</head>

<body>
  <div id="main">
    <div id="nav">
      <ul>
        <li><a href="#">Movie</a></li>
        <li><a href="#">Cinemas</a></li>
        <li><a href="#">Promotion</a></li>
        <li><a href="#">News & Activities</a></li>
        <li><a href="#">Contact us</a></li>
      </ul>
    </div>

    <div id="description">
      <div class="content">
        <?php
        if (isset($_REQUEST['movie_id'])) {
          $id = $_REQUEST['movie_id'];
          $sql1 = 'SELECT movie_title,description,rating,release_date,durations,movie_image,categorie_name,url_trailer FROM movies LEFT JOIN categories
              on categories.categorie_id=movies.movie_id
              WHERE movie_id=' . $id . '';
          $result = $connection->query($sql1);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
            <div id="movie-image">
              <img src="../image/<?php echo $row['movie_image'] ?>" alt="" />
            </div>
            <div id="middle">

              <?php ?>
              <div id="movie-title"> <?php echo $row['movie_title'] ?> </div>
              <div id="movie-datetime"> <?php echo $row['release_date'] ?> <br /> <?php echo $row['durations'] ?></div>
              <div id="movie-genre">Action, Sci-fi, Superhero, Comedy</div>
              <div id="movie-description"> <?php echo $row['description'] ?></div>
              <div id="btnShowtime">
                <a href="select-showtime.php?movie_id=<?php echo $id?>">ShowTime</a>
              </div>
            </div>

            <div id="movie-screen-types">
              <img src="../image/4DX_2019_logo.svg.png" alt="" />
              <img src="../image/pngegg.png" alt="" />
            </div>
      </div>
  
    </div>
    <div class="trialer"><?php echo $row['url_trailer']?></div>
    <?php }
        } 
  ?>
  </div>
</body>

</html>