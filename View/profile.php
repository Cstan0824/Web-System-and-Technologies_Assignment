<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inner Page - Squadfree Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
    <link href="../Css/assets/css/profile-style.css" rel="stylesheet" />
  
</head>

<body>
    <?php 
    include('../Root/link.php');
    include('header.php');
    ?>


  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Profile</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Profile</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
        

      <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="profile-nav col-md-3">
                <div class="panel">
                    <div class="user-heading round">
                        <h1>Tan Choon Shen</h1>
                    </div>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="booking-history.php"> <i class="fa fa-calendar"></i> Booking History</a></li>
                        <li><a href="edit-profile.php"> <i class="fa fa-edit"></i> Edit Profile</a></li>
                    </ul>
                </div>
            </div>

            <div class="profile-info col-md-9">
                <div class="panel">
                    <div class="bio-graph-heading">
                        Welcome, Tan Choon Shen.
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1>Member Profile</h1>
                        <div class="row">
                            <div class="bio-row">
                                <p><span>Member ID </span>: Tan Choon Shen</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Name </span>: Australia</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Email</span>: example@mail.com</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Register Date </span>:  01/01/2024</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h4>Upcoming Events</h4>
                        
                    <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="bio-chart">
                                        <div style="display:inline;width:100px;height:100px;"><canvas width="100"
                                                height="100px"></canvas><input class="knob" data-width="100"
                                                data-height="100" data-displayprevious="true" data-thickness=".2"
                                                value="50" data-fgcolor="#cba4db" data-bgcolor="#e8e8e8"
                                                style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(203, 164, 219); padding: 0px; appearance: none; background: none;">
                                        </div>
                                    </div>
                                    <div class="bio-desk">
                                        <h4 class="purple">my AI Rakyat</h4>
                                        <p>Started : 15 July</p>
                                        <p>Deadline : 15 August</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


      
      </div>
    </section>

  </main><!-- End #main -->

 <?php include('footer.php'); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</body>

</html>