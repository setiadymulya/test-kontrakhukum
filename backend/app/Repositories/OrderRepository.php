<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Order;

class OrderRepository extends Repository
{
    /**
     * Class constructor
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * Create self instance
     *
     * @return Object $instance
     */
    public static function init()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self(new Order);
        }

        return self::$instance;
    }

    public function renderChildModel()
    {
        $this->model = $this->model->with('ticket')->with('customer');
        return $this;
    }
}