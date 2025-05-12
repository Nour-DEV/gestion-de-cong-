<?php
 session_start();
 if(!isset($_SESSION["username"])&&!isset($_SESSION["password"]) ){
      header("location: index.html");
 } else {
require_once "../connexion.php";
$num = 5;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$depart = ($page - 1) * $num;
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $connexion->query("DELETE FROM employes WHERE id_employe= $id");
    header("Location: gereremployes.php");
    exit();
}
$emplSql = "SELECT e.*, d.nom_departement 
FROM employes e 
LEFT JOIN departements d ON e.id_departement = d.id_departement LIMIT $depart, $num";
$result = $connexion->query($emplSql);

$totalReq = "SELECT COUNT(*) AS total FROM employes";
$totalResult = mysqli_query($connexion, $totalReq);
$row = mysqli_fetch_assoc($totalResult);
$numberofrows = $row['total'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gérer les Employés</title>
    <link rel="stylesheet" href="../assets/style1.css">
</head>

<body>
    <div><?php include("includes/sidebar.php"); ?></div>
    <div class="container-fluid" style="margin-left: 140px;">
        <div class="table-container container-xl">
            <h2>Liste des Employés</h2>
            <table class="table table-bordered table-hover w-100">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Département</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($emp = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $emp['id_employe'] ?></td>
                            <td><?= $emp['nom'] ?></td>
                            <td><?= $emp['email'] ?></td>
                            <td><?= $emp['nom_departement'] ?></td>
                            <td>
                                <a href="editemploye.php?id=<?= $emp['id_employe'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="?delete_id=<?= $emp['id_employe'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet employé ?');">Supprimer</a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="container d-flex">
                <?php
                $numberOFpages = ceil($numberofrows / $num);


                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $numberOFpages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="gereremployes.php?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
            <div class="text-center">
                <a href="ajouterEMPLOYEE.php" class="btn btn-primary mt-3"><i class="bi bi-plus-circle"></i> Ajouter un Employé</a>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
<?php } ?>