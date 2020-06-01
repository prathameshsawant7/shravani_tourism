<div class="hr hr-bg"></div>
 <div class="container-fluid" style="background-color:#f0f0f0;">

    <button onclick="topFunction()" id="to-top" title="Go to top">Top</button>

    <div class="row  row-no-gutters">
      <div class="col-xs-12 col-sm-6 col-md-3" >
        <ul>
          <li class="col-heading">Reach Us</li>
          <li>
            <i class="fa fa-phone" aria-hidden="true"></i><a href="tel:99-999-999-9999" class="foo"><?php echo $site_cms['site_phone'];?></a>
          </li>
          <li>
             <i class="fa fa-envelope-square" aria-hidden="true"></i><a href="mailto:<?php echo $site_cms['site_email'];?>" class="foo"><?php echo $site_cms['site_email'];?></a>  
          </li> 
        </ul>
      </div>     

      <div class="col-xs-12 col-sm-6 col-md-3" >
        <ul>
          <li class="col-heading">shravani tours</li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=East%20Zone&region=3" class="foo">East Zone</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=West%20Zone&region=1" class="foo">West Zone</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=North%20Zone&region=4" class="foo">North Zone</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=South%20Zone&region=2" class="foo">South Zone</a></li>
        </ul>
      </div>      

      <div class="col-xs-12 col-sm-6 col-md-3" >
        <ul>
          <li class="col-heading">Tours</li>
          <li><a href="#" class="foo">Home</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=Maharashtra%20Tours&category=Maharashtra%20Tours&subcategory=Daily%20Tour" class="foo">Maharashtra Tours</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=India-Tours&category=India-Tours" class="foo">India Tours</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=Family-Holiday-Tours&category=Family-Holiday-Tours" class="foo">Family Holiday Tours</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=Honeymoon-Tours&category=Honeymoon-Tours" class="foo">Honeymoon Tours</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=Speciality-Tours&category=Speciality-Tours" class="foo">Speciality Tours</a></li>
          <li><a href="<?php echo LIVEROOT;?>packages.php?q=International-Tours&category=International-Tours" class="foo">International Holidays</a></li>
        </ul>
      </div>
      
      <!-- <div class="col-xs-12 col-sm-6 col-md-3" >
        <ul>
          <li class="col-heading">Service Links</li>
          <li><a href="#" class="foo">About Us</a></li>
          <li><a href="#" class="foo">Contact Us</a></li>
          <li><a href="#" class="foo">Privacy Policy</a></li>
          <li><a href="#" class="foo">Terms & Conditions</a></li>
          <li><a href="#" class="foo"	>FAQs</a></li>
        </ul>
      </div> -->
    </div> <!--  end row  -->
    
    <div class="row row-no-gutters" id="bottom-footer" >
      
     
      <div class="col-xs-12  col-sm-12 col-md-12 col-lg-12 text-center" >
        <ul>
          <li class="small">© Copyright  Website by Shravani Tourism. All Rights reserved.</li>
        </ul>
      </div>
    </div> <!--  end row  -->

  </div> <!--  end container-fluid  -->
  <script>
// Script from W3 Schools  
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("to-top").style.display = "block";
  } else {
    document.getElementById("to-top").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<!-- <script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script> -->