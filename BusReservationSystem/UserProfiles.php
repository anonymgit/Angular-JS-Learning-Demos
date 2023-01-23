
<script src="./angular/1.2.0angular.min.js"></script>
<script>

	var app = angular.module('MyApp', []);
	app.controller('Table', function($rootScope,$scope, $http,$filter)
	{
		
		var request = $http({
			method: "get",
			url: "RetrieveAllData.php",
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});
		request.success(function (data) 
		{
				//alert(JSON.stringify(data.UserData));
				$rootScope.data=data.UserData;
				
			
		});
		request.error(function (data) 
		{
			alert("Error Notification");
		});
	
		
		$rootScope.CloseModel=function()
		{
			
			$("#MyModel").show('hide');
		}
		
	
	
		
	});
	
	
	app.controller('Form_CNT', function($rootScope,$scope, $http,$filter)
	{
		
		$rootScope.States=[{"SID":1,"SNAME":"Andhra Pradesh"},{"SID":2,"SNAME":"Andaman and Nicobar Islands"},{"SID":3,"SNAME":"Arunachal Pradesh"},{"SID":4,"SNAME":"Assam"},{"SID":5,"SNAME":"Bihar"},{"SID":6,"SNAME":"Chandigarh"},{"SID":7,"SNAME":"Chhattisgarh"},{"SID":8,"SNAME":"Dadar and Nagar Haveli"},{"SID":9,"SNAME":"Daman and Diu"},{"SID":10,"SNAME":"Delhi"},{"SID":11,"SNAME":"Lakshadweep"},{"SID":12,"SNAME":"Puducherry"},{"SID":13,"SNAME":"Goa"},{"SID":14,"SNAME":"Gujarat"},{"SID":15,"SNAME":"Haryana"},{"SID":16,"SNAME":"Himachal Pradesh"},{"SID":17,"SNAME":"Jammu and Kashmir"},{"SID":18,"SNAME":"Jharkhand"},{"SID":19,"SNAME":"Karnataka"},{"SID":20,"SNAME":"Kerala"},{"SID":21,"SNAME":"Madhya Pradesh"},{"SID":22,"SNAME":"Maharashtra"},{"SID":23,"SNAME":"Manipur"},{"SID":24,"SNAME":"Meghalaya"},{"SID":25,"SNAME":"Mizoram"},{"SID":26,"SNAME":"Nagaland"},{"SID":27,"SNAME":"Odisha"},{"SID":28,"SNAME":"Punjab"},{"SID":29,"SNAME":"Rajasthan"},{"SID":30,"SNAME":"Sikkim"},{"SID":31,"SNAME":"Tamil Nadu"},{"SID":32,"SNAME":"Telangana"},{"SID":33,"SNAME":"Tripura"},{"SID":34,"SNAME":"Uttar Pradesh"},{"SID":35,"SNAME":"Uttarakhand"},{"SID":36,"SNAME":"West Bengal"}];
		$scope.Form1=[];		
		$rootScope.edit=function(x)
		{
			alert(JSON.stringify(x));
			$rootScope.UserID=x.UserID;
			
			$scope.Form1=x;
			$("#MyModel").modal({escapeClose: false,clickClose: false, showClose: false});
		}
		$rootScope.delete=function(UserID)
		{
			
			
			var request = $http({
						method: "post",
						url: "delete.php",
						data: {"UserID":UserID},
						headers: { 'Content-Type': 'application/x-www-form-urlencoded'		 }
					});
					request.success(function (data) 
					{
						
						//alert(JSON.stringify(data.message));
						failureData=[];
						failureData.push("UNSUCCESS");
						
						SuccessData=[];
						SuccessData.push("SUCCESS");
						
						
						if(data.message==SuccessData)
						{
							location.replace("./UserProfiles.php");
						}
						else if(data.message==failureData) 
						{
							alert(data.message);
						}
						else
						{
							alert("error");
						}
						
		
					});
					request.error(function (data) 
					{
						
						alert("ERROR");
						
					});
				
					
		}
			
		$rootScope.getStateName=function(id)
		{
			
			if(angular.isDefined(id))
			{
				var st=$filter('filter')($rootScope.States,{"SID":id},true);
				return(st[0].SNAME);
				
			}
			else
				return("NONE");
		}
		$rootScope.Update=function()
		{
			
			SID=$scope.Form1.SID;
			StateName=$rootScope.getStateName(SID);
			var request = $http({
						method: "post",
						url: "Update.php",
						data: {"Uname" : $scope.Form1.Uname,"Fname" : $scope.Form1.Fname,"Lname":$scope.Form1.Lname,"EmailID":$scope.Form1.EmailID,"Phone": $scope.Form1.Phone,"Address":$scope.Form1.Address,"City":$scope.Form1.City,"Pincode":$scope.Form1.Pincode,"State":StateName,"UserID":$rootScope.UserID},
						
						headers: { 'Content-Type': 'application/x-www-form-urlencoded'		 }
					});
					request.success(function (data) 
					{
						
						//alert(JSON.stringify(data.message));
						failureData=[];
						failureData.push("UNSUCCESS");
						
						SuccessData=[];
						SuccessData.push("SUCCESS");
						
						
						if(data.message==SuccessData)
						{
							location.replace("./UserProfiles.php");
						}
						else if(data.message==failureData) 
						{
							alert(data.message);
						}
						else
						{
							alert("error");
						}
						
		
					});
					request.error(function (data) 
					{
						
						alert("ERROR");
						
					});
				
					
			}
				
			
		
				

		
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
	BodyHeader_9("All Users");
	
?>
<body ng-app="MyApp"> 
	 <div class="table-responsive" ng-controller="Table">
		  <table id="dataTableExample1" class="table table-bordered table-striped table-hover" >
			 <thead>
				<tr class="info">
				   <th>UserID</th>
				   <th>Email ID</th>
				   <th>Fname</th>
				   <th>Lname</th>
				   <th>Phone</th>
				   <th>City</th>
				   <th>state</th>
				   <th>status</th>
				   <th>Action</th>
				</tr>
			 </thead>
			 <tbody>
				<tr ng-repeat="x in data | filter: textSearch">
				   <td>{{x.UserID}}</td>    
				   <td>{{x.EmailID}}</td>
				   <td>{{x.Fname}}</td>
				   <td>{{x.Lname}}</td>
				   <td>{{x.Phone}}</td>
					<td>{{x.City}}</td>
				   <td>{{x.State}}</td>
				   <td><span class="label-custom label label-default" >{{x.Status}}</span>
				   </td>
				    <td>	
						<a class="btn btn-add btn-sm" ng-click="edit(x)">edit</a>
					<!--	<a class="btn btn-danger btn-sm" href="dbOperationModule.php">delete</a>  -->
						<a class="btn btn-danger btn-sm" ng-click="delete(x.UserID)">delete</a>
						
                    </td>
				</tr>
			 </tbody>
		  </table>
	   </div>
	  
	   
	   <div ng-controller="Form_CNT" class="modal fade modal-warning in" id="MyModel" tabindex="-1" role="dialog" style="display: none; padding-right: 6px;">
			<div class="modal-dialog" role="document">
			   <div class="modal-content">
				  <div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times;</span></button>
					 <h1 class="modal-title">Edit User Details</h1>
				  </div>
				  <div class="modal-body" >
					 <form   ng-model="Form1"  novalidate>
										
						<div class="row">
							<div class="form-group col-lg-6">
								<label>Username</label>
								<input type="text"   class="form-control"  ng-model="Form1.Uname">
								<span class="help-block small">Your unique username to app </span>						</div>
							<div class="form-group col-lg-6">
								<label>First name</label>
								<input type="text"  class="form-control"  ng-model="Form1.Fname">
								<span class="help-block small">Your first name</span>									</div>
							<div class="form-group col-lg-6">
								<label>Last name</label>
								<input type="text"   class="form-control" ng-model="Form1.Lname">
								<span class="help-block small">Your last name</span>									</div>
							
							<div class="form-group col-lg-6">
								<label>Email Address</label>
								<input type="email"   class="form-control" ng-model="Form1.EmailID">
								<span class="help-block small">Your address email to contact</span>						</div>
							<div class="form-group col-lg-6">
								<label>Phone Number</label>
								<input type="text"  class="form-control" ng-model="Form1.Phone">
								<span class="help-block small">Your address Phone number to contact</span>				</div>
							<div class="form-group col-lg-6">
								<label>Address</label>
								<input type="text"   class="form-control" ng-model="Form1.Address">
								<span class="help-block small">Your address to contact</span>							</div>
							<div class="form-group col-lg-6">
								<label>City</label>
								<input type="text"   class="form-control" ng-model="Form1.City">
								<span class="help-block small">Your city</span>											</div>
							<div class="form-group col-lg-6">
								<label>Pin code</label>
								<input type="text"  class="form-control"  ng-model="Form1.Pincode" >
								<span class="help-block small">Your zipcode(pin code)</span>							</div>
							<div class="form-group col-lg-6">
								<label>state</label>
								<select ng-options="x.SID as x.SNAME for x in States" ng-model="Form1.SID" class="form-control">
										<option value="#" ></option>
								</select>
							   <!--<input type="text" value="" id="state" class="form-control" name="state"> -->
								<span class="help-block small">choose your state</span> 								</div>     
						</div>
						
						<div>
							<input class="btn btn-warning" type="submit" value="update" ng-click="Update()">
							
							<input class="btn btn-danger btn-sm" type="submit" value="delete" name="delete">
							<!--
							<button class="btn btn-warning">Register</button>
							<a class="btn btn-add" href="login.html">Login</a>
							-->
						</div>
					</form>
				  </div>
				  <div class="modal-footer">
					 <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="CloseModel()">Close</button>
					 <button type="button" class="btn btn-warning">Save changes</button>
				  </div>
			   </div>
			   <!-- /.modal-content -->
			</div>
                        <!-- /.modal-dialog -->
		</div>
</body>
<?php
//	BodyContent_10();
	BodyContainerEnd_11();
	SetFooter_12();
	BodyEnd_13();
	End_14();
?>