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
                        <a data-toggle="modal" data-target="#registration">Register</a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#faqs">FAQs <span class="badge">11</span></a><br>
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
    <section id="devs" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>The Developers</h2>
                <p>Antonio Sotto Jr.<br>Systems Programmer, Design Specialist</a></p>
                <p>Syd Kryz Shyr Bardoquillo<br>Systems Programmer, Testing and Documentation</a></p>
            </div>
        </div>
    </section>



    <!-- Registration Modal -->
      <div class="modal fade" id="registration" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content: Registration Form-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Register You Junkshop</h4>
            </div>
            <div class="modal-body">
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
                    <input type="text" class="form-control" id="js_contacts" placeholder="Contact number(s)">
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
                   <div class="form-group col-sm-offset-2"> 
                           <div class="checkbox">
                        <label><input type="checkbox"> By check this box, I agree with the terms and conditions</label>
                      </div>
                  </div>
                 
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="modalbtn modalbtn-default" data-dismiss="modal">Submit</button>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>



    <!-- FAQS-->
      <div class="modal fade" id="faqs" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content: FAQS-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Register You Junkshop</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-success">  <!-- faq1 -->
      
                  <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq1">
                      Q1: What is Golden Garbage?
                    </a>
                  </h4>
                  </div>
                 <!-- answer -->
                <div id="faq1" class="panel-collapse collapse">
                  <div class="panel-body">
                    Golden Garbage allows you to view nearby junkshops around you.
                    It also allows you to view the prices of the junks the 
                    specific junkshops accept.
                  </div>
                </div>

                <div class="panel panel-success">  <!-- faq1 -->
      
                  <div class="panel-heading"> 
                  <h4 class="panel-title"> <!-- title 2 -->
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq1">
                      Q1: What is Golden Garbage?
                    </a>
                  </h4>
                  </div>
                 <!-- answer -->
                <div id="faq1" class="panel-collapse collapse">
                  <div class="panel-body">
                    Golden Garbage allows you to view nearby junkshops around you.
                    It also allows you to view the prices of the junks the 
                    specific junkshops accept.
                  </div>
                </div>

                





            </div>
            <div class="modal-footer">
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
