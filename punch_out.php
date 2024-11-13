<?php
    include('class.php');
    
    $object= new major;
    $timeout_status = $object->get_time_out_status();
    $timeout = $object->now_in_ts;

    $date = date('Y-m-d');
    $punch_in = strtotime($object->get_punch_in_time());
	
	$duration = $object->GetTimeDiff($punch_in);
        if($timeout_status =='NULL'){
    $object->query="
    UPDATE attendance  SET time_out='$timeout',time_spend='$duration' WHERE (emp_id='$_SESSION[ID]') AND (date LIKE '$date%')
    ";
    $object->execute();
    header('Location:logout.php');
    }else{
        header('Location:logout.php');
 
    }
?>