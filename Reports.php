<?php
//flamur statovci
//jeta statovci
include_once "session.php" ;

   
$type = $_GET["type"];	

$archive_table = $_GET["archive_table"];		
$archive = "archive";
			  
$level = $_SESSION['level'];
  
  //security feature - user access restriction
  if(!in_array($level ,$raportet))
  {
	 header("Location:index.php?"); 
  }
  


?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-gb">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Gjenero raporte</title>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<script type='text/javascript' src='js/common.js'></script>
<script type='text/javascript' src='js/Reports.js'></script>
<SCRIPT LANGUAGE="JavaScript" SRC='js/calendar1.js'></SCRIPT>

<script language="javascript"> 

window.onload = function() {
document.getElementById('kerko').focus();
}

	

function load_url(url){
	location.href  = url;
}

function sendWeek(week)
{ 	
	  if(week == 0)
	  {
		var start_week_date = document.getElementById("startDate");
		var end_week_date = document.getElementById("endDate");
		start_week_date.value ="";
		end_week_date.value ="";
	  }
	  else
		requestObject('datesPerWeek',week,load_dates);
		
		
  var monthValue = document.getElementById("month");
  var weekValue = document.getElementById("week");

  for (var i=0; i<weekValue.length; i++)
	  {
	   if(weekValue.value == 0)
	      monthValue.disabled = false;
	   else
	      monthValue.disabled = true;
	  }					 
  document.getElementById("action").value = 'REG_CUSTOMER_BY_WEEK';
}

function load_dates(){
	
	if (req.readyState == 4 && req.status == 200){
		var start_week_date = document.getElementById("startDate");
		var end_week_date = document.getElementById("endDate");
		start_week_date.value = req.responseXML.getElementsByTagName('START')[0].firstChild.nodeValue;
		end_week_date.value = req.responseXML.getElementsByTagName('END')[0].firstChild.nodeValue;
	}
}

function selectMonth(val)
{
  var monthValue = document.getElementById("month");
  var weekValue = document.getElementById("week");

  for (var i=0; i<monthValue.length; i++)
	  {
	   if(monthValue.value == 0)
	      weekValue.disabled = false;
	   else
	      weekValue.disabled = true;
	  }					
	  document.getElementById("action").value = 'REG_CUSTOMER_BY_MONTH';
}

function contractedDateEntered()
{
    var contractedDateValue = document.getElementById("search_byContractedDate");
	var transferedDateValue = document.getElementById("search_byTransferedDate");
	var processedDateValue = document.getElementById("search_byProcessedDate");
	var monthValue = document.getElementById("month");
    var weekValue = document.getElementById("week");
    var pakoValue = document.getElementById("pako");

	if (!is_empty(contractedDateValue.value)) 
	{
		transferedDateValue.disabled = true;
		processedDateValue.disabled = true;
		weekValue.disabled = true;
		monthValue.disabled = true;
		pakoValue.disabled = true;
	}
	else
	{
	    transferedDateValue.disabled = false;
		processedDateValue.disabled = false;
		weekValue.disabled = false;
		monthValue.disabled = false;
		pakoValue.disabled = false;
	}
	document.getElementById("action").value = 'REG_CUSTOMER_BY_DATE';
}

function processedDateEntered()
{	
    var contractedDateValue = document.getElementById("search_byContractedDate");
	var transferedDateValue = document.getElementById("search_byTransferedDate");
	var processedDateValue = document.getElementById("search_byProcessedDate");
	var monthValue = document.getElementById("month");
    var weekValue = document.getElementById("week");
    var pakoValue = document.getElementById("pako");
	
	if (!is_empty(processedDateValue.value)) 
	{
		contractedDateValue.disabled = true;
		transferedDateValue.disabled = true;
		weekValue.disabled = true;
		monthValue.disabled = true;
		pakoValue.disabled = true;
	}
	else
	{
		contractedDateValue.disabled = false;
		transferedDateValue.disabled = false;
		weekValue.disabled = false;
		monthValue.disabled = false;
		transferedDateValue.disabled = false;
	}
	document.getElementById("action").value = 'REG_CUSTOMER_BY_DATE';
}
function transferedDateEntered()
{
    var contractedDateValue = document.getElementById("search_byContractedDate");
	var transferedDateValue = document.getElementById("search_byTransferedDate");
	//var processedDateValue = document.getElementById("search_byProcessedDate");
	var monthValue = document.getElementById("month");
    var weekValue = document.getElementById("week");
    var pakoValue = document.getElementById("pako");
	
	if (!is_empty(transferedDateValue.value)) 
	{
		contractedDateValue.disabled = true;
		processedDateValue.disabled = true;
		weekValue.disabled = true;
		monthValue.disabled = true;
		pakoValue.disabled = true;
	}
   else
	{
		contractedDateValue.disabled = false;
		processedDateValue.disabled = false;
		weekValue.disabled = false;
		monthValue.disabled = false;
		pakoValue.disabled = true;
	}
	document.getElementById("action").value = 'REG_CUSTOMER_BY_DATE';
}

function checkButton()
{
	len = document.reports_frm.gjendja.length;
	
  
   for (i = 0; i <len; i++) 
	{
		if (document.reports_frm.gjendja[i].checked) 
		 {
			document.reports_frm.chosen1.value = document.reports_frm.gjendja[i].value;
		 }
	}
    
	//alert(document.reports_frm.chosen1.value);
	
    var contractedDateValue = document.getElementById("search_byContractedDate");
	var transferedDateValue = document.getElementById("search_byTransferedDate");
	//var processedDateValue = document.getElementById("search_byProcessedDate");
	var monthValue = document.getElementById("month");
    var weekValue = document.getElementById("week");
    var pakoValue = document.getElementById("pako");

   contractedDateValue.disabled = true;
   processedDateValue.disabled = true;
   transferedDateValue.disabled = true;
   weekValue.disabled = true;
   monthValue.disabled = true;
   pakoValue.disabled = true;
	
}

function checkPako()
{
	len = document.reports_frm.gjendja.length;
  
   for (i = 0; i <len; i++) 
	{
		if (document.reports_frm.gjendja[i].checked) 
		 {
			document.reports_frm.chosen1.value = document.reports_frm.gjendja[i].value;
		 }
	}
    
    var contractedDateValue = document.getElementById("search_byContractedDate");
	var transferedDateValue = document.getElementById("search_byTransferedDate");
	var processedDateValue = document.getElementById("search_byProcessedDate");
	var monthValue = document.getElementById("month");
    var weekValue = document.getElementById("week");


   contractedDateValue.disabled = true;
   processedDateValue.disabled = true;
   transferedDateValue.disabled = true;
   weekValue.disabled = true;
   monthValue.disabled = true;

	
}

function checkEmptyFields()
{

	var search_byContractedDate = document.reports_frm.search_byContractedDate.value;
	var search_byTransferedDate = document.reports_frm.search_byTransferedDate.value;
	var search_byProcessedDate = document.reports_frm.search_byProcessedDate.value;

	var search_byCity = document.reports_frm.search_byCity.value;
	
   alert("check empty fields" + search_byContractedDate + search_byTransferedDate + search_byProcessedDate + search_byCity);
	if (is_empty(search_byContractedDate) && is_empty(search_byTransferedDate) && is_empty(search_byProcessedDate)
	    && is_empty(search_byCity))
		{
			alert("Ju lutem kerkoni ne baze te nje fushe!");
			return false;
		}
    else
		{
			return true;
		}
}


function anyCheck2(form, prodName)
{
	
	var total = 0;
	var max = reports_frm.package_new.length;
	document.getElementById("ordered_package_new").value = "";
	
		for(var idx = 0; idx < max; idx++)
		{
			
			if(eval("document.reports_frm.package_new[" + idx + "].checked") == true)
			{
				document.getElementById("ordered_package_new").value += document.reports_frm.package_new[idx].value + "; ";
			}
		}
}





function anyCheck(form, prodName)
{
	
	//alert(prodName);
	
	var total = 0;
	var max = reports_frm.package.length;
	
	document.getElementById("ordered_package").value = "";
	
		for(var idx = 0; idx < max; idx++)
		{
			//alert('test');
			
			if(eval("document.reports_frm.package[" + idx + "].checked") == true)
			{
				document.getElementById("ordered_package").value += document.reports_frm.package[idx].value + "; ";
			}
		}
}

function check_special(data){
	
 var iChars = "!#$%^&*()+=[]\\\';,/{}|\":<>?~_"; 
   for (var i = 0; i < data.value.length; i++) {
  	if (iChars.indexOf(data.value.charAt(i)) != -1) {
  	  alert ("Simbolet e tilla jane te ndaluara!");
  	    data.value = "";
  		return false;
  		
  	
  	}
  }
  
}

</script>
</head>

<body style="margin-top:0px;">


<form name="reports_frm" method="POST" action="" >

 <table>
   <tr>
	<td valign="top">
		
		<table width="195" border="0" bordercolor="#cccccc"  cellspacing="1" height="733" style='border : solid 1px #e2e2e2; background : #ffffff;'>
			<tr>
				<td width="187" height="729" valign="top">
				
			<table width="195" border="0" bordercolor="#cccccc" cellspacing="0" valign=top> 
				<tr>
					<td width="173">
					<a target="_blank">
					<img border="0" src="images/logo.jpg" width="159" height="73"></a></td>
				</tr>
			</table>
			
             		<?php include "menu1.php" ; ?>
            
            </td>
		  </tr>
     </table>	
	 </td>
 	<td>

	 
	 
	 
	<table border="0" width="770" cellspacing="0" cellpadding="0" style="margin-top:0px" bordercolor="" height="790" style='border : solid 1px #e2e2e2; background : #ffffff;'>
	<tr><td height="4"></td></tr>
	<tr>
	   <td height="781" valign="top" align="centre" bgcolor="#FFFFFF">
	   	
	   <table style="width:770px;margin-top:0px;" border="0" cellpadding="0" cellspacing="0">
		<tr>
		  <td height="15" width="85%">
			<p align="left">
			<span style="font-family:Arial; font-size:10px;">Useri: <b> <?php echo $emp['Emp_Id'];?> / <?php echo $emp['Emp_Name'];?> <?php echo $emp['Emp_Lastname'];?> / <?php echo $emp['Emp_Department'];?> / <?php echo $emp['Emp_Position'];?> / <?php echo $emp['Region'];?> </b></span>
				<a style="font-family: Arial; font-size: 10px; text-decoration: none; color: #808080; font-weight: bold" href="index.php"></a>
		   </td>
		   <td height="15" width="15%" align="right">
		        <a style="font-family: Arial; font-size: 10px; text-decoration: none; color: #808080; font-weight: bold" href="ndrysho_fjalekalimin.php"></a>
		   </td>
		</tr>
		<tr><td style="background:#cccccc; height:5px;" colspan="2"></td></tr>
		<tr><td style="height:5px;" colspan="2"></td></tr>
	 </table>
	 
	   
	    <table border="0" width="770" cellspacing="0" cellpadding="0">
			<tr>
				<td height="24" bgcolor="#CCCCCC">
				<p align="center" class="subItem"><b>Gjenero Raporte dhe Arkiva</a></b></p></td>
			</tr>
		</table>
		
		
	   
	    <table width="768">
	                <tr>
						<td width="143" align="right" >Emri:</td>
						<td width="227"  align="left" valign="top">
                        <input name="search_byCustomerName" id="search_byCustomerName" class="txt_input" size="30" onchange="check_special(this)"></td>
						<td width="114" align="right">Mbiemri:</td>
						<td width="264" align="left"><input name="search_byCustomerSurname" id="search_byCustomerSurname" class="txt_input" size="30" onchange="check_special(this)"></td>
					  </tr>
					<tr>
						<td align="right">Nr i kerkeses :</td>
						<td align="left" ><input name="search_byCustomerId" id="search_byCustomerId" class="txt_input" size="30" onchange="check_special(this)">
						
						<td align="right">Numri i Telefonit:</td>
						<td align="left">

						<div id="bycity">
							<input name="current_phone" class="txt_input" id="current_phone" size="30" onchange="check_special(this)">
						</div>
						
						</td>
									
						</tr>
						
					<tr>
						<td align="right">Numri i konsumatorit:</td>
						<td align="left" >
							<input name="customer_id" id="customer_id"  class="txt_input" size="30" onchange="check_special(this)">
						</td>
						
						<td align="right">Useri ADSL:
						</td>
						
						<td align="left"><input name="adsl_user_name" id="adsl_user_name"  class="txt_input" size="30" onchange="check_special(this)">					
						</td>
									
					</tr>
		</table>
		

			 
			   <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24" bgcolor="#CCCCCC">
						<p align="center" class="subItem"><b>Raporte ne baze te dates dhe llojit te saj</b></p></td>
					</tr>
			  </table>
			  
			  
			  
			  <div id="showDatatDetalisht" style="border: solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; height : 90px;">
			  <table width="765" border="0">
			  
					<tr>
						<td width="189" align="right" >Prej dates:</td>
						<td>  
						    <input type="text" name="sdate" id="sdate" class="txt_input" readonly>
						    <a href="javascript:getcal('reports_frm','sdate');"><img src="images/cal.gif" width="16" height="16" border="0" alt="Kliko per te marre daten."></a>			   		  
						</td>
					</tr>
					
					
					<tr>
						<td width="189" align="right" >Deri me daten:</td>
						<td>
					  		<input type="text" name="edate" id="edate" class="txt_input" readonly>
						    <a href="javascript:getcal('reports_frm','edate');"><img src="images/cal.gif" width="16" height="16" border="0" alt="Kliko per te marre daten."></a>			   		
						</td>
					</tr>
					
						<td width="189" align="right" >Lloji i Dates:</td>
						<td>
							<select class="select_list" name="date_type" id="date_type" >
							  	<option value="">=============</option>
							  	<option value="odate">Data e Hapjes</option>
							  	<option value="cdate">Data e Kontraktuar</option>
							  	<option value="pdate">Data e Procesimit</option>
							  	<option value="rdate">Data e Realizimit</option>
							  	<option value="fdate">Data e Fakturimit</option>
							</select>
						</td>
					   
					</tr>
					
		      </table>
			  </div>
		
		<table border="0" width="770" cellspacing="0" cellpadding="0">
			<tr>
				<td height="24" bgcolor="#CCCCCC">
				<p align="center" class=""><b>Raporte ne baze te ID dhe dates se punes</a></b></p></td>
			</tr>
		</table>
		
			 <div id="showDatatDetalisht" style="border: solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; ">
			  <table width="765" border="0">
			  
			  
					<tr>

					  <td width="189" align="right" >ID e Personelit:</td>
					  <td>						    
						    <input type="text" name="agent" id="agent" class="txt_input" onchange="check_special(this)">  
					   </td>
					   
					  <td width="189" align="right" >Data e punes:</td>
					  <td>
					  
					  		<input type="text" name="wdate" id="wdate" class="txt_input" readonly>
						    <a href="javascript:getcal('reports_frm','wdate');"><img src="images/cal.gif" width="16" height="16" border="0" alt="Kliko per te marre daten."></a>			   		
   					  
					   </td>
					</tr>
					
		      </table>
			  </div>
			  
			  
			   <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24" bgcolor="#CCCCCC">
						<p align="center" class="subItem"><b>Raporte ne baze te llojit te kerkeses </b></p></td>
					</tr>
			  </table>
			  
			  
			  <div id="showKlientet" style="border : solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; height : 30px;">
			    <table width="766" border="0">
			    
			    	<tr>
		      			<td width="191" align="right">Lloji i Kerkeses:
		      			<td class="bodytext">
		      			
		      			 
							  
							  <select class="select_list" name="lloji" id="lloji" onchange="getordercontent()">
							  	<option value="">=============</option>
										<?php echo get_order_types();?>
							  </select>
							  
							  
						</tr>	
                    
		      </table>
			  </div>
			  
			  
			  
			 <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24" bgcolor="#CCCCCC">
						<p align="center" class="subItem"><b>Raporte ne baze te fazes se rikyqjes </b></p></td>
					</tr>
			  </table>
			  
			  
			  <div id="showKlientet" style="border : solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; height : 30px;">
			    <table width="766" border="0">
			    
			    	<tr>
		      			<td width="191" align="right">Faza:
		      			<td class="bodytext">
		      								  
									<select name="faza_rikyqjes" id="faza_rikyqjes">
										<option value="">======================</option>
										<option value="1">Faza I</option>
										<option value="2">Faza II</option>
										<option value="3">Faza III</option>
										<option value="4">Faza IV</option>
									</select>
							  
							  
						</tr>	
                    
		      </table>
			  </div>
			  
			  
			  
			  <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24" bgcolor="#CCCCCC">
						<p align="center" class="subItem"><b>Raporte ne baze te Lokacionit se ku gjendet kerkesa: </b></p></td>
					</tr>
			  </table>
			  
			  
			  
			  
			  
			 <div id="showKlientet" style="border : solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; height : 30px;">
			    <table width="766" border="0">
			    
			    	<tr>
		      			<td width="191" align="right">Departamenti:
		      			<td class="bodytext">
								<select class="txt_input" name="level_code" id="level_code" size="1" onChange="javascript:get_locations(this.value, this.form.region.value)">
										<option value="">= = = = = = = = = = = = =</option>
											<?php echo get_groups(5);?>
											
										<option value="5">Linja 2</option>	
								</select>
						
						</td>
						<td width="191" align="right">Lokacioni:
						<td>							  
							<div name="location1" id="location1">
								<select class="txt_input" name="location" id="location" size="1">
									<option value="">= = = = = = = = = = = = =</option>
								</select>
							</div>
							
						</td>	  	  
							  
						</tr>	
                    
    		      </table>
			  </div>
			  
			  
			  
			  
			  <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24" bgcolor="#CCCCCC">
						<p align="center" class="subItem"><b>Raporte ne baze te Puntorit qe ka punuar ne kerkese/pengese </b></p></td>
					</tr>
			  </table>
			  
			  
			  
			  <div style="border : solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; height : 30px;">
			    <table width="766" border="0">
			    
		      	        <tr>
						<td width="191" align="right" >Emri i punetorit: </td>

						<td width="564"  align="left" valign="top">
						
						<div name="employees" id="employees">
							  <select class="select_list" name="employee" id="employee" onClick="javascript:get_employees(this.form.location.value)">
							  	<option value="">=============</option>
							  </select>
						</div>
					  </tr>
					  
					
					  </td>
					  		      	   
                    
                    
		      </table>
			  </div>
			  
			  
			  
			  
			  
			  			  
			   <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24" bgcolor="#CCCCCC">
						<p align="center" class="subItem"><b>Raporte ne baze te Gjendjes se kerkeses </b></p></td>
					</tr>
			  </table>
			  
			  
			  
			  <div id="showKlientet" style="border : solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; height : 30px;">
			    <table width="766" border="0">
			    
		      	        <tr>
						<td width="191" align="right" >Gjendja e kerkeses: </td>

						<td width="564"  align="left" valign="top">
						
							  <select class="select_list" name="gjendja" id="gjendja" >
							  	<option value="">=============</option>
							  	<option value="eRe" style="background-color: #CCFFCC">Te reja</option>
							  	<option value="nukRealizohet">Ska mundesi Realizimi</option>
							  	
							  	<option value="nePritje" style="background-color: #FFCC99">Ne pritje</option>
							  	<option value="neProcesim" style="background-color: #e2e2e2">Ne procesim</option>
							  	<option value="realizuar" style="background-color: #99CCCC">Realizuar</option>
							  	<option value="pjeserisht">Pjeserisht e Realizuar</option>
							  	<option value="fakturuar" style="background-color: #669999">Fakturuar</option>
							  </select>

					  </tr>
					  


                    
                    
		      </table>
			  </div>
			  
			  
			  
			  
			  
			  
			  
			 <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24" bgcolor="#CCCCCC">
						<p align="center" class="subItem"><b>Raporte ne baze te Arsyjes se Mosrealizimit </b></p></td>
					</tr>
			  </table>
			  
			  
			  
			  <div id="showKlientet" style="border : solid 1px #cccccc; background : #ffffff; color : #000000; padding : 1px; width : 770px; height : 30px;">
			    <table width="766" border="0"> 
		      	    <tr>
						<td width="191" align="right" >Arsyja: </td>

						<td width="564"  align="left" valign="top">
						
							<select class="txt_input" name="unrealized_reason" id="unrealized_reason" size="1">
								<option value="">= = = = = = = = = = = = =</option>
									<?php echo  get_unrealized_reasons($arsyja);?>
							</select>
					</tr>
				</table>
			  </div>
			  
	
				
			<table border="0" width="770" cellspacing="0" cellpadding="0">
				<tr>
					<td height="24" bgcolor="#CCCCCC">
						<p align="center"><b>Raporte mbi pakot</b></p>
					</td>
				</tr>
			</table>	
				
				
			<div id="">
				<table>
					<tr>
						<td>
				    
				    <div style="background:#e2e2e2;text-align:center; width:100%">
				         <b>Pako eksistuese</b></div>	    
				       
				      <div id="pakore"  style="display:block">
						<table id="table22" style="BORDER-COLLAPSE: collapse" borderColor="#dfdfdf" height="24" cellSpacing="1" cellPadding="1" width="100%" border="0">
							<tr class="body-text">
								<td align="right" width="138" height="22">Pako:</td>
								<td align="left" width="226" height="22">
								<select name='pako2' id='pako2' class='select_list' onChange="getpackprod('pakot2', 'package_new', this.value, 'ordered_package_new')">
									<option value=''>======================</option>
									<?php echo getpackages(10000);?>	
									
								</select>
								</td>
								<td align="right" width="162" height="22"></td>
								<td align="left" width="222" height="22">
								</td>
							</tr>
				      </table>		
				    </div>
				    
				    
				    <td>
				    <div style="background:#e2e2e2;text-align:center; width:100%">
				         <b>Pako e vjeter</b></div>	 
				         
				               <div id="pakore"  style="display:block">
						<table id="table22" style="BORDER-COLLAPSE: collapse" borderColor="#dfdfdf" height="24" cellSpacing="1" cellPadding="1" width="100%" border="0">
							<tr class="body-text">
								<td align="right" width="138" height="22">Pako:</td>
								<td align="left" width="226" height="22">
								<select name='pako' id='pako' class='select_list' onChange="getpackprod('pakot', 'package', this.value, 'ordered_package')">
									<option value=''>======================</option>
									<?php echo getpackages(10000);?>	
									
								</select>
								</td>
								<td align="right" width="162" height="22"></td>
								<td align="left" width="222" height="22">
								</td>
							</tr>
				      </table>		
				    </div>
				    
				
				    
				    </table>
				    </div>
				   
				    
				     
				   <div> 
				   <table>
				   
				   <tr>
				   <td width="50%">
				   <div id='pakot2'>
				    
				   </div> 
				   
				   
				   <td>
				   <div id='pakot'>
				    
				   </div>
				    
				   </table>
				   </div>
				

					  
			  
			   <table border="0" width="770" cellspacing="0" cellpadding="0">
					<tr>
						<td height="24"  bgcolor=<?php if($archive_table == "old") { echo '#ff0000' ; }else{ echo '#CCCCCC';} ?> >
						<p align="center"><b>Raporte ne baze të vendit te gjenerimit</b></p></td>
					</tr>
				</table>
				
				    <div name="adresa2" id="adresa2">
					  <table id="table22" style="BORDER-COLLAPSE: collapse" borderColor="#dfdfdf" height="59" cellSpacing="1" cellPadding="1" width="100%" border="0">			

								<tr class="body-text">
									<td align="right" width="139" height="22">Regjioni: </td>
									<td align="left" width="225" height="22">
		
									
									
                                   <div id="newplaces">
										<select name="region" id="region" class="select_list">

                                   			<?php 
												if(in_array($level,$admin) || in_array($level,$gen_man) || in_array($level,$qth_group) || in_array($level,$all_regions) || in_array($user_loc_id,$special_locations) || in_array($mainid,$special))
												{
													if($archive_table == "o")
													{
														
													}
													else
													{
														echo "<option value=''>= = = = = = = = = = = = =</option>";
													}
													echo getallregions();
												}
												else
												{
													
													echo getallregions($region);
												}
											
											
											?>

                                   		</select>
                                   </div>
                                   
								
									</td>
									<td align="right" width="161" height="22"></td>
									<td align="left" width="223" height="22">
										
									</td>
								</tr>
					  </table>	
			    </div>			  
			  
			  <table width="770" height="22">
			   <tr>
					   <td width="351" height="18"></td>
					   <td width="407" height="18" align="center">
						 <div align="left">
						   <input type="button" style="width:140px; height:25px" name="kerko" value="Kerko <?php if($archive_table == "old") { echo '(te vjetra)' ; } ?> " class="button" onClick='javascript:get_pre_reports("<?php echo $archive_table ?>")'>
						   <input type="button" style="width:100px; height:25px" name="printo" value="Printo" class="button" disabled onClick="javascript:printreport()">
												
						   		<input type="button" style="width:140px; height:25px" name="search" value="Eksporto ne Excel" class="button" onClick='javascript:export_report("<?php echo $archive_table ?>")'>						   
						   
						   <!--<input type="button" style="width:80px; height:18px" name="search" value="Grafiko" class="button" disabled onClick="javascript:graph_reports()">-->
						   
					     </div></td>
				</tr>
			  </table>
			  
			 <a name="table_section"></a> 
	   
			<div style="background:#e2e2e2; text-align:center; height:10px; width:100%; font-weight: bold;">Tabela</div>

					<div id="table">

		            </div>
		  
		            <br>
		
		                        
		
		<a name="details_section"></a>
		            
		<div style="background:#e2e2e2; text-align:center; height:10px; width:100%; font-weight: bold;">Detajet e Kerkeses</div>
            
		           <div id="details" style="width:771px">
									
                   </div>  

		</td>
	</tr>	
</table>


</td>
</tr>
</table>



<input type="hidden" name="ordered_package" id="ordered_package" value ="" />	
<input type="hidden" name="ordered_package_new" id="ordered_package_new" value ="" />
<input type="hidden" name="action" id="action" value="REG_CUSTOMER_BY_CITY" />
<input type="hidden" name="chosen1" id="chosen1" value=""/>

<input type="hidden" name="type" id="type" value=<?php echo $type;?>>
<input type="hidden" id="page" name="page" value="1"/>

<input type="hidden" name="user_level" id="user_level" value =<?php echo $level;?> />

</form>
</body>
</html>



