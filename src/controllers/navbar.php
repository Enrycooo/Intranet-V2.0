<?php

namespace Application\Controllers\Navbar;

class Navbar
{
    public function execute()
    {
        if($_SESSION['username'] !== ""){
            require('templates/header/navbar.php');
        }else{
            header("Location: index.php");
        }
    }
}
