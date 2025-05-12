<?php
 session_start();
 if(!isset($_SESSION["username"])&&!isset($_SESSION["password"]) ){
      header("location: index.html");
 } else {
require_once "../connexion.php";
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $connexion->query("DELETE FROM type_conge  WHERE id = $id");
    header("Location: gerertypeconge.php");
    exit();
}

$result = $connexion->query("SELECT * FROM type_conge");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Types de Congé</title>
    <link rel="stylesheet" href="../assets/style1.css">
</head>
<body>
    <div><?php include("includes/sidebar.php"); ?></div>

    <div class="container-fluid w-75 pt-2" style="margin-left: 250px;">
        <div class="table-container">
            <h2 class="text-center mb-4">Liste des Types de Congé</h2>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Type de Congé</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($ligne = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $ligne['id'] ?></td>
                        <td><?= $ligne['nom'] ?></td>
                        <td><?= $ligne['description']?></td>
                        <td>
                            <a href="modifiedierTypeconge.php?id=<?= $ligne['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="?delete_id=<?= $ligne['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce type de congé ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="ajoutertypeconge.php" class="btn btn-primary mt-3"><i class="bi bi-plus-circle"></i> Ajouter un Type de Congé</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>