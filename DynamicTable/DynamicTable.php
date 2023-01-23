<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
html {
  font-size: 62.5%;
  box-sizing: border-box;
}

*, *::before, *::after {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}
.body {
  border: 1px solid #ccc;
  border-radius: 5px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 400px;
}

.text-field{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;

}
.button{
width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
 }
.button:hover{
background-color: #45a049;
}

.table,tr,td{
border: 1px solid black;
width:100%;
font-size:20px;
text-align: center;


}


</style>

<script>

function gen()
{
	var max=parseInt(document.getElementById("max").value);
	var min=parseInt(document.getElementById("min").value);
	var value=parseInt(document.getElementById("value").value);
	
	for(var i=min; i<=max; i++)
	{
		
		document.getElementById("screen").innerHTML+="<tr><td>"+value+"*"+i+"="+value*i+"</td></tr>";
	}
	
	
	
}


</script>





</head>

<body>

<div class="body">
	<form name="form1">
	
	<div class="text-field">
		MIN:<input  class="text-field" type="text" id="min" name="min" /><br /></br>
		MAX:<input  class="text-field" type="text" id="max" name="max"/><br /><br />
		VALUE:<input   class="text-field" type="text" id="value" /><br /><br />
		<input type="button" class="button" id="generate" value="generate table" onclick="gen()" />
		<table id ="screen" class="table">
		
		</table>
	</div>
	</form>
</div>
</body>
</html>
