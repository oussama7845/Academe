<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentsForm</title>
    <link rel="stylesheet" href="assets/css/signup.css">
    <script src="https://kit.fontawesome.com/b9398f24d6.js" crossorigin="anonymous"></script>
</head>
<header class="Student_header">
    <h1>veuillez remplir le formulaire suivant</h1>
</header>

<body>
    <form action="controllers/AddStudent.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <input type="text" name="name" placeholder="Nom" required>
            </div>
            <div class="col-lg-12">
                <input type="text" name="prenom" placeholder="prenom" required>
            </div>
            <div class="col-lg-12">
                <input type="email" name="email" placeholder="email" required>
            </div>
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="password" name="password" placeholder="Mot de passe" required class="form-control" id="password">
                    <div class="input-group-append">
                        <span class="input-group-text" id="show-hide-password">
                            <i class="fas fa-eye-slash" id="eye-icon"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <input type="text" name="CodeMassar" placeholder="Code Massar" required>
            </div>
            <div class="col-lg-12">
                <input type="date" name="date" placeholder="Date de naissance" required>
            </div>
            <div class="col-lg-12">
                <input type="text" name="adresse" placeholder="adresse" required>
            </div>
            <div class="col-lg-12">
                <input type="text" name="nationalite" placeholder="nationalité" required>
            </div>
            <div class="col-lg-12">
            <input type="tel" name="numero" placeholder="Numéro de téléphone" pattern="[0-9]{10}" required>

            </div>

            <div class="col-lg-12">
                <select name="sexe">
                    <option value="Homme">Male</option>
                    <option value="Femme">Female</option>
                </select>
            </div>

            <div class="col-lg-12">
                <select name="cycle">
                    <option value="Génie de Procédés de l’Energie et de l’Environnement">Génie de Procédés de l’Energie et de l’Environnement</option>
                    <option value="Génie Civil">Génie Civil</option>
                    <option value="Génie Industriel">Génie Industriel</option>
                    <option value="Génie Informatique">Génie Informatique</option>
                    <option value="Génie Electrique">Génie Electrique</option>
                    <option value="Génie Mécanique">Génie Mécanique</option>
                    <option value="Master spécialisé : Efficacité Énergétique et Contrôle des Bâtiments">Master spécialisé : Efficacité Énergétique et Contrôle des Bâtiments</option>
                    <option value="Master spécialisé : Ingénierie Financière">Master spécialisé : Ingénierie Financière</option>
                </select>
            </div>
            <div class="col-lg-12">
                <select name="filiere">
                    <option value="CP">CP</option>
                    <option value="Ingénierie">Ingénierie</option>
                    <option value="Master spécialisé">Master spécialisé</option>
                </select>
            </div>

            <div class="col-lg-12">
                <label for="photo">Importer une photo :</label>
                <input type="file" id="photo" name="photo" required>
            </div>
            <div class="col-lg-12">
                <button class="active" name="submit" type="submit" value="post">Comfirmer</button>
            </div>


        </div>
    </form>

</body>

</html>

<script>
  const password = document.getElementById('password');
  const eyeIcon = document.getElementById('eye-icon');
  const showHidePassword = document.getElementById('show-hide-password');

  showHidePassword.addEventListener('click', function() {
    if (password.type === 'password') {
      password.type = 'text';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
    } else {
      password.type = 'password';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
    }
  });
</script>
