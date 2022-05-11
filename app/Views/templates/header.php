<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- <title>Admin</title> -->
    <!-- <title>Customer View</title> -->
    <!-- <title>Vendor Home</title> -->
    <!-- FAH Reset Password View -->
    <!-- Vendor Home -->
    <!-- <title>Customer Home</title> -->

    <!-- Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">


    <!--  -->
    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Javascript -->

    <script type="text/javascript" src=<?php echo base_url("FAH/public/assets/js/jquery-1.9.1.min.js")?>></script>
    <script type="text/javascript" src=<?php echo base_url("FAH/public/assets/js/jquery-ui-1.10.3-custom.min.js")?>></script>
    <script type="text/javascript" src=<?php echo base_url("FAH/public/assets/js/jquery_blockUI.js")?>></script>
    <script type="text/javascript" src=<?php echo base_url("FAH/public/assets/js/comments_blog.js")?>></script>
    <script type="text/javascript" src=<?php echo base_url("FAH/public/assets/js/logger.js")?>></script>
    <script type="text/javascript" src=<?php echo base_url("FAH/public/assets/js/header.js")?>></script>
    <script type="text/javascript" src=<?php echo base_url("FAH/public/assets/js/lightslider.js")?>></script>


    <!-- jQuery Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.jqueryui.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <?php if(isset($data["role"])){
        if($data["role"]=="2"){?>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://use.fontawesome.com/9538db27f4.js"></script>
    
    <style>
    .actived {
        color: black !important;
    }
    #addVendor {
        display: none;
    }
    th, td
    /* {
        padding: 15px;
        border-right: 1px solid #eddfdf;
    }
    tr
    {
        border-bottom: 1px solid #eddfdf;
    } */
    .labels
    {
        font-weight: 700;
    }
    .accordion-header {
    margin-bottom: 10px;
    }
</style>

    <?php } } ?>
    <!-- CSS -->

    <link type="text/css" rel="stylesheet" href=<?php echo base_url("FAH/public/assets/css/comments.css")?>/>
    <link rel="stylesheet" href=<?= base_url('FAH/public/assets/css/style.css'); ?>>
    <!-- <link rel="stylesheet" href="../public/assets/css/style.css"> -->
    <link type="text/css" rel="stylesheet" href=<?php echo base_url("FAH/public/assets/css/lightslider.css")?> />


    <!-- style customerView -->
    <style>
        .act {
    background-color: #1a2e6e;
    color: white;
    }
    </style>

    <!-- Images -->
    <link rel = "icon" href=<?= base_url('FAH/public/assets/images/logofah.png'); ?> type = "image/x-icon">
</head>