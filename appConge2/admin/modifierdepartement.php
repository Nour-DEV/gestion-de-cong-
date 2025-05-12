<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Department</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 420px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 1px;
            text-transform: uppercase;
            background-image: linear-gradient(135deg, #4CAF50, #2196F3);
            -webkit-background-clip: text;
            color: transparent;
            transition: all 0.3s ease-in-out;
        }

        h2:hover {
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            letter-spacing: 2px;
        }

        .form-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s ease;
        }

        .form-label:hover {
            color: #4CAF50;
        }

        .form-control {
            width: 93%;
            padding: 14px;
            margin-bottom: 25px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.4);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .btn-link {
            color: #4CAF50;
            text-decoration: none;
            font-size: 1rem;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .mt-3 {
            margin-top: 15px;
        }

        /* Alert styles */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
<?php
 session_start();
 if(!isset($_SESSION["username"])&&!isset($_SESSION["password"]) ){
      header("location: index.html");
 } else {
require_once "../connexion.php";
$message = ''; 
if (isset($_POST["department_name"])) {
    $department_nom = $_POST["department_name"];
    $department_id = $_GET["id"];
    $updateSQL = "UPDATE departements SET nom_departement= '$department_nom' WHERE id_departement = $department_id";

    if ($connexion->query($updateSQL)) {
        $message = '<div class="alert alert-success" role="alert">Department updated successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: Could not updated department. Please try again.</div>';
    }
}
?>
 
    <div class="container">
        <?php if ($message) echo $message; ?>
        <h2>Add New Department</h2>
        <?php 
           $id=$_GET["id"];
           $values="SELECT*FROM departements where id_departement=$id";
           $result=$connexion->query($values);
           $depart=$result->fetch_assoc();
        ?>
        <form method="POST">
            <div>
                <label for="department_name" class="form-label">Department Name</label>
                <input type="text" name="department_name" value="<?= $depart["nom_departement"]?>" id="department_name" class="form-control" required>
            </div>
            <button type="submit" class="btn">Update Department</button>
        </form>
        <div class="mt-3">
            <a href="dashboard.php" class="btn-link">← Back to Home</a>
        </div>
    </div>
</body>
</html>
<?php } ?>