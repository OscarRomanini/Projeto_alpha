<?php

require_once "Sql.php";

class Cliente
{
    private $idcli;
    private $nome;
    private $nasc;

    public function loadById($id)
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM cliente WHERE idcli = :ID", array(
            ":ID" => $id
        ));
        if (count($result) > 0){
            $row = $result[0];
            $this->setIdcli($row['idcli']);
            $this->setNome($row['nome']);
            $this->setNasc($row['dtnasc']);
        }


    }

    public function getList()
    {
        $sql= new Sql();
        return $sql->select("SELECT * FROM cliente ORDER BY nome");
    }

    public function insert()
    {
        $sql = new Sql();
        $result = $sql->select("CALL insert_cliente (:NOME, :DTNASC)", array(
            ':NOME' => $this->getNome(),
            ':DTNASC' => $this->getNasc()
        ));
        if (count($result) > 0){
            $this->setData($result[0]);
        }

    }

    public function update($id, $nome, $nasc)
    {
        $this->setNome($nome);
        $this->setNasc($nasc);
        $this->setIdcli($id);
        $sql = new Sql();
        $sql->query("UPDATE cliente SET nome = :NOME, dtnasc = :DTNASC WHERE idcli = :ID", array(
            ":NOME" => $this->getNome(),
            ":DTNASC" => $this->getNasc(),
            ":ID" => $this->getIdcli()
        ));
    }

    public function delete()
    {
        $sql = new Sql();
        $sql->select("DELETE FROM cliente WHERE idcli = :ID", array(
           ":ID" => $this->getIdcli()
        ));
        /*$this->setIdcli(0);
        $this->setNasc(" ");
        $this->setNome(" "); */
    }

    public static function search($nome){
        $sql = new Sql();
        return $sql->select("SELECT * FROM cliente WHERE nome LIKE :SEARCH ORDER BY nome", array(
            ":SEARCH" => "%".$nome."%"
        ));
    }

    private function setData($data)
    {
        $this->setNome($data['nome']);
        $this->setNasc($data['dtnasc']);
    }


    public function __toString()
    {
        return json_encode(array(
            ":ID" => $this->getIdcli(),
            ":NOME" => $this->getNome(),
            ":DTNASC" => $this->getNasc()
        ));
    }


    /**
     * @return mixed
     */
    public function getIdcli()
    {
        return $this->idcli;
    }

    /**
     * @param mixed $idcli
     */
    public function setIdcli($idcli)
    {
        $this->idcli = $idcli;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNasc()
    {
        return $this->nasc;
    }

    /**
     * @param mixed $nasc
     */
    public function setNasc($nasc)
    {
        $this->nasc = $nasc;
    }



}