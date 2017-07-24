<?php
class Menu{

  public function loadMen(){
    return "Menu Admin Loaded";
  }

  public function getTestFromBookClass(){
    return Book::init()->test_book_controller();
  }
}

?>
