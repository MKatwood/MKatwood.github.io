

<!-- Wrap -->

  <!-- Top Bar -->
  <div class="top-bar tri-white-bottom">
    <div class="container"> 
     
      <!-- Pull Left --> 
      <span class="numb">Call 954-761-7652 or <a href="https://ordering.chownow.com/order/5203/locations?add_cn_ordering_class=true" target="_blank" style="color: #fff;">Click to Order</a></span> 
      <!-- Social Icons -->
      <div class="social">
				<a href="https://www.facebook.com/DOUGHBOYSftl"><i class="fa fa-facebook"></i></a>
				<a href="https://twitter.com/DoughboysFtl"><i class="fa fa-twitter"></i></a>
				<a href="https://www.pinterest.com/doughboysftlaud/"><i class="fa fa-pinterest"></i></a>
				<a href="http://www.linkedin.com/in/randygreenfi"><i class="fa fa-linkedin-square"></i></a>
			</div>
			<?php
			$abierto = "";
			switch (date("w")){
				case "1":
					$abierto = "Open Today 10:30 AM - 10:30 PM";
					break;
				case "2":
					$abierto = "Open Today 10:30 AM - 10:30 PM";
					break;
				case "3":
					$abierto = "Open Today 10:30 AM - 10:30 PM";
					break;
				case "4":
					$abierto = "Open Today 10:30 AM - 10:30 PM";
					break;
				case "5":
					$abierto = "Open Today 10:30 AM - 11:00 PM (temporarily)";
					break;
				case "6":
					$abierto = "Open Today 10:30 AM - 11:00 PM (temporarily)";
					break;
				case "7":
					$abierto = "Open Today 10:30 AM - 10:30 PM";
					break;
			}
			?>
      <span class="time-ta"><?php echo $abierto; ?></span> 
      
			<div class="pull-right">
				<span class="numb" style="border-right: none;"><a href="menu-Lunch-Specials_10" style="color: #fff;">Lunch Specials</a></span>
			</div>
			<?php if (false) { ?>
      <!-- Pull Right -->
      <div class="pull-right">
        <ul class="login-info">
          <li>
            <select class="selectpicker">
              <option>EN</option>
              <option>FR</option>
              <option>AR</option>
            </select>
          </li>
          <li> <a href="#.">Login</a> </li>
          <li> <a href="#.">Register</a> </li>
        </ul>
      </div>
			<?php } ?>
    </div>
  </div>