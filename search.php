<?php include "include/header.php"; 

if(!isset($_SESSION['user'])){
    $snap->redirect('login');
}
?>

<div class="container mt-5">
    <div class="card border-0">
    <form action="" method="post">
        <div class="card-body">
        <?php
            $search = $_GET['user'];
            $query = $snap->select("SELECT * FROM pro_update JOIN accounts ON pro_update.u_id = accounts.id WHERE pro_update.name LIKE '%$search%' ");
            
            foreach($query as $q): ?>
            <div class="col">
               <div class="card">
                    <div class="card-body border-0 d-flex search">
                        <div class="img">
                            <a href="user_profile.php?user_id=<?=$q['u_id'];?>"><img src="include\img\<?= $q['pic'];?>" class="img-fluid rounded-circle" style="height: 60px; width: 70px;" alt="">
                        </a>
                        </div>
                        <div class="name">
                            <a href="user_profile.php?user_id=<?=$q['u_id'];?>" class="text-dark nav-link"><p class="lead mt-3"><?= $q['name'];?></p></a>
                        </div>
                        <div class="action">
                        <input type="hidden" name="following" value="<?= $q['id'];?>" class="form-control">
                        <button class="btn btn-outline" name="follow">Follow</button>
                        </div>
                    </div>
               </div>
            </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['follow'])){
        $following = $_POST['following'];
        $data = [
            'following' => $following,
            'follower' => $user
        ];
        $query = $snap->insert('follow', $data);
    }

?>

