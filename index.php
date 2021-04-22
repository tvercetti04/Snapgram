<?php include "include/header.php";

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
$query = $snap->countData("SELECT * FROM pro_update WHERE u_id = '$user_id'");
    if($query < 1){
        $snap->redirect('pro_update');
    }


?>

<div class="container mt-2">
    <div class="row">
   
    <div class="col-lg-8">
    <!-- <form action="" method="post"> -->
    <?php 
        $follow = $snap->select("SELECT * FROM follow WHERE follower = '$user'");
        
        // foreach($follow as $f){
        //     $fuck = $f['following'];
        //     echo $f_id = explode(',',array_keys($fuck));
        //     echo $f['following'];
            
        //     // echo $f['following'];
        //     // foreach($f_id as $fuck){
        //     //    echo $fuck;
        //     // }
        // }
        // $call = $snap->select("SELECT * FROM posts JOIN follow On posts.user_id = follow.following JOIN pro_update On pro_update.u_id = follow.following WHERE follower = '$user' OR posts.user_id = '$user' ORDER BY posts.post_id DESC");
        $call = $snap->select("SELECT * FROM posts JOIN follow On posts.user_id = follow.following JOIN pro_update On pro_update.u_id = follow.following WHERE follower = '$user'ORDER BY posts.post_id DESC");
        // $call = $snap->select("SELECT * FROM posts WHERE user_id IN (7,8,9)");
       
       
        foreach($call as $c):
           
           
    ?>
        <div class="card border-0 post my-3">
            <div class="card-header border d-flex post-header">
                    <a href="user_profile.php?user_id=<?=$c['u_id'];?>"><img src="include\img\<?= $c['pic'];?>"> </a>
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
<?php 
 


endforeach; ?>
    <?php 
        $post_id = $_POST['post_id'];

        
 if(isset($_POST['send_comment'])){
    $data = [
        'user_id' => $user,
        'post_id' => $post_id,
        'comment' => $_POST['comment']
    ];
    
    $query = $snap->insert("comments",$data);
}      
        ?>   


       
    </div>
    <div class="col-lg-4">
        <div class="card border-0">
        <?php 
                $yo = $_SESSION['user'];
                $query = $snap->select("SELECT * FROM pro_update WHERE p_email = '$yo'");
                foreach($query as $q):
            ?>
            <div class="card-body">
                <div class="profile d-flex">
                    <a href="profile.php" class=""><img src="include\img\<?= $q['pic'];?>" alt=""></a>
                    <a href="profile.php" class="nav-link text-dark mx-2"><strong><?= $q['name'];?></strong></a>
                    <a href="logout.php" class="nav-link ms-5">Logout</a>
                </div>
                <div class="list-group border-0 mt-3">
                    <a href="#post" data-bs-toggle="modal" class="list-group-item list-group-item-action border-0 py-3"><i class="bi bi-camera-fill"></i> Add Post</a>
                    <a href="messages.php" class="list-group-item list-group-item-action border-0 py-3"><i class="bi bi-chat-fill"></i> Chats</a>
                    <a href="id_edit.php" class="list-group-item list-group-item-action border-0 py-3"><i class="bi bi-person-fill"></i> Account</a>
                    <a href="settings.php" class="list-group-item list-group-item-action border-0 py-3"><i class="bi bi-gear-fill"></i> Settings</a>
                    <a href="pp.php" class="list-group-item list-group-item-action border-0 py-3"><i class="bi bi-person-square"></i> Privacy Policy</a>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
   
    </div>
</div>

<div class="modal fade mt-5 ms-auto" id="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body bg-light p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="mb-4">
                    <textarea name="caption" placeholder="Enter Caption..." id="" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="d-grid">
                        <input type="submit" name="post" value="Post" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['post'])){

        $photo = $_FILES['photo']['name'];
        $tmp_image = $_FILES['photo']['tmp_name'];

        move_uploaded_file($tmp_image,"include/img/$photo");

        $data = [
            'user_id' => $user,
            'photo' => $photo,
            'caption' => $_POST['caption'],
        ];
        $query = $snap->insert("posts",$data);
        
    }
?>
<script>
    $(document).ready(function() {
        $.ajax({
                                    url: "view.php",
                                    type: "POST",
                                    data:{ 
                                        // user_id:user_id
                                    },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(dataResult){
                                        console.log(dataResult);
                                        var resultData = dataResult.data;
                                        var resultData1 = dataResult.status;
                                        // var i=1;
                                        console.log(resultData.post_id);
                                        if(resultData1 == 1){
                                        $.each(resultData,function(index,row){
                                            $('.like_post_'+row.post_id).removeClass('text-dark bi bi-heart')
                                            $('.like_post_'+row.post_id).addClass('text-danger bi bi-heart-fill')
                                            $('#'+row.user_id+'_'+row.post_id).removeClass('like')
                                            $('#'+row.user_id+'_'+row.post_id).addClass('Unlike')
                                        });
                                        }
                                    }
                                });
                $('.like').click(function(e) {
                    e.preventDefault();
                    var el = this;
                    var id = this.id;
                    var splitid = id.split("_");

                    // Add id
                    var user_id = splitid[0];
                    var post_id = splitid[1];
                    // AJAX Request
                    $.ajax({
                        url:'like.php',
                        type: 'POST',
                        data:{
                            user_id:user_id, 
                            post_id:post_id
                        },
                        success: function(response) {
                            console.error(response.status);
                            // if (response === '1'){
                                // alert("Data inserted");
                                // $('.like_post_'+post_id).removeClass('text-dark bi bi-heart')
                                // $('.like_post_'+post_id).addClass('text-danger bi bi-heart-fill')
                                $.ajax({
                                    url: "view.php",
                                    type: "POST",
                                    // data:{ 
                                    //     user_id:user_id
                                    // },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(dataResult){
                                        var resultData = dataResult.data;
                                        var resultData1 = dataResult.status;
                                        console.log(resultData);

                                        // var i=1;
                                        console.log(resultData.post_id);
                                        if(resultData1 == 1){
                                        $.each(resultData,function(index,row){
                                            $('.like_post_'+row.post_id).removeClass('text-dark bi bi-heart')
                                            $('.like_post_'+row.post_id).addClass('text-danger bi bi-heart-fill')
                                            $('#'+row.user_id+'_'+row.post_id).removeClass('like')
                                            $('#'+row.user_id+'_'+row.post_id).addClass('Unlike')
                                        });
                                        }
                                    }
                                });

                            // }
                            // else if(response == 0) {
                                // var heart = $('.wishlist_heart_'+product_id);
                                // $.ajax({
                                //     url:'/wishlist_remove',
                                //     type: 'POST',
                                //     data:{
                                //         product_id:product_id
                                //     },
                                //     success: function(response) {
                                //         // heart.fadeOut("slow");
                                //         $('.wislist_heart_'+product_id).addClass('text-dark fa-heart-o')
                                //         $('.wislist_heart_'+product_id).removeClass('text-danger fa-heart')
                                //     }
                                //     // $(this).parents(".wislist_heart_'+product_id").animate({ backgroundColor: "#fbc7c7" }, "fast")
                                // });
                            // }
                        }

                    });

                });
                $('.Unlike').click(function(e) {
                    e.preventDefault();
                    var el = this;
                    var id = this.id;
                    var splitid = id.split("_");

                    // Add id
                    var user_id = splitid[0];
                    var post_id = splitid[1];
                    // AJAX Request
                    $.ajax({
                        url:'unlike.php',
                        type: 'POST',
                        data:{
                            user_id:user_id, 
                            post_id:post_id
                        },
                        success: function(response){
                            $('.like_post_'+row.post_id).addClass('text-dark bi bi-heart')
                            $('.like_post_'+row.post_id).removeClass('text-danger bi bi-heart-fill')
                            $('#'+row.user_id+'_'+row.post_id).addClass('like')
                            $('#'+row.user_id+'_'+row.post_id).removeClass('Unlike')
                        }
                    });
                });
            });

</script>

</body>
</html>