<?php
    session_start();
   require 'functions.php'; 
     $conn = mysqlconnect('root','1234','appdev');
    if(isset($_POST['submit'])){
        $errorMessage = NULL;
        $valid = true;
         
        
        
        if(empty($_POST["moduleno"] )) {
            $errorMessage .= "<b> <p> Error: Person responsible field empty</p> </b>";
            $valid = false;
        }
        if(empty($_POST["status"])){
            $errorMessage .= "<b> <p> Error:Completion date empty</p> </b>";
            $valid = false;
        }
        if($valid)
        {
            if($_POST['status'] == 1){
                    $checker=query("SELECT * FROM MODULES WHERE MODULESNO=".$_POST["moduleno"],$conn);
                    if($checker[0]['actualenddate'] <>null  ){
                         $errorMessage .= "<b> <p> Error:Completion date is already set</p> </b>";
                        $valid = false;
                    }
                    if( $checker[0]['actualstartdate']== null){
                         $errorMessage .= "<b> <p> Error:Start date should be intialized first!</p> </b>";
                        $valid = false;
                    }
                }
                if($_POST['status'] == 3){
                    $checker=query("SELECT * FROM MODULES WHERE MODULESNO=".$_POST["moduleno"],$conn);
                    if($checker[0]['actualstartdate'] <>null ){
                         $errorMessage .= "<b> <p> Error:Start date is already set</p> </b>";
                        $valid = false;
                    }
                }
        }
        if($valid ){
             
            if($_POST['status'] == 1){
                  $temp3 ="UPDATE MODULES 
                        SET STATUSID=".$_POST['status'].
                            " ,actualenddate = now() WHERE modulesno=".$_POST['moduleno'];
            }
             elseif ($_POST['status'] == 3) {
                 
                       $temp3 ="UPDATE MODULES 
                        SET STATUSID=".$_POST['status'].
                            " ,actualstartdate = now() WHERE modulesno=".$_POST['moduleno'];
            }
            
           
            $query4=query($temp3,$conn);
             
            if($query4){
                 echo "Confirm Success!";
               #header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/projectlist_backend.php?");

            }
             
        }
        echo $errorMessage;
    }

?>