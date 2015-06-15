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
    $CrmId = $_POST['CrmId'];



    $result = mysqli_query($con,"UPDATE vtiger_crmentity, vtiger_leaddetails, vtiger_leadaddress, vtiger_leadsubdetails SET vtiger_crmentity.description='$Description', vtiger_leaddetails.firstname='$FirstName', vtiger_leaddetails.lastname='$LastName' ,vtiger_leaddetails.salutation='$salutation', vtiger_leaddetails.company='$Company' , vtiger_leaddetails.designation='$Designation' , vtiger_leaddetails.leadsource='$LeadSource' , vtiger_leaddetails.industry='$Industry' , vtiger_leaddetails.annualrevenue=$AnnualRevenue , vtiger_leaddetails.secondaryemail='$SecondaryEmail' , vtiger_leaddetails.noofemployees=$NoOfEmployees , vtiger_leaddetails.emailoptout='$EmailOptOut' , vtiger_leadaddress.phone='$PrimaryPhone' , vtiger_leadaddress.mobile='$MobilePhone' , vtiger_leadaddress.fax='$Fax' , vtiger_leaddetails.email='$PrimaryEmail' , vtiger_leadsubdetails.website='$Website' , vtiger_crmentity.status='$LeadStatus' , vtiger_leaddetails.rating='$Rating' , vtiger_leadaddress.lane='$Street' , vtiger_leadaddress.pobox='$PoBox' , vtiger_leadaddress.code='$PostalCode' , vtiger_leadaddress.country='$Country' , vtiger_leadaddress.state='$State' WHERE vtiger_crmentity.crmid=vtiger_leaddetails.leadid AND vtiger_leaddetails.leadid=vtiger_leadaddress.leadaddressid AND vtiger_leadaddress.leadaddressid=vtiger_leadsubdetails.leadsubscriptionid AND vtiger_crmentity.crmid = $CrmId;");
    
          // echo $result;
      if($result){
       echo "Lead Succesfully Updated!" ;
     
        }else{
           echo "Sorry Lead did't updated!";
        }
    mysqli_close($con);
    ?>