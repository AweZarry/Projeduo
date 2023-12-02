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
        $query = "SELECT * FROM usuario WHERE email_usuario = :email_usuario OR nome_usuario = :nome_usuario ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email_usuario', $login);
        $stmt->bindValue(':nome_usuario', $login);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha_usuario'])) {
                return $usuario['id_usuario'];
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

    public function ids($login)
    {
        $sql = "SELECT * FROM usuario WHERE email_usuario = :email_usuario OR nome_usuario = :nome_usuario ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":email_usuario", $login);
        $stmt->bindValue(":nome_usuario", $login);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pegarImagem($login)
    {
        $sql = "SELECT foto_usuario FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id_usuario", $login);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updatePerfil($data)
    {
        $id_usuario = $data['id_usuario'];
        $nome = $data['nome'];
        $email = $data['email'];
        $biografia = $data['biografia'];

        if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
            $arquivo = $_FILES['foto'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp');

            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $foto = '../public/img/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $foto);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $query = "SELECT foto_usuario FROM usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_usuario", $id_usuario);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $foto = $result['foto_usuario'];
        }

        $query = "UPDATE usuario SET nome_usuario = :nome, email_usuario = :email, bio_usuario = :biografia, foto_usuario = :foto WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':biografia', $biografia);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':id_usuario', $id_usuario);

        if ($stmt->execute()) {
            print "<script> alert('Usuario atualizado com sucesso!!!')</script>";
            return true;
        } else {
            return false;
        }
    }

    public function delete($id_usuario)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_usuario);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}


