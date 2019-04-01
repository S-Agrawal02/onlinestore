<?php
    require 'connection.php';
    session_start();
    
    $email=mysqli_real_escape_string($con,$_POST['email']);

    $password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));

    $user_authentication_query="select id,email from users where email='$email' and password='$password'";
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    
    if($rows_fetched==0)
    {
        //no user
        //redirecting to same login page
          ?>

        <script>
       
            if(confirm("Wrong username or password"))
            {
                window.location.href = "javascript:history.go(-1)";
            }
            else
            {
                window.location.href = "javascript:history.go(-1)";
            }
        
        </script>      
        

        <?php
        
        //echo "Wrong email or password.";
    }

    else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['email']=$email;
        $_SESSION['id']=$row['id'];  //user id
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }
    
 ?>