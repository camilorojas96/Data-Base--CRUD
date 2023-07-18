<?php

$host = "localhost";
$user = "root";
$password = "Knightwalker123@";
$dbname = 'dental_clinic_database'; 


$con = new mysqli($host,$user,$password,$dbname);


$id = "";
$patient_name ="";
$patient_last_name = "";
$phone = "";
$address ="";
$gender = "";
$age = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']== 'GET'){

    if(!isset($_GET["id"])){
        header("location: /proyect/index.php");
        exit;
    }
    
    $id = $_GET["id"];
 
    $sql = "SELECT * FROM patients WHERE id=$id";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){ 
        header("location: /proyect/index.php");
        exit;
    }

    $patient_name = $row["patient_name"];
    $patient_last_name = $row["patient_last_name"];
    $phone = $row["phone"];
    $address = $row["address"];
    $gender = $row["gender"];
    $age = $row['age'];
}
else {
    $id = $_POST["id"];
    $patient_name = $_POST["patient_name"];
    $patient_last_name = $_POST["patient_last_name"];
    $phone = $_POST["phone"];
    $address =$_POST["address"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];

    do {
        if( empty($id) || empty($patient_name)|| empty($patient_last_name)|| empty($phone)|| empty($address) || empty($gender)|| empty($age) ) {
            $errorMessage = "Es necesario llenar todos los campos";
            break;
        } 
        
        try {
            $sql =  "UPDATE patients " .
                    "SET patient_name = '$patient_name', patient_last_name = '$patient_last_name', phone = '$phone', address = '$address', gender = '$gender', age = '$age' " .
                    "WHERE id = $id";
            $result = $con->query($sql);
        }catch(\Exception $e){
        
            $errorMessage = "Entrada invalida " . $con->error;
            break;
        };
        
        $successMessage = "Paciente actualizado con exito";

        header("location: /proyect/index.php");
        exit;

    }while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental database</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class = "container my-5">
        <h2> Nuevo paciente</h2>
        <?php
        if(!empty($errorMessage)){
            echo"
            <div class = 'alert alert-warning alert-dismissible fade show' role='alert'> 
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } 
        ?>
        <form method="post">
            <input type="hidden" name = "id" value="<?php echo $id;?>" >
            <div class = "row mb-3">
                <label class ="col-sm-3 col-form-label">Cedula</label>
                <div class ="col-sm6">
                    <input type="text" class = "form-control" name = 'id' value="<?php echo $id;?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class ="col-sm-3 col-form-label">Nombre</label>
                <div class ="col-sm6">
                    <input type="text" class = "form-control" name = 'patient_name' value="<?php echo $patient_name;?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class ="col-sm-3 col-form-label">Apellido</label>
                <div class ="col-sm6">
                    <input type="text" class = "form-control" name = 'patient_last_name' value="<?php echo $patient_last_name;?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class ="col-sm-3 col-form-label">Telefono</label>
                <div class ="col-sm6">
                    <input type="text" class = "form-control" name = 'phone' value="<?php echo $phone;?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class ="col-sm-3 col-form-label">Direccion</label>
                <div class ="col-sm6">
                    <input type="text" class = "form-control" name = 'address' value="<?php echo $address;?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class ="col-sm-3 col-form-label">Genero</label>
                <div class ="col-sm6">
                    <input type="text" class = "form-control" name = 'gender' value="<?php echo $gender;?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class ="col-sm-3 col-form-label">Edad</label>
                <div class ="col-sm6">
                    <input type="text" class = "form-control" name = 'age' value="<?php echo $age;?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo"
                <div class='row mb-3'>
                    <div class = 'offset-sm-3 col-sm-6'>
                        <div class ='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class = "row mb-3">
                <div class ="offset-sm3-3 d-grid">
                    <button type ="Crear" class= "btn btn-primary">Actualizar</button>
                </div>
                <div class ="offset-sm3-3 d-grid">
                <a class ="btn btn-outline-primary"href="index.php" role ="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>