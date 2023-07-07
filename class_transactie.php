<?php
class Transactie extends Bankr
{
    protected float $bedrag;
    protected Bankr $rekeningZender;
    protected Bankr $rekeningOntvanger;
    protected Timestamp $datumTijd;

    public function __construct(float $bedrag, Bankr $rekeningZender, Bankr $rekeningOntvanger)
    {
        $this->bedrag = $bedrag;
        $this->rekeningZender = $rekeningZender;
        $this->rekeningOntvanger = $rekeningOntvanger;
        $this->datumTijd = new Timestamp;
    }

    public function transactie()
    {
        if ($this->rekeningZender->blokkade == True) {
            echo "Transactie niet mogelijk. Je rekening is geblokkeerd, " . $this->rekeningZender->naam . ".<br>";
            exit;
        }
        if ($this->rekeningOntvanger->blokkade == True) {
            echo "Transactie niet mogelijk. Rekening " . $this->rekeningOntvanger->rekeningnr . " op naam van " . $this->rekeningOntvanger->naam . " is geblokkeerd.<br>";
            exit;
        }
        if ($this->bedrag < 0) {
            echo "NEGATIEVE OVERBOEKINGEN NIET TOEGESTAAN!<br>
            (al zou dat voor jou vast heel POSITIEF uitpakken, boefje)<br>";
            exit;
        }
        $y = $this->rekeningZender->saldo - $this->bedrag;
        $z = $this->rekeningOntvanger->saldo + $this->bedrag;
        if ($y < $this->rekeningZender->saldobodem) {
            echo "Onvoldoende saldo!<br>";
        } else {
            $this->rekeningZender->saldo = round($y, 2);
            $this->rekeningOntvanger->saldo = round($z, 2);
            //een nieuw object TransactieOverzicht wordt gemaakt,
            //het transactieoverzicht wordt als (sub)array in de transactieGeschiedenis(array, van de bankrekeningobjecten) v. Zender en Ontvanger gezet,
            //waarbij met de bijbehorende functies wordt gedifferentieerd tussen het overzicht van Zender/Ontvanger:
            $transactieOverzicht = new TransactieOverzicht($this->get_bedrag(), $this->get_rekeningZender(), $this->get_rekeningOntvanger(), $this->get_datumTijd());
            $transactieOverzicht->transactieOverzichtZender();
            $transactieOverzicht->transactieOverzichtOntvanger();
        }
    }

    public function get_bedrag()
    {
        return $this->bedrag;
    }

    public function get_rekeningZender()
    {
        return $this->rekeningZender;
    }

    public function get_rekeningOntvanger()
    {
        return $this->rekeningOntvanger;
    }
    public function get_datumTijd()
    {
        return $this->datumTijd;
    }

}