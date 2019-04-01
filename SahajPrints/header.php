
<!DOCTYPE html>
<html>
<head>
  <style type="text/css">

        .topnav {
          /* background-color: #333; */
          margin-left: 150px;
          overflow: hidden;
          border-left-style: solid;
          border-right-style: solid;
          border-width: 5px;
          border-radius: 5px
        }

        /* Style the links inside the navigation bar */
        .topnav a {
          float: left;
          color: #f2f2f2;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 17px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
          background-color: #3cb371;
          color: white;
        }

        /* Add a color to the active/current link */
        .topnav a.active {
          background-color: #4CAF50;
          color: white;
        }
        
  </style>

  <title></title>
</head>
<body>

    <nav class="navbar navbar-inverse navabar-fixed-top">
               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="index.php" class="navbar-brand">Sarees Store</a>

                       <div class="topnav">

                          <script type="text/javascript">
    
  </script>
  
                    <?php
                        if($page_no==1)
                        { ?>
                          <a href="silk.php" class="active">Silk Sarees</a>
                          <a href="reniyal.php">Reniyal</a>
                          <a href="cotton.php">Cotton</a>
                          <a href="designer.php">Designer Sarees</a>
                     <?php   
                        }

                        else if($page_no==2)
                        { ?>
                          <a href="silk.php">Silk Sarees</a>
                          <a href="reniyal.php" class="active">Reniyal</a>
                          <a href="cotton.php">Cotton</a>
                          <a href="designer.php">Designer Sarees</a>
                   <?php     
                        }

                        elseif ($page_no==3)
                        { ?>
                          <a href="silk.php">Silk Sarees</a>
                          <a href="reniyal.php">Reniyal</a>
                          <a href="cotton.php" class="active">Cotton</a>
                          <a href="designer.php">Designer Sarees</a>
                   <?php                               
                        }

                        elseif ($page_no==4)
                        { ?>
                          <a href="silk.php">Silk Sarees</a>
                          <a href="reniyal.php">Reniyal</a>
                          <a href="cotton.php">Cotton</a>
                          <a href="designer.php" class="active">Designer Sarees</a>
                   <?php                               
                        }

                        else
                        { ?>
                          <a href="silk.php">Silk Sarees</a>
                          <a href="reniyal.php">Reniyal</a>
                          <a href="cotton.php">Cotton</a>
                          <a href="designer.php">Designer Sarees</a>
                   <?php        
                        }
                    ?>

                       </div>
                      

                   </div>
                  
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <?php
                           if(isset($_SESSION['email'])){
                           ?>
                           <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                           <?php
                           }else{
                            ?>
                            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                           <?php
                           }
                           ?>
                           
                       </ul>
                   </div>
               </div>
</nav>
</body>
</html>