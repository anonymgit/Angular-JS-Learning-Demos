<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script >
	//Add();
	function Addition()
	{
		alert(document.getElementById("No1").value+"+"+document.getElementById("No2").value);
		//document.getElementById("No1").value=100;
		var x=parseInt(document.getElementById("No1").value);
		var y=parseInt(document.getElementById("No2").value);
		var z=x+y;
		alert(z);
		
		document.getElementById("Re").innerHTML="<B>"+z;
		
	}
	function Subtract()
	{
		alert(document.getElementById("No1").value+"-"+document.getElementById("No2").value);
		//document.getElementById("No1").value=100;
		var x=parseInt(document.getElementById("No1").value);
		var y=parseInt(document.getElementById("No2").value);
		var z=x-y;
		alert(z);
		
		document.getElementById("Re").innerHTML="<B>"+z;
		
	}
	function Division()
	{
		alert(document.getElementById("No1").value+"/"+document.getElementById("No2").value);
		//document.getElementById("No1").value=100;
		var x=parseInt(document.getElementById("No1").value);
		var y=parseInt(document.getElementById("No2").value);
		var z=x/y;
		alert(z);
		document.getElementById("Re").innerHTML="<B>"+z;
		
	}
	function Multiply()
	{
		alert(document.getElementById("No1").value+"*"+document.getElementById("No2").value);
		//document.getElementById("No1").value=100;
		var x=parseInt(document.getElementById("No1").value);
		var y=parseInt(document.getElementById("No2").value);
		var z=x*y;
		alert(z);
		
		document.getElementById("Re").innerHTML="<B>"+z;
		
	}
	
</script>
</head>

<body>
<div id="frm">
<form action="#" name="frm1" >
No 1<input type="text" id="No1" name="No1" /><br /><br />
No 2<input type="text" id="No2" name="NO2" /><br /><br />

<input type="button" value="+" id="Add" name="Add"  onClick="Addition()"/>
<input type="button" value="-" id="Sub" name="Subtract" onClick="Subtract()" />
<input type="button" value="/" id="Divide" name="Divide" onClick="Division()"/>
<input type="button" value="*"  id="Multiply"name="Multiply" onClick="Multiply()" /><br /><br />

MyResult:<label id="Re"></label>
</form>
</div>

</body>
</html>
