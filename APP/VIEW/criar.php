<?php
require_once './APP/CLASSE/Guiche.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_guiche = $_POST['num_guiche'];
    $nome_guiche = $_POST['nome_guiche'];
    $ativo = 'ATIVO'; // Você pode definir como ATIVO por padrão ou com base em algum input

    $guiche = new Guiche();
    $guiche->num_guiche = $num_guiche;
    $guiche->nome_guiche = $nome_guiche;
    $guiche->ativo = $ativo;

    $guiche->insert([
        'num_guiche' => $guiche->num_guiche,
        'nome_guiche' => $guiche->nome_guiche,
        'ativo' => $guiche->ativo
    ]);

    header("Location: index.php"); // Redireciona após a criação
}
?>

<form action="criar.php" method="post">
    <label for="num_guiche">Número do Guichê:</label>
    <input type="text" name="num_guiche" id="num_guiche" required>

    <label for="nome_guiche">Nome do Guichê:</label>
    <input type="text" name="nome_guiche" id="nome_guiche" required>

    <button type="submit">Criar</button>
</form>
