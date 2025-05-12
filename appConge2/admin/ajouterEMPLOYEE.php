<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ajouter Employé</title>
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
            max-width: 800px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .cont{
            display: flex;
            gap: 100px;
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

            width: 300px;
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
        .frc{
            width: 325px;
        }
        .btn {
            width: 60%;
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $department_id = $_POST["department_id"];
        $position = $_POST["position"];
        $date_embauche = $_POST["date_embauche"];

        $sql = "INSERT INTO `employes` (`nom`, `email`, `telephone`, `id_departement`, `poste`, `date_embauche`, `statut`) 
            VALUES ('$nom', '$email', '$phone', '$department_id', '$position ', '$date_embauche', 'Actif')";

        if ($connexion->query($sql)) {
            $message = '<div class="alert alert-success">Employé ajouté avec succès !</div>';
        } else {
            $message = '<div class="alert alert-danger">Erreur : impossible d\'ajouter l\'employé.</div>';
        }
    }
    ?>
    <div class="container">
        <?php if ($message)
            echo $message; ?>
        <h2>Ajouter un Employé</h2>
        <form method="POST">
            <div class="cont">
                <div>
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="nom" id="name" class="form-control" required>

                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>

                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div>
                    <label for="department_id" class="form-label">Département</label>
                    <select name="department_id" id="department_id" class="form-control frc" required>
                        <option value="">-- Sélectionnez un département --</option>
                        <?php
                        $sql_departments = "SELECT*FROM departements";
                        $result = $connexion->query($sql_departments);
                        while ($selD = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $selD['id_departement'] ?>"><?= $selD['nom_departement'] ?></option>
                        <?php } ?>
                    </select>


                    <label for="position" class="form-label">Poste</label>
                    <input type="text" name="position" id="position" class="form-control" required>

                    <label for="date_embauche" class="form-label">Date d'embauche</label>
                    <input type="date" name="date_embauche" id="date_embauche" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn">Ajouter Employé</button>

        </form>
        <div class="mt-3">
            <a href="dashboard.php" class="btn-link">← Retour à l'accueil</a>
        </div>
    </div>
</body>

</html>
<?php } ?>