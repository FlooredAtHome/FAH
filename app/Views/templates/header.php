<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <!-- Carousal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!-- End Carousal -->
    <!-- JS -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/FAH/public/assets/css/comments.css"/>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/jquery-1.9.1.min.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/jquery-ui-1.10.3-custom.min.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/jquery_blockUI.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/comments_blog.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/header.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/logger.js"></script>
   
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script type="text/javascript" src="../public/assets/js/header.js"></script>
<script type="text/javascript" src="../public/assets/js/lightslider.js"></script>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light">
        <div class="container cust-border bg-white">
            <a class="navbar-brand">
                <img src="../public/assets/images/logofah.png" alt="" width="100" height="85" class="d-inline-block align-text-top img-fluid">   
            </a>
            <div class="me-auto">Contact Us<br>
            <a href="tel:123456789">123456789</a>
            </div>
            <div class="justify-content-between">
            <div class="me-5"><strong>Project Managers</strong><br>
            <p id="user"><?= esc($email)?></p>
            Mahek Savani: &nbsp; <a href="tel:contact">123456789</a></div>
            </div>
            <button id="logout" type="button" class="btn custbtn" style="" ><a href="<?= base_url('FAH/Login/logout');?>" style="color:white;">Logout</a></button>
        </div>
    </nav>