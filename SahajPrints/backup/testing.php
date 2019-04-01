<?php
    require 'connection.php';
    require 'check_if_added.php';
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <link rel="icon" href="images/icon.png">

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
        </style>

        <script>

        		function pcs()
        		{
        			return document.getElementById("qty").value;
        		}

				function magnify(imgID, zoom) {
				  var img, glass, w, h, bw;
				  img = document.getElementById(imgID);
				  /*create magnifier glass:*/
				   glass = document.createElement("DIV");
				   glass.setAttribute("class", "magnifier");
				   glass.setAttribute("id", "magnifier1");
				  //glass.setAttribute("class", "img-magnifier-glass");
				  /*insert magnifier glass:*/
				  img.parentElement.insertBefore(glass, img);
				  /*set background properties for the magnifier glass:*/
				  glass.style.backgroundImage = "url('" + img.src + "')";
				  glass.style.backgroundRepeat = "no-repeat";
				  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
				  bw = 2;
				  w = glass.offsetWidth / 2;
				  h = glass.offsetHeight / 2;
				  /*execute a function when someone moves the magnifier glass over the image:*/
				  glass.addEventListener("mousemove", moveMagnifier);
				  img.addEventListener("mousemove", moveMagnifier);
				  /*and also for touch screens:*/
				  glass.addEventListener("touchmove", moveMagnifier);
				  img.addEventListener("touchmove", moveMagnifier);

				  function moveMagnifier(e) {
				    var pos, x, y;
				    /*prevent any other actions that may occur when moving over the image*/
				    e.preventDefault();
				    /*get the cursor's x and y positions:*/
				    pos = getCursorPos(e);
				    x = pos.x;
				    y = pos.y;
				    /*prevent the magnifier glass from being positioned outside the image:*/
				    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
				    if (x < w / zoom) {x = w / zoom;}
				    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
				    if (y < h / zoom) {y = h / zoom;}
				    /*set the position of the magnifier glass:*/
				    glass.style.left = (x - w) + "px";
				    glass.style.top = (y - h) + "px";
				    /*display what the magnifier glass "sees":*/
				    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
				  }

				  function getCursorPos(e) {
				    var a, x = 0, y = 0;
				    e = e || window.event;
				    /*get the x and y positions of the image:*/
				    a = img.getBoundingClientRect();
				    /*calculate the cursor's x and y coordinates, relative to the image:*/
				    x = e.pageX - a.left;
				    y = e.pageY - a.top;
				    /*consider any page scrolling:*/
				    x = x - window.pageXOffset;
				    y = y - window.pageYOffset;
				    return {x : x, y : y};
				  }
				}

				function remove() {
				  var element = document.getElementById("magnifier1")
 				  element.parentNode.removeChild(element);
				  }
		  
		</script>

       
      
    </head>
    <body background="images/bg2.jpg">
        <div>
            <?php
               require 'header.php';
            ?>
            <div class="container">
                <div class="jumbotron">
                    <h1>Welcome to our Sarees Store!</h1>
                    <p>We have the best cameras, watches and shirts for you. No need to hunt around, we have all in one place.</p>
                </div>
            </div>



            <div class="container">


                	<?php

						define('IMAGEPATH', 'img/');
						$directoryfiles = array();

						if (is_dir(IMAGEPATH)){
						    $handle = opendir(IMAGEPATH);
						    

/*						    while(false!== ($file = readdir($handle)))
						    {
						    	$crap   = array(".jpg", ".jpeg", ".JPG", ".JPEG", ".png", ".PNG", ".gif", ".GIF", ".bmp", ".BMP", "_", "-");    

						        $newstring = str_replace($crap, " ", $file );   

						        //asort($file, SORT_NUMERIC); - doesnt work :(

						        // hides folders, writes out ul of images and thumbnails from two folders

						        if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails") {
						            $directoryfiles[] = $file;
						    	}
							}
*/

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

                            <a href="product_display.php?img=<?php echo IMAGEPATH.$directoryfile; ?> &id=<?php echo $id[0]; ?>" target="_blank" >
                                        
                                              
                                <img id=<?php echo "myimage".$ctr ?> src="<?php echo IMAGEPATH.$directoryfile ?>" alt="<?php echo IMAGEPATH.$directoryfile ?>" style="height: 200px; width: 100%" >
                                                     
                            </a>
                            
                            
                        
                            <center>
                                <div class="caption">
                                    <h4> <?php echo $price['name'] ?> 	</h4>
                                    <p> <?php echo "Rs.". $price['price'] ?> <br> <div style="display: inline-block;"> <b> Quantity :   </b> <?php echo '<input id="qty" style="height:20px; width:40px; size="10" type="number" id="qty" value="1">'?>&nbsp;&nbsp; <b><a href="product_display.php?img=<?php echo IMAGEPATH.$directoryfile; ?> &id=<?php echo $id[0]; ?>" target="_blank">View Details</a></b> </div></p>
                                    <?php if(!isset($_SESSION['email'])){  ?>
                                        <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                        <?php
                                        }
                                        else
                                        {   
                                            if(check_if_added_to_cart($id[0]))
                                            {
                                               echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                                            }
                                            else
                                            {
                                            	
                                                ?>

                                                <a href="cart_add.php?id=<?php echo $id[0]; ?> &qty=javascript:document.getElementById('qty').value; &cost_per_pc=<?php echo $price['price']; ?> &item_name=<?php echo $details[0]; ?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                <?php
                                            }
                                        }
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