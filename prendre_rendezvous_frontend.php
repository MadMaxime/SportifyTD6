<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
</head>
<body>
    <h1>Prendre un rendez-vous</h1>
    
    <!-- Formulaire pour afficher les disponibilités des coachs -->
    <form action="prendre_rendezvous_backend.php" method="POST">
        <?php
        // Récupérer les disponibilités des coachs depuis le backend
        $disponibilites = json_decode(file_get_contents('http://localhost/projet_piscine/get_disponibilites.php'), true);

        // Vérifier si $disponibilites n'est pas nul avant de le parcourir
        if ($disponibilites) {
            // Afficher les disponibilités dans le formulaire
            foreach ($disponibilites as $slot) {
                echo "<input type='radio' name='id' value='" . $slot['id'] . "'/>" . $slot['debut'] . " - " . $slot['fin'] . "<br>";
            }
        } else {
            echo "Aucune disponibilité n'a été récupérée depuis le backend.";
        }
        ?>
        <input type='submit' value='Prendre rendez-vous'>
    </form>
</body>
</html>

