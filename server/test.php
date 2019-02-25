<?php
require_once 'core.inc.php';

if (isset($_GET['data'])) {

    $data = $_GET['data'];

    if (!empty($data) ) {
    	$split_data = str_split($data,2);
    	if($split_data[0]=="B:") {
    		echo "BPM: ".$split_data[1];
    	}
    	else if($split_data[0]=="T:") {
    		echo "Temperature: ".$split_data[1];
    	}
    	

    	//echo $patient_id.": Habibur Rahman<br/>";
    }   
}	
