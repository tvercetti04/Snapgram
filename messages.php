<?php include "include/header.php";
if(!isset($_SESSION['user'])){
    $snap->redirect('login');
} ?>

<div class="container mt-4">
    <div class="card border-0">
    <?php 
                    $query = $snap->select("SELECT * FROM follow JOIN pro_update ON follow.following = pro_update.u_id WHERE follower = '$user' OR following = '$user'");
                    foreach($query as $yo):
                        if($yo['u_id'] == $user){
                            continue;
                        }
                ?>
                
        <div class="card-body border mb-2 d-flex">
               <div class="img"><img src="include\img\<?= $yo['pic'];?>" class="img-fluid rounded-circle" style="height:70px; width: 75px;" alt=""></div>
                    <a href="chat.php?chat_id=<?=$yo['u_id'];?>" class="nav-link text-dark">
                    <div class="mx-5"><p class="lead"><?=$yo['name'];?></p></div>
                    </a>              
                       </div>
        <?php endforeach; ?>
    </div>
</div>