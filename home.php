<!DOCTYPE html>
<?php 
session_start();
include('include/config.php');

if(!isset($_SESSION['user_email'])){
    header("location:signin.php");
}

else{
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMchat</title>
     <!-- bootstrap cdn -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqery/3.2.1/jquery.min.js"></script> -->

<!-- custom -->
<link rel="stylesheet" href="css/home.css">

</head>
<body>
    <div class="container main-section">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                <div class="input-group searchbox">
                    <div class="input-group-btn d-flex justify-content-center w-100">
                       <a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">
                            Search user and account setting
                        </button></a>
                    </div>
                </div>
                <div class="left-chat">
                    <ul>
                         <?php 
                         include("include/get_users_data.php"); ?> 
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                <div class="row">
                    <!-- getting the user who is loggged in  -->
                    <?php 
                    $user = $_SESSION['user_email'];
                    $get_user="SELECT * from users where user_email='$user'";
                    $run_user=mysqli_query($con,$get_user);
                    $row=mysqli_fetch_array($run_user);

                    $user_id=$row['user_id'];
                    $user_name=$row['user_name'];
                    
                    ?>

                    <!-- getting the user data on which user click -->
                    <?php 
                        if(isset($_GET['user_name'])){
                            global $con;

                            $get_username=$_GET['user_name'];

                            $get_user="SELECT * from users where user_name='$get_username'";

                            $run_user=mysqli_query($con,$get_user);

                            $row_user=mysqli_fetch_array($run_user);

                            $username=$row_user['user_name'];
                            $user_profile_image = $row_user['user_profile'];
                        }
                    $total_message="SELECT * from user_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                    
                    $run_messages= mysqli_query($con,$total_message);

                    $total = mysqli_num_rows($run_messages);
                    ?>

                    <div class="col-md-12 right-header d-flex align-items-center">
                        <div class="right-header-img">
                            <img  src="<?php echo"$user_profile_image";?>" alt="">
                        </div>
                        <div class="right-header-detail">
                            <form action="" method="POST">
                                <p><?php echo "$username";?></p>

                                <span><?php echo $total;?> messages</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button name="logout" class="btn btn-danger">Logout</button>
                            </form>
                            <?php 
                                if(isset($_POST['logout'])){
                                    $update_msg = mysqli_query($con,"UPDATE users SET log_in='offline' WHERE user_name='$user_name'");
                                    header("Location:logout.php");
                                    exit();
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                        <?php 
                            $update_msg=mysqli_query($con,"UPDATE user_chat SET msg_status='read' WHERE sender_username='$username' AND receiver_username='$user_name'");

                            $sel_msg="SELECT * from user_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";

                            $run_msg=mysqli_query($con,$sel_msg);

                            while($row =mysqli_fetch_array($run_msg)){
                                $sender_username=$row['sender_username'];
                                $receiver_username=$row['receiver_username'];
                                $msg_content=$row['msg_content'];
                                $msg_date=$row['msg_date'];
                        ?>
                        <ul>
                            <?php 
                                if($user_name == $sender_username AND $username ==$receiver_username){
                                    echo"
                                        <li>
                                            <div class='rightside-right-chat'>
                                                <span>$user_name <small>$msg_date</small></span><br><br>
                                                <p>$msg_content</p>
                                            </div>
                                        </li>
                                    ";
                                }
                                else if($user_name == $receiver_username AND $username ==$sender_username){
                                    echo"
                                        <li>
                                            <div class='rightside-left-chat'>
                                                <span>$username <small>$msg_date</small></span><br><br>
                                                <p>$msg_content</p>
                                            </div>
                                        </li>
                                    ";
                                }
                            ?>
                        </ul>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 right-chat-textbox">
                        <form action="" method="POST">
                            <input type="text" autocomplete="off" name="msg_content" placeholder="Write Message ...">
                            <button class="btn" name="submit"><i class="fa-brands fa-telegram text-light h3"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        if(isset($_POST['submit'])){
            $msg=htmlentities($_POST['msg_content']);

            if($msg ==""){
                echo"
                <div class='alert alert-danger'>
        <strong>
            <center>Message was unablle to send.</center>
        </strong>
    </div>
                ";
            }

            else if(strlen($msg)>100){
                echo"
                <div class='alert alert-danger'>
        <strong>
            <center>Message is too long . use only 100 characters</center>
        </strong>
    </div>
                ";
            }
            else{
                $insert = "INSERT into user_chat(sender_username,receiver_username,msg_content,msg_status,msg_date) values ('$user_name','$username','$msg','unread',NOW())";

                $run_insert=mysqli_query($con,$insert);

                print_r($run_insert);
            }
        }
    ?>
    
    <script>
        $('#scrolling_to_bottom').animate({
            scrollTop:$('#scrolling_to_bottom').get(0).scrollHeight},1000);
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var height=$(window).height();
            $('.left-chat').css('height',(height-92)+'px');
            $('.right-header-contentChat').css('height',(height - 163)+'px');
        })
    </script>
</body>
</html>
<?php }; ?>