<script src="./angular/1.2.0angular.min.js"></script>
<script>
	var app = angular.module('MyApp', []);
	app.controller('Form_CNT', function($rootScope,$scope, $http,$filter)
	{
		$rootScope.Profile=[];
		$rootScope.Profile=JSON.parse(sessionStorage.getItem("Data"));
		$rootScope.Uname=$rootScope.Profile[0].Uname;
		$rootScope.Phone=$rootScope.Profile[0].Phone;
		$rootScope.EmailID=$rootScope.Profile[0].EmailID;
		$rootScope.Address=$rootScope.Profile[0].Address;
		$rootScope.City=$rootScope.Profile[0].City;
		$rootScope.State=$rootScope.Profile[0].State;
		$rootScope.Pincode=$rootScope.Profile[0].Pincode;
		
		
		
		
		
	});
</script>



<?php


	include("UILibrary.php");
	include("DBLib.php");
	Start_1();
	Head_2();
	BodyStart_3();
	SetPreloader_4();
	BodyContentStart_5();
	Heading_6();
	SideBarMenu_7();
	BodyContainerStart_8();
	BodyHeader_9("Profile");
	
?>

<body ng-app="MyApp">	
	<!-- Main content -->
		<section class="content">
		   <div class="row" ng-controller="Form_CNT">
			  <div class="col-sm-12 col-md-4" style="width:100%;margin:auto;">
				 <div class="card">
					<div class="card-header">
					   <div class="card-header-headshot"></div>
					</div>
				   
					   
					   <div class="card-content-languages">
						  <div class="card-content-languages-group">
							 <div>
								<h4>Name:</h4>
							 </div>
							 <div>
								<ul>
								   <li>
										{{Uname}}
									  <div class="fluency fluency-4"></div>
								   </li>
								</ul>
							 </div>
						  </div>
						  
						  <div class="card-content-languages-group">
							 <span>
								<h4>Phone number:</h4>
							 </span>
							 <div>
								<ul>
								   <li>{{Phone}}</li>
								</ul>
							 </div>
						  </div>
						  
						  <div class="card-content-languages-group">
							 <span>
								<h4>Email Id:</h4>
							 </span>
							 <div>
								<ul>
								   <li>{{EmailID}}</li>
								</ul>
							 </div>
						  </div>
						  
						  <div class="card-content-languages-group">
							 <span>
								<h4>Address:</h4>
							 </span>
							 <div>
								<ul>
								   <li>{{Address}}</li>
								</ul>
							 </div>
						  </div>
						  
						  <div class="card-content-languages-group">
							 <span>
								<h4>City:</h4>
							 </span>
							 <div>
								<ul>
								   <li>{{City}}</li>
								</ul>
							 </div>
						  </div>
						  
						  <div class="card-content-languages-group">
							 <span>
								<h4>State:</h4>
							 </span>
							 <div>
								<ul>
								   <li>{{State}}</li>
								</ul>
							 </div>
						  </div>
						  
						  <div class="card-content-languages-group">
							 <span>
								<h4>Pincode:</h4>
							 </span>
							 <div>
								<ul>
								   <li>{{Pincode}}</li>
								</ul>
							 </div>
							 <div style="width:1000px;">
							 <div style="float: right; width: 125px"> 
								<form action="dbOperationModule.php" method="get">
									<input class="btn btn-warning" type="submit" value="delete profile"  name="deleteAccount">
								</form>
							</div>
							<div style="float:right; width: 130px"> 
								<form  action="updateProfile.php" method="get">
									<input class="btn btn-warning" type="submit" value="update profile" name="updateProfile">
								</form>
							</div>
							
						</div>
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