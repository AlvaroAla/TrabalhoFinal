<?php
class Usuario
{
    private $nome;
    private $dtNasc;
    private $cpf;
    private $telefone;
    private $email;
    private $senha;

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDtNasc()
    {
        return $this->dtNasc;
    }
    public function setDtNasc($dtNasc)
    {
        $this->nome = $dtNasc;
    }

    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->cpf = $telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->cpf = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($senha)
    {
        $this->cpf = $senha;
    }
}
