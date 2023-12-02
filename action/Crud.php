<?php

class CrudNomes
{
    private $conn;
    private $table_name = "nome";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create($postValue)
    {
        $nome_jogo = $postValue['nome_jogo'];
        $descricao = $postValue['descricao'];
        $datas = $postValue['datas'];

        if (isset($_FILES['foto_jogo'])) {
            $arquivo = $_FILES['foto_jogo'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp');

            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $caminho_jogo = '../public/img/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $caminho_jogo);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $caminho_jogo = '';
        }

        $query = "INSERT INTO nome (nome_jogo, foto_jogo, descricao, datas) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nome_jogo);
        $stmt->bindParam(2, $caminho_jogo);
        $stmt->bindParam(3, $descricao);
        $stmt->bindParam(4, $datas);

        $rows = $this->read();
        if ($stmt->execute()) {
            print "<script> alert('Cadastro realizado com sucesso!!! ')</script>";
            print "<script>  location.href='?action=read';</script>";
            return true;
        } else {
            return false;
        }
    }


    public function read()
    {
        $query = "SELECT * FROM nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update($postValues)
    {
        $id_jogo = $postValues['id_jogo'];
        $nome_jogo = $postValues['nome_jogo'];
        $caminho_jogo = $postValues['caminho_jogo'];
        $descricao = $postValues['descricao'];

        if (empty($id_jogo) || empty($nome_jogo) || empty($caminho_jogo) || empty($descricao)) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " SET nome_jogo = ?, foto_jogo = ?, descricao = ? WHERE id_jogo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nome_jogo);
        $stmt->bindParam(2, $caminho_jogo);
        $stmt->bindParam(3, $descricao);
        $stmt->bindParam(4, $id_jogo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readOne($id_jogo)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_jogo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_jogo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id_jogo)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_jogo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_jogo);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function search($term)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nome_jogo LIKE ?";
        $stmt = $this->conn->prepare($query);
        $term = "%" . $term . "%";
        $stmt->bindParam(1, $term);
        $stmt->execute();
        return $stmt;
    }
}



class CrudDicas
{
    private $conn;
    private $table_name = "nome";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function createDicas($postValue)
    {
        $nome_jogo = $postValue['nome_jogo'];
        $id_jogo = ($nome_jogo);
        $titdicas = $postValue['titdicas'];
        $dicascat = $postValue['dicascat'];
        $dicainput = $postValue['dicainput'];
        $postador = $postValue['postador'];
        $foto_postador = $postValue['foto_postador'];

        $query = "INSERT INTO dicas (id_jogo, titdicas, dicascat, dicasinput, postador, foto_postador) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $id_jogo);
        $stmt->bindParam(2, $titdicas);
        $stmt->bindParam(3, $dicascat);
        $stmt->bindParam(4, $dicainput);
        $stmt->bindParam(5, $postador);
        $stmt->bindParam(6, $foto_postador);

        $dica = $this->readDicas();
        if ($stmt->execute()) {
            print "<script> alert('Cadastro realizado com sucesso!!! ')</script>";
            print "<script>  location.href='?action=read';</script>";
            return true;
        } else {
            return false;
        }
    }

    public function readDicas()
    {
        $query = "SELECT * FROM dicas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

class CrudVideo
{
    private $conn;
    private $table_name = "nome";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function createVideo($postValue)
    {
        $nome_jogo = $postValue['nome_jogo'];
        $id_jogo = ($nome_jogo);
        $titvideo = $postValue['titvideo'];
        $postador = $postValue['postador'];
        $foto_postador = $postValue['foto_postador'];

        if (isset($_FILES['videos'])) {
            $arquivo = $_FILES['videos'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('mp4', 'webp');

            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $caminho_video = '../public/videos/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $caminho_video);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $caminho_video = ''; // Se nenhum arquivo foi enviado, defina o caminho como vazio
        }

        $query = "INSERT INTO videos (id_jogo, titvideo, videos, postador, foto_postador) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_jogo);
        $stmt->bindParam(2, $titvideo);
        $stmt->bindParam(3, $caminho_video);
        $stmt->bindParam(4, $postador);
        $stmt->bindParam(5, $foto_postador);

        $video = $this->readVideo();
        if ($stmt->execute()) {
            print "<script> alert('Cadastro realizado com sucesso!!! ')</script>";
            print "<script>  location.href='?action=read';</script>";
            return true;
        } else {
            return false;
        }
    }


    public function readVideo()
    {
        $query = "SELECT * FROM videos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}

class CrudFoto
{
    private $conn;
    private $table_name = "nome";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function createFoto($postValue)
    {
        $nome_jogo = $postValue['nome_jogo'];
        $id_jogo = ($nome_jogo);
        $titcaptura = $postValue['titcaptura'];
        $postador = $postValue['postador'];
        $foto_postador = $postValue['foto_postador'];

        if (isset($_FILES['captura'])) {
            $arquivo = $_FILES['captura'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp');

            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $caminho_foto = '../public/img/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $caminho_foto);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $caminho_foto = '';
        }

        $query = "INSERT INTO fotos (id_jogo, titcaptura, captura, postador, foto_postador) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_jogo);
        $stmt->bindParam(2, $titcaptura);
        $stmt->bindParam(3, $caminho_foto);
        $stmt->bindParam(4, $postador);
        $stmt->bindParam(5, $foto_postador);

        $foto = $this->readFoto();
        if ($stmt->execute()) {
            print "<script> alert('Cadastro realizado com sucesso!!! ')</script>";
            print "<script>  location.href='?action=read';</script>";
            return true;
        } else {
            return false;
        }
    }


    public function readFoto()
    {
        $query = "SELECT * FROM fotos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
