<?php
class Deactivator extends Core{
  public function loadParentCoreFromDeactivator(){
    return parent::init()->testCore();
  }
}
?>
