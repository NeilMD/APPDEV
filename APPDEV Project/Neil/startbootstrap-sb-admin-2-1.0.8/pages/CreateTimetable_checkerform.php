<?php
session_start();
    
    require 'functions.php';
    $conn = mysqlconnect('root','1234','appdev');
    
    if(isset($_POST['submit'])){

        $errorMessage = NULL;
        $valid = true;
         
        
        
        if(empty($_POST["personresponsible"] )) {
            $errorMessage .= "<b> <p> Error: Person responsible field empty</p> </b>";
            $valid = false;
        }
        if(empty($_POST["completion"])){
            $errorMessage .= "<b> <p> Error:Completion date empty</p> </b>";
            $valid = false;
        }
        if(empty($_POST["actualstart"])){
            $errorMessage .= "<b> <p> Error:Actual date empty</p> </b>";
            $valid = false;
        }
        $diff = date_diff(new DateTime($_POST['actualstart']),new DateTime($_POST['completion']));
        
        if(substr($diff->format('%r%a'), 0,1) =='-'){
             $errorMessage .= "<b> <p> Error:Expected completion date should be greater than Date Initialized!</p> </b>";
             $valid = false;
        }
        if(isset($errorMessage)){
            echo '<font color="red">'.$errorMessage.'</font>';
            $valid = false;
        }
          
        if($valid){
           $temp5= $_POST['actualstart'].' 00:00:00';
            $temp3 ="INSERT INTO MODULES VALUES (NULL,'"
            .$_POST['description']
            ."',null,5,null,null,'"
            .$_POST['personresponsible']
            ."','".$_POST['actualstart']."','".$_POST['completion']."',".$_POST['phaseno'].","
            .$_SESSION['project'].")";
            
           
            $query4=query($temp3,$conn);
           
            if($query4){
                 echo "Create Sucess";
              #header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/redirect.php?project=".$_SESSION['project']);

            }
             
             
        }
           

    }

?>