<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['book_name']) && !empty($_POST['book_desc']) && !empty($_POST['book_cost']) && !empty($_POST['book_image']) ) {
    $sql = "INSERT INTO `books`( `book_name`, `book_desc`, `book_image`, `book_cost`) VALUES (:name, :desc, :image,:cost)";
    $stmt = $conn->prepare($sql);
     echo base64_encode(file_get_contents(addslashes(file_get_contents($_POST['image']))));
    $stmt->bindParam(':name', $_POST['book_name']);
    $stmt->bindParam(':desc', $_POST['book_desc']);
     $stmt->bindParam(':image', $_POST['book_image']);
    // $imagename=$_FILES["book_image"]["name"]; 
    $imagetmp = addslashes(file_get_contents($_FILES['myimage']['tmp_name']));
    echo $imagetmp;
    $stmt->bindParam(':image',$imagetmp);
    $stmt->bindParam(':cost', $_POST['book_cost']);

    if ($stmt->execute()) {
      $message = 'Book added for sale';
      header("Location: show_books");
    } else {
      $message = 'Sorry book not uploaded &#x1f595;';]
    }
  }
  ?>
<?php require 'check_session.php'; ?>
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
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>

    <div class="card border-primary">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h4 class="card-title">Sell Books</h4>
        <p class="card-text">Text</p>
      </div>
      <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <form action="sell_book.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="book_name" id="" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Enter Your Book Name</small>
      </div>
      <div class="form-group">
        <label for="">Description</label>
        <input type="text" name="book_desc" id="" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Enter Book Description</small>
      </div>
      <div class="form-group">
        <label for="">Cost</label>
        <input type="text" name="book_cost" id="" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Enter Book Cost</small>
      </div>
      <div class="form-group">
        <label for="">Book Image</label>
        <input type="file" class="form-control-file" name="book_image" id="" placeholder="" accept="image/*" aria-describedby="fileHelpId">
        <small id="fileHelpId" class="form-text text-muted">Upload Books Image</small>
      </div>
      <button type="submit" class="btn btn-primary">Sell</button>
    </form>
    </div>


      <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
  </body>
</html>


