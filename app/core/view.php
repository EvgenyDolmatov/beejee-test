<?php

class View
{
    public $session;

    function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Generate view
     */
    function generate($contentView, $templateView, $data = null)
    {
        require '../app/views/'.$templateView;
    }
}