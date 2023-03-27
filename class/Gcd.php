<?php
class Gcd {
  private int $num1;
  private int $num2;

  public function __construct() {
    $this->setNum1(1);
    $this->setNum2(1);
  }
  /**
   * num1
   */
  public function getNum1(): int {
    return $this->num1;
  }
  public function setNum1(int $num1) : void {
    if ($num1 <= 0) {
      throw new Exception('num1は正の整数で指定します。');
    }
    $this->num1 = $num1;
  }
  /**
   * num2
   */
  public function getNum2(): int {
    return $this->num2;
  }
  public function setNum2(int $num2) : void {
    if ($num2 <= 0) {
      throw new Exception('num2は正の整数で指定します。');
    }
    $this->num2 = $num2;
  }
  /**
   * Calc Greatest Common Divisor
   */
  public function getCalc(): string {
    $num1 = $this->getNum1();
    $num2 = $this->getNum2();

    $big = 0;
    $small = 0;
    $remainder = 0;

    if($num1 > $num2){
      $big   = $num1;
      $small = $num2;
    }else{
      $big   = $num2;
      $small = $num1;
    }

    while(($remainder = $big % $small) != 0){
      $big = $small;
      $small = $remainder;
    }

    $msg = "最大公約数は". $small . "です";

    return $msg;
  }
}
