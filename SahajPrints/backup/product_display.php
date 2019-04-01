<?php
    session_start();
    require 'connection.php';
    require 'check_if_added.php';
?>
<!DOCTYPE html>
<html>
    <head>
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

        <link rel="stylesheet" href="css/product_display_style.css" type="text/css">

        
         <style>


            .img-magnifier-container {
                      position:relative;
                    }

                    .magnifier
                    {
                      border: 4px solid #000;
                      position : absolute;
                      cursor: crosshair;
                      /*Set the size of the magnifier glass:*/
                      width: 250px;
                      height: 250px;
                    }

              div#image
              {
                height: 100%; 
                width: 50%;
                float: left;
              }

              div#product_details
              {
                height: 100%; 
                width: 50%;
                float: right;
              }

              hr { 
                    border-color: #000;
                    border-width: 1px;
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

        <?php
               require 'header.php';
               $item=$_GET['img'];
               $id=$_GET['id'];

               $info_query="select name, price, details, tagline, material from items where id='$id[0]'";
               $info_result=mysqli_query($con,$info_query) or die(mysqli_error($con));
               $rows_fetched=mysqli_num_rows($info_result);

               if($rows_fetched==0)
                {
                    $name="---";
                    $price = "---";
                    $details="----";
                    $tagline="---";
                    $material="---";
                }

                else
                {
                    $info=mysqli_fetch_array($info_result);   //results fetched array

                    $name = $info['name'];
                    $price = $info['price'];
                    $details = $info['details'];
                    $tagline = $info['tagline'];
                    $material = $info['material'];
                }
        ?>

     <div style="margin: 20px">
            
        <div id="image">
            <a href="#" onmouseenter="magnify(<?php echo "'img1'" ?>, 2)" onmouseleave="remove()" >
                      <img id="img1" src="<?php echo $item; ?>" style="height: 80%; width: 90%; border: 1px dashed" />   
            </a>               
        </div>


            <div id="product_details">

                <h1><?php echo $name; ?></h1>
                <p style="font-family: Book Antiqua"><i><?php echo $tagline; ?></i></p>
                <hr>
                
                  <div id="product-price" style="display: inline-block;">
                    <div style="font-
                    size: 20px"><b>Rs. <?php echo $price; ?> </b> <?php echo "per pc." ?>
                  </div></div>

                  <br>
                  <h5 style="font-size: 16px; font-weight: bold">Product Details</h5>
                   <div id="product-details">
                    <p><?php echo $details; ?></p>
                  </div>

                  <br>
                  <h5 style="font-size: 16px;font-weight: bold">Product Material</h5>
                   <div id="product-material">
                    <p><?php echo $material; ?></p>
                  </div>                   
                  
                  <br>

              <?php if(isset($_SESSION['email']))
                    {  
                      ?>       
                  <div style="display: inline-block;"> <b> Quantity :   </b> <?php echo '<input id="qty" style="height:20px; width:40px; size="10" type="number" id="qty" value="1">'?>
                      &nbsp;&nbsp;
                    <a href="cart_add.php?id=<?php echo $id[0]; ?> &qty=javascript:document.getElementById('qty').value; &cost_per_pc=<?php echo $price['price']; ?> &item_name=<?php echo $details[0]; ?>" name="add" value="add" ><button style="font-weight: bold; background-color: silver; color: black; size: 20px ">Add to cart</button></a>
                    
                  </div>

                  <?php 
                }

                else
                {   ?>
                  
                  <div style="display: inline-block;"> <b> Quantity :   </b> <?php echo '<input id="qty" style="height:20px; width:40px; size="10" type="number" id="qty" value="1">'?>
                      &nbsp;&nbsp;
                    <button onclick="document.getElementById('modal-wrapper').style.display='block'" style="font-weight: bold; background-color: silver; color: black; size: 20px ">Add to cart</button></a>
                    
                  </div>

                  <div id="modal-wrapper" class="modal">
  
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-3">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3>LOGIN</h3>
                                        </div>
                                        <div class="panel-body">
                                            <p>Login to make a purchase.</p>
                                            <form method="post" action="login_submit.php">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" pattern=".{6,}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="Login" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="panel-footer">Don't have an account yet? <a href="signup.php">Register</a></div>
                                    </div>
                                </div>
                            </div>
                       </div>
                        
                  </div>

                  <script>
                      // If user clicks anywhere outside of the modal, Modal will close

                      var modal = document.getElementById('modal-wrapper');
                      window.onclick = function(event) {
                          if (event.target == modal) {
                              modal.style.display = "none";
                          }
                      }
                  </script>

               <?php  }

                ?>
                

            </div>
            

            <br><br><br><br><br>

    </div>      
           <footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy Lifestyle Store. All Rights Reserved. | Contact Us: +91 9585586236</p>
                   <p>This website is developed by Shubham Agrawal</p>
               </center>
               </div>
           </footer>

    </body>
</html>