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


<!-- add book detail view part here -->


      <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
  </body>
</html>
