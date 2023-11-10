<?php
include_once 'controllers/ConnectionDb.php';

class ProdutoRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new ConnectionDb();

    }

    function getProdutos(int $offset, int $total_records_per_page, array $filtro): array
    {

        $conn = $this->conn->getConnection();
        $sql = "SELECT p.id,
                       p.nome,
                       sum(case when m.tipo_produto = 1 then m.quantidade else 0 end) - sum(case when m.tipo_produto = 2 then m.quantidade else 0 end) as estoque,
                       u.name,
                       date_format(p.created_at, '%d/%m/%Y %H:%i:%s') as created_at,
                       date_format(p.updated_at, '%d/%m/%Y %H:%i:%s') as updated_at
                    FROM produtos as p
                    INNER JOIN users as u
                       on p.user_id = u.id
                    LEFT JOIN movimentacao_produtos as m
                       on  p.id = m.produto_id
                    WHERE p.deleted_at is null";

        $nomefiltro = $filtro['nome_filtro'] ?? [];
        $nomeuser = $filtro['nome_user'] ?? [];

        if (!empty($nomefiltro)) {
            $sql .= " AND p.nome like '%$nomefiltro%'";
        }
        if (!empty($nomeuser)) {
            $sql .= " AND u.name like '%$nomeuser%'";
        }

        $sql .= " GROUP BY p.id LIMIT " . $offset . ' , ' . $total_records_per_page;
        $result = $this->conn->getConnection()->query($sql);
        $dados = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $dados[] = [
                    "id" => $row["id"],
                    "nome" => $row["nome"],
                    "estoque" => $row["estoque"],
                    "name" => $row["name"],
                    "created_at" => $row["created_at"],
                    "updated_at" => $row["updated_at"]
                ];
            }
        }
        $conn->close();

        return [
            'dados' => $dados,
            'filtros' => $filtro
        ];
    }

    public function getPedidos(): array
    {

        $conn = $this->conn->getConnection();
        $sql = "SELECT vp.id, v.cod_venda, v.cliente,p.nome,vp.quantidade_venda, v.status_venda, v.data_venda,vp.venda_id
                    FROM venda_produtos as vp
                        JOIN vendas as v
                            on vp.venda_id = v.id
                        join produtos as p
                            on vp.prod_id = p.id
                    where v.deleted_at is null
                    GROUP BY v.id";

        $result = $this->conn->getConnection()->query($sql);
        $pedido = [];

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $pedido[] = [
                    "venda_id" => $row["venda_id"],
                    "cod_venda" => $row["cod_venda"],
                    "cliente"=> $row['cliente'],
                    "nome" => $row["nome"],
                    "quantidade_venda" => $row["quantidade_venda"],
                    "status_venda" => $row["status_venda"],
                    "data_venda" => $row["data_venda"]
                ];
            }

        }
        $conn->close();
        return ['pedidos' => $pedido];
    }

    function getControleProduto(): array
    {
        $conn = $this->conn->getConnection();
        $sql = "SELECT id, nome FROM produtos WHERE deleted_at is null";
        $result = $this->conn->getConnection()->query($sql);
        $dados = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $dados[] = [
                    "id" => $row["id"],
                    "nome" => $row["nome"],
                ];
            }
        }
        $conn->close();
        return [
            'dados' => $dados];

    }

    function updateProduto($id, $dados, $user): bool
    {
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d H:i:s');

        $userId = $this->getUserID($user);
        $conn = $this->conn->getConnection();
        $sql = "UPDATE produtos set nome = '" . $dados['nome'] . "', user_id = '" . $userId['id'] . "',updated_at = '" . $currentDate . "'  WHERE id = '$id'";
        $conn->query($sql);
        $sql2 = "UPDATE dados_produto set quantidade = '" . $dados['quantidade_prod'] . "', valor = '" . $dados['valor_prod'] . "',updated_at = '" . $currentDate . "'  WHERE prod_id = '$id'";
        $conn->query($sql2);

        if ($conn->error) {
            return false;
        }
        $conn->close();
        return true;
    }
    public function getProdutoPedido($id){
        $conn = $this->conn->getConnection();

        $sql = "SELECT vp.id, p.nome,vp.quantidade_venda, vp.venda_id
                FROM venda_produtos as vp
                    JOIN vendas as v
                        on vp.venda_id = v.id
                    join produtos as p
                        on vp.prod_id = p.id
                where v.deleted_at is null
                AND v.id = '$id' ";
        $result = $this->conn->getConnection()->query($sql);
        $dados = [];
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                $dados = [
                    "nome" => $row["nome"],
                    "quantidade_venda" => $row["quantidade_venda"],
                    "venda_id"=> $row["venda_id"]
                ];
            }
        $conn->close();
        return $dados;
    }

    function getUserID($email)
    {
        $conn = $this->conn->getConnection();
        $sql = "SELECT id, email FROM users WHERE email = '" . $email . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $produto = [
                    "id" => $row["id"],
                ];
            }

        }
        $conn->close();
        return $produto;
    }

    function deleteProduto($id)
    {
        $conn = $this->conn->getConnection();
        $conn->begin_transaction();
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d H:i:s');


        $sql = "UPDATE movimentacao_produtos SET deleted_at = '" . $currentDate . "' WHERE produto_id = '$id'";
        $conn->query($sql);

        $sql = "UPDATE produtos SET deleted_at = '" . $currentDate . "' WHERE id = '$id'";
        $conn->query($sql);


        if ($conn->connect_error) {
            $conn->rollback();
            die("Connection failed: " . $conn->connect_error);
        } else {
            $conn->commit();
        }

        $conn->close();
        return $conn;
    }

    function storeProduto($nome, $id)
    {
        $conn = $this->conn->getConnection();
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d H:i:s');
        $sql = "INSERT INTO produtos (nome,user_id,created_at ,updated_at) VALUES ('$nome','$id','$currentDate','$currentDate')";
        $conn->query($sql);
        $conn->close();
    }

    function storeVendas($nomeCliente, $idProduto, $quantidadeVenda)
    {

        $produtoRepository = new ProdutoRepository();
        $conn = $this->conn->getConnection();
        $conn->begin_transaction();
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d H:i:s');

        $sql2 = "INSERT INTO venda_produtos (prod_id,quantidade_venda,venda_id,created_at ,updated_at) 
                    VALUES((SELECT id FROM produtos WHERE id= '$idProduto'),'$quantidadeVenda',(SELECT id FROM vendas WHERE cliente = '$nomeCliente' AND created_at = '$currentDate'),'$currentDate','$currentDate')";
        $conn->query($sql2);

        if ($conn->connect_error) {
            $conn->rollback();
            die("Connection failed: " . $conn->connect_error);
            return false;
        } else {
            $produtoRepository->storeMovimentacao($idProduto, $quantidadeVenda, 2);
            $conn->commit();
            return true;
        }

        $conn->close();
    }

    function storeMovimentacao($id, $quantidade, $tipoMovimentacao)
    {
        $conn = $this->conn->getConnection();
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d H:i:s');
        $sql = "INSERT INTO movimentacao_produtos (quantidade,tipo_produto,produto_id,created_at ,updated_at) VALUES('$quantidade','$tipoMovimentacao',(SELECT id FROM produtos WHERE id= '$id'),'$currentDate','$currentDate')";
        $conn->query($sql);
        $conn->close();
    }

    function storeCliente($nomeCliente, $dataVenda, $statusVenda, $uniqid)
    {


        $conn = $this->conn->getConnection();
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d H:i:s');

        $sql = "INSERT INTO vendas (cliente,cod_venda,data_venda,status_venda,created_at ,updated_at) VALUES('$nomeCliente','$uniqid','$dataVenda','$statusVenda','$currentDate','$currentDate')";
        $conn->query($sql);
        $conn->close();

    }

    function paginacao($total_records_per_page)
    {
        $conn = $this->conn->getConnection();
        $sql = "SELECT COUNT(*) As total_records  FROM produtos";
        $result = $conn->query($sql);

        $total_records = mysqli_fetch_array($result);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);

        $conn->close();
        return $total_no_of_pages;
    }

    function getLogin($login, $senha): bool
    {
        $conn = $this->conn->getConnection();
        $sql = "SELECT email,password FROM users WHERE email ='" . $login . "' AND password ='" . $senha . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }

    function storeUsuario(string $nome, string $login, string $senha): bool
    {
        $conn = $this->conn->getConnection();
        $sql = "INSERT INTO users (name,email,password) VALUES ('$nome','$login','$senha')";
        $result = $conn->query($sql);
        $conn->close();

        return $result;

    }

    function verificarDisponibilidade($login)
    {
        $conn = $this->conn->getConnection();
        $sql = "SELECT * FROM users WHERE email ='" . $login . "'";
        $result = $conn->query($sql);
        $conn->close();
        return empty($result->num_rows);
    }

    public function showMessage(): void
    {
        $authenticator = new Authenticator();
        $message = $authenticator->getMessage();
        if (isset($message)) {
            echo "<p style='color: green' >" . $message . "</p>";
            $authenticator->notification("");
        } else {
            $message = "";
            $authenticator->notification($message);
        }
    }

    public function numberFormat(float $numero)
    {
        $numeroFormatado = number_format($numero, 2, ',', '');
        return $numeroFormatado;
    }

    public function stockValidator($itens): bool
    {
        $produtoRepository = new ProdutoRepository();

        foreach ($itens as $chave => $item) {
            $idProduto = $item["produto_id"];
            $quantidadeVenda = $item['quantidade'];
            $quantidadeEstoque = $produtoRepository->getProduto($idProduto);
            $total = $quantidadeEstoque['estoque'] - $quantidadeVenda;
            if ($total <= 0) {
                $validator = false;
                return $validator;
            } else {
                $total = 0;
                $validator = true;
            }
        }
        return $validator;
    }

    function getProduto($id): array
    {
        $conn = $this->conn->getConnection();
        $sql = "SELECT  p.id, 
                        p.nome,
                        sum(case when m.tipo_produto = 1 then m.quantidade else 0 end) - sum(case when m.tipo_produto = 2 then m.quantidade else 0 end) as estoque,
                        u.name,
                        p.created_at,
                        p.updated_at 
                FROM produtos as p
                INNER JOIN users as u
                    on p.user_id = u.id
                    LEFT JOIN movimentacao_produtos as m
                        on  p.id = m.produto_id
                    WHERE p.deleted_at is null
                AND p.id = '$id'";
        $result = $conn->query($sql);
        $produto = [];

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $produto = [
                "id" => $row["id"],
                "nome" => $row["nome"],
                "estoque" => $row["estoque"],
                "name" => $row["name"],
                "created_at" => $row["created_at"],
                "updated_at" => $row["updated_at"]
            ];
        }
        $conn->close();

        return $produto;
    }

    public function getUniqId(): string
    {
        $prefix = "COD";
        $unique = substr(uniqid(rand(), true), 0, 5); // 16 characters long
        $cod = $prefix . $unique;
        return $cod;
    }


}