<?php

require_once dirname(__DIR__) . '/controller/db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php'; // Modifier le chemin si nécessaire


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();
    } else {
        echo "Aucun membre trouvé avec cet ID.";
        exit;
    }
} else {
    echo "ID de membre non spécifié.";
    exit;
}
?>