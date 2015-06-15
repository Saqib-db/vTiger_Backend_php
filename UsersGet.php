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
    
    
    
    
    
    $UserID = $_GET['UserID'];
    
    $result = mysqli_query($con,"SELECT * FROM vtiger_users where id=$UserID");
    
    $row = mysqli_fetch_array($result);
    $data = $row[0];
    if($data){
        //echo $data;
        echo $data;
    }else{
        echo "No Record Found";
    }
    mysqli_close($con);
    ?>