function redirect(str){
  if(confirm("Do You Want To Logout ?")){
    location.replace(str);
  }
}

function search_by_floor(){

  var officeId = document.getElementById("office").value;
  //alert("officeId : "+officeId);
  var floorId = document.getElementById("floor").value;
  var lockerNum = document.getElementById("locker_number").value;
  //alert(card1);
  if (floorId.length > 0 || floorId.length > 0)
  {
    //alert('Inside If Statement');
    var url="view_added_locker.php?officeId="+officeId+"&floorId="+floorId+"&lockerNum="+lockerNum;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(show_by_floor)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }

}


$(document).ready(function(){
  $(document).mousemove(function(e){
     TweenLite.to($('body'),
        .5,
        { css:
            {
                backgroundPosition: ""+ parseInt(event.pageX/8) + "px "+parseInt(event.pageY/'12')+"px, "+parseInt(event.pageX/'15')+"px "+parseInt(event.pageY/'15')+"px, "+parseInt(event.pageX/'30')+"px "+parseInt(event.pageY/'30')+"px"
            }
        });
  });
});

function show_by_floor(){
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showList").innerHTML=xmlHttp.responseText;
    }

  }
}

function search_added_locker(){
  var officeId = document.getElementById("office").value;
  //alert("officeId : "+officeId);
  var floorId = document.getElementById("floor").value;
  var lockerNum = document.getElementById("locker_number").value;
  //alert(card1);
  if (floorId.length > 0 || lockerNum.length > 0)
  {
    //alert('Inside If Statement');
    var url="view_added_locker.php?officeId="+officeId+"&floorId="+floorId+"&lockerNum="+lockerNum;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(search_added_locker_fetch)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }

}

function search_added_locker_fetch()
{
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showList").innerHTML=xmlHttp.responseText;
    }

  }
}



function search_locker(){
  var officeId = document.getElementById("office").value;
  //alert("officeId : "+officeId);
  var floorId = document.getElementById("floor").value;
  var lockerNum = document.getElementById("locker_number").value;
  //alert(card1);
  if (floorId.length > 0 || lockerNum.length > 0)
  {
    //alert('Inside If Statement');
    var url="search_locker_list.php?officeId="+officeId+"&floorId="+floorId+"&lockerNum="+lockerNum;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(search_locker_fetch)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }

}

function search_locker_fetch()
{
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showList").innerHTML=xmlHttp.responseText;
    }

  }
}


function search_assign_locker(){
  var officeId = document.getElementById("office").value;
  //alert("officeId : "+officeId);
  var floorId = document.getElementById("floor").value;
  var lockerNum = document.getElementById("locker_number").value;
  //alert(card1);
  if (floorId.length > 0 || lockerNum.length > 0)
  {
    //alert('Inside If Statement');
    var url="search_assign_locker.php?officeId="+officeId+"&floorId="+floorId+"&lockerNum="+lockerNum;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(show_assign_locker)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }

}

function show_assign_locker()
{
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showList").innerHTML=xmlHttp.responseText;
    }

  }
}


function search_floor_locker(){
  var officeId = document.getElementById("office").value;
  //alert("officeId : "+officeId);
  var floorId = document.getElementById("floor").value;
  var lockerNum = document.getElementById("locker_number").value;
  //alert(card1);
  if (floorId.length > 0 || lockerNum.length > 0)
  {
    //alert('Inside If Statement');
    var url="search_locker_floor.php?officeId="+officeId+"&floorId="+floorId+"&lockerNum="+lockerNum;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(show_floor_locker)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }

}

function show_floor_locker()
{
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showFloor").innerHTML=xmlHttp.responseText;
    }

  }
}



function find_locker(){

  var officeId = document.getElementById("officelocation").value;
  //alert("officeId : "+officeId);
  var floorId = document.getElementById("floornum").value;
  //alert(card1);
  if (floorId.length > 0 || lockerNum.length > 0)
  {
    //alert('Inside If Statement');
    var url="find_locker.php?officeId="+officeId+"&floorId="+floorId;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(showLocker)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }
}

function showLocker(){


  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("lockerList").innerHTML=xmlHttp.responseText;
    }

  }

}


function search_locker_floor(){
  var officeId = document.getElementById("office").value;
  //alert(officeId);

  if(officeId > 0)
  {
    var url = "search_locker_floor.php?office="+officeId;
    //alert(url);
    xmlHttp=GetXmlHttpObject1(show_locker_floor)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }
}

function show_locker_floor(){

  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showFloor").innerHTML=xmlHttp.responseText;
    }

  }
}


function search_assign_floor(){
  var officeId = document.getElementById("office").value;
  //alert(officeId);

  if(officeId > 0)
  {
    var url = "search_assign_floor.php?office="+officeId;
    //alert(url);
    xmlHttp=GetXmlHttpObject1(show_assign_floor)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }
}

function show_assign_floor(){

  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showFloor").innerHTML=xmlHttp.responseText;
    }

  }
}


function search_floor(){
  var officeId = document.getElementById("office").value;
  //alert(officeId);

  if(officeId > 0)
  {
    var url = "search_floor.php?office="+officeId;
    //alert(url);
    xmlHttp=GetXmlHttpObject1(show_floor)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }
}

function show_floor(){

  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showFloor").innerHTML=xmlHttp.responseText;
    }

  }
}


function chk_floor_ass()
{
  //alert("Avijit Datta : ");
  var officeId = document.getElementById("officelocation").value;
 // alert("officeId : "+officeId);
  //alert(card1);
  if (officeId.length > 0)
  {
    var url="seeFloor.php?officId="+officeId;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(showAreaAss)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }
}
function showAreaAss()
{
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("showFloor").innerHTML=xmlHttp.responseText;
    }

  }
}

function chk_floor()
{
  //alert("Avijit Datta : ");
  var officeId = document.getElementById("officeloc").value;
  //alert("officeId : "+officeId);
  //alert(card1);
  if (officeId.length > 0)
  {
    var url="find_floors.php?officId="+officeId;
    //alert('url : '+url);
    xmlHttp=GetXmlHttpObject1(showArea)
    xmlHttp.open("GET", url , true)
    xmlHttp.send(null)
  }
}
function showArea()
{
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  {
    //alert(xmlHttp.responseText);
    if(xmlHttp.responseText)
    {
      document.getElementById("areaHint").innerHTML=xmlHttp.responseText;
    }

  }
}

function deleteFunc(str){

  if(confirm("Are You Sure that You Want to Delete ?"))
  {
    location.replace(str);
  }
}

//######################################################################

// Ajax Code

function GetXmlHttpObject1(handler)
{
var objXmlHttp=null

if (navigator.userAgent.indexOf("Opera")>=0)
{
alert("This example doesn't work in Opera")
return
}
if (navigator.userAgent.indexOf("MSIE")>=0)
{
var strName="Msxml2.XMLHTTP"
if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
{
strName="Microsoft.XMLHTTP"
}
try
{
objXmlHttp=new ActiveXObject(strName)
objXmlHttp.onreadystatechange=handler
return objXmlHttp
}
catch(e)
{
alert("Error. Scripting for ActiveX might be disabled")
return
}
}
if (navigator.userAgent.indexOf("Mozilla")>=0)
{
objXmlHttp=new XMLHttpRequest()
objXmlHttp.onload=handler
objXmlHttp.onerror=handler
return objXmlHttp
}
}
//#############################################################################