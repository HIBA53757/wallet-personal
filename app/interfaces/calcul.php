<?php 
namespace personalWallet\app\interfaces;
 interface calcul{
    public function getTotal():float;
    public function getMonth(int $month,int $year): ?array;
 }