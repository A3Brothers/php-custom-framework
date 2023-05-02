<?php
namespace System;

class File extends \SplFileObject
{

    public function __construct($file, $permission) 
    {
        parent::__construct($file, $permission);
    }
}