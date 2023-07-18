<?php
$errorMessage = "";
if (isset($_GET["id"])){
    $id =$_GET['id'];

    $host = "localhost";
    $user = "root";
    $password = "Knightwalker123@";
    $dbname = 'dental_clinic_database'; 

    $con = new mysqli($host,$user,$password,$dbname);

    try{
        $sql = "DELETE FROM patients WHERE id=$id";
        $con ->query($sql);
    }catch(\Exception $e){
        $errorMessage = $con->error;
    };
    

}

header("location: /proyect.indexphp");
exit;

?>