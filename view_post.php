<?php include "include/header.php"; ?>


<div class="card border-0 post my-3">
            <div class="card-header border d-flex post-header">
                    <a href="user_profile.php?user_id=<?=$c['u_id'];?>"><img src="include\img\<?= $c['pic'];?>" style="height: 60vh; width: auto;"> </a>
                    <a href="user_profile.php?user_id=<?=$c['u_id'];?>" class="nav-link text-dark"><?= $c['name'];?></a> 
                    <a href="" class="text-dark ms-auto"><i class="bi bi-three-dots"></i></a>
            </div>
            <div class="card-body border-0 p-0">
                <img src="include\img\<?= $c['photo'];?>" class="w-100" alt="">
            </div>
            <div class="card-footer border px-0">                        
                <button class="btn like shadow-none" name="like" id="<?= $user.'_'.$c['post_id']; ?>" style="font-size: 26px;"><i class="bi bi-heart like_post_<?= $c['post_id'];?>"></i></button>
                <button class="btn shadow-none" style="font-size: 26px;"><i class="bi bi-chat"></i></button>
               <div class="likes">
               <strong class="mx-3">
                    <?php 
                        $like_post = $c['post_id'];
                        $count = $snap->countData("SELECT * FROM like_post WHERE post_id = '$like_post'");
                    ?>
                <?php if($count != 0): echo $count; echo " Likes"; endif;?> </strong>         
               </div>             
                <div class="caption d-flex mx-2">                       
                <a href="" class="nav-link px-2 text-dark pt-1"><strong><?= $c['name'];?></strong></a>                      
                <p class="lead px-2"><?= $c['caption'];?></p>                       
                </div>                      
                <p class="text-muted px-3 time"><?= $c['doc'];?></p> 
                <div class="comment-box px-2">
               <form action="" method="post">
                <div class="input-group p-0">
                    <input type="text" name="comment" placeholder="Enter your comment" class="form-control bg-light">
                    <input type="hidden" name="post_id" value="<?=$c['post_id'];?>" class="form-control">
                    <button class="btn" name="send_comment"><i class="bi bi-arrow-right"></i></button>
                </div>
               </form>
            </div>                       
            </div>
        </div>