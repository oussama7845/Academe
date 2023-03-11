<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$matricule = $_SESSION['matricule'];
include_once('DAO.php');

$dao = new DAO();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/StudentInterface.css">
    <script src="assets/js/script.js"></script>
    <script src="https://kit.fontawesome.com/b9398f24d6.js" crossorigin="anonymous"></script>
    <title>Interface Prof</title>
</head>

<body>
    <main id="main">
        <h2 class="center-text">Bienvenue dans votre Plateforme ENSA</h2>




        <a href ='InterfaceProf.php'>retour</a>



        <div class="wrapper">
            <table>
                <tr>

                    <th>Matricule</th>
                    <th>nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Dept</th>
                    <th>Email</th>
                    <th>Numéro</th>
                    <th>Sexe</th>
                    <th>Nationalité</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                
                $Data = $dao->DataProf($matricule);
                foreach ($Data as $user) {
                    echo '
        <tr>
          <td>' . $user[0] . '</td>
          <td>' . $user[1] . '</td>
          <td>' . $user[2] . '</td>
          <td>' . $user[4] . '</td>
          <td>' . $user[6] . '</td>
          <td>' . $user[3] . '</td>
          <td>' . $user[5] . '</td>
          <td>' . $user[7] . '</td>
          <td>' . $user[8] . '</td>  
          <td>' . $user[9] . '</td>   
          <td><a href="#" onclick="EditUserBoxOn(' . $user[0] . ')"><i class="fas fa-pen-to-square"></i></a>&nbsp&nbsp&nbsp&nbsp</td>
        </tr>';
                }
                ?>

            </table>
        </div>
    </main>

    <?php
        if (isset($user) && !empty($user)) {
            $Data = $dao->DataProf($user[0]);
            foreach ($Data as $user) {

        echo '
        <div class="post-popup job_post" id="edit_user' . $user[0] . '">
            <div class="post-project">
                <h3>Modifier un événement</h3>
                <div class="post-project-fields">
                    <form action="controllers/Editchef_filiere.php" method="post" enctype="multipart/form-data"> 
                        <div class="row">
                            <div class="col-lg-12">             
                                <input type="hidden" name="matricule" value="' . $user[0] . '" >
                            </div>

                        <div class="col-lg-12">
                        <input type="text" name="name" placeholder="nom" value="' . $user[1] . '" required>
                    </div>
                            <div class="col-lg-12">
                                <input type="text" name="prenom" placeholder="prenom" value="' . $user[2] . '" required>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="nationalite" id="nationalite" placeholder="nationalite" value="' . $user[8] . '">
                            </div>              
                            <div class="col-lg-12">
                                <input type="text" name="email" placeholder="email" value="' . $user[3] . '">
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="numero" placeholder="numéro" value="' . $user[5] . '">
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="address" id="address" placeholder="address" value="' . $user[4] . '">
                            </div>
                            <div class="col-lg-12">
                            <select name="filiere" id="filiere">
                            <option value="Ingénierie"' . (($user[6] == 'Ingénierie') ? 'selected' : '') . '>Ingénierie</option>
                              <option value="CP"' . (($user[6] == 'CP') ? 'selected' : '') . '>CP</option>
                              <option value="Master spécialisé"' . (($user[6] == 'Master spécialisé') ? 'selected' : '') . '>Master spécialisé</option>
                            </select>
                          </div>


                            <div class="col-lg-12">
                                <select name="sexe" id="sexe">
                                    <option value="Homme"' . (($user[7] == 'Homme') ? ' selected' : '') . '>Male</option>
                                    <option value="Femme"' . (($user[7] == 'Femme') ? ' selected' : '') . '>Female</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <input type="date" name="date" id="date" placeholder="date" value="' . $user[9] . '">
                            </div>

                            <div class="col-lg-12">
                                <ul>
                                    <li><button class="active" name="submit" type="submit" value="post">Modifier</button></li>
                                    <li><button href="#" title="" type="cancel">Cancel</button></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                        </div><!--post-project-fields end-->
                        <a href="#" onclick="EditUserBoxOn(' . $user[0] . ')"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12zm8.207-3.207a1 1 0 0 0-1.414 1.414L10.586 12l-1.793 1.793a1 1 0 1 0 1.414 1.414L12 13.414l1.793 1.793a1 1 0 0 0 1.414-1.414L13.414 12l1.793-1.793a1 1 0 0 0-1.414-1.414L12 10.586l-1.793-1.793z" fill="currentColor"/></g></svg></a>
                    </div><!--post-project end-->
                </div><!--post-project-popup end-->';
    }
} 
    ?>



<script>
        function EditUserBoxOn(userId) {
            var popup = document.getElementById("edit_user" + userId);
            var main = document.getElementById("main");
            var footer = document.getElementById("footer");
            popup.classList.toggle("active");
            main.classList.toggle("overlay");
        }
    </script>
</body>

</html>