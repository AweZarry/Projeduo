<?php
include("../database/Conexao.php");

$db = new Conexao();

class projeto
{
    private $conn;
    private $table_name = "usuario";

    public function __construct($db)
    {
        $this->conn = $db;

    }

    public function cadastrar($nome, $email, $senha, $confSenha)
    {
        if ($senha === $confSenha) {

            $emailExistente = $this->verificarEmailExistente($email);
            if ($emailExistente) {
                print "<script> alert('Email ja cadastrado')</script>";
                return false;
            }

            $usuarioExistente = $this->verificarUsuarioExistente($nome);
            if ($usuarioExistente) {
                print "<script> alert('Usuario ja cadastrado')</script>";
                return false;
            }

            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO " . $this->table_name . " (nome_usuario, email_usuario, senha_usuario) VALUES (? ,? ,?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $senhaCriptografada);

            $rows = $this->read();
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }


    private function verificarEmailExistente($email)
    {
        $sql = "SELECT COUNT(*) FROM usuario WHERE email_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    private function verificarUsuarioExistente($nome)
    {
        $sql = "SELECT COUNT(*) FROM usuario WHERE nome_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $nome);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function logar($login, $senha)
    {
        $query = "SELECT * FROM usuario WHERE email_usuario = :email_usuario OR nome_usuario = :nome_usuario OR id_usuario = :id_usuario ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email_usuario', $login);
        $stmt->bindValue(':nome_usuario', $login);
        $stmt->bindValue(':id_usuario', $login);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha_usuario'])) {
                return true;
            }
        }

        return false;
    }
    public function read()
    {
        $sql = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function verificarAdm($login)
    {
        $query = "SELECT adm FROM usuario WHERE email_usuario = :email_usuario OR nome_usuario = :nome_usuario ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email_usuario', $login);
        $stmt->bindValue(':nome_usuario', $login);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario['adm'] == 1;
        }

        return false;

    }
}
