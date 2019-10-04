<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Ticket;

class FilmRepository extends Repository
{
    /**
     * Class constructor
     */
    public function __construct(Ticket $model)
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
            self::$instance = new self(new Ticket);
        }

        return self::$instance;
    }

    public function renderChildModel()
    {
        return $this;
    }
}