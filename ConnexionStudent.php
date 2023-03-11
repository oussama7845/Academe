<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/connexion.css">
    <title>Etudiant login</title>

</head>


<body>
    <header>
        <div class="header_txt">
            <h2>Bienvenue</h2>
        </div>
    </header>

    <div class="container">
        <div class="main">
            <h1>Connexion</h1>
            <form action="controllers/loginEtudiant.php" method="POST">
                <div class="input">
                    <input type="text" name="email" placeholder="Email">
                </div> <br>
                <div class="input">
                    <input type="password" name="password" placeholder="Mot de passe">
                </div>
                <div class="button">
                    <button type="submit">Se connecter</button>
                </div>
                <br>
                <div class="problem-signup"> 
                    <a href="SignupStudent.php" class="Sign-up">SignUp</a>
                </div>

        </div>
        </form>

    </div>

</body>

</html>