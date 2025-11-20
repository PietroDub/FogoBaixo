<?php

namespace bng\Controllers;

use bng\Models\Agents;
use bng\Controllers\BaseController as BaseController;

class Main extends BaseController
{
    public function index()
    {   
        //abre a view independentemente 
        $this->view('home');
    }

}

