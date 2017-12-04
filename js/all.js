// JavaScript Document

function chk_admin_login(){
	
	if(document.getElementById("user_name").value == "")
	{
		alert("Please Enter The User Name : ")
		document.getElementById("user_name").focus();
		return false;
	}
	if(document.getElementById("passwd").value == "")
	{
		alert("Please Enter The Password : ")
		document.getElementById("passwd").focus();
		return false;
	}
	return true;
}

function admin_add_menu_chk_null(){
	
	if(document.getElementById("menu_parent").selectedIndex== 0)
	{
		alert("Please Select The Menu Parent : ")
		document.getElementById("menu_parent").focus();
		return false;
	}
	if(document.getElementById("menu_name").value == "")
	{
		alert("Please Enter The Menu Name : ")
		document.getElementById("menu_name").focus();
		return false;
	}
	if(document.getElementById("menu_link").value == "")
	{
		alert("Please Enter The Menu Link : ")
		document.getElementById("menu_link").focus();
		return false;
	}
	
}

function chk_null_register(){
	//alert("Avijit Datta");
	if(document.getElementById("fname").value == "")
	{
		alert("Please Enter The Full Name");
		document.getElementById("fname").focus();
		return false;
	}
	if(document.getElementById("cname").value == "")
	{
		alert("Please Enter The Company Name");
		document.getElementById("cname").focus();
		return false;
	}
	if(document.getElementById("cemail").value == "")
	{
		alert("Please Enter The Company Email Id");
		document.getElementById("cemail").focus();
		return false;
	}
	var email = document.getElementById("cemail").value;
	if(document.getElementById("password").value == "")
	{
		alert("Please Enter The Password");
		document.getElementById("password").focus();
		return false;
	}
	if(document.getElementById("repassword").value == "")
	{
		alert("Please Re-Enter The Password");
		document.getElementById("repassword").focus();
		return false;
	}
	if(document.getElementById("password").value != document.getElementById("repassword").value)
	{
		alert("Password Does Not Matched");
		document.getElementById("repassword").focus();
		return false;
		
	}
	if(document.getElementById("cfield").value == "")
	{
		alert("Please Enter The Companies Field of Work");
		document.getElementById("cfield").focus();
		return false;
	}
	if(document.getElementById("location").value == "")
	{
		alert("Please Enter The Location of The Company");
		document.getElementById("location").focus();
		return false;
	}
	return true;
}

function login_null_chk()
{
	if(document.getElementById("email").value == "")
	{
		alert("Please Enter Your Email Id");
		document.getElementById("email").focus();
		return false;
	}
	if(document.getElementById("passwd").value == "")
	{
		alert("Please Enter Your Password");
		document.getElementById("passwd").focus();
		return false;
	}
	return true;
}

function add_locker_chk(){
	
	if(document.getElementById("fnum").selectedIndex== 0)
	{
		alert("Please Select The Floor Number : ")
		document.getElementById("fnum").focus();
		return false;
	}
	if(document.getElementById("off_locker").value == "")
	{
		alert("Please Enter The Office Locker Number");
		document.getElementById("off_locker").focus();
		return false;
	}
	return true;
}

function assign_locker_chk_null(){

	if(document.getElementById("fnum").selectedIndex== 0)
	{
		alert("Please Select The Floor Number : ")
		document.getElementById("fnum").focus();
		return false;
	}	
	if(document.getElementById("locker_num").selectedIndex== 0)
	{
		alert("Please Select The Locker Number : ")
		document.getElementById("locker_num").focus();
		return false;
	}
	if(document.getElementById("emp_id").value == "")
	{
		alert("Please Enter The Employee Id");
		document.getElementById("emp_id").focus();
		return false;
	}
	if(document.getElementById("emp_name").value == "")
	{
		alert("Please Enter The Employee Name");
		document.getElementById("emp_name").focus();
		return false;
	}
	return true;
}

function office_location_chk()
{
	if(document.getElementById("autocomplete").value == "")
	{
		alert("Please Enter The Location of The Office");
		document.getElementById("autocomplete").focus();
		return false;
	}
	if(document.getElementById("offname").value == "")
	{
		alert("Please Enter The Name of The Office");
		document.getElementById("offname").focus();
		return false;
	}
	if(document.getElementById("offfloor").value == "")
	{
		alert("Please Enter The Floor Number of The Office");
		document.getElementById("offfloor").focus();
		return false;
	}
	var floor_number = document.getElementById("offfloor").value;
	if(isNaN(floor_number))
	{
		alert("Floor Number Must Be An Integer")
		document.getElementById("offfloor").focus();
		return false;
	}
	return true;
}

function office_admin_chk()
{
	if(document.getElementById("officeloc").selectedIndex==0)
	{
		alert("Please Select The Location of The Office");
		document.getElementById("officeloc").focus();
		return false;
	}
	if(document.getElementById("fnum").selectedIndex==0)
	{
		alert("Please Select The Floor of The Office");
		document.getElementById("fnum").focus();
		return false;
	}
	if(document.getElementById("admin_name").value=="")
	{
		alert("Please Enter The Admin Name");
		document.getElementById("admin_name").focus();
		return false;
	}
	if(document.getElementById("uname").value=="")
	{
		alert("Please Enter The Email Id");
		document.getElementById("uname").focus();
		return false;
	}
	if(document.getElementById("passwd").value=="")
	{
		alert("Please Enter The Password");
		document.getElementById("passwd").focus();
		return false;
	}
}
function change_passwd_chk(){
	
	if(document.getElementById("oldpass").value=="")
	{
		alert("Please Enter The Old-Password");
		document.getElementById("oldpass").focus();
		return false;
	}
	if(document.getElementById("newpass").value=="")
	{
		alert("Please Enter The New-Password");
		document.getElementById("newpass").focus();
		return false;
	}
	if(document.getElementById("rnewpass").value=="")
	{
		alert("Please Re-Enter The New-Password");
		document.getElementById("rnewpass").focus();
		return false;
	}
	if(document.getElementById("newpass").value != document.getElementById("rnewpass").value)
	{
			
		alert("Password Does Not Matched With The New Password");
		document.getElementById("rnewpass").focus();
		return false;
	}

}

function chk_null()
{
	//alert("Avijit Datta");
	if(document.getElementById("eid").value=="")
	{
		alert("Please Enter Your Employee Id");
		document.getElementById("eid").focus();
		return false;
	}
	if(isNaN(document.getElementById("eid").value) == true)
	{
		alert("Employee Id Must Be An Integer");
		document.getElementById("eid").focus();
		return false;
	}
	if(document.getElementById("ename").value=="")
	{
		alert("Please Enter Your Employee Name");
		document.getElementById("ename").focus();
		return false;
	}
	if(document.getElementById("snum").value=="")
	{
		alert("Please Enter Your Seat Number");
		document.getElementById("snum").focus();
		return false;
	}
	if(isNaN(document.getElementById("snum").value) == true)
	{
		alert("Seat Number Must Be An Integer");
		document.getElementById("snum").focus();
		return false;
	}
	if(document.getElementById("key_num").value=="")
	{
		alert("Please Enter Your Key Number");
		document.getElementById("key_num").focus();
		return false;
	}
	if(isNaN(document.getElementById("key_num").value) == true)
	{
		alert("Key Number Must Be An Integer");
		document.getElementById("key_num").focus();
		return false;
	}
	
	return true;
	
}


function startclock()
{
	var thetime=new Date();
	
	var nhours=thetime.getHours();
	var nmins=thetime.getMinutes();
	var nsecn=thetime.getSeconds();
	var nday=thetime.getDay();
	var nmonth=thetime.getMonth();
	var ntoday=thetime.getDate();
	var nyear=thetime.getYear();
	var AorP=" ";
	
	if (nhours>=12)
		AorP="P.M.";
	else
		AorP="A.M.";
	
	if (nhours>=13)
		nhours-=12;
	
	if (nhours==0)
	   nhours=12;
	
	if (nsecn<10)
	 nsecn="0"+nsecn;
	
	if (nmins<10)
	 nmins="0"+nmins;
	
	if (nday==0)
	  nday="Sunday";
	if (nday==1)
	  nday="Monday";
	if (nday==2)
	  nday="Tuesday";
	if (nday==3)
	  nday="Wednesday";
	if (nday==4)
	  nday="Thursday";
	if (nday==5)
	  nday="Friday";
	if (nday==6)
	  nday="Saturday";
	
	nmonth+=1;
	
	if (nyear<=99)
	  nyear= "19"+nyear;
	
	if ((nyear>99) && (nyear<2000))
	 nyear+=1900;
	
	document.getElementById("clock").innerHTML=nhours+": "+nmins+": "+nsecn+" "+AorP+" "+nday+", "+ntoday+"-"+nmonth+"-"+nyear;
	
	setTimeout('startclock()',1000);

} 


function logout(str)
{
	if(confirm("Are You Sure You Want To Logout ?"))
	{
		location.replace(str);
	}
}

function deleteFunc(str)
{
	if(confirm("Are You Sure You Want To Delete ?"))
	{
		location.replace(str);
	}
}

function chk_call(){
	
	alert('Avijit Datta');	
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

function chk_locker_list(){

	
	var floorId = document.getElementById("floor").value;
	//alert("officeId : "+officeId);
	//alert(card1);
	if (floorId.length > 0)
	{ 
		var url="find_locker_list.php?floorId="+floorId;
		//alert('url : '+url);
		xmlHttp=GetXmlHttpObject1(locker_fetch)
		xmlHttp.open("GET", url , true)
		xmlHttp.send(null)
	} 

}


function locker_fetch() 
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
	var officeId = document.getElementById("officeId").value;
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

function findCompany(){

	var companyName = document.getElementById("company_name").value;
	
	//alert("officeId : "+officeId);
	//alert(card1);
	if (companyName.length > 0 )
	{ 
		//alert('Inside If Statement');
		var url="find_company.php?companyName="+companyName;
		//alert(url);
		//alert('url : '+url);
		xmlHttp=GetXmlHttpObject1(showCompany)
		xmlHttp.open("GET", url , true)
		xmlHttp.send(null)
	} 

}


function showCompany(){
	
	
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		//alert(xmlHttp.responseText);
		if(xmlHttp.responseText)
		{
			document.getElementById("company").innerHTML=xmlHttp.responseText; 
		}
		
	} 

}

function find_locker(){
	
	var officeId = document.getElementById("officeloc").value;
	//alert("officeId : "+officeId);
	var floorId = document.getElementById("fnum").value;
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
//#############################################################################//