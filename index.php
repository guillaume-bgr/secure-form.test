<?php 
require 'form.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire sécurisé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <pre><?= var_dump($errors); ?></pre>

    <header class="title d-flex justify-content-between bg-primary">
        <h1 class="bg-primary h-100 text-left text-white d-flex align-items-center ps-4">Fiche de renseignement</h1>
        <img class="img-fluid py-1 pe-1" src="img\la_manu_formation_visuel_presentation_article.jpg" alt="logo">
    </header>
    <div class="container w-50 align-left ms-4">
        <form action="" method="post" novalidate>
            <h2 class="h4 mt-3">Coordonnées personnelles</h2>
            <div class="my-3 col-10">
                <label for="firstname" class="form-label">Prénom(s)</label>
                <input type="text" class="form-control <?php echo isset($errors['firstname'])? 'is-invalid' : ''; ?>"
                    id="firstname" name="firstname" value="<?= $firstname ?>" placeholder="Ex: John">
            </div>
            <div class="mb-3 col-10">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control <?php echo isset($errors['lastname'])? 'is-invalid' : ''; ?>"
                    id="lastname" name="lastname" value="<?= $lastname ?>" placeholder="Ex: Doe">
            </div>
            <div class="mb-3 col-10">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control <?php echo isset($errors['address'])? 'is-invalid' : ''; ?>"
                    id="address" name="address" value="<?= $address ?>">
                <ul class="list-group address">
                </ul>
            </div>
            <div class="mb-3 col-10">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control <?php echo isset($errors['phone'])? 'is-invalid' : ''; ?>"
                    id="phone" name="phone">
            </div>
            <div class="mb-3 col-10">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control <?php echo isset($errors['email'])? 'is-invalid' : ''; ?>"
                    id="email" name="email" value="<?= $email ?>">
            </div>
            <div class="mb-3 col-10">
                <label for="birthdate" class="form-label">Date de naissance</label>
                <input type="date" class="form-control <?php echo isset($errors['birthdate'])? 'is-invalid' : ''; ?>"
                    id="birthdate" name="birthdate" value="<?= $birthdate ?>">
            </div>
            <div class="mb-3 col-10">
                <label for="birthplace" class="form-label">Lieu de naissance</label>
                <input type="text" class="form-control" id="birthplace" name="birthplace">
                <ul class="list-group birthplace">
                </ul>
            </div>
            <div class="mb-3 col-10">
                <label for="birthdepartment" class="form-label">Département de naissance</label>
                <input type="text" class="form-control" id="birthdepartment" name="birthdepartment">
            </div>
            <div class="mb-3 col-10">
                <label for="birthstate" class="form-label">Etat de naissance</label>
                <input type="text" class="form-control" id="birthstate" name="birthstate">
            </div>
            <div class="mb-3 col-10">
                <label for="nationality" class="form-label">Nationalité</label>
                <input type="text" class="form-control" id="nationality" name="nationality">
            </div>
            <h2 class="h4 my-3">Parcours scolaire</h2>
            <div class="mb-3 col-10">
                <label for="lastclass" class="form-label">Dernière classe suivie</label>
                <input type="text" class="form-control" id="lastclass" name="lastclass"
                    placeholder="Terminale, Licence, BTS..">
            </div>
            <div class="cert col-10">
                <label for="certificates" class="form-label">Diplômes obtenus</label>
                <input type="text" class="form-control" id="certificates" name="certificates" placeholder="1er diplôme">
            </div>
            <button onclick="return false" class="btn btn-light add-cert mb-3">+</button>
            <div class="emergency my-3">
                <h2 class="h4 mb-3">Personnes à prévenir en cas d'urgence</h2>
                <div class="emergency-person">
                        <h3 class="h6">Personne n°1</h3>
                    <div class="d-flex justify-content-left grow">
                        <div class="mb-3 col-5 pe-3">
                            <label for="emergencyfirstname" class="form-label">Prénom(s)</label>
                            <input type="text" class="form-control" id="emergencyfirstname" value="<?= $emergencyfirstname ?>" name="emergency[firstname][]"
                                placeholder="Ex: John">
                        </div>
                        <div class="mb-3 col-5 ">
                            <label for="emergencylastname" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="emergencylastname" value="<?= $emergencylastname ?>" name="emergency[lastname][]"
                                placeholder="Ex: Doe">
                        </div>
                    </div>
                    <div class="d-flex justify-content-left grow">
                        <div class="mb-3 col-5 pe-3">
                            <label for="emergencyphone" class="form-label">Téléphone fixe</label>
                            <input type="tel" class="form-control" id="emergencyphone" value="<?= $emergencyphone ?>" name="emergency[phone][]">
                        </div>
                        <div class="mb-3 col-5">
                            <label for="emergencysmartphone" class="form-label">Téléphone portable</label>
                            <input type="tel" class="form-control" id="emergencysmartphone" value="<?= $emergencysmartphone ?>" name="emergency[smartphone][]"
                        </div>
                    </div>
                    <div class="mb-3 col-10">
                        <label for="emergencyemail" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="emergencyemail" value="<?= $emergencyemail ?>" name="emergency[email][]">
                    </div>
                </div>
            <button onclick="return false" class="add-emergency btn btn-light mb-3">Ajouter une personne</button>
            </div>
            <h2 class="h4 my-3">Autres</h2>
            <div class="mb-3  col-10">
                <label for="others" class="form-label">Informations supplémentaires (allergies, handicap)</label>
                <textarea class="form-control" id="others" name="others"></textarea>
            </div>
            <div class="col-2">
                <button type="submit" class="form-control">Envoyer</button>
            </div>
        </form>
    </div>
</body>

</html>