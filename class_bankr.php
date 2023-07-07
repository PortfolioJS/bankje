<?php
class Bankr
{
    protected string $naam;

    protected int $rekeningnr;

    protected float $saldo;

    protected array $transactieGeschiedenis;

    protected float $saldobodem;

    protected bool $blokkade;

    public function __construct(string $naam, int $rekeningnr, float $saldo)
    {
        $this->naam = $naam;
        $this->rekeningnr = $rekeningnr;
        $this->saldo = $saldo;
        $this->transactieGeschiedenis = [];
        $this->saldobodem = 0; //default value saldobodem
        $this->blokkade = false; //default value blokkade
    }

    public function get_name()
    {
        return $this->naam;
    }

    public function set_name($naam)
    {
        return $this->naam = $naam;
    }

    public function get_rekeningnr()
    {
        return $this->rekeningnr;
    }

    public function get_saldo()
    {
        return $this->saldo;
    }

    public function set_saldo($saldo)
    {
        return $this->saldo = $saldo;
    }

    public function get_saldobodem()
    {
        return $this->saldobodem;
    }

    public function set_saldobodem($saldobodem)
    {
        return $this->saldobodem = $saldobodem;
    }

    public function get_blokkade()
    {
        return $this->blokkade;
    }
    public function set_blokkade($blokkade)
    {
        return $this->blokkade = $blokkade;
    }

    public function get_transactieGeschiedenis()
    {
        return $this->transactieGeschiedenis;
    }

    public function set_transactieGeschiedenis($transactieGeschiedenis)
    {
        return $this->transactieGeschiedenis = $transactieGeschiedenis;
    }


}