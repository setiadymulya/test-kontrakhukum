<?php

namespace App\Repositories;

use App\Repositories\Traits\ModelTrait;
use App\Repositories\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    use ModelTrait;

    /**
     * Instance Variable
     */
    protected static $instance;

    protected $model;

    protected $dataType = '';

    public function renderChildModel() {}
}