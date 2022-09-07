<?php 
$con=mysqli_connect("localhost","root","","smchat") or die("connection was not established");

// $user="SELECT * from users";

$run_user = mysqli_query($con,"SELECT * from users") or die("query error");

// print_r(mysqli_fetch_array($run_user));

while($row_user=mysqli_fetch_array($run_user)){
    // print_r($row_user);
    $user_id=$row_user['user_id'];
    $user_name=$row_user['user_name'];
    $user_profile=$row_user['user_profile'];
    $login=$row_user['log_in'];
    echo"
    <li>
     <div class='chat-left-img' width='20px'>
        <img src='./$user_profile'>  
     </div>
    <div class='chat-left-detail'>
        <p><a href='home.php?user_name=$user_name'>$user_name</a></p>";
        if($login == "Online"){
            echo "<span><i class='fa fa-circle' aria-hidden='true'></i>Online</span>"; 
        }
        else{
            echo "<span><i class='fa-regular fa-circle'></i>Offline</span>"; 
        }
        "
    </div>

</li>
    ";
}
?>


</li>