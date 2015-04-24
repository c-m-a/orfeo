

function setupDescriptions() {
var x = navigator.appVersion;
y = x.substring(0,4);
if (y>=4) setVariables();
}
var x,y,a,b;
k=0;

function setVariables(){
if (navigator.appName == "Netscape") {
h=".left=";
v=".top=";
dS="document.";
sD="";
}
else 
{
h=".pixelLeft=";
v=".pixelTop=";
dS="";
sD=".style";
   }
}

var isNav = (navigator.appName.indexOf("Netscape") !=-1);
function popLayer(a){

   k=k+1;
   
       if (event.button == 2) {
document.getElementById('depsel').style.display = "none"; 
document.getElementById('depsel8').style.display = "none"; 
cerrar = "<table border=0 bgcolor='<?php echo "$tbbordes"; ?>' width=100% onClick=hideLayer(-50)><tr><td> " ;
cerrar += "<center><a href='sss'  ><img src='iconos/cerrar.gif' border=0></a><b></b>"; 
cerrar += "</td></tr> </table></a>";
desc = "<table width=100%  cellpadding=0 border=0 bgcolor='<?php echo "$tbbordes" ?>'><tr><td>" ;
desc += cerrar + 	a  + cerrar ;
desc += "</table>";
if(isNav) {
document.object1.document.write(desc);
document.object1.document.close();
document.object1.left=x+25;
document.object1.top=y + y1;
}
else {
	var y1 = document.body.scrollTop;
    object1.innerHTML=desc;
	eval(dS+"object1"+sD+h+(x+25));
	eval(dS+"object1"+sD+v+y1);
	document.getElementById('depsel8').style.display = "none";
	document.getElementById('depsel').style.display = "none";
	document.getElementById('enviara').style.display = "none";
   }}
}
function hideLayer(a){
if(isNav) {

eval(document.object1.top=a);
document.getElementById('enviara').style.display = "";
document.getElementById('depsel8').style.display = "";
}
else object1.innerHTML="";
document.getElementById('enviara').style.display = "";
document.getElementById('depsel8').style.display = "none";
document.getElementById('depsel').style.display = "";
}
function inici()
{
  k=0;
}
function handlerMM(e){
x = (isNav) ? e.pageX : event.clientX;
y = (isNav) ? e.pageY : event.clientY;
}
if (isNav){
document.captureEvents(Event.MOUSEMOVE);
}
document.onmousemove = handlerMM;
//  End -->


