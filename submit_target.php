<?php
// Fonction pour récupérer l'adresse IP du visiteur
function get_ip_address() {
    // Si l'adresse IP est spécifiée par un proxy
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Si l'adresse IP est spécifiée par un autre proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Si l'adresse IP est spécifiée par l'utilisateur directement
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $target_name = $_POST['target_name'];
    $target_description = $_POST['target_description'];

    // Récupérer la date et l'heure actuelles
    $current_datetime = date("Y-m-d H:i:s");

    // Récupérer l'adresse IP du visiteur
    $visitor_ip = get_ip_address();

    // Chemin du fichier où enregistrer les données
    $file_path = "propositions.txt";

    // Format des données à enregistrer dans le fichier
    $data_to_write = "Date et heure: $current_datetime\nIP du visiteur: $visitor_ip\nCible proposée: $target_name\nDescription: $target_description\n\n";

    // Écrire les données dans le fichier
    if (file_put_contents($file_path, $data_to_write, FILE_APPEND | LOCK_EX) !== false) {
        // Afficher un message de confirmation
        echo "<p>Merci pour votre proposition de cible: $target_name. Nous la prendrons en considération.</p>";
    } else {
        // En cas d'erreur lors de l'écriture dans le fichier
        echo "<p>Erreur lors de l'enregistrement de la proposition.</p>";
    }
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers une page d'erreur ou afficher un message
    echo "<p>Erreur: Le formulaire n'a pas été soumis correctement.</p>";
}
?>
