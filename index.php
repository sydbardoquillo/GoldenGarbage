<!DOCTYPE html>
<html lang="en">
<?php
$gguFilename="files/GGU.apk";
$ggoFilename="files/GGO.apk";
if(isset($_GET['dl'])){
        if($_GET['dl']=='ggu'){ 
            if (file_exists($gguFilename)){
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header('Content-Type: application/vnd.android.package-archive');
                header("Content-Transfer-Encoding: binary");    
                header('Content-Disposition: attachment; filename="GGU.apk"');//file as it appears upon download
                ob_clean(); //clean header
                flush(); //flush header
                readfile('files/GGU.apk');//the file to read with the location
                exit();
            }
            else{
                echo "<p style=\"background-color:red; color:white;\">The file requested GGU.apk does not exist. Please contact developers.</p>";
            }
        }
        elseif($_GET['dl']=='ggo'){
            if(file_exists($ggoFilename)){
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header('Content-Type: application/vnd.android.package-archive');
                header("Content-Transfer-Encoding: binary");    
                header('Content-Disposition: attachment; filename="GGO.apk"');
                ob_clean(); //clean header
                flush(); //flush header
                readfile('files/GGO.apk');
                exit();
            }
            else{
                echo "<p style=\"background-color:red; color:white;\">The file requested GGO.apk does not exist. Please contact developers.</p>";
            }
        }
        

   

}?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/goldengarbage.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/grayscale.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="img/icon.png">
    
    <title>Golden Garbage</title>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <span style="color:#e3c432;">Golden</span><span style="color:#7ab800;"> Garbage</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#download">Download</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#devs">Devs</a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#RegisterModal">Reg</a>                        
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#faqsModal">FAQs<span class="badge" >11</span></a>                        
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading"><img class="img-responsive" src="img/gg_v2.png"></h1>
                        <p class="intro-text">Turn your garbage to gold!</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About Golden Garbage</h2>
                <p> <span style="color:#e3c432;">Golden</span><span style="color:#7ab800;"> Garbage</span> is a map enabled application that allows the users to locate nearby junkshops. It also teaches them how to do basic waste segregation.
                <br>Golden Garbage comes in two versions: the  Golden Garbage for regular users and the  Golden Garbage for Junkshop owners.
                <br><span style="color:#e3c432;">Golden</span><span style="color:#7ab800;"> Garbage</span> for regular users can Locate Nearby Junkshops, View Junkshop Info and items with their prices, and also Rate and Review the service of a junkshop.
                <br><span style="color:#e3c432;">Golden</span><span style="color:#7ab800;"> Garbage</span> for Junkshop Owner also have the same functionalities except the Rate and Review. It is customized to allow the junkshop owners edit their information.</p>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Download Golden Garbage</h2>
                    <!--<a href="http://localhost/goldengarbage.com?dl=ggu" class="btn btn-default btn-lg"><img src="img/icon.png" style="max-height:100px;"><br>GG for Users<br> &nbsp;</a>
                    <a href="http://localhost/goldengarbage.com?dl=ggo" class="btn btn-default btn-lg"><img src="img/ggo.png" style="max-height:100px;"><br>GG for <br>Junkshop Owners</a>-->
                    <a href="files/GGU.apk" class="btn btn-default btn-lg"  download><img src="img/icon.png" style="max-height:100px;"><br>GG for Users<br> &nbsp;</a>
                    <a href="files/GGO.apk" class="btn btn-default btn-lg" download><img src="img/ggo.png" style="max-height:100px;"><br>GG for <br>Junkshop Owners</a>
                </div>
            </div>
        </div>
    </section>

  

    <!-- Contact Section -->
    <section id="devs" class="container content-section text-center" style=" padding-bottom: 74px;">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>The Developers</h2>
                <p>Antonio Sotto Jr.<br>Systems Programmer, Design Specialist</a></p>
                <p>Syd Kryz Shyr Bardoquillo<br>Systems Programmer, Testing and Documentation</a></p>
            </div>
        </div>
    </section>

    <!-- Modal -->
      <div class="modal fade" id="RegisterModal" role="dialog" >
        <div class="modal-dialog">
        
          <!-- RegisterModal content-->
          <div class="modal-content" style="color:white;">
            <div class="modal-header" style="background-color:#649502;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Register your junkshop!</h4>
            </div>
            <div class="modal-body" style="background-color:#7ab800;">
              <form role="form">
                  <div class="form-group">
                    <label for="js_owner">Junkshop Owner:</label>
                    <input type="text" class="form-control" id="js_owner" placeholder="Enter junkshop owner">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="text" class="form-control" id="js_email" placeholder="Enter e-mail address">
                  </div>
                  <div class="form-group">
                    <label for="js_contact">Contact(s):</label>
                    <input type="number" class="form-control" id="js_contacts" placeholder="Contact number(s)">
                  </div>
                  <div class="form-group">
                    <label for="js_name">Junkshop Name:</label>
                    <input type="text" class="form-control" id="js_name" placeholder="Enter junkshop name">
                  </div>
                  <div class="form-group">
                    <label for="js_address">Junkshop address:</label>
                    <input type="text" class="form-control" id="js_address" placeholder="Enter junkshop address">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="confirmpwd">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmpwd" placeholder="Confirm">
                  </div>
                  
                  <div class="checkbox">
                    <label><input type="checkbox"> By checking this box, you accept the terms and conditions</label>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <a data-toggle="modal" data-target="#loginModal" class="b" style="padding-right: 403px;" data-dismiss="modal">Admin Log-in</a>
              <button type="button" class="modalbtn modalbtn-default" data-dismiss="modal">Submit</button>
            </div>
          </div>
          
        </div>
      </div>

      






     <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; QuadCore&trade;, a Team Spectrum subsidiary<br>Cebu Institute of Technology - University<br>2015</p>
        </div>
    </footer>

    <!--Login Modal -->
      <div class="modal fade" id="loginModal" role="dialog" >
        <div class="modal-dialog">
        
          <!-- RegisterModal content-->
          <div class="modal-content" style="color:white;">
            <div class="modal-header" style="background-color:#649502;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Register your junkshop!</h4>
            </div>
            <div class="modal-body" style="background-color:#7ab800;">
              <form role="form">
                  <div class="form-group">
                    <label for="admin">Admin:</label>
                    <input type="text" class="form-control" id="admin" placeholder="Enter admin username">
                  </div>
                                   
                  <div class="form-group">
                    <label for="admin_pwd">Password:</label>
                    <input type="password" class="form-control" id="admin_pwd" placeholder="Enter Password">
                  </div>
                  
                  
                  <div class="checkbox">
                    <label><input type="checkbox"> Remember Me</label>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="modalbtn modalbtn-default"><a href="/goldengarbage.com/adminpage.php">Log-in</a></button>
            </div>
          </div>
          
        </div>
      </div>



    <!-- faqs Modal -->
      <div class="modal fade" id="faqsModal" role="dialog" >
        <div class="modal-dialog">
        
          <!-- RegisterModal content-->
          <div class="modal-content" style="color:white;">
            <div class="modal-header" style="background-color:#649502;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><span style="color:#e3c432;">Golden</span><span style="color:#7ab800;"> Garbage</span><span style="color:white;"> FAQs</span></h4>
            </div>
            <div class="modal-body" style="background-color:#7ab800;">
              
              <div class="panel panel-success">  <!-- faq1 -->
                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 1 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq1">
                      Q1: What is Golden Garbage?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq1" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    Golden Garbage allows you to view nearby junkshops around you.
                    It also allows you to view the prices of the junks the 
                    specific junkshops accept.
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq2">
                      Q2:That's great! But how does it work?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq2" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    Golden Garbage has embedded Google Maps for 
                    you to view nearby junkshops registered to Golden 
                    Garbage Community. The app will automatically detect your current 
                    location and provide you the path to the junkshop nearest to you.
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq3">
                       Q3: Do I need to have my own account for this app?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq3" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    No need. But there are features that won't be 
                    available if you don't create an account for your 
                    Golden Garbage.
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq4">
                      Q4: What benefits do I get when I create my own account?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq4" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    You will be able to use the following features of the app:
                    Search - you will be able to directly search for a junk item and see the junkshops that accepts the searched item with the corresponding prices.
                    Rate and Review - you will be able to review the service of a junkshop, just like in the Google Play rate and review.
                    Auction - you will be able to make an auction with your junk items.
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq5">
                      Q5: Auction sounds interesting! How does it work?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq5" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    Auction is simply posting any of your junk items under your name.
                     Interested junkshops will place their bid and it is up to you to select which bidder you wish to close the deal with 
                    (or simply, select the junkshop you wish to sell your item).
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq6">
                     Q6: How can I auction my item?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq6" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    A floating mallet appears at the bottom right corner once you enter 
                    the map interface of the application. 
                    Simply click the icon, and a form will appear. 
                    Just fill-up the form and click Auction.
    
                    <p>Please take into consideration that you should
                    auction junk items in large quantities. Do make a reasonable 
                    auction in order draw the owners to make a bid for your items.</p>
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq7">
                      Q7: Do I have to pay to auction?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq7" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    Absolutely not. Any registered user can be able to make 
                    an auction anytime for free as the floating 
                    mallet is always avilable once you, user get to the map interface.
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq8">
                      Q8: Can I know who bid for my items?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq8" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    Yes, as a matter of fact, junkshop owners who place a bid 
                    for your auction will be listed below the from. 
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq9">
                      Q9: How to make sure that the bidder is an authentic junkshop?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq9" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    All junkshop owners listed that are seen in the map are 
                    required to register for the Golden Garbage community. Prior to be officially
                    part of the community, the registering junkshoop are
                    given authentication code to give assurance of the authenticity of the junkshop.
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq10">
                      Q10: What happens if an item doesn't sell?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq10" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    To be able to make a succesful deal to to bidders, you, 
                    user should make a reasonable price for your item. 
                    You might also consider lowering your price to give interest to the junkshop owners.
                    However, in any case you waren't able find bidders for your items, you be notified 
                    that your post will be removed and so you can somehow make another item to auction. 
                  </div>
                </div>

                <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq11">
                      Q11: What conditions should my items be in?
                    </a>
                  </h4>
                  </div>

                 <!-- answer -->
                <div id="faq11" class="panel-collapse collapse">
                  <div class="panel-body" style="color:black;">
                    It is necessary that items are in really good, and presentable condition for this can add 
                    up a higher possiblities that more junkshop are going to place a bid for your item.
                  </div>
                </div>

              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="modalbtn modalbtn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
  
    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>



</body>

</html>