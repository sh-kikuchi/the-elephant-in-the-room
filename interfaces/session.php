<?php

interface ISession{
  //function oldPostValue($oldPostValue);
  function oldPostValue(ISession $iSession);
  function checkToken(ISession $iSession);
}

?>
