<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap -->
  <link href = "/ci1/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <style>
    body{
      padding-top:60px;
    }

    .container2{
      padding-left:0px;
      padding-right:0px;
    }

    .redBox{
      border:1px red solid;
    }
  </style>
</head>
<body>
<?php
  if($this->session->flashdata('message')){
?>
  <script>
    alert('<?=$this->session->flashdata('message')?>');
  </script>
<?php
  }
?>
  <div class="container fixed-top container2">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
      <a class="navbar-brand" href="/ci1/topic">javascript</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link disabled" href="#">menu1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="/ci1/Mailtest">mail</a>
          </li>
        </ul>
<?php
  if($this->session->userdata('is_login')){
?>
        <a class="btn btn-outline-primary" href="/ci1/auth/logout" role="button">Sign Out</a>
<?php
  }else{
?>
        <a class="btn btn-outline-primary" href="/ci1/auth/login" role="button">Sign In</a>
        <a class="btn btn-outline-primary" href="/ci1/auth/register" role="button">Sign Up</a>
<?php
  }
?>
      </div>

    </nav>
  </div>



  <div class="container">
    <div class="row">
