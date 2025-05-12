
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<aside class="sidebar bg-light text-dark p-4 vh-100 shadow-sm rounded-3">
  <a href="#" class="d-flex align-items-center mb-4 text-dark text-decoration-none">
    <i class="bi bi-calendar-heart fs-4 me-2"></i>
    <span class="fs-5 fw-semibold">Gestion Congés</span>
  </a>
  <ul class="nav nav-pills flex-column gap-3">
    <li class="nav-item">
      <a href="dashboard.php" class="nav-link text-dark d-flex align-items-center p-2 rounded-2 hover-item">
        <i class="bi bi-grid-1x2-fill me-2"></i> Tableau de Bord
      </a>
    </li>

    <li class="nav-item">
      <a href="DemandesConge.php" class="nav-link text-dark d-flex align-items-center p-2 rounded-2 hover-item">
        <i class="bi bi-journal-text me-2"></i> Demandes de Congé
      </a>
    </li>

    <li class="nav-item dropdown">
      <button class="btn btn-light dropdown-toggle w-100 text-start d-flex align-items-center p-2 rounded-2 hover-item" type="button" id="dropdownDept" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-building me-2"></i> Département
      </button>
      <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownDept">
        <li><a class="dropdown-item" href="ajouterdepart.php">Ajouter un département</a></li>
        <li><a class="dropdown-item" href="gererdeparts.php">Gérer les départements</a></li>
      </ul>
    </li>

    <li class="nav-item dropdown">
      <button class="btn btn-light dropdown-toggle w-100 text-start d-flex align-items-center p-2 rounded-2 hover-item" type="button" id="dropdownEmp" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-people-fill me-2"></i> Gestion Employés
      </button>
      <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownEmp">
        <li><a class="dropdown-item" href="ajouterEMPLOYEE.php">Ajouter un Employé</a></li>
        <li><a class="dropdown-item" href="gereremployes.php">Gérer les Employés</a></li>
      </ul>
    </li>

    <li class="nav-item dropdown">
      <button class="btn btn-light dropdown-toggle w-100 text-start d-flex align-items-center p-2 rounded-2 hover-item" type="button" id="dropdownConge" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-tags-fill me-2"></i> Types de Congé
      </button>
      <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownConge">
        <li><a class="dropdown-item" href="ajoutertypeconge.php">Ajouter un Congé</a></li>
        <li><a class="dropdown-item" href="gerertypeconge.php">Gérer les Congés</a></li>
      </ul>
    </li>

    <hr class="text-dark">

    <li class="nav-item">
      <a href="#modifier-mdp" class="nav-link text-dark d-flex align-items-center p-2 rounded-2 hover-item">
        <i class="bi bi-lock-fill me-2"></i> Modifier le mot de passe
      </a>
    </li>

    <li class="nav-item">
      <a href="logout.php?log=1" class="nav-link text-dark d-flex align-items-center p-2 rounded-2 hover-item">
        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
      </a>
    </li>
  </ul>
</aside>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>

  .sidebar {
    background-color: #f8f9fa;
    color: #212529; 
    position: fixed;
    width: 250px;
    height: 100%;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    z-index: 10;
    transition: all 0.3s ease-in-out;
  }

  .sidebar .nav-link {
    font-size: 1.1rem;
    font-weight: 500;
    padding: 12px;
    border-radius: 5px;
  }

  .sidebar .nav-link:hover, .sidebar .hover-item:hover {
    background-color: #e2e6ea; 
    transform: scale(1.05);
    transition: background-color 0.3s ease, transform 0.2s ease-in-out;
  }

  .sidebar .btn {
    border-radius: 5px;
    padding: 12px;
  }

  .sidebar .btn:hover {
    background-color: #f1f3f5; 
  }

  .sidebar .dropdown-menu-light {
    background-color: #e9ecef; 
  }

  .sidebar .nav-item a i {
    font-size: 1.4rem;
  }

  .sidebar .nav-item a {
    color: #212529; 
  }

  .sidebar .nav-item a:hover {
    color: #007bff;
  }


  @media (max-width: 768px) {
    .sidebar {
      width: 200px;
    }
  }
</style>
