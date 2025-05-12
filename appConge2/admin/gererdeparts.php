<?php
session_start();
if (!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
  header("location: index.html");
} else {

  require_once "../connexion.php";


  if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $connexion->query("DELETE FROM departements WHERE id_departement = $id");
    header("Location: gererdeparts.php");
    exit();
  }

  $result = $connexion->query("SELECT * FROM departements");
?>

  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gérer les départements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/style1.css">
  </head>

  <body>
    <?php include("includes/sidebar.php") ?>
    <div class="container-fluid w-75 pt-2" style="margin-left: 250px;">
      <div class="table-container">
        <h2 class="text-center mb-4">Liste des Départements</h2>
        <table class="table table-striped table-bordered align-middle text-center inner-borders-only">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nom du Département</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($ligne = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $ligne['id_departement'] ?></td>
                <td><?= $ligne['nom_departement'] ?></td>
                <td>
                  <a href="modifierdepartement.php?id=<?= $ligne['id_departement'] ?>" class="btn btn-sm btn-primary me-2">
                    <i class="bi bi-pencil-square"></i> Modifier
                  </a>
                  <a href="?delete_id=<?= $ligne['id_departement'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce département ?');">
                    <i class="bi bi-trash"></i> Supprimer
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

  </body>

  </html>
<?php } ?>