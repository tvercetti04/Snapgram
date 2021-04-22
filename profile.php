<?php include "include/header.php";

if(!isset($_SESSION['user'])){
    $snap->redirect('login');
}

?>


<div class="container mt-4">
   <div class="row">
        <div class="col-5">
            <div class="main text-center">
            <?php
                 $yo = $_SESSION['user'];
                $query = $snap->select("SELECT * FROM pro_update JOIN accounts ON accounts.id = pro_update.u_id WHERE p_email = '$yo'");
                foreach($query as $q): ?>
                <a href="#dp" data-bs-toggle="modal"><img src="include\img\<?= $q['pic'];?>" alt=""></a>
                <h4 class="mt-2"><?= $q['name'];?></h4>
                <?php endforeach; ?>  
            </div>
        </div>
        <div class="col-7 mt-5">
            <div class="row text-center">
                <div class="col-4">
                <?php 
                    $yo = $_SESSION['user'];
                    // $user = $snap->select("SELECT * FROM accounts where email = '$yo'");
                    
                    $count = $snap->countData("SELECT * FROM posts WHERE user_id = '$user'");
                  
                ?>
                    <h3><?php echo $count; ?> <br> Posts</h3>
                  
                </div>
                <div class="col-4">
                <?php
                $follower = $snap->countData("SELECT * FROM follow WHERE following= '$user'"); ?>

                    <h3><?php echo $follower; ?> <br> Followers</h3>
                </div>
                <div class="col-4">
                <?php
                $following = $snap->countData("SELECT * FROM follow WHERE follower= '$user'"); ?>
                   <a href="#following" data-bs-toggle="modal" class="nav-link text-dark p-0"> <h3><?php echo $following ?> <br> Following</h3></a>
                </div>
            </div>
            <div class="actions d-flex mt-5 px-0">
                <a href="id_edit.php" class="btn btn-dark py-2 mx-3 w-100">Edit Profile</a>
                <a href="" class="btn btn-dark py-2 w-100">Saved</a>
            </div>
        </div>
            
        </div>
   </div>

   <div class="container">
   <hr class="my-5">
<div class="row">
        <?php
            $yo = $_SESSION['user'];
            $query = $snap->select("SELECT * FROM posts JOIN pro_update ON posts.user_id = pro_update.u_id JOIN accounts ON accounts.id = pro_update.u_id WHERE p_email = '$yo'");
            foreach($query as $q): ?>
                <div class="col-4 photos my-2">
                    <img src="include\img\<?= $q['photo'];?>" class="" alt="">
                </div>
            <?php endforeach; ?>
        </div>
   </div>
    
</div>

<div class="modal fade" id="following">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                       
                        <div class="list-group">
                        <?php 
                            $call = $snap->select("SELECT * FROM follow JOIN pro_update ON follow.following = pro_update.u_id WHERE pro_update.u_id = '$user'");
                            foreach($call as $c): ?>
                            <a href="" class="list-group-item"><?= $c['name'];?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
        </div>
      </div>
    </div>
</div>

