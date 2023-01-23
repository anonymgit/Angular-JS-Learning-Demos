



<?php
	include("UILibrary.php");
//	include("dbconnection.php");
	Start_1();
	Head_2();
	BodyStart_3();
	SetPreloader_4();
	BodyContentStart_5();
	Heading_6();
	SideBarMenu_7();
	BodyContainerStart_8();
	BodyHeader_9("My Dashboard"); 
?>
	<section class="content">
	   <div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="display:<?php $_SESSION['UserType']=='USER'? print('none') : print('');?>">
			 <div id="cardbox1">
				<div class="statistic-box">
				   <i class="fa fa-user-plus fa-3x"></i>
				   <div class="counter-number pull-right">
					  <span class="count-number">
							<!--data-->
					  </span> 
					  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
					  </span>
				   </div>
				   <h3> Total users</h3>
				</div>
			 </div>
		  </div>
		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="display:<?php $_SESSION['UserType']=='USER'? print('none') : print('');?>">
			 <div id="cardbox2">
				<div class="statistic-box">
				   <i class="fa fa-user-secret fa-3x"></i>
				   <div class="counter-number pull-right">
					  <span class="count-number">
					  	<!--data-->
					  </span> 
					  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
					  </span>
				   </div>
				   <h3>  Active Admin</h3>
				</div>
			 </div>
		  </div>
		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="display:<?php $_SESSION['UserType']=='USER'? print('none') : print('');?>">
			 <div id="cardbox3" >
				<div class="statistic-box">
				   <i class="fa fa-money fa-3x"></i>
				   <div class="counter-number pull-right">
					  <i class="ti ti-money"></i>
					  <span class="count-number">
					  	<!--data-->
						</span> 
					  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
					  </span>
				   </div>
				   <h3>  Total Expenses</h3>
				</div>
			 </div>
		  </div>
		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="display:<?php $_SESSION['UserType']=='USER'? print('none') : print('');?>">
			 <div id="cardbox4">
				<div class="statistic-box">
				   <i class="fa fa-files-o fa-3x"></i>
				   <div class="counter-number pull-right">
					  <span class="count-number">
					 <!--data-->
						</span> 
					  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
					  </span>
				   </div>
				   <h3> Total Buses</h3>
				</div>
			 </div>
		  </div>
		  
		   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="display:<?php $_SESSION['UserType']=='USER'? print('none') : print('');?>">
			 <div id="cardbox3">
				<div class="statistic-box">
				   <i class="fa fa-money fa-3x"></i>
				   <div class="counter-number pull-right">
					  <span class="count-number">
					  	<!--data-->
						</span> 
					  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
					  </span>
				   </div>
				   <h3>  Total Stations</h3>
				</div>
			 </div>
		  </div>
		   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" style="display:<?php $_SESSION['UserType']=='USER'? print('none') : print('');?>" >
			 <div id="cardbox3">
				<div class="statistic-box">
				   <i class="fa fa-money fa-3x"></i>
				   <div class="counter-number pull-right">
					  <span class="count-number">
					  	<!--data-->
						</span> 
					  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
					  </span>
				   </div>
				   <h3>  Total Routes</h3>
				</div>
			 </div>
		  </div>
	   </div>
	</section>

<?php
//	BodyContent_10();
	BodyContainerEnd_11();
	SetFooter_12();
	BodyEnd_13();
	End_14();
?>