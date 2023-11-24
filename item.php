<?php
class Item
{
    private $modelo;
    private $cpfdono;
    private $consumoeletricidade;
    private $tipoconsumoenergia;
    private $consumomedio;
    private $tipoconsumocombustivel;

    public function getModelo()
    {
        return $this->modelo;
    }
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function getCpfDono()
    {
        return $this->cpfdono;
    }
    public function setCpfDono($cpfdono)
    {
        $this->cpfdono = $cpfdono;
    }

    public function getConsumoEletricidade()
    {
        return $this->consumoeletricidade;
    }
    public function setConsumoEletricidade($consumoeletricidade)
    {
        $this->consumoeletricidade = $consumoeletricidade;
    }

    public function getTipoConsumoEnergia()
    {
        return $this->tipoconsumoenergia;
    }
    public function setTipoConsumoEnergia($tipoconsumoenergia)
    {
        $this->tipoconsumoenergia = $tipoconsumoenergia;
    }

    public function getConsumoMedio()
    {
        return $this->consumomedio;
    }
    public function setConsumoMedio($consumomedio)
    {
        $this->consumomedio = $consumomedio;
    }

    public function getTipoConsumoCombustivel()
    {
        return $this->tipoconsumocombustivel;
    }
    public function setTipoConsumoCombustivel($tipoconsumocombustivel)
    {
        $this->tipoconsumocombustivel = $tipoconsumocombustivel;
    }

}
