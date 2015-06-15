<?php
    $hostname_localhost ="localhost";
    $database_localhost ="virtuald_vtiger";
    $username_localhost ="virtuald_vtiger";
    $password_localhost ="vtiger";
    $con=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
    if (mysqli_connect_errno($con))
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $salutation=$_POST['salutation'];
    $FirstName = $_POST['FirstName'];
   // echo $FirstName ;
    $LastName = $_POST['LastName'];
    $Company = $_POST['Company'];
    $Designation = $_POST['Designation'];
    $LeadSource = $_POST['LeadSource'];
    $Industry = $_POST['Industry'];
    $AnnualRevenue = $_POST['AnnualRevenue'];
    $NoOfEmployees = $_POST['NoOfEmployees'];
    $SecondaryEmail = $_POST['SecondaryEmail'];
    $EmailOptOut = $_POST['EmailOptOut'];
    $TestField = $_POST['TestField'];
    $PrimaryPhone = $_POST['PrimaryPhone'];
    $MobilePhone = $_POST['MobilePhone'];
    $Fax = $_POST['Fax'];
    $PrimaryEmail = $_POST['PrimaryEmail'];
    $Website = $_POST['Website'];
    $LeadStatus = $_POST['LeadStatus'];
    $Rating = $_POST['Rating'];
    $AssignedTo = $_POST['AssignedTo'];
    $Street = $_POST['Street'];
    $PoBox = $_POST['PoBox'];
    $PostalCode = $_POST['PostalCode'];
    $Country = $_POST['Country'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $Description = $_POST['Description'];
    $LeadNumber = $_POST['LeadNumber'];
    $label=$FirstName.' '.$LastName;

    //***********************Transaction begins**************************//
   
   // mysqli_query($con, "START TRANSACTION");

   //***********************SELECTTING ID**************************//

    $selectID = mysqli_query($con,"SELECT id FROM `vtiger_crmentity_seq`");
    $id;
    while($row = mysqli_fetch_array($selectID))
     {
      $id =$row['id'];
     } 
      $new_id=$id+1;
     
  $updateID =mysqli_query($con,"UPDATE `vtiger_crmentity_seq`
    SET id='$new_id'");

    //********************SELECTTING USER ID*********************//

    $piece = explode(" ", $AssignedTo);
    $asgn2_f_name= $piece[0];
    $asgn2_l_name= $piece[1];
    
    $selectUSER_ID = mysqli_query($con,"SELECT * FROM vtiger_users WHERE first_name='$asgn2_f_name' AND last_name='$asgn2_l_name'");
    $u_Id;
    while($row = mysqli_fetch_array($selectUSER_ID))
     {
      $u_Id =$row['id'];
     }

    //********************INSERTION TO CRMENTITY********************//

   $time=date('Y-m-d H:i:s');
  $resultCRM = mysqli_query($con,"INSERT INTO vtiger_crmentity (crmid, smcreatorid, smownerid, setype, modifiedby, description, createdtime, modifiedtime, label) VALUES ('$new_id', '$u_Id', '$u_Id', 'Leads', '$u_Id', '$Description', '$time', '$time', '$label')");

   //********************SELECTTING LEAD NUMBER*********************//

    $selectLEAD = mysqli_query($con,"SELECT `lead_no` FROM `vtiger_leaddetails` WHERE `leadid` ='$id'");

   $leadNO;
   while($row = mysqli_fetch_array($selectLEAD))
     {
        $leadNO =$row['lead_no'];
     } 
  
    $pieces = explode("A", $leadNO);
    $lead_num= $pieces[1];
    $lead_new_num=$lead_num+1;
    $leadNewNO='LEA'.$lead_new_num;

    //************************LEAD DETAIL***************************//

   $resultDETAIL = mysqli_query($con, "INSERT INTO vtiger_leaddetails (leadid, lead_no, email, firstname, salutation, lastname, company, annualrevenue, industry, rating, leadstatus, leadsource, designation, noofemployees, emailoptout) VALUES('$new_id', '$leadNewNO', '$PrimaryEmail', '$FirstName', '$salutation', '$LastName', '$Company', '$AnnualRevenue', '$Industry', '$Rating', '$LeadStatus', '$LeadSource', '$Designation', '$NoOfEmployees', '$EmailOptOut')");
   
    //***********************LEAD ADDRESS***************************//

  $resultADRESS = mysqli_query($con,"INSERT INTO vtiger_leadaddress (leadaddressid, city, code, state, pobox, country, phone, mobile, fax, lane) VALUES('$new_id', '$City', '$PostalCode', '$State', '$PoBox', '$Country', '$PrimaryPhone', '$MobilePhone', '$Fax', '$Street')");
  
    //**********************LEAD SUB DETAIL*************************//

    $resultSUBDETAIL = mysqli_query($con,"INSERT INTO vtiger_leadsubdetails (leadsubscriptionid, website) VALUES('$new_id', '$Website')");
   
    //**********************LEAD TEST FIELD*************************//

    $resultSCF = mysqli_query($con,"INSERT INTO vtiger_leadscf (leadid, cf_751) VALUES ('$new_id', '$TestField')");
    
          // echo $result;
        if(!$resultSCF || !$resultSUBDETAIL || !$resultADRESS || !$resultDETAIL || !$selectLEAD || !$resultCRM || !$selectUSER_ID  || !$updateID  || !$selectID)
	{
	 // mysql_query($con, "ROLLBACK"); // transaction rolls back
	  echo "Sorry Try again Leads not Added :(";
	 //mysqli_rollback($con)
	 // exit;
	  }
	else
	{
	  //mysql_query($con, "COMMIT"); // transaction is committed
	  echo "Leads Added Successfully :)";
	// mysqli_commit($con);
	 }	

     /* if($resultSCF){
       echo "Lead inserted!" ;
        }else{
           echo "Sorry cannot inserted!";
        } */

//***************************************************************//

    mysqli_close($con);

function begin()
{
mysql_query("BEGIN",$con);
}

function commit()
{
mysql_query("COMMIT",$con);
}

function rollback()
{
mysql_query("ROLLBACK",$con);
}
    ?>