<?php
// Envoyer un code de réponse 404 (Page non trouvée)
http_response_code(404);

// Redirection vers index.php après quelques secondes
header("Refresh: 3; url=/TFG/index.php");
?>
