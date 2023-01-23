<script src="./angular/1.2.0angular.min.js"></script>
<script>

	var app = angular.module('MyApp', []);
	app.controller('Form1_CNT', function($rootScope,$scope, $http,$filter)
	{
		
		var request = $http({
			method: "get",
			url: "getRoutes.php",
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});
		request.success(function (data) 
		{
				////alert(JSON.stringify(data.Routes));
				$rootScope.Routes=data.Routes;
				
			
		});
		request.error(function (data) 
		{
			//alert("Error Notification");
		});
		$rootScope.StationList=[];
		
		$rootScope.ShowStations=function()
		{
			$rootScope.array=[];
			var request = $http({
				method: "post",
				data:{"RouteID":$scope.Form1.RouteID},
				url:"getStationListJSON.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			});
			request.success(function (data) 
			{
					
					//alert(JSON.stringify(data.StationList));
					$rootScope.StationList=data.StationList;
				
					for(var i=0;i<data.StationList.length;i++)
					{
						$rootScope.StationID=data.StationList[i].StationID;
						////alert($rootScope.StationID);
						$rootScope.Name=data.StationList[i].Name;
						////alert($rootScope.Name);
						d={"StationID":$rootScope.StationID,
							 "Name":$rootScope.Name,
							 "ArrivalTime":$scope.ArrivalTime,
							 "DepartureTime":$scope.DepartureTime
						  };
					$rootScope.array.push(d);
						
					}
					
					
					////alert(JSON.stringify($rootScope.array));
					
				
			});
			request.error(function (data) 
			{
				//alert("Error Notification");
			});
		}
		
		$rootScope.Save=function()
		{
			
			
			
			
			var request = $http({
				method: "post",
				data:{$rootScope.array,"RouteID":$scope.Form1.RouteID,"size":$rootScope.StationList.length,"BusName":$scope.Form1.BusName},
				url:"AddBusJSON.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			});
			request.success(function (data) 
			{
					
					////alert(JSON.stringify(data.StationList));
					$rootScope.StationList=data.StationList;
					CloseModel();
				
			});
			request.error(function (data) 
			{
				//alert("Error Notification");
			});
		}
		$rootScope.CloseModel=function()
		{
			
			$("#MyModel").show('hide');
		}
			
					
		
		
	
	});
	
	
	app.controller('Table2', function($rootScope,$scope, $http,$filter)
	{
		
		var request = $http({
			method: "get",
			url: "RouteDetailsJSON.php",
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});
		request.success(function (data) 
		{
				
			////alert(JSON.stringify(data.Bus));
			$rootScope.data=data.Bus;
				
			
		});
		request.error(function (data) 
		{
			//alert("Error Notification");
		});
		$rootScope.AddBus=function()
		{
			
			$("#MyModel").modal({escapeClose: false,clickClose: false, showClose: false});
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
	BodyHeader_9("Add Bus"); 
?>

 
<body ng-app="MyApp"> 
	<section class="content">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default panel-table">
					<div class="panel-heading">
						<div class="row">
							<div class="col col-xs-6">
								<h3 class="panel-title">Bus List</h3>
							</div>
							<div class="col col-xs-6 text-right">
								<div class="pull-right">
									<div class="btn-group" data-toggle="buttons">
			
										<input class="btn btn-success btn-filter active" type="submit" value="Add Bus" ng-click="AddBus()"> 
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="table-responsive" ng-controller="Table2" >
						<table id="dataTableExample1" class="table table-bordered table-striped table-hover" >
							<thead>
								<tr class="info">
									<th>Route name</th>
										<th>Bus name</th>
										<th>Bus ID</th>
			
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="x in data | filter: textSearch">
									<td>{{x.RouteName}}</td>
									<td>{{x.BusName}}</td>
									<td>{{x.BusID}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div ng-controller="Form1_CNT" class="modal fade modal-warning in" id="MyModel" tabindex="-1" role="dialog" style="display: none; padding-right: 6px;">
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
								<label>Routes</label>
								<select ng-options="x.RouteID as x.RouteName for x in Routes" ng-model="Form1.RouteID" class="form-control" ng-blur="ShowStations()">
										<option value="#" ></option>
								</select>
								<span class="help-block small">via route</span> 								
							</div>   
							<div class="form-group col-lg-6">
								<label>BusName</label>
								<input type="text"   class="form-control"  ng-model="Form1.BusName" >
								<span class="help-block small">Enter New Bus Name </span>						
							</div>
							  
						</div>
						<div class="table-responsive" >
							  <table id="dataTableExample1" class="table table-bordered table-striped table-hover" >
								 <thead ng-show="StationList.length>0?true:false">
									<tr class="info">
									    <th>SNO</th>
									    <th>Station Name</th>
									    <th>Arrival time</th>
									    <th>Departure time</th>
									  
									</tr>
								 </thead>
								 <tbody>
									<tr ng-repeat="x in array">
										<td>{{$index+1}}</td>
									   	<td>{{x.Name}}</td>
										<td><input type="time" ng-model="x.ArrivalTime"></td>
										<td><input type="time" ng-model="x.DepartureTime"></td>
										
										
									</tr>
								</tbody>
							  </table>
						</div>
						
						
						<div>
							
							<input class="btn btn-warning" type="submit" value="Save" ng-click="Save()">
							
							
							<!--
							<button class="btn btn-warning">Register</button>
							<a class="btn btn-add" href="login.html">Login</a>
							-->
						</div>
					</form>
				  </div>
				  <div class="modal-footer">
					 <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="CloseModel()">Close</button>
					
				  </div>
			   </div>
			   <!-- /.modal-content -->
			</div>
                        <!-- /.modal-dialog -->
		</div>
			 
	</section>
            
</body>
<?php
	
//	BodyContent_10();
	BodyContainerEnd_11();
	SetFooter_12();
	BodyEnd_13();
	End_14();
?>
