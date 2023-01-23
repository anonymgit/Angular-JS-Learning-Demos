<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<title>calculator</title>
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
.calculator {
  border: 1px solid #ccc;
  border-radius: 5px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 400px;
}
.calculator-screen {
  width: 100%;
  font-size: 5rem;
  height: 80px;
  border: none;
  background-color: #252525;
  color: #fff;
  text-align: right;
  padding-right: 20px;
  padding-left: 10px;
}
.button {
  height: 60px;
  background-color: #f7f2f5;
  border-radius: 3px;
  border: 1px solid #c4c4c4;
  background-color: transparent;
  font-size: 2rem;
  color: #333;
  background-image: linear-gradient(to bottom,transparent,transparent 50%,rgba(0,0,0,.04));
  box-shadow: inset 0 0 0 1px rgba(255,255,255,.05), inset 0 1px 0 0 rgba(255,255,255,.45), inset 0 -1px 0 0 rgba(255,255,255,.15), 0 1px 0 0 rgba(255,255,255,.15);
  text-shadow: 0 1px rgba(255,255,255,.4);
}

.button:hover {
  background-color: #f7f2f5;
}

.operator {
  color: #337cac;
}

.all-clear {
  background-color: #f0595f;
  border-color: #b0353a;
  color: #fff;
}

.all-clear:hover {
  background-color: #f17377;
}

.equal-sign {
  background-color: #2e86c0;
  border-color: #337cac;
  color: #fff;
}

.equal-sign:hover {
  background-color: #4e9ed4;
}
.calculator-keys {
  display: grid;
}
.calculator-keys {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
}
.calculator-keys {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
}
.calculator-keys {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-row-gap: 20px;
  grid-column-gap: 20px;
}
.equal-sign {
  background-color: #2e86c0;
  border-color: #337cac;
  color: #fff;
  grid-row-start: 2;
}
.equal-sign {
  background-color: #2e86c0;
  border-color: #337cac;
  color: #fff;
  height: 100%;
  grid-row-start: 2;
  grid-row-end: 6;
}
.equal-sign {
  background-color: #2e86c0;
  border-color: #337cac;
  color: #fff;
  height: 100%;
  grid-row-start: 2;
  grid-row-end: 6;
  grid-column-start: 4;
  grid-column-end: 5;
}
.equal-sign {
  background-color: #2e86c0;
  border-color: #337cac;
  color: #fff;
  height: 100%;
  grid-row: 2 / 6;
  grid-column: 4 / 5;
}
.equal-sign {
  background-color: #2e86c0;
  border-color: #337cac;
  color: #fff;
  height: 100%;
  grid-area: 3/ 4 / 6 / 5;
}
</style>


<script>
function button(no)
{
	
	document.getElementById("screen").value+=no;
}

function equalto()
{
	var x=document.getElementById("screen").value;
	var y=eval(x)
	document.getElementById("screen").value=y;
} 



function clearScreen()
{
	
	document.getElementById("screen").value=" ";
}
function del()
{
  var x=document.getElementById("screen").value ;
  var y= x.slice(0,-1);
  document.getElementById("screen").value=y;
}



</script>	
</head>

<body>
<div class="calculator">
<form name="form1">
  <input type="text" class="calculator-screen" id="screen" value=""  name="screen" disabled />

  <div class="calculator-keys">
  
  	
	
	<input type="button" class="operator button" id="Add" value="+" onclick="button('+')" />
    <input type="button" class="operator button" id="Sub" value="-" onclick="button('-')">
    <input type="button" class="operator button" id="Multiply" value="&times;" onclick="button('&times;')"/>
    <input type="button" class="operator button" id="Divide" value="&divide;" onclick="button('&divide;')"/>
  	
	<input type="button" class="button" id="No7" value="7" onclick="button('7')">
    <input type="button" class="button" id="No8" value="8" onclick="button('8')"/>
    <input type="button" class="button" id="No9" value="9" onclick="button('9')"/>
	
	<input type="button" class="button" id="delete" value="&larr;" onclick="del()"  />
	<input type="button" class="button" id="No4" value="4" onclick="button('4')"/>
    <input type="button" class="button" id="No5" value="5" onclick="button('5')"/>
    <input type="button" class="button" id="No6" value="6" onclick="button('6')"/>
	
	<input type="button" class="button" id="No1" value="1" onclick="button('1')"/>
    <input type="button" class="button" id="No2" value="2" onclick="button('2')"/>
    <input type="button" class="button" id="No3" value="3" onclick="button('3')"/>
	
	
	<input type="button" class="button" id="No0" value="0" onclick="button('0')"/>
    <input type="button" class="decimal" id="decimal" value="." onclick="button('.')"/>
    <input type="button" class="all-clear" id="clear" value="AC" onclick="clearScreen()"/>
	

    <input type="button" class="equal-sign" id="equal" value="=" onclick="equalto()"/>

</form>
  </div>
</div>


</body>
</html>
