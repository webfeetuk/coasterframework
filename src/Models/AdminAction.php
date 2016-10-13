<?php namespace CoasterCms\Models;

use CoasterCms\Libraries\Traits\DataPreLoad;
use Eloquent;

class AdminAction extends Eloquent
{
    use DataPreLoad;

    protected $table = 'admin_actions';

    public static function inherited()
    {
        $actions = [];
        foreach (static::preloadArray() as $action) {
            if ($action->inherit) {
                $actions[] = $action;
            }
        }
        return $actions;
    }

    public static function edit_based()
    {
        $actions = [];
        foreach (static::preloadArray() as $action) {
            if ($action->edit_based) {
                $actions[] = $action;
            }
        }
        return $actions;
    }

    /**
     * @return array[]
     */
    public static function idsByControllerAction()
    {
        $controllerNames = AdminController::controllersById();
        $controllerActionsIds = [];
        foreach (static::select(['id', 'controller_id', 'action'])->get() as $action) {
            $controllerActionsIds[$controllerNames[$action->controller_id]][$action->action] = $action->id;
        }
        return $controllerActionsIds;
    }

}