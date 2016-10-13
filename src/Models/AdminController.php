<?php namespace CoasterCms\Models;

use CoasterCms\Libraries\Traits\DataPreLoad;
use Eloquent;

class AdminController extends Eloquent
{
    use DataPreLoad;

    /**
     * @var string
     */
    protected $table = 'admin_controllers';

    /**
     * @return array
     */
    public static function idsByController()
    {
        $controllerNames = [];
        foreach (static::select(['id', 'controller'])->get() as $controller) {
            $controllerNames[$controller->controller] = $controller->id;
        }
        return $controllerNames;
    }

    /**
     * @return array
     */
    public static function controllersById()
    {
        $controllerNames = [];
        foreach (static::select(['id', 'controller'])->get() as $controller) {
            $controllerNames[$controller->id] = $controller->controller;
        }
        return $controllerNames;
    }

}