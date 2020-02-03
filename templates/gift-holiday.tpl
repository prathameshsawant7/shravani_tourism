
<!DOCTYPE html>
<html>
<head>
  <title>Take a Break</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
  <link href="css/take-a-break.css" rel="stylesheet">
  <link href="css/log.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
  <div class="container-fluid padding-none">
    
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner carou-bor-radius">
          <div class="item active">
            <img src="images/gift.jpg" alt="...">
            
         </div>
    </div>

        <!-- Controls -->
        <!--<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>-->
  </div>
    <div class="container">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
        <p class="text-ab">Stuck for the last minute gift idea? Take a Break Gift Voucher is the perfect planned gift or a superb surprise to your loved ones for every occasion.
  Simply fill the below details and we shall contact you for further assistance.</p> 
      <form method="post" name="giftHolidayForm" id="giftHolidayForm">
      <input type="hidden" name="action" id="action" value="gift-holiday">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 gift-border">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="form-head-text">
            From
          </div>
           <div class="form-group fogp form-text-gp">
              <input type="text" class="form-control1" name="fromName" id="fromName" placeholder="Full Name">
          </div>
           <div class="form-group fogp form-text-gp">
              <input type="text" class="form-control1" name="fromEmail" id="fromEmail" placeholder="Email">
          </div>
           <div class="form-group fogp form-text-gp">
              <input type="number" class="form-control1" name="fromMobile" id="fromMobile" placeholder="Phone No. / Mobile No.">
          </div>
          <div class="form-group fogp form-text-gp">
              <input type="number" class="form-control1" name="fromAmount" id="fromAmount" placeholder="Amount">
          </div>
          <div class="form-group fogp form-text-gp">
              <textarea class="form-control text-area-bor" rows="3" name="fromAddress" id="fromAddress" placeholder="Address"></textarea>
              <span style="font-size:12px;">(Minimum Gift Amount Rs.5000/- only.)</span>

          </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="form-head-text">
          To
          </div>
          <div class="form-group fogp form-text-gp">
              <input type="text" class="form-control1" name="toName" id="toName" placeholder="Full Name">
          </div>
          <div class="form-group fogp form-text-gp">
              <input type="text" class="form-control1" name="toEmail" id="toEmail" placeholder="Email">
          </div>
           <div class="form-group fogp form-text-gp">
              <input type="number" class="form-control1" name="toMobile" id="toMobile" placeholder="Phone No. / Mobile No.">
          </div>
          <div class="form-group fogp form-text-gp">
              <textarea class="form-control text-area-bor" rows="3" name="toAddress" id="toAddress" placeholder="Address"></textarea>
          </div>
          <div class="form-group fogp form-text-gp">
            <span class="enquiry-popup-text" style="color: ##4F8A10;display: none;" id="error_msg"></span>
          </div>
          <div class="form-group fogp form-text-gp" align="center">
              <button type="button" class="btn btn-success log-in-but" onclick="submitHolidayForm()">SUBMIT</button>
          </div>
        </div>
      </div>
      </form>
    </div>
    </div>
    </body>
</html>
<script type="text/javascript" src="js/gift-holiday.js"></script>