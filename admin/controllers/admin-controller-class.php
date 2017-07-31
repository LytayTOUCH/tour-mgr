<?php
class Admin_Controller{
  public function test_app(){
    return "test_app @ admin controllers";
  }
  public function add_hook_loader(){
    return Hooks_Loader::test_hook_loader();
  }
}
?>
