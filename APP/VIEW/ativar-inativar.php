<?php
// require_once './APP/CLASSE/guiche.php';
require_once __DIR__ . '/../CLASSE/guiche.php';

if (isset($_GET['id_guiche'])) {
    $id_guiche = $_GET['id_guiche'];
    $guiche = new Guiche();
    $guiche = $guiche->buscar_por_id($id_guiche);

    // Alterna o status
    $guiche->alternar_ativo($id_guiche, $guiche->ativo);
    
    header("Location: index.php");
}
