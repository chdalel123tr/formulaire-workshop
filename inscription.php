<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $universite = $_POST['universite'];
    $departement = $_POST['departement'];
    $niveau = $_POST['niveau'];
    $autre_niveau = isset($_POST['autre_niveau']) ? $_POST['autre_niveau'] : '';
    $connaissances = $_POST['connaissances'];
    $objectifs = isset($_POST['objectifs']) ? implode(', ', $_POST['objectifs']) : '';
    $autre_objectif = isset($_POST['autre_objectif']) ? $_POST['autre_objectif'] : '';
    $suggestions = isset($_POST['suggestions']) ? $_POST['suggestions'] : '';
    $credits = $_POST['credits'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'inscription_even');

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO inscriptions (nom, prenom, email, telephone, universite, departement, niveau, autre_niveau, connaissances, objectifs, autre_objectif, suggestions, credits) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $nom, $prenom, $email, $telephone, $universite, $departement, $niveau, $autre_niveau, $connaissances, $objectifs, $autre_objectif, $suggestions, $credits);

    if ($stmt->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>
