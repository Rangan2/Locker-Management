function redirect(str){
  if(confirm("Do You Want To Logout ?")){
    location.replace(str);
  }
}
/*
  $('.featuresDiv').height($(window).height() - 50)
*/



/*$(document).on( "click", '#editDetails',function(e) {
    var lcoation = $(this).data('autocomplete');
    var officeName = $(this).data('offname');
    var officeFloor = $(this).data('offfloor');
    var floorId = $(this).data('id');

    console.log(lcoation + '@' + officeName + '@' + officeFloor + '@' + floorId);
    alert(lcoation + '@' + officeName + '@' + officeFloor + '@' + floorId);
});*/
   /* $(".business_skill_id").val(id);
    $(".business_skill_name").val(name);
    $(".business_skill_quote").val(quote);
    tinyMCE.get('business_skill_content').setContent(content);
});*/

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
/*
function chk_floor()
{
  alert("Avijit Datta : ");
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
}*/


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