<?php
require_once '../class/Gcd2.php';

$gcd = new Gcd2();
print '整数1(初期値):'.$gcd->getNum1().'<br>';
print '整数2(初期値):'.$gcd->getNum2().'<br>';
$gcd->setNum1(600);
$gcd->setNum2(20);
print '整数1:'.$gcd->getNum1().'<br>';
print '整数2:'.$gcd->getNum2().'<br>';
print "最大公約数：{$gcd->getCalc()}";
