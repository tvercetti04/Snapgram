<?php include "include/config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>
   
<div class="container mt-5">
    <div class="row">
    <div class="col-6"></div>
        <div class="col-6">
            <div class="card shadow px-4 py-2 border-0">
                <div class="card-body">
                <h3 class="text-center">Signup on SnapGram</h3>
                <hr class="mb-5">
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" placeholder="Contact Number" name="contact" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" placeholder="Email Address" name="email" class="form-control" required>   
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" placeholder="Password" name="password" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <input type="text" placeholder="Repeat Password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <input type="submit" value="Register" name="signup" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <a href="login.php" class="btn btn-danger">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="row p-0">
                                <div class="col-3">
                                    <input type="checkbox" class="form-check-input" checked required>
                                    <label for="">I Agree</label>
                                </div>
                                <div class="col-9">
                                    <p class="small check p-0">By clicking Register, you agree in the Terms & Conditions set out by this site, including our Cookie use.</p>
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
    if(isset($_POST['signup'])){
        $data = [
            'contact' => $_POST['contact'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ];
       
        $query = $snap->insert('accounts', $data);
        $snap->redirect('login'); 

        if($query){
            $snap->redirect('login');
        }
    }

?>