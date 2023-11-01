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
                       u.name, 
                       date_format(p.created_at, '%d/%m/%Y %H:%i:%s') as created_at,
                       date_format(p.updated_at, '%d/%m/%Y %H:%i:%s') as updated_at
                FROM produtos as p 
                INNER JOIN users as u 
                on p.user_id = u.id
                WHERE p.deleted_at is null";
        $nomefiltro = $filtro['nome_filtro'] ?? [];
        $nomeuser = $filtro['nome_user'] ?? [];
        if (!empty($nomefiltro)) {
            $sql .= " AND p.nome like '%$nomefiltro'";
        }
        if (!empty($nomeuser)) {
            $sql .= " AND u.name like '%$nomeuser'";
        }

        $sql .= " LIMIT " . $offset . ' , ' . $total_records_per_page;
        $result = $this->conn->getConnection()->query($sql);
        $dados = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $dados[] = [
                    "id" => $row["id"],
                    "nome" => $row["nome"],
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

    function getProduto($id): array
    {
        $conn = $this->conn->getConnection();
        $sql = "SELECT p.id, p.nome, u.name,p.created_at,p.updated_at FROM produtos as p INNER JOIN users as u on p.user_id = u.id WHERE p.id = '$id'";
        $result = $conn->query($sql);
        $produto = [];

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $produto = [
                "id" => $row["id"],
                "nome" => $row["nome"],
                "name" => $row["name"],
                "created_at" => $row["created_at"],
                "updated_at" => $row["updated_at"]
            ];
        }
        $conn->close();

        return $produto;
    }

    function updateProduto($id, $dados, $user): bool
    {
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d H:i:s');

        $userId = $this->getUserID($user);
        $conn = $this->conn->getConnection();
        $sql = "UPDATE produtos set nome = '" . $dados['nome'] . "', user_id = '" . $userId['id'] . "',updated_at = '" . $currentDate . "'  WHERE id = '$id'";
        $conn->query($sql);

        if ($conn->error) {
            return false;
        }
        $conn->close();
        return true;
    }

    function deleteProduto($id)
    {
        $conn = $this->conn->getConnection();
        $conn->begin_transaction();
        $sql = "DELETE FROM sub_produtos  WHERE produto_id = '$id'";
        $conn->query($sql);

        $sql = "DELETE FROM produtos  WHERE id = '$id'";
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

}