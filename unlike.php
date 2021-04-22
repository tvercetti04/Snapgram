<?php include "include/config.php"; ?>

<?php
    $user = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    
    $query = $snap->delete('like_post', "'post_id' = $post_id AND 'user_id' = $user");
?>