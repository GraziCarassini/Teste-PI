<?php
require './APP/DATABASE/Database.php';

Class Guiche{
    public int $id_guiche;
    public string $num_guiche;
    public string $nome_guiche;


    public function buscar($where=null, $order=null, $limit=null){
        $db = new Database('Guiche');

        $res = $db->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS,self::class);
        return $res;
    }

    public function buscar_por_id($id_guiche){
        $db = new Database('Guiche');

        $obj = $db->select('id_guiche ='.$id_guiche)->fetchObject(self::class);
        return $obj;
    }
    public function excluir(){
        $db = new Database('Guiche');
        $res = $db->delete('id_guiche ='.$this->id_guiche);
        return $res;
    }
    public function editar(){
        $db = new Database('Guiche');
        $res= $db->update(
            'Guiche',
            [
                "nome_guiche"=>$this->nome_guiche,
                "num_guiche"=>$this->num_guiche
            ],
            'id_guiche='.$this->id_guiche
        );
        return $res;

    }

    public function alternar_ativo(){
        $db = new Database('Guiche');
        $obj = $this->buscar_por_id($this->id_guiche); 
        $novo_ativo = ($obj->ativo == 1) ? 0 : 1;
        $res = $db->update(
            'Guiche',
            ['ativo' => $novo_ativo],
            'id_guiche = ' . $this->id_guiche 
        );
        return $res; 
    }
    
}

// O arquivo Guiche.php que você compartilhou é uma classe (chamada Guiche) que serve para representar e manipular dados relacionados ao guichê no seu sistema. Essa classe age como uma camada de modelo (do padrão MVC) que lida com as operações CRUD (Create, Read, Update, Delete) para a tabela Guiche no banco de dados. Vamos analisar cada parte dessa classe para entender seu funcionamento:

// Estrutura e Funções da Classe Guiche
// 1. Propriedades da Classe ($id_guiche, $num_guiche, $nome_guiche)
_______________________________________________________________________
public int $id_guiche;
public string $num_guiche;
public string $nome_guiche;
_________________________________________________________________________

// Essas são as propriedades da classe Guiche. Elas representam os atributos de um guichê:

// $id_guiche: Identificador único do guichê (provavelmente é um campo auto-incremento no banco de dados).
// $num_guiche: Número do guichê (provavelmente é um campo que identifica o guichê de forma única).
// $nome_guiche: Nome do guichê (provavelmente um campo descritivo do guichê).
// Essas propriedades são utilizadas para armazenar os dados de um guichê específico.

// 2. Método buscar
_________________________________________________________________________
public function buscar($where=null, $order=null, $limit=null){
    $db = new Database('Guiche');
    $res = $db->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS,self::class);
    return $res;
}
_________________________________________________________________________
// Este método é responsável por buscar guichês no banco de dados. Ele utiliza a classe Database (que você forneceu anteriormente) para executar uma consulta de seleção (SELECT) na tabela Guiche.

// O parâmetro $where permite adicionar condições para a busca (exemplo: id_guiche = 1).
// O parâmetro $order permite ordenar os resultados (exemplo: ORDER BY nome_guiche).
// O parâmetro $limit limita o número de resultados (exemplo: LIMIT 10).
// A consulta retorna os resultados e os converte em uma lista de objetos da classe Guiche usando fetchAll(PDO::FETCH_CLASS, self::class).

// 3. Método buscar_por_id
_________________________________________________________________________
public function buscar_por_id($id_guiche){
    $db = new Database('Guiche');
    $obj = $db->select('id_guiche =' . $id_guiche)->fetchObject(self::class);
    return $obj;
}
_________________________________________________________________________
// Este método é usado para buscar um guichê específico pelo seu id_guiche. Ele faz uma consulta com a condição id_guiche = X e retorna um único objeto da classe Guiche usando fetchObject(self::class).

// 4. Método excluir
_________________________________________________________________________
public function excluir(){
    $db = new Database('Guiche');
    $res = $db->delete('id_guiche =' . $this->id_guiche);
    return $res;
}
_________________________________________________________________________
// Esse método é responsável por excluir um guichê do banco de dados. Ele usa o id_guiche do próprio objeto ($this->id_guiche) para executar a operação de deleção (DELETE) na tabela Guiche.

// O método retorna o resultado da operação de exclusão (geralmente, se o registro foi excluído com sucesso, o método retornará true).
// 5. Método editar
_________________________________________________________________________
public function editar(){
    $db = new Database('Guiche');
    $res = $db->update(
        'Guiche',
        [
            "nome_guiche" => $this->nome_guiche,
            "num_guiche" => $this->num_guiche
        ],
        'id_guiche=' . $this->id_guiche
    );
    return $res;
}
_________________________________________________________________________
// Esse método serve para atualizar os dados de um guichê existente no banco de dados. Ele usa o id_guiche do objeto para identificar o guichê e atualiza seus valores, como nome_guiche e num_guiche.

// O método de atualização (update) recebe três parâmetros:

// O nome da tabela (Guiche).
// Um array associativo contendo os campos que serão atualizados (neste caso, nome_guiche e num_guiche).
// A condição WHERE, que é usada para identificar qual guichê será atualizado (baseado no id_guiche).
// 6. Método alternar_ativo
_________________________________________________________________________
public function alternar_ativo(){
    $db = new Database('Guiche');
    $obj = $this->buscar_por_id($this->id_guiche);
    $novo_ativo = ($obj->ativo == 1) ? 0 : 1;
    $res = $db->update(
        'Guiche',
        ['ativo' => $novo_ativo],
        'id_guiche = ' . $this->id_guiche
    );
    return $res;
}
__________________________________________________________________________

// Esse método é responsável por alternar o status de "ativo" de um guichê. Ele primeiro verifica o status atual do guichê (através do método buscar_por_id), e então alterna o valor de ativo (se for 1, muda para 0; se for 0, muda para 1).

// Em seguida, ele atualiza a tabela Guiche no banco de dados com o novo valor de ativo.

// Resumo da Funcionalidade da Classe Guiche
// A classe Guiche permite realizar as seguintes operações sobre o guichê no banco de dados:

// 1-Buscar guichês (um ou vários) com base em uma condição (buscar e buscar_por_id).
// 2-Excluir um guichê (excluir).
// 3-Editar os dados de um guichê (editar).
// 4-Alternar o status de "ativo" de um guichê (alternar_ativo).
// Ela abstrai as operações de banco de dados, utilizando a classe Database para executar as consultas SQL necessárias.
_________________________________________________________________________

Exemplo 1: Buscar todos os guichês
php
Copiar
$guiche = new Guiche();
$guiches = $guiche->buscar();
foreach ($guiches as $g) {
    echo $g->nome_guiche . "<br>";
}
Exemplo 2: Buscar um guichê pelo ID
php
Copiar
$guiche = new Guiche();
$guiche_especifico = $guiche->buscar_por_id(1); // Busca o guichê com id = 1
echo $guiche_especifico->nome_guiche;
Exemplo 3: Excluir um guichê
php
Copiar
$guiche = new Guiche();
$guiche->id_guiche = 1; // Define o ID do guichê
$guiche->excluir(); // Exclui o guichê com esse ID
Exemplo 4: Editar um guichê
php
Copiar
$guiche = new Guiche();
$guiche->id_guiche = 1; // Define o ID do guichê
$guiche->nome_guiche = "Novo Nome do Guichê";
$guiche->num_guiche = "Novo Número";
$guiche->editar(); // Atualiza os dados do guichê
Exemplo 5: Alternar o status de "ativo"
php
Copiar
$guiche = new Guiche();
$guiche->id_guiche = 1; // Define o ID do guichê
$guiche->alternar_ativo(); // Alterna o status de ativo (1 ou 0)
Essa classe é útil porque centraliza a lógica relacionada ao guichê, mantendo o código limpo e organizado. Ela também facilita a reutilização das operações em outras partes do seu sistema.



