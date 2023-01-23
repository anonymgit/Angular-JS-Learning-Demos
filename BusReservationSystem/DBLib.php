
<?php

function getDBConnection()
{
	$connection=new MySqli("localhost","root","","busreservtionsystem");
	return($connection);
}
function registerUser()
{
	$connection=getDBConnection();
	try
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$Uname=$request->Username;
		
		$Fname=$request->first_name;
		$Lname=$request->last_name;
		$Password=$request->Password;
		$EmailID=$request->Email;
		$Phone=$request->Phone_number;
		$Address=$request->Address;
		$City=$request->City;
		$State=$request->State;
		$Pincode=$request->Pincode;
		$UserType=$request->UserType;
		$st=$connection->prepare("select IFNULL(MAX(UserID)+1,10001) as ID from User_profile_auth");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$UserID=$row[0]['ID'];
		
		
		
		$st=$connection->prepare("INSERT INTO User_profile_auth(Uname,UserID,Fname,Lname,PASSWORD,EmailID,City,Phone,State,Address,Pincode,UpdatedON,UserType)VALUES('$Uname','$UserID','$Fname','$Lname','$Password','$EmailID','$City',$Phone,'$State','$Address',$Pincode,now(),'$UserType')");
		$st->execute();
		if($st->affected_rows>0)
		{
			$data["message"]="SUCCESS";
			
			
			return($data);

		}
		else
		{
			
			$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID' ");
			$st->execute();
			$rs=$st->get_result();
			$row=$rs->fetch_all(MYSQLI_ASSOC);
		
			if($rs->num_rows==1)
			{
				$data["message"]="EXIST";				
				return($data);

			}
		
		}
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}
function AllUserData()
{
	$connection=getDBConnection();
	try
	{
		$st=$connection->prepare("SELECT * FROM user_profile_auth");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			$data["UserData"]=$row;	
			return $data;
		}
		else
		return([]);
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function login()
{	
	$connection=getDBConnection();
	
	try
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$EmailID=$request->username;
		$Password=$request->password;
		//stored in session
		$_SESSION['EmailID'] = "";
// conditional usage of session values that may have been set in a previous session
		if(!isset($_SESSION["EmailID"])) {
		 echo "Please login first";
		 exit;
		}
		
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID' AND Password='$Password'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows==1)
		{
			$_SESSION['UserType']=$row[0]['UserType'];
			$_SESSION['EmailID'] = $EmailID;
			$data["UserDetails"]=$row;
			$data["message"]="SUCCESS";
			return($data);
		}
		
		else
		{
			
			$data["message"]="INVALID";
			return($data);
		}
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}
function updateUserProfile()
{	
	$connection=getDBConnection();
	try
	{	
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$UserID=$request->UserID;
		$Uname=$request->Uname;
		$Fname=$request->Fname;
		$Lname=$request->Lname;
		$EmailID=$request->EmailID;
		$Phone=$request->Phone;
		$Address=$request->Address;
		$City=$request->City;
		$State=$request->State;
		$Pincode=$request->Pincode;
		
		
		$st=$connection->prepare("UPDATE user_profile_auth SET Uname='$Uname',Fname='$Fname',Lname='$Lname',EmailID='$EmailID',City='$City',Phone=$Phone,Address='$Address',State='$State',Pincode=$Pincode,UpdatedON=NOW() where UserID='$UserID'");
		
		$st->execute();
		$st->get_result();
		if($st->affected_rows>0)
		{
			$data["message"]="SUCCESS";
			return($data);
		}
		else
		{
			$data["message"]="UNSUCCESS";
			return($data);
		}
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}
function getUserDelete()
{	
	
	$connection=getDBConnection();
	try
	{	
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$UserID=$request->UserID;
		$st=$connection->prepare("DELETE FROM user_profile_auth WHERE UserID='$UserID' ");
		$st->execute();
		if($st->affected_rows>0)
		{
			$data["message"]="SUCCESS";
			return($data);
		}
		else
		{
			$data["message"]="UNSUCCESS";
			return($data);
		}
		
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	
}

function updateProfile()
{	
	$connection=getDBConnection();
	try
	{	
		
		$ID=$_SESSION["EmailID"];
		$Uname=$_REQUEST["Uname"];
		$Fname=$_REQUEST["first_name"];
		$Lname=$_REQUEST["last_name"];
		$EmailID=$_REQUEST["Email"];
		$Phone=$_REQUEST["Phone_number"];
		$Address=$_REQUEST["Address"];
		$City=$_REQUEST["City"];
		$State=$_REQUEST["State"];
		$Pincode=$_REQUEST["Pincode"];
		$st=$connection->prepare("UPDATE user_profile_auth SET Uname='$Uname',Fname='$Fname',Lname='$Lname',EmailID='$EmailID',City='$City',Phone=$Phone,Address='$Address',State='$State',Pincode=$Pincode,UpdatedON=NOW() where EmailID='$ID'");
		unset($_SESSION["EmailID"]);
		$_SESSION["EmailID"]=$EmailID;
		$st->execute();
		$st->get_result();
		if($st->affected_rows>0)
		{
			print("profile updated successfully!");
			header("location:./profile.php");
		}	
		else
		{
			print("profile not updated successfully!");
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}


function deleteAccount()
{	
	$connection=getDBConnection();
	try
	{	
		
		$delete_id=$_SESSION["EmailID"];
		
		$st=$connection->prepare("DELETE FROM user_profile_auth WHERE EmailID='$delete_id'");
		$st->execute();
		$st->get_result();
		if($st->affected_rows>0)
		{
			header("location:./login.php");
		}
		else
		{
			print("Record Not delete...");
		}
	}
	
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}


//searching individual user deatils to get data on profile page
function getUserName()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			print($row[$i]["Fname"]." ".$row[$i]["Lname"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}
function getUserPhone()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			print($row[$i]["Phone"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}
function getUserAddress()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			print($row[$i]["Address"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}
function getUserEmailID()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			print($row[$i]["EmailID"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}
function getUserCity()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			print($row[$i]["City"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}

function getUserState()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			print($row[$i]["State"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}

function getUserPincode()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select * from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			print($row[$i]["Pincode"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}
function getUserID()
{
	try
	{	
		$EmailID=$_SESSION["EmailID"];
		$connection=getDBConnection();
		$st=$connection->prepare("select UserID from user_profile_auth where  EmailID='$EmailID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{	
			return($row);
			//print($row[$i]["UserID"]);
		}
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}

function getAlluser()
{	
	
	$connection=getDBConnection();
	try
	{	
		$st=$connection->prepare("select * from user_profile_auth where UserType='USER'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		return($row);
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	
}

function getAllAdmin()
{	
	
	$connection=getDBConnection();
	try
	{	
		$st=$connection->prepare("select * from user_profile_auth where UserType='ADMIN'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			$data["AdminList"]=$row;	
			return $data;
		}
		else
		return([]);
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	
}

function getUserProfile($UserID)
{	
	
	$connection=getDBConnection();
	try
	{	
		
		
		$st=$connection->prepare("select * from user_profile_auth where UserID='$UserID' ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$i=0;
		if($rs->num_rows==1)
		{
			return($row);
		}
		
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	
}



function getRoutes()
{
	$connection=getDBConnection();
	$row=[];
	
	try
	{	
		$st=$connection->prepare("select IFNULL(MAX(UserID)+1,10001) as RouteID from route_master");
		$st=$connection->prepare("select * from route_master ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			$data["Routes"]=$row;	
			return $data;
		}
		else
		{
			return([]);
		}
	}
	catch(Exception $X)
	{
		return($row);
	}	
	
}

function registerRoutes()
{
	$connection=getDBConnection();
	
	try
	{
		$RouteName=$_REQUEST["route"];
		$st=$connection->prepare("SELECT IFNULL(MAX(RouteID)+1,10001) AS ID FROM route_master;");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$RouteID=$row[0]['ID'];
		
		$st=$connection->prepare("INSERT INTO route_master(RouteName,RouteID)VALUES('$RouteName','$RouteID')");
		print("not effected");
		$st->execute();
		print("not effected");
		if($st->affected_rows>0)
		{
			header("location:./route.php");
		}
		else
		{
		 	print("not effected");
		}
	}
	catch(Exception $X)
	{
		return($row);
	}	
	
}

function registerStation()
{
	$connection=getDBConnection();
	
	try
	{
		$RouteID=$_REQUEST["RouteID"];
		$Name=$_REQUEST["Name"];
		$FareFromOrigin=$_REQUEST["fare"];
		
		$st=$connection->prepare("SELECT IFNULL(MAX(StationID)+1,1) AS ID FROM station_master;");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$StationID=$row[0]['ID'];
		
		$st=$connection->prepare("SELECT IFNULL(MAX(StationNumber)+1,100) AS ID FROM station_master;");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$StationNumber=$row[0]['ID'];
		
		$st=$connection->prepare("INSERT INTO station_master(StationID,Name,RouteID,StationNumber,FareFromOrigin)VALUES('$StationID','$Name','$RouteID','$StationNumber','$FareFromOrigin')");
		
		
		$st->execute();
		if($st->affected_rows>0)
		{
			header("location:./route.php");
		}
		else
		{
		 	print("not effected");
		}
	}
	catch(Exception $X)
	{
		return($row);
	}	
	
}

function getAllRoutes()
{
	$connection=getDBConnection();
	try
	{	
		
		
		$st=$connection->prepare("select * from station_details_with_route ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		return($row);
		
	}
	catch(Exception $X)
		{
			print("Not Connected!!");
		}	
}

function AddBus()
{
	$connection=getDBConnection();
	try
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$RouteID=$request->RouteID;
		$size=$request->size;
		$BusName=$request->BusName;
		
		$st=$connection->prepare("SELECT IFNULL(MAX(BusID)+1,1) AS ID FROM bus_master;");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$BusID=$row[0]['ID'];
		
		

	
		for($i=0;$i<$size;$i++)
		{
			$ArrivalTime=$request->ArrivalTime.$i;
			$DepartureTime=$request->DepartureTime.$i;
			$StationID=$request->StationID.$i;
			$st=$connection->prepare("INSERT INTO bus_station_details(BusID,StationID,ArrivalTime,DepartureTime)VALUES('$BusID','$StationID','$ArrivalTime','$DepartureTime')");
			print("<br>");
			print("INSERT INTO bus_station_details(BusID,StationID,ArrivalTime,DepartureTime)VALUES('$BusID','$StationID','$ArrivalTime','$DepartureTime')");
			$st->execute();
			$st->get_result();
		}
		
		
		$st=$connection->prepare("INSERT INTO bus_master(BusID,BusName,RouteID)VALUES('$BusID','$BusName','$RouteID')");
		$st->execute();
		
		if($st->affected_rows>0)
		{
			header("location:./AddBus.php");
		}
		else
		{
		 	print("not effected");
		}
	}
	catch(Exception $X)
	{
		return($row);
	}	
}

function getAllBus()
{
	$connection=getDBConnection();
	try
	{	
		$st=$connection->prepare("SELECT * FROM bus_master  INNER JOIN route_master ON bus_master.RouteID=route_master.RouteID;");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		return($row);
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function getBus()
{
	$connection=getDBConnection();
	try
	{	
		
		
		$st=$connection->prepare("SELECT * FROM bus_master  INNER JOIN route_master ON bus_master.RouteID=route_master.RouteID;");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			$data["Bus"]=$row;	
			return $data;
		}
		else
		{
			return([]);
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function getStations()
{	
	$RouteID=$_REQUEST["RouteID"];
	
	$connection=getDBConnection();
	try
	{	
		$st=$connection->prepare("SELECT * FROM bus_master  INNER JOIN route_master ON bus_master.RouteID=route_master.RouteID where bus_master.RouteID='$RouteID';");
		
		$st->execute(); 
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function getAllStations()
{	
	
	
	print($RouteID);
	
	$connection=getDBConnection();
	try
	{	
		$st=$connection->prepare("SELECT *  FROM station_master ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		return($row);
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function getRouteName($RouteID)
{	
	if(!isset($_SESSION["RouteID"]))
	$_SESSION["RouteID"]=$_REQUEST["RouteID"];
	$RouteID=$_SESSION["RouteID"];
	
	$connection=getDBConnection();
	try
	{	
		
		$st=$connection->prepare("select RouteName from route_master where RouteID='$RouteID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function Booking()
{	
	$connection=getDBConnection();
	try
	{	
		$JourneyDate=$_REQUEST["JourneyDate"];
		
		$NoOfPerson=$_REQUEST["NoOfPerson"];
		$SourceStationID=$_REQUEST["SourceStationID"];
		$DestinationStationID=$_REQUEST["DestinationStationID"];
		$BusID=$_REQUEST["BusID"];
		
		$st=$connection->prepare("select FareFromOrigin from station_master where StationID='$SourceStationID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$SourceFare=$row[0]['FareFromOrigin'];
		
		$st=$connection->prepare("select FareFromOrigin from station_master where StationID='$DestinationStationID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$DestinationFare=$row[0]['FareFromOrigin'];
		
		$TotalFare=abs($SourceFare-$DestinationFare);
		
		$Total=($TotalFare)*$NoOfPerson;
		$TotalAmount=abs($Total);
		
		$st=$connection->prepare("SELECT * FROM bus_station_details  INNER JOIN station_master ON bus_station_details.StationID=station_master.StationID WHERE bus_station_details.BusID='$BusID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$ArrivalTime=$row[0]['ArrivalTime'];
		$DepartureTime=$row[0]['DepartureTime'];
		
		$st=$connection->prepare("select IFNULL(MAX(PNRnumber)+1,500) as ID from booking_master");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		$PNRnumber=$row[0]['ID'];
		
		$rows=getUserID();
		$UserID=$rows[0]['UserID'];
		
		for($i=0;$i<$NoOfPerson;$i++)
		{
			$PassengerName=$_REQUEST["PassengerName".$i];
			$Age=$_REQUEST["Age".$i];
			$Phone=$_REQUEST["Phone".$i];
			$Sex=$_REQUEST["Sex".$i];
		
			$st=$connection->prepare("INSERT INTO booking_details(PNRnumber,PassengerName,Age,Phone,Sex,TotalFare,ArrivalTime,DepartureTime,BusID)VALUES('$PNRnumber','$PassengerName','$Age','$Phone','$Sex','$TotalFare','$ArrivalTime','$DepartureTime','$BusID')");
			
			$st->execute();
			$st->get_result();
		}
		
		
		
		
			
		$st=$connection->prepare("INSERT INTO booking_master(UserID,PNRnumber,NoOfPerson,SourceStationID,DestinationStationID,TotalAmount,BusID,BoardingTime,JourneyDate)VALUES('$UserID','$PNRnumber','$NoOfPerson','$SourceStationID','$DestinationStationID','$TotalAmount','$BusID','$ArrivalTime','$JourneyDate')");
		
		$st->execute();
		$st->get_result();
		if($st->affected_rows>0)
		{	
			header("location:./invoice.php?PNRnumber=".$PNRnumber);
		}	
		else
		{
			print("Not Saved");
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}

function getBookingMaster($PNRnumber)
{
	$connection=getDBConnection();
	try
	{	
		$rows=getUserID();
		$UserID=$rows[0]['UserID'];
		
		
		
		$st=$connection->prepare("SELECT * FROM booking_master_data where UserID='$UserID' AND PNRnumber='$PNRnumber' ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	

}


function getBookingDetails($PNRnumber)
{
	$connection=getDBConnection();
	try
	{	
		$rows=getUserID();
		$UserID=$rows[0]['UserID'];
		
		$st=$connection->prepare("SELECT * FROM booking_details_data where UserID='$UserID' AND PNRnumber='$PNRnumber'  ");
		$st->execute();
		
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	

}

function getAllBookingHistory()
{
	$connection=getDBConnection();
	try
	{	
		$rows=getUserID();
		$UserID=$rows[0]['UserID'];
		
		
		
		$st=$connection->prepare("SELECT * FROM booking_master_data ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	

}

function getStationName()
{	
	
	
	$connection=getDBConnection();
	try
	{	
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		
		$RouteID=$request->RouteID;
		$st=$connection->prepare("SELECT * FROM station_master where RouteID='$RouteID';");
		
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			$data["StationList"]=$row;
			return $data;
		}
		else
		{
			return([]);
		}
		
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function getBusStation($BusID)
{	
	if(!isset($_SESSION["BusID"]))
	$_SESSION["BusID"]=$_REQUEST["BusID"];
	$RouteID=$_SESSION["BusID"];
	$connection=getDBConnection();
	try
	{	
		$st=$connection->prepare("SELECT * FROM bus_station_details  INNER JOIN station_master ON bus_station_details.StationID=station_master.StationID WHERE bus_station_details.BusID='$BusID'");
		
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}	
}

function getSourceFare($SourceStationID)
{	
	if(!isset($_SESSION["SourceStationID"]))
	$_SESSION["SourceStationID"]=$_REQUEST["SourceStationID"];
	$SourceStationID=$_SESSION["SourceStationID"];
	$connection=getDBConnection();
	try
	{
		$st=$connection->prepare("select FareFromOrigin from station_master where StationID='$SourceStationID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		return($row);
		$SourceFare=$row[0]['FareFromOrigin'];
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
	
}


function getDestinationFare($DestinationStationID)
{	
	if(!isset($_SESSION["DestinationStationID"]))
	$_SESSION["DestinationStationID"]=$_REQUEST["DestinationStationID"];
	$DestinationStationID=$_SESSION["DestinationStationID"];
	$connection=getDBConnection();
	try
	{
		$st=$connection->prepare("select FareFromOrigin from station_master where StationID='$DestinationStationID'");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		return($row);
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
	
}
	
function getTicketHistory()
{
	$connection=getDBConnection();
	try
	{	
		$rows=getUserID();
		$UserID=$rows[0]['UserID'];
		
		
		
		$st=$connection->prepare("SELECT * FROM booking_master_data where UserID='$UserID' ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}	

function getTotalAdmin()
{
	$connection=getDBConnection();
	try
	{	
	
		$st=$connection->prepare("SELECT COUNT(UserID) AS 'TotalAdmin' FROM user_profile_auth WHERE UserType='ADMIN';  ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		
		if($rs->num_rows>0)
		{
			return($row);
		}
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}	

function getTotalUserCount()
{
	$connection=getDBConnection();
	try
	{	
	
		$st=$connection->prepare("SELECT COUNT(UserID) AS 'TotalUser' FROM user_profile_auth WHERE UserType='USER'; ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}	

function getTotalEarning()
{
	$connection=getDBConnection();
	try
	{	
	
		$st=$connection->prepare("SELECT SUM(TotalAmount) AS 'TotalAmount' FROM booking_master ; ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}	

function NoOfTotalBuses()
{
	$connection=getDBConnection();
	try
	{	
	
		$st=$connection->prepare("SELECT COUNT(BusID) AS 'TotalBus' FROM bus_master; ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}

function NoOfTotalStations()
{
	$connection=getDBConnection();
	try
	{	
	
		$st=$connection->prepare("SELECT COUNT(StationID) AS 'TotalStation' FROM station_master; ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}	

function NoOfTotalRoutes()
{
	$connection=getDBConnection();
	try
	{	
	
		$st=$connection->prepare("SELECT COUNT(RouteID) AS 'TotalRoutes' FROM route_master; ");
		$st->execute();
		$rs=$st->get_result();
		$row=$rs->fetch_all(MYSQLI_ASSOC);
		if($rs->num_rows>0)
		{
			return($row);
		}
		
		
	}
	catch(Exception $X)
	{
		print("Not Connected!!");
	}
}	




?>