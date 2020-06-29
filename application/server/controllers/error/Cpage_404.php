<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Cpage_404 extends CAaskController {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function create()
    {
        
        parent::create();
        return;
    }
    public function initialize()
    {
        parent::initialize();
        $this->loadView("page_404",false);
        return;
    }
    public function execute()
    {
        return;
    }
    public function finalize()
    {
         
        return;
    }
    public function reader()
    {
        return;
    }
    public function distory()
    {
        return;
    }
}
