<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Database</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class = "container my-5">
        <h2>Pacientes</h2>
        <a class = "btn btn-primary" href ="/proyect/create.php" role = "button">Nuevo paciente</a>
        <br>
        <table class = "table"> 
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Genero</th>
                <th>Edad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $host = "localhost";
            $user = "root";
            $password = "Knightwalker123@";
            $dbname = 'dental_clinic_database'; 
            
            $con = new mysqli($host,$user,$password,$dbname);
            // check connection
            if($con->connect_error){
                die("Connection failed: ". $con->connect_error);
            }

            // read al rows from the database table
            $sql = "SELECT * FROM  patients";
            $result = $con->query($sql);
            
            if(!$result){
                die("Invalid query");
            }
            // read each row
            while($row = $result->fetch_assoc()){
                echo"
                <tr>
                    <td>$row[id]</td>
                    <td>$row[patient_name]</td>
                    <td>$row[patient_last_name]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[gender]</td>
                    <td>$row[age]</td>
                    <td>
                        <a class ='btn btn-primary btn-sm' href='/proyect/edit.php?id=$row[id]'>Editar</a>
                        <a class ='btn btn-danger btn-sm' href='/proyect/delete.php?id=$row[id]'>Borrar</a>
                    </td>
                </tr>
                ";
            }
            
            ?> 
        </tbody>   
    </table>

    </div>    
</body>
</html>