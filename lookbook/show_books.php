<?php require 'check_session.php'; ?>
<?php 
    $book_records = $conn->prepare('SELECT * FROM `books` WHERE 1');
    $book_records->execute();
    $book_results = $book_records->fetchAll();

    $books = null;

    if (count($book_results) > 0) {
      $books = $book_results;
    //   echo $books;
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Look Books</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['name']; ?>
      <a href="logout.php">
        Logout
      </a>
      <br>
      <a href="sell_book.php">
        Sell Book
      </a>
      <div>
        <div>
          <h3>Books Available</h3>
        </div>
        <div>
          <?php
                foreach($books as $data)
                {
                  echo "<div class='templatemo_product_box'>";
                  echo "<h1>";
                  echo $data['book_name'];
                  echo "</h1>";
   	              echo '<img src="data:image/jpg;base64,' . base64_encode( $data['book_image'] ) . '" />';        
                  echo "<div class=\"product_info\">";
                  echo "<p>";
                  echo $data['book_desc'];
                  echo "</p>";
                  echo "<h3>$"; 
                  echo $data['book_cost'];
                  echo "</h3>";
                  echo "<div class=\"buy_now_button\"> <button type=\"submit\" >buy</button></div>";
                  echo "<div class=\"detail_button\"> <button type=\"sumbit\" >book_details</button></div>";
                  echo "</div>";
                  echo "<div class=\"cleaner\">&nbsp;</div>;";
                  echo "</div>";
                }
            ?>
        </div>
      </div>
      <?php else: ?>buy
      <h1>Please Login or SignUp</h1>
<button type="submit"></button>
      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
      <?php endif; ?>
    </body>
</html>