<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Customer;

class CustomerRepository extends Repository
{
    /**
     * Class constructor
     */
    public function __construct(Customer $model)
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
            self::$instance = new self(new Customer);
        }

        return self::$instance;
    }

    public function renderChildModel()
    {
        return $this;
    }
}