<?php
class TransactieOverzicht extends Transactie //i.v.m. 'extends' zijn de properties/constructor hieronder weg gecomment (niet nodig)
{
    protected float $bedrag;
    protected Bankr $rekeningZender;
    protected Bankr $rekeningOntvanger;
    protected Timestamp $datumTijd;

    public function __construct(float $bedrag, Bankr $rekeningZender, Bankr $rekeningOntvanger, Timestamp $datumTijd)
    {
        $this->bedrag = $bedrag;
        $this->rekeningZender = $rekeningZender;
        $this->rekeningOntvanger = $rekeningOntvanger;
        $this->datumTijd = $datumTijd;
    }

    //de transactieGeschiedenis van beide bankrekeningen wordt m.b.v. onderstaande functies gevuld met een subarray transactieOverzicht:
    public function transactieOverzichtZender()
    {
        array_push($this->rekeningZender->transactieGeschiedenis, array("Datum/tijdstip:" => $this->datumTijd->timestamp(), "Bedrag:" => $this->bedrag * -1, "Ten gunste van rekeningnr.:" => $this->rekeningOntvanger->rekeningnr . " op naam van " . $this->rekeningOntvanger->naam));
        // return $this->rekeningZender->transactieGeschiedenis;
        //return niet nodig, want de transactiegeschiedenis wordt elders opgeroepen
    }

    public function transactieOverzichtOntvanger()
    {
        array_push($this->rekeningOntvanger->transactieGeschiedenis, array("Datum/tijdstip:" => $this->datumTijd->timestamp(), "Bedrag:" => $this->bedrag, "Ten laste van rekeningnr.:" => $this->rekeningZender->rekeningnr . " op naam van " . $this->rekeningZender->naam));
        // return $this->rekeningOntvanger->transactieGeschiedenis;
        //idem
    }

}