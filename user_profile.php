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
                 $yo = $_GET['user_id'];
                $query = $snap->select("SELECT * FROM pro_update JOIN accounts ON accounts.id = pro_update.u_id WHERE u_id = '$yo'");
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
                     $yo = $_GET['user_id'];
                    // $user = $snap->select("SELECT * FROM accounts where email = '$yo'");
                    
                    $count = $snap->countData("SELECT * FROM posts WHERE user_id = '$yo'");
                  
                ?>
                    <h3><?php echo $count; ?> <br> Posts</h3>
                  
                </div>
                <div class="col-4">
                <?php
                $follower = $snap->countData("SELECT * FROM follow WHERE following= '$yo'"); ?>

                    <h3><?php echo $follower; ?> <br> Followers</h3>
                </div>
                <div class="col-4">
                <?php
                $following = $snap->countData("SELECT * FROM follow WHERE follower= '$yo'"); ?>
                    <h3><?php echo $following ?> <br> Following</h3>
                </div>
            </div>
            <div class="actions d-flex mt-5">
                <button class="btn btn-dark w-100 mx-2 py-2" name="follow">Follow</button>
                <a href="messages.php" class="btn btn-dark w-100 mx-2 py-2">Message</a>
                <a href="" class="btn btn-dark w-100 mx-2 py-2">More</a>
            </div>
        </div>
            
        </div>
   </div>

   <div class="container">
   <hr class="my-5">
<div class="row">
        <?php
            $yo = $_GET['user_id'];
            $query = $snap->select("SELECT * FROM posts JOIN pro_update ON posts.user_id = pro_update.u_id JOIN accounts ON accounts.id = pro_update.u_id WHERE u_id = '$yo'");
            foreach($query as $q): ?>
                <div class="col-4 photos my-2">
                    <img src="include\img\<?= $q['photo'];?>" class="" alt="">
                </div>
            <?php endforeach; ?>
        </div>
   </div>
    
</div>

<div class="modal fade" id="following">
    <div class="modal-dialog"></div>
</div>

