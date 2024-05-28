<?php
// Connexion à la base de données
$servername = "localhost";
$username = "Maxime";
$password = "max";
$dbname = "projet_piscine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifier si la clé 'id' existe dans le tableau POST
if (isset($_POST['id'])) {
    // Récupérer l'ID du créneau envoyé depuis le frontend
    $id = $_POST['id'];

    // Récupérer la date de début du créneau
    $sql = "SELECT debut, coach_id FROM disponibilites WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Extraire la date de début et l'ID du coach
        $row = $result->fetch_assoc();
        $debut = $row['debut'];
        $coach_id = $row['coach_id'];

        // Insérer le rendez-vous dans la table rendezvous
        $sql_insert = "INSERT INTO rendezvous (date_heure, coach_id) VALUES ('$debut', '$coach_id')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Rendez-vous créé avec succès";
        } else {
            echo "Erreur lors de la création du rendez-vous : " . $conn->error;
        }
    } else {
        echo "Erreur : Aucune disponibilité trouvée pour le créneau sélectionné.";
    }
} else {
    // Gérer le cas où la clé 'id' n'existe pas dans le tableau POST
    echo "Erreur : Aucun créneau n'a été sélectionné.";
}

$conn->close();
?>
