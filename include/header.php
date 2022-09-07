<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand nav-link" href="#">
            <?php 
                $user=$_SESSION['user_email'];
                $get_user="SELECT * from users where user_email='$user'";
                $run_user=mysqli_query($con,$get_user);
                $row=mysqli_fetch_array($run_user);

                $user_name=$row['user_name'];
                echo "<a class='nav-link text-light' href='../home.php?user_name=$user_name'>SM Chat</a>";
            ?>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../account_settings.php">Setting</a>
            </li>
        </ul>
        </div>

</nav><br>