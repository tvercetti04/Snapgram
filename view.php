<?php include "include/config.php";

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
?>

<?php 

// $user = 7;
$query = $snap->select("SELECT * FROM like_post WHERE user_id = '$user'");
// $yo = [];
// foreach($query as $q){
    if(count($query) > 0){
        echo json_encode(array('data'=>$query, 'status'=>1));
    }else{
        echo json_encode(array('status'=>0));
    }  
// }
// print_r($query);

?>