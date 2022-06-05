<?php session_start(); /* to start session to stay login   */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/amit/css/main.css">
</head>
<body class="text-white">
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/amit/home.php">school</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
    <ul class="navbar-nav mr-auto">
    <?php if(isset($_SESSION['Validity'])){ ?>
      <li class="nav-item active">
        <a class="nav-link" href="/amit/home.php">Home</a>
      </li>
      <?php if($_SESSION["Validity"]!="slist"){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          students
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php if($_SESSION["Validity"]=="full"){ ?>
          <a class="dropdown-item" href="/amit/students/add.php">add</a>
          <?php } ?>
          <?php if($_SESSION["Validity"]=="full" || $_SESSION["Validity"]=="tlist"){ ?>
          <a class="dropdown-item" href="/amit/students/list.php">list</a>
          <?php } ?>
        </div>
      </li>
      <?php } ?>
      <?php if($_SESSION["Validity"]!="tlist"){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          teachers
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php if($_SESSION["Validity"]=="full"){ ?>
          <a class="dropdown-item" href="/amit/teachers/add.php">add</a>
          <?php } ?>
          <?php if($_SESSION["Validity"]=="full" || $_SESSION["Validity"]=="slist"){ ?>
          <a class="dropdown-item" href="/amit/teachers/list.php">list</a>
          <?php } ?>
        </div>
      </li>
      <?php } ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         courses
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php if($_SESSION["Validity"]=="full"){ ?>
          <a class="dropdown-item" href="/amit/courses/add.php">add</a>
          <?php } ?>
          <a class="dropdown-item" href="/amit/courses/list.php">list</a>
        </div>
      </li>
      <?php if($_SESSION["Validity"]=="full"){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/amit/user/list.php">list</a>
        </div>
      </li>
      <?php } ?>
      <?php } ?>
    </ul>
    <?php if(isset($_SESSION["Validity"])): ?>
      <a href="/amit/index.php?logout=" class="btn btn-outline-success my-2 my-sm-0">logout</a>
      <?php else: ?>
        <a href="/amit/index.php" class="btn btn-outline-success my-2 my-sm-0">login</a>
      <?php endif ?>
  </div>
</nav>

