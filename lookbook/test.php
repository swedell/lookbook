<?php

  require 'database.php';

  $message = '';
  if (!empty($_POST['image']) ){
    $sql = "INSERT INTO `test`(`image`) VALUES (:image)";
    $stmt = $conn->prepare($sql);
    $imagetmp = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    echo $imagetmp;
    $stmt->bindParam(':image',$imagetmp);
    
    if ($stmt->execute()) {
        $message = 'Book added for sale';
        header("Location: show_books");
      } else {
        $message = 'Sorry book not uploaded &#x1f595;';
      }
    }
    ?>
    <?php require 'check_session.php'; ?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
<body>

<div id="wrapper">
 <input type="file">
 <div id="drop-area">
  <h3 class="drop-text">Drag and Drop Images Here</h3>
 </div>

</div>
<form action="test.php" method="post"></form>

</body>

</html>

<script>
$(document).ready(function()
{
 $("#drop-area").on('dragenter', function (e){
  e.preventDefault();
  $(this).css('background', '#BBD5B8');
 });

 $("#drop-area").on('dragover', function (e){
  e.preventDefault();
 });

 $("#drop-area").on('drop', function (e){
  $(this).css('background', '#D8F9D3');
  e.preventDefault();
  var image = e.originalEvent.dataTransfer.files;
  createFormData(image);
 });
});

function createFormData(image)
{
 var formImage = new FormData();
 formImage.append('image', image[0]);
 uploadFormData(formImage);
}

function uploadFormData(formData) 
{
 $.ajax({
 url: "test.php",
 type: "POST",
 data: formData,
 contentType:false,
 cache: false,
 processData: false,
 success: function(data){
  $('#drop-area').html(data);
 }});
}</script>

<style>
    body
{ width:100%;
 margin:0 auto;
 padding:0px;
 font-family:helvetica;
 background-color:#084B8A;
}
#wrapper
{
 text-align:center;
 margin:0 auto;
 padding:0px;
 width:995px;
}
#drop-area
{
 margin-top:20px;
 margin-left:220px;
 width:550px;
 height:200px;
 background-color:white;
 border:3px dashed grey;
}
.drop-text
{
 margin-top:70px;
 color:grey;
 font-size:25px;
 font-weight:bold;
}
#drop-area img
{
 max-width:200px;
}</style>


