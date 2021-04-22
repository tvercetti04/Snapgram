<?php include "include/header.php";
if(!isset($_SESSION['user'])){
    $snap->redirect('login');
}
?>
<?php
    $user_id = $_GET['chat_id'];
    $query = $snap->select("SELECT * FROM pro_update WHERE u_id = '$user_id'");
?>
<style>
    /* body{
  width:100vw;
  height:100vh;
  background-color:#efefff;
} */
.msgcard {
	box-shadow: 0 0px 25px rgba(0, 0, 0, .2);
    
}

.chat-log {
	overflow: auto;
	height: calc(64vh);
}

.chat-log_item {
	background: #eaeaea;
	padding: 10px;
	margin: 0 auto 10px;
	max-width: 95%;
	min-width: 25%;
	float: left;
	font-size: 13px;
	border-radius: 0 20px 20px 20px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
	clear: both;
}

.chat-log_item.chat-log_item-own {
	float: right;
	background: #D5F4E7;
	text-align: right;
	margin-right: 0.7rem;
  border-radius: 20px 0 20px 20px;
}

.chat-form {
	background: #DDDDDD;
	padding: 30px 0;
	position: fixed;
	bottom: 0;
	width: 100%;
}

.chat-log_author {
	margin: 0 auto 0em;
	font-size: 12px;
	font-weight: bold;
}

.chat-log_time {
	margin: 0 auto .5em;
	direction: rtl;
	font-size: 12px;
	opacity: 0.5;
}
</style>
<div class="container">
<div class="col col-md-10 col-lg-9 col-xl-8 mx-auto my-auto">
        <div class="card my-1 msgcard">
            <div class="card-header d-flex py-0">
                <a href="user_profile.php?user_id=<?=$query[0]['u_id'];?>"><img src="include\img\<?=$query[0]['pic'];?>" class="img-fluid rounded-circle mt-1" style="height: 50px; width:55px;" alt=""></a>
                <a href="user_profile.php?user_id=<?=$query[0]['u_id'];?>" class="nav-link text-dark mt-1"><p class="lead ms-3"><?=$query[0]['name'];?></p></a>
            </div>
          <div class="card-body">
            <div class="container-fluid">
              <div id="messages_container" class="chat-log">  
                  <?php
                        $send_to = $_GET['chat_id'];
                        $query = $snap->select("SELECT * FROM chat JOIN pro_update ON chat.send_by = pro_update.u_id ORDER BY c_id ASC");
                        foreach($query as $q):
                            if($q['send_by'] == $user && $q['send_to'] == $send_to):

                            
                  ?>
                <div class="chat-log_item chat-log_item-own z-depth-0">
                  <div class="row justify-content-end mx-1 d-flex">
                    <div class="col-auto px-0">
                      <span class="chat-log_author">
                        Me
                      </span>
                    </div>
                    <div class="col-auto px-0">
                    </div>
                  </div>
                  <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                  <div class="chat-log_message">
                    <p><?= $q['body'];?></p>
                  </div>
                  <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                  <div class="row chat-log_time m-0 p-0 justify-content-end">
                  <p class="me-2"><?= $q['doc'];?></p>
                  </div>
                </div>
               
                <?php   
                 elseif($q['send_by'] == $send_to && $q['send_to'] == $user): ?>
                  
               <div class="chat-log_item chat-log_item z-depth-0">
                  <div class="row justify-content-end mx-1 d-flex">
                    <div class="col-auto px-0">
                      <span class="chat-log_author">
                       <p><?= $q['name']; ?></p>
                      </span>
                    </div>
                    <div class="col-auto px-0">
                    </div>
                  </div>
                  <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                  <div class="chat-log_message">
                    <p><?= $q['body'];?>
                    </p>
                  </div>
                  <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                  <div class="row chat-log_time m-0 p-0 justify-content-end">
                    23:15
                  </div>
                </div>
                <?php endif; endforeach; ?>
              </div>
             
            </div>
          </div>
         <form action="chat.php?chat_id=<?= $_GET['chat_id'];?>" method="post">
         <div class="card-footer border-0 bottom-rounded z-depth-0 py-2" style="background-color: #97E3C2">
            <div class="row">
              <div class="col col-md-10 col-lg-9 mx-auto">
                <div class="row d-flex justify-content-center">
                  <div class="col-12 col-md-9 align-self-center my-0">
                    <div class="row d-flex align-self-center justify-content-center">
                      <div class="col-12 d-flex px-0">
                        <div class="form-group col-12 my-0 mx-0">
                          <input type="text" id="content" size=""  name="msgbox" placeholder="Send message" class="form-control textarea resize-ta rounded-0 border-0"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-3 d-flex align-self-center my-0 px-0">
                    <div class="md-form my-1">
                    <button name="enter" class="btn btn-success py-1 rounded-0"><i class="bi bi-arrow-right"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        </div>
      </div>

</div>

<?php
    if(isset($_POST['enter'])){
       $data = [
            'send_to' => $_GET['chat_id'],
            'send_by' => $user,
            'body' => $_POST['msgbox'],

       ];
       $query = $snap->insert('chat', $data);


    }
?>