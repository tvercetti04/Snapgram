<?php include "include/config.php";
if(!isset($_SESSION['user'])){
    $snap->redirect('login');
} ?>
<?php

                    
                   $post_id = $_POST['post_id'];
                   $user_id = $_POST['user_id'];

                   $like = $snap->countData("SELECT * FROM like_post WHERE post_id = '$post_id' AND user_id = '$user_id'");

                   if($like == 0){
                       
                   $data = [
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                    'action' => 1
                ];
                 // print_r($data); 
                    $query = $snap->insert("like_post",$data);
                    echo json_encode(array('status'=>1));
                    echo 1;
                   }
               
            //    if ($query) {
            //     // echo json_encode(array("statusCode"=>200));
            //     echo 1;
            // } 
            // else {
            //     // echo json_encode(array("statusCode"=>201));
            //     echo 0;
            // }
            

           ?>   