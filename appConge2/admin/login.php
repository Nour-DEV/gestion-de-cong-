
<?php
require_once "../connexion.php";
session_start();
if(isset($_POST["loginbtn"])){
$username = $_POST["nom"];
$password = $_POST["motpass"];
$loginQUERY = "SELECT * FROM administrateurs WHERE nom_utilisateur='$username' AND mot_de_passe='$password'"; 
$result = mysqli_query($connexion,$loginQUERY); 
if(mysqli_num_rows($result)!=0){
   $_SESSION["username"]=$username; 
   $_SESSION["password"]=$password; 
header("location: dashboard.php");
} else{
echo "<script> alert('erorr')</script>"; 
header("location: index.html");
}
}
?>