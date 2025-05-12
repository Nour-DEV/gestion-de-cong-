<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demandes de congé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style1.css">
</head>

<body>

    <?php
    require_once "../connexion.php";
    session_start();

    if (!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
        header("location: index.html");
        exit;
    }

    if (isset($_GET['id']) && isset($_GET['statut'])) {
        $idConge = intval($_GET['id']);
        $statut = $_GET['statut'];

        $sqlstatut = "UPDATE demandes_conge 
                  SET statut = '$statut', date_demande = CURDATE() 
                  WHERE id_conge = $idConge";
        $connexion->query($sqlstatut);
        header("Location: DemandesConge.php");
        exit;
    }

    $lsitdemande = "SELECT 
                 lr.id_conge, 
                 e.id_employe, 
                 e.nom AS nom_employe, 
                 lr.type_conge, 
                 lr.date_debut, 
                 lr.date_fin, 
                 lr.statut
             FROM 
                 demandes_conge lr
             JOIN 
                 employes e ON lr.id_employe = e.id_employe";

    $resultlist = mysqli_query($connexion, $lsitdemande);
    if (mysqli_num_rows($resultlist) == 0) {
        echo "<script>alert('Aucune demande de congé trouvée dans la base de données');</script>";
    }
    ?>

<?php include("includes/sidebar.php") ?>
    <main class="d-flex justify-content-end ain-content-area ">

        <section id="demandes-de-conge" class="mb-4 card shadow-sm mt-4" style="margin-right: 80px;">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0 text-primary"><i class="bi bi-journal-text me-2"></i> Les demandes de congé</h2>
                <button class="btn btn-primary btn-sm"><i class="bi bi-plus-circle-fill me-1"></i> Nouvelle Demande (Admin)</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover caption-top">
                        <caption class="small text-muted">Liste des  demandes de congé</caption>
                        <thead>
                            <tr>
                                <th>ID Employé</th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Dates</th>
                                <th>Durée</th>
                                <th>Statut</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($demande = mysqli_fetch_assoc($resultlist)) { ?>
                                <tr>
                                    <td><?= $demande['id_employe']; ?></td>
                                    <td><?= $demande['nom_employe']; ?></td>
                                    <td><?= $demande['type_conge']; ?></td>
                                    <td><?= date('d/m/y', strtotime($demande['date_debut'])) . ' - ' . date('d/m/y', strtotime($demande['date_fin'])); ?></td>
                                    <td>
                                        <?php
                                        $startDate = new DateTime($demande['date_debut']);
                                        $endDate = new DateTime($demande['date_fin']);
                                        $interval = $startDate->diff($endDate);
                                        echo $interval->format('%d jours');
                                        ?>
                                    </td>
                                    <td><span class="badge bg-warning text-dark"><?= $demande['statut']; ?></span></td>
                                    <td>
                                        <a href="?id=<?= $demande['id_conge']; ?>&statut=Approuve" class="btn btn-success btn-sm">Approuver</a>
                                        <a href="?id=<?= $demande['id_conge']; ?>&statut=Rejete" class="btn btn-danger btn-sm">Rejeter</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-sNQME5r6FiW3R1OECmvqRphqOtT8sKmTZ6mPSPdyh9E7L2GgheltFWjANuCgakjN" crossorigin="anonymous"></script>
</body>

</html>