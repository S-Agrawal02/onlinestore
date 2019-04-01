<?php
	session_start();
    require 'connection.php';
    require 'check_if_added.php';
?>

<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <link rel="icon" href="images/icon.png">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>

        <title>Lifestyle Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">

        <style>

        	.img-magnifier-container {
					  position:relative;
					}

					.magnifier {
					  border: 4px solid #000;
					  position : absolute;
					  cursor: crosshair;
					  /*Set the size of the magnifier glass:*/
					  width: 200px;
					  height: 200px;
					}

           
            .topnav {
              background-color: #333;
              overflow: hidden;
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
              background-color: #ddd;
              color: black;
            }

            /* Add a color to the active/current link */
            .topnav a.active {
              background-color: #4CAF50;
              color: white;
            }

        </style>

       
      
    </head>
    <body background="images/bg2.jpg">
        <div>
            <?php
                $page_no=3;   //highlighted page
                require 'header.php';
            ?>

            <div class="container">
                <div class="jumbotron">
                    <h1>Welcome to our Sarees Store!</h1>
                    <p>We have the best cameras, watches and shirts for you. No need to hunt around, we have all in one place.</p>
                </div>
            </div>



		<?php if(!isset($_SESSION['email']))
				{  
					?>            

            <div class="container">


                	<?php

						define('IMAGEPATH', 'img/');
						$directoryfiles = array();

						if (is_dir(IMAGEPATH)){

						    $handle = opendir(IMAGEPATH); 

						}

						else{
						    echo 'No image directory';
						}

						

						$count=0;
						$ctr=0;

						$d = 'img/';
		
						$x = glob($d.'*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE);
						sort($x);
       


						foreach($x as $file){
						    $directoryfile =  basename($file);
						//}

						//foreach(glob(IMAGEPATH.'*') as $directoryfile)
						//{

							$count++;
							$ctr++;
						
						if($count==4)
						{
								echo '<div class="row">';
						}		// IF statement


						?>



                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">

                        	 <?php
                                 $details = explode(".",$directoryfile);	// ID - Name . type
                                 $id = explode("-", $details[0]);	// ID - Name

                                 $price_query="select price,name from items where id='$id[0]'";
                                 $price_result=mysqli_query($con,$price_query) or die(mysqli_error($con));
    							               $rows_fetched=mysqli_num_rows($price_result);

    							 if($rows_fetched==0)
    							 {
						        	$price = "---";
						    	}


						    else
						    {
						        $price=mysqli_fetch_array($price_result);
						    }
                                 ?>


                   <!--         <a href="product_display.php?id=<?php //echo $directoryfile; ?>" onmouseenter="magnify(<?php //echo "'myimage".$ctr."'" ?>, 1.8)" onmouseleave="remove()">  -->

                            <a href="product_display.php?img=<?php echo IMAGEPATH.$directoryfile; ?> &id=<?php echo $id[0]; ?> &page_no=1" target="_blank" >
                                        
                                              
                                <img id=<?php echo "myimage".$ctr ?> src="<?php echo IMAGEPATH.$directoryfile ?>" alt="<?php echo IMAGEPATH.$directoryfile ?>" style="height: 200px; width: 100%" >
                                                     
                            </a>
                            
                            
                        
                            <center>
                                <div class="caption">
                                    <h4> <?php echo $price['name'] ?> 	</h4>
                                    <p> <?php echo "Rs.". $price['price'] ?> <br> <div style="display: inline-block;"> <b> Quantity :   </b> <?php echo '<input id="qty" style="height:20px; width:40px; size="10" type="number" id="qty" value="1">'?>&nbsp;&nbsp; <b><a href="product_display.php?img=<?php echo IMAGEPATH.$directoryfile; ?> &id=<?php echo $id[0]; ?>" target="_blank">View Details</a></b> </div></p>
                                    
                                        <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                        
                                    
                                </div>
                            </center>
                        </div>
                    </div>

                    <?php

                    	if($count==4)
						{
								echo '</div>';
								$count=0;
						}		// IF statement

                    	}	//For each
                    ?>


                    	<?php 
                    		closedir($handle); 
                    	?>

                </div>
                

            <?php    }   //IF NOT LOGGED IN
   

            else{		//IF LOGGED IN
            		?>


              <div class="container">


                	<?php

						define('IMAGEPATH', 'img/');
						$directoryfiles = array();

						if (is_dir(IMAGEPATH)){
						    $handle = opendir(IMAGEPATH);
						    
						}

						else{
						    echo 'No image directory';
						}

						

						$count=0;
						$ctr=0;

						$d = 'img/';
		
						$x = glob($d.'*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE);
						sort($x);

						foreach($x as $file)
                        {
						    $directoryfile =  basename($file);
						

							$count++;
							$ctr++;
						
						if($count==4)
						{
								echo '<div class="row">';
						}		// IF statement


						?>



                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">

                        	 <?php
                                 $details = explode(".",$directoryfile);	// ID - Name . type
                                 $id = explode("-", $details[0]);	// ID - Name

                                 $price_query="select price,name from items where id='$id[0]'";
                                 $price_result=mysqli_query($con,$price_query) or die(mysqli_error($con));
    							 $rows_fetched=mysqli_num_rows($price_result);

    							 if($rows_fetched==0)
    							 {
						        	$price = "---";
						    	}


						    else
						    {
						        $price=mysqli_fetch_array($price_result);
						    }
                                 ?>


                   <!--         <a href="product_display.php?id=<?php //echo $directoryfile; ?>" onmouseenter="magnify(<?php //echo "'myimage".$ctr."'" ?>, 1.8)" onmouseleave="remove()">  -->

                            <a href="product_display.php?img=<?php echo IMAGEPATH.$directoryfile; ?> &id=<?php echo $id[0]; ?>" target="_blank" >
                                        
                                              
                                <img id=<?php echo "myimage".$ctr ?> src="<?php echo IMAGEPATH.$directoryfile ?>" alt="<?php echo IMAGEPATH.$directoryfile ?>" style="height: 200px; width: 100%" >
                                                     
                            </a>
                            
                            
                        
                            <center>
                                <div class="caption">
                                    <h4> <?php echo $price['name'] ?> 	</h4>
                                    <p> <?php echo "Rs.". $price['price'] ?> <br> <div style="display: inline-block;"> <b> Quantity :   </b> <?php echo '<input id="qty" style="height:20px; width:40px; size="10" type="number" value=1>'?>&nbsp;&nbsp; <b><a href="product_display.php?img=<?php echo IMAGEPATH.$directoryfile; ?> &id=<?php echo $id[0]; ?>" target="_blank">View Details</a></b> </div></p>
                                   
                                        <?php
                                          
                                          /*  if(check_if_added_to_cart($id[0]))
                                            {
                                               echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                                            }
                                            else
                                            {
                                            	*/
                                            	
                                                ?>

                                                <a href="cart_add.php?id=<?php echo $id[0]; ?> &qty=javascript:document.getElementById('qty').value; &cost_per_pc=<?php echo $price['price']; ?> &item_name=<?php echo $details[0]; ?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                <?php
                                            //}
                                        
                                        ?>
                                    
                                </div>
                            </center>
                        </div>
                    </div>

                    <?php

                    	if($count==4)
						{
								echo '</div>';
								$count=0;
						}		// IF statement
                          

                    	}	//For each
                    ?>


                    	<?php 
                    		closedir($handle); 
                    	?>

                </div>

                <?php    }//IF LOGGED IN     ?>


            <br><br><br><br><br><br><br><br>

           <footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy Lifestyle Store. All Rights Reserved. | Contact Us: +91 9585586236</p>
                   <p>This website is developed by Shubham Agrawal</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>