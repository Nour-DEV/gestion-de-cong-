<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin V2 - Système de Gestion des Congés</title>
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
    } else {
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
                    employes e ON lr.id_employe = e.id_employe
                ORDER BY lr.id_employe DESC LIMIT 6";
        //approve calcul
        $today = date('Y-m-d');
        $sql1 = "SELECT COUNT(*) AS count FROM demandes_conge WHERE statut = 'Approuve'AND DATE(date_demande)='$today'";
        $result1 = $connexion->query($sql1);
        $row = $result1->fetch_assoc();
        $approvedToday = $row['count'];


        $resultlist = mysqli_query($connexion, $lsitdemande);
        if (mysqli_num_rows($resultlist) == 0) {
            echo "<script>alert('Aucune demande de congé trouvée dans la base de données');</script>";
        }
    ?>

        <div class="wrapper">
            <?php include("includes/sidebar.php") ?>
            <div class="content">
                <header class="header-custom d-flex justify-content-between align-items-center">
                    <h1 class="h4 mb-0 text-primary fw-bold">Panneau d'Administration</h1>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary btn-sm me-3" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Rafraîchir les données">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                        <form class="d-flex">
                            <input class="form-control form-control-sm me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                            <button class="btn btn-sm btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </header>

                <main class="main-content-area">
                    <section id="tableau-de-bord" class="mb-4">
                        <h2 class="h5 mb-3 text-secondary fw-light">Aperçu Rapide</h2>
                        <div class="row">
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card text-white bg-primary shadow-sm h-100 stat-card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="card-title h6 text-uppercase small">Demandes en Attente</div>
                                            <div class="fs-2 fw-bold">5</div>
                                        </div>
                                        <i class="bi bi-hourglass-split card-icon"></i>
                                    </div>
                                    <a href="#demandes-de-conge" class="card-footer d-flex justify-content-between align-items-center text-white text-decoration-none small p-2">
                                        <span>Voir détails</span> <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            </div>


                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card text-white bg-success shadow-sm h-100 stat-card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="card-title h6 text-uppercase small">Approuvées Aujourd'hui</div>
                                            <div class="fs-2 fw-bold"><?= $approvedToday ?></div>
                                        </div>
                                        <i class="bi bi-check-circle-fill card-icon"></i>
                                    </div>
                                    <a href="#demandes-de-conge" class="card-footer d-flex justify-content-between align-items-center text-white text-decoration-none small p-2">
                                        <span>Voir détails</span> <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card text-dark bg-warning shadow-sm h-100 stat-card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="card-title h6 text-uppercase small">Congés à Venir (7j)</div>
                                            <div class="fs-2 fw-bold">10</div>
                                        </div>
                                        <i class="bi bi-calendar-event card-icon"></i>
                                    </div>
                                    <a href="#calendrier" class="card-footer d-flex justify-content-between align-items-center text-dark text-decoration-none small p-2">
                                        <span>Voir calendrier</span> <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $employeeCount = 0;
                            $sql = "SELECT COUNT(*) AS count FROM employes WHERE statut = 'Actif'";
                            $result = mysqli_query($connexion, $sql);
                            if ($row = mysqli_fetch_assoc($result)) {
                                $employeeCount = $row['count'];
                            }
                            ?>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card text-white bg-info shadow-sm h-100 stat-card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="card-title h6 text-uppercase small">Total Employés Actifs</div>
                                            <div class="fs-2 fw-bold"><?= $employeeCount ?></div>
                                        </div>
                                        <i class="bi bi-people-fill card-icon"></i>
                                    </div>
                                    <a href="#gestion-employes" class="card-footer d-flex justify-content-between align-items-center text-white text-decoration-none small p-2">
                                        <span>Gérer employés</span> <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="demandes-de-conge" class="mb-4 card shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h2 class="h5 mb-0 text-primary"><i class="bi bi-journal-text me-2"></i> Dernières demandes de congé</h2>
                            <button class="btn btn-primary btn-sm"><i class="bi bi-plus-circle-fill me-1"></i> Nouvelle Demande (Admin)</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover caption-top">
                                    <caption class="small text-muted">Liste des dernières demandes de congé</caption>
                                    <thead>
                                        <tr>
                                            <th>ID Employé</th>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Dates</th>
                                            <th>Durée</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($demande = mysqli_fetch_assoc($resultlist)) {
                                        ?>
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
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-sNQME5r6FiW3R1OECmvqRphqOtT8sKmTZ6mPSPdyh9E7L2GgheltFWjANuCgakjN" crossorigin="anonymous"></script>
</body>

</html>
<?php } ?>