<?php
require_once './APP/CLASSE/Guiche.php';

class GuicheController {

    public function listar() {
        $guiche = new Guiche();
        $guiches = $guiche->buscar();
        include './APP/VIEW/index.php'; // Carrega a view com a lista de guichês
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $guiche = new Guiche();
            $guiche->num_guiche = $_POST['num_guiche'];
            $guiche->nome_guiche = $_POST['nome_guiche'];
            $guiche->ativo = 'ATIVO';
            $guiche->insert([
                'num_guiche' => $guiche->num_guiche,
                'nome_guiche' => $guiche->nome_guiche,
                'ativo' => $guiche->ativo
            ]);
            header("Location: index.php");
        }
        include './APP/VIEW/criar.php'; // Carrega a view do formulário de criação
    }

    public function editar($id_guiche) {
        $guiche = new Guiche();
        $guiche = $guiche->buscar_por_id($id_guiche);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $guiche->num_guiche = $_POST['num_guiche'];
            $guiche->nome_guiche = $_POST['nome_guiche'];
            $guiche->editar();
            header("Location: index.php");
        }

        include './APP/VIEW/editar.php'; // Carrega a view do formulário de edição
    }

    public function ativar_inativar($id_guiche) {
        $guiche = new Guiche();
        $guiche->alternar_ativo($id_guiche, $guiche->ativo);
        header("Location: index.php");
    }

    public function excluir($id_guiche) {
        $guiche = new Guiche();
        $guiche->excluir($id_guiche);
        header("Location: index.php");
    }
}
?>
