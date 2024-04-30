<?php
require '../vendor/autoload.php';
require_once "../classi/db_connection.php";

session_start();

$app = new \Slim\App;
$db=Database::getInstance();

$app->post('/timer/stop', function ($request, $response, $args) use ($db) {
    $message = $request->getParsedBody()['message'] ?? null;

    if ($message=='stop') {
        // Se riceviamo un messaggio, cancelliamo il timer
        unlink('/tmp/delete_timer');
        return $response->withJson(['message' => 'Timer stop']);
        
    } else {
        // Se non riceviamo un messaggio, impostiamo un timer per la cancellazione
        touch('/tmp/delete_timer');
    }

    return $response->withStatus(200);
});

$app->get('/timer/check_timer', function ($request, $response, $args) use ($db) {
    // Controlliamo se il timer è scaduto
    if (file_exists('/tmp/delete_timer') && time() - filemtime('/tmp/delete_timer') >= 30) {
        // Se il timer è scaduto, cancelliamo tutti i messaggi dal database
        foreach($_SESSION['prod_temp'] as $prod_temp){
            $db->delete("aggiunta_carrello", array("idProdotto"=>$prod_temp, "idCarrello"=>$_SESSION['id_carrello']));
        }

        // Eliminiamo il file temporaneo
        unlink('/tmp/delete_timer');
        return $response->withJson(['message' => 'Timer stop']);
    }
    return $response->withJson(['message' => 'Timer still running']);
});


$app->get('/timer/start', function ($request, $response, $args) {

    
    // Se non riceviamo un messaggio, impostiamo un timer per la cancellazione
    touch('/tmp/delete_timer');
    

    return $response->withJson(['message' => 'Timer started']);
});

$app->run();
?>
