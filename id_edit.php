<?php include "include/header.php";
if(!isset($_SESSION['user'])){
    $snap->redirect('login');
} ?>

<div class="container mt-5">
    <div class="card border-0">
        <div class="card-body">
            <?php 
                $select = $snap->select("SELECT * FROM accounts JOIN pro_update ON accounts.id = pro_update.u_id WHERE accounts.id = '$user'");
                foreach($select as $s):
            ?>
            <div class="user_img text-center p-4">
                <img src="include\img\<?=$s['pic'];?>" alt="" class="img-fluid rounded-circle" style="height: 100px; width: 110px; object-fit: cover;">
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" name="name" value="<?=$s['name'];?>" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="date" name="dob" value="<?=$s['dob'];?>" class="form-control">
                </div>
                <div class="mb-3">
                    <select name="g" class="form-control">
                        <option value="<?php 
                                if($s['gender'] == 1){
                                    echo "1";
                                }
                                elseif($s['gender'] == 2){
                                    echo "2";
                                }
                                elseif($s['gender'] == 3){
                                    echo "3";
                                }
                            ?>" selected hidden disabled>
                            <?php 
                                if($s['gender'] == 1){
                                    echo "Male";
                                }
                                elseif($s['gender'] == 2){
                                    echo "Female";
                                }
                                elseif($s['gender'] == 3){
                                    echo "Other";
                                }
                            ?>
                        </option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="file" name="pic" value="<?=$s['pic'];?>" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" name="update" value="Update" class="btn btn-dark w-100">
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
   if(isset($_POST['update'])){
    $dp = $_FILES['pic']['name'];
    $tmp_img = $_FILES['pic']['tmp_name'];

    move_uploaded_file($tmp_img,"include/img/$dp");

      echo $name = $_POST['name'];
      echo $dob = $_POST['dob'];
      echo $gender = $_POST['g'];
      echo $pic = $dp;
      
      $query = $snap->update("pro_update", "name = '$name', dob = '$dob', gender = '$gender', pic = '$pic'",  "u_id = '$user'");
        $snap->redirect('id_edit');
   }
   
?>