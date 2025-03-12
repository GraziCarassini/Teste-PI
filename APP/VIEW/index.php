

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guichês</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    
    <h1 class="mb-4 text-center">Guichês</h1>

    <!-- Formulário para criação de guichês -->
    <div class="card p-3 mb-4">
        <h4>Criar Novo Guichê</h4>
        <form action="criar.php" method="POST">
            <div class="mb-3">
                <label for="num_guiche" class="form-label">Número do Guichê</label>
                <input type="text" class="form-control" id="num_guiche" name="num_guiche" required>
            </div>
            <div class="mb-3">
                <label for="nome_guiche" class="form-label">Nome do Guichê</label>
                <input type="text" class="form-control" id="nome_guiche" name="nome_guiche" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar Guichê</button>
        </form>
    </div>
    
    <!-- Lista de Guichês -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                require_once __DIR__ . '/../CLASSE/guiche.php';

                $guiche = new Guiche();
                $guiches = $guiche->buscar();
                foreach ($guiches as $g) : 
            ?>
                <tr>
                    <td><?php echo $g->id_guiche; ?></td>
                    <td><?php echo $g->num_guiche; ?></td>
                    <td><?php echo $g->nome_guiche; ?></td>
                    <td>
                        <span class="badge bg-<?php echo $g->ativo ? 'success' : 'danger'; ?>">
                            <?php echo $g->ativo ? 'Ativo' : 'Inativo'; ?>
                        </span>

                    </td>
                    <td>
                        <a href="editar.php?id_guiche=<?php echo $g->id_guiche; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="ativar_inativar.php?id_guiche=<?php echo $g->id_guiche; ?>" class="btn btn-secondary btn-sm">
                            <?php echo $g->ativo ? 'Inativar' : 'Ativar'; ?>
                        </a>
                        <a href="excluir.php?id_guiche=<?php echo $g->id_guiche; ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
