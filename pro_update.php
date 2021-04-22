<?php include "include/header.php";

if(!isset($_SESSION['user'])){
    $snap->redirect('login');
}

$yo = $_SESSION['user'];
$query = $snap->select("SELECT * FROM accounts WHERE email = '$yo'");
$profile = [];
foreach($query as $q){
    $profile = $q['id'];
    $email = $q['email'];
} 

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card border-0">
                <div class="card-body">
                    <h3 class="text-center">Update Your SnapGram Profile</h3>
                    <hr class="mb-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="">Name: </label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Date of Birth: </label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Gender: </label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="" selected disabled hidden>Select Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Profile Picture: </label>
                            <input type="file" name="pic" class="form-control" required>
                        </div>
                        <div class="d-grid mb-2">
                            <input type="submit" name="pro_add" value="Update" class="btn btn-dark">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['pro_add'])){

        $dp = $_FILES['pic']['name'];
        $tmp_img = $_FILES['pic']['tmp_name'];

        move_uploaded_file($tmp_img,"include/img/$dp");

        $data = [
            'u_id' => $profile,
            'p_email' => $email,
            'name' => $_POST['name'],
            'dob' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'pic' => $dp
        ];
        $query = $snap->insert('pro_update', $data);
        $snap->redirect('index');

        if($query){
            $snap->redirect('index');
        }
    }

?>