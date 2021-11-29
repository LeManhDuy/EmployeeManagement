<?php
class Entity_Faculty
{
    public $IDPB;
    public $Tenpb;
    public $Mota;
    public function __construct($_IDPB, $_Tenpb, $_Mota)
    {
        $this->IDPB = $_IDPB;
        $this->Tenpb = $_Tenpb;
        $this->Mota = $_Mota;
    }
}
