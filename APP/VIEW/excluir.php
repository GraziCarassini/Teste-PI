<?php
require_once './APP/CLASSE/Guiche.php';

if (isset($_GET['id_guiche'])) {
    $id_guiche = $_GET['id_guiche'];
    $guiche = new Guiche();
    $guiche = $guiche->buscar_por_id($id_guiche);

    $guiche->excluir();
    
    header("Location: index.php"); // Redireciona após a exclusão
}
?>
