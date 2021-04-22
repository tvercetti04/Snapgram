<?php include "config.php"; 

if(!isset($_SESSION['user'])){
    $snap->redirect('login');
}

$sess = $_SESSION['user'];
$query = $snap->select("SELECT * FROM accounts WHERE email = '$sess'");
$user_id = [];
foreach($query as $q){
    $user_id = $q['id'];
}

$query = $snap->select("SELECT * FROM pro_update WHERE u_id = '$user_id'");
$user = [];
foreach($query as $a){
    $user = $a['u_id'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnapGram</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<style>
    nav ul .btn{
        font-size: 25px;
        padding-top: 0;
        padding-bottom: 0;
    }
    nav .navbar-brand{
        font-family: fantasy;
    }
    nav ul img{
        height: 30px;
        width: 35px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 4px;
    }
    .container .post-header{
        align-items: center;
    }
    .container .post-header img{
        height: 35px;
        width: 42px;
        border-radius: 50%;
        object-fit: cover;
    }
    .container .card-footer .reactions a{
        font-size: 25px;
    }
    .container .card-footer .time{
        font-size: 12px;
    }
    .col-lg-4 .card-body .profile img{
        height: 55px;
        width: 62px;
        object-fit: cover;
        border-radius: 50%;
    }
    .col-lg-4 .card-body .profile{
        align-items: center;
    }
    .col-lg-4 .card{
        position: fixed;
    }
    .col-lg-4 .list-group-item:hover{
        background-color: grey;
        color: white;
    }
    .container .chat-head img{
        height: 50px;
        width: 57px;
        object-fit: cover;
        border-radius: 50%;
    }
    .container .card .chat-body{
        height: 70vh;
        position: 
    }
    .container .card .chat-body .msgbox{
        margin-top: 70vh;  
    }
    .container .main img{
        height: 200px;
        width: 220px;
        border-radius: 50%;
        border: 2px solid black;
        object-fit: cover;
    }
    .container .col-7 .actions{
        display: flex;
        justify-content: space-around;
    }
    .container .photos img{
        height: 250px;
        width: 360px;
        object-fit: cover;
    }
    .card .search{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
   
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
    <div class="container">
        <a href="index.php" class="navbar-brand">SnapGram</a>
        <form action="search.php" method="get" class="ms-auto">
            <div class="input-group">
                <input type="search" name="user" class="form-control border-0" placeholder="Search">
                <button class="btn btn-dark border-0"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="index.php" class="btn  shadow-none"><i class="fa fa-home"></i></a></li>
            <li class="nav-item"><a href="messages.php" class="btn  shadow-none"><i class="bi bi-chat-quote-fill"></i></a></li>
            <li class="nav-item"><a href="" class="btn  shadow-none"><i class="fa fa-heart"></i></a></li>
            <li class="nav-item"><a href="settings.php" class="btn  shadow-none"><i class="fa fa-cog"></i></a></li>
            <?php 
                $yo = $_SESSION['user'];
                $query = $snap->select("SELECT * FROM pro_update WHERE p_email = '$yo'");
                foreach($query as $q):
            ?>
            <li class="nav-item"><a href="profile.php" class="btn shadow-none"><img src="include\img\<?= $q['pic'];?>" alt=""></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
    
