<?php

// Vérification de l'existence des données POST
if (
    !isset($_POST['CodeMassar']) ||
    !isset($_POST['name']) ||
    !isset($_POST['prenom']) ||
    !isset($_POST['email']) ||
    !isset($_POST['adresse']) ||
    !isset($_POST['numero']) ||
    !isset($_POST['cycle']) ||
    !isset($_POST['filiere']) ||
    !isset($_FILES['photo']['name']) ||
    !isset($_POST['sexe']) ||
    !isset($_POST['nationalite']) ||
    !isset($_POST['date']) ||
    !isset($_POST['password'])
) {
    header("Location: ../StudentForm.php?error=1");
    exit();
}


// Récupération des données POST
$CodeMassar = $_POST['CodeMassar'];
$nom = $_POST['name'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$numero = $_POST['numero'];
$cycle = $_POST['cycle'];
$filiere = $_POST['filiere'];
$photo = $_FILES['photo'];
$sexe = $_POST['sexe'];
$nationalite = $_POST['nationalite'];
$date = $_POST['date'];
$password = $_POST['password'];

// Vérification de l'existence de la photo
if ($photo['error'] === UPLOAD_ERR_NO_FILE) {
    header("Location: ../StudentForm.php?error=4");
    exit();
}

// Vérification de la réussite de l'upload de la photo
if ($photo['error'] !== UPLOAD_ERR_OK) {
    header("Location: ../StudentForm.php?error=3");
    exit();
}

// Vérification du type de la photo
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($photo['type'], $allowed_types)) {
    header("Location: ../StudentForm.php?error=5");
    exit();
}

// Renommage et enregistrement de la photo
$image_name_parts = explode('.', $photo['name']);
$ext = end($image_name_parts);
$image_name = "Student-" . rand(0000, 9999) . "." . $ext;
$src = $photo['tmp_name'];
$dst = "../assets/images/profil/" . $image_name;
$upload = move_uploaded_file($src, $dst);
if (!$upload) {
    header("Location: ../StudentForm.php?error=3");
    exit();
}

// Ajout de l'étudiant à la base de données

include_once('../DAO.php');
$dao = new DAO();

// Check if the email already exists in the student table
$emailExists = $dao->CheckIfEmailExists($email);

if ($emailExists) {
    $errorMsg = "Email already exists.";
    header("Location: ../SignupStudent.php?error=" . urlencode($errorMsg));
    exit();
} 



try {
    if ($dao->AddStudent($CodeMassar, $nom, $prenom, $email, $adresse, $numero, $cycle, $filiere, $image_name, $sexe, $nationalite, $date, $password)) {
        header("Location: ../ConnexionStudent.php");
        exit();
    } else {
        header("Location: ../SignupStudent.php");
        exit('Failed to add student');
    }
} catch (Exception $e) {
    header("Location: ../SignupStudent.php?error=2");
    exit('Failed to add student');
}


?>