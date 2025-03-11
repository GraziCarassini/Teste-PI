<?php
require_once './APP/CLASSE/Guiche.php';

$guiche = new Guiche();
$guiches = $guiche->buscar(); // Busca todos os guichês

?>

<h1>Lista de Guichês</h1>
<a href="criar.php">Criar novo guichê</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Numero</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($guiches as $g) : ?>
            <tr>
                <td><?php echo $g->id_guiche; ?></td>
                <td><?php echo $g->num_guiche; ?></td>
                <td><?php echo $g->nome_guiche; ?></td>
                <td><?php echo $g->ativo; ?></td>
                <td>
                    <a href="editar.php?id_guiche=<?php echo $g->id_guiche; ?>">Editar</a>
                    <a href="ativar_inativar.php?id_guiche=<?php echo $g->id_guiche; ?>">Ativar/Inativar</a>
                    <a href="excluir.php?id_guiche=<?php echo $g->id_guiche; ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
