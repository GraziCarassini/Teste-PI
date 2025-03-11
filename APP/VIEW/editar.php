<?php
require_once './APP/CLASSE/Guiche.php';

if (isset($_GET['id_guiche'])) {
    $id_guiche = $_GET['id_guiche'];
    $guiche = new Guiche();
    $guiche = $guiche->buscar_por_id($id_guiche);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $guiche->num_guiche = $_POST['num_guiche'];
        $guiche->nome_guiche = $_POST['nome_guiche'];
        
        $guiche->editar();
        header("Location: index.php"); // Redireciona após a edição
    }
}
?>

<form action="editar.php?id_guiche=<?php echo $guiche->id_guiche; ?>" method="post">
    <label for="num_guiche">Número do Guichê:</label>
    <input type="text" name="num_guiche" id="num_guiche" value="<?php echo $guiche->num_guiche; ?>" required>

    <label for="nome_guiche">Nome do Guichê:</label>
    <input type="text" name="nome_guiche" id="nome_guiche" value="<?php echo $guiche->nome_guiche; ?>" required>

    <button type="submit">Editar</button>
</form>
