<?php

namespace App\Facade;

use System\Facade\BaseFacade;
use System\View as SystemView;

class View extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return SystemView::class;
    }
}