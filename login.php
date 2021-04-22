<?php include "include/config.php";

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card border-0 px-4 py-2 ">
                <div class="card-body">
                <h2 class="text-center">SnapGram Login</h2>
                <hr class="mb-5">
                
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" name="email" placeholder="Registered Email or Contact Number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Enter Password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <a href="signup.php" class="btn btn-primary w-100">Register</a>
                                    <a href="">Forgot password?</a>
                                </div>
                                <div class="col-6">
                                    <input type="submit" name="login" value="Login" class="btn btn-danger w-100">
                                </div>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $check = $snap->countData("SELECT * FROM accounts WHERE email='$email' AND password='$password'");

        if($check > 0){
            $_SESSION['user'] = $email;
            $snap->redirect('index');
        }
        else{
            echo "Login Failed";
        }
    }

?>