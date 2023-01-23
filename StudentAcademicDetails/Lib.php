<?php
	function ListData()
	{
		$connection=getDBConnection();
		try
		{
			$st=$connection->prepare("SELECT * FROM student_academic_data");
			$st->execute();
			$rs=$st->get_result();
			$row=$rs->fetch_all(MYSQLI_ASSOC);
			if($rs->num_rows>0)
			{
					return($row);	
			}
			else
			return([]);
		}
		catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	}
	function InsertStudentData()
	{
		
		try
		{
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
		
			$connection=getDBConnection();
			$Name=$request->Name;
			$Rollno=$request->Rollno;
			$Physics=$request->Physics;
			$Chemistry=$request->Chemistry;
			$Math=$request->Math;
			$Total=$Physics+$Chemistry+$Math;
			$Percentage=($Total/300)*100;
			if($Physics>=35)
			{
				if($Chemistry>=35)
				{
					if($Math>=35)
					{
						if($Percentage>=35)
						{ 
							if($Percentage<=45)
							{ 
				
								$Division="3rd division";
							}	
						}
						if($Percentage>45)
						{
							if($Percentage<=60)
							{ 
								$Division="2nd division";
							}   
						}
						if($Percentage>60)
						{   
								$Division="1st division";
						}

					}	 
					if($Math<35)
					{
						$Division= "fail";
					}
				}
				if($Chemistry<35)
				{
					$Division= "fail";
				}	
			}
			$st=$connection->prepare("INSERT INTO student_academic_data(Name,Rollno,Physics,Chemistry,Math,Percentage,Division,Total)VALUES('$Name','$Rollno','$Physics','$Chemistry','$Math','$Percentage','$Division',$Total)");
			
			$st->execute();
			if($st->affected_rows>0)
			{
				$data['StudentList']=ListData();
				$data['success']='Result fetched!!';
				return($data);
			}
			else
			{
				print("not effected");
			}
	
		}
		catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	
	
	}
	function getDBConnection()
	{
		$connection=new MySqli("localhost","root","","studentacademicdetails");
		return($connection);
	}
	
	function DeleteStudentList($Rollno)
	{
		$connection=getDBConnection();
		try
		{	
			
			$st=$connection->prepare("DELETE FROM student_academic_data WHERE Rollno='$Rollno'");
			$st->execute();
			$st->get_result();
			if($st->affected_rows>0)
			{
				$data['StudentList']=ListData();
				$data['success']='Result fetched!!';
				return($data);	
			}
			else
			return([]);
		}
		catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	}
	function EditStudentList()
	{
		$connection=getDBConnection();
		try
		{	
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
		
			$connection=getDBConnection();
			
			$Name=$request->Name;
			$Rollno=$request->Rollno;
			$Physics=$request->Physics;
			$Chemistry=$request->Chemistry;
			$Math=$request->Math;
			$Total=$Physics+$Chemistry+$Math;
			$Percentage=($Total/300)*100;
			if($Physics>=35)
			{
				if($Chemistry>=35)
				{
					if($Math>=35)
					{
						if($Percentage>=35)
						{ 
							if($Percentage<=45)
							{ 
				
								$Division="3rd division";
							}	
						}
						if($Percentage>45)
						{
							if($Percentage<=60)
							{ 
								$Division="2nd division";
							}   
						}
						if($Percentage>60)
						{   
								$Division="1st division";
						}

					}	 
					if($Math<35)
					{
						$Division= "fail";
					}
				}
				if($Chemistry<35)
				{
					$Division= "fail";
				}	
			}
			$st=$connection->prepare("UPDATE student_academic_data SET Name='$Name',Physics='$Physics',Chemistry='$Chemistry',Math='$Math',Percentage='$Percentage',Division='$Division',Total=$Total where Rollno=$Rollno");
			$st->execute();
			$st->get_result();
			if($st->affected_rows>0)
			{
				$data['StudentList']=ListData();
				$data['success']='Result fetched!!';
				return($data);	
			}
			else
			return([]);
		}
		catch(Exception $X)
		{
			print("Not Connected!!");
		}	
	}
?>