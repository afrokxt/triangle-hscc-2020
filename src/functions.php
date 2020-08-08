<?php 

//Checks if session is logged in
function isAdminLoggedIn(){
    if(isset($_SESSION['admin_account'])){   
        return True
    }
    else{
        return False
    }
}

?>