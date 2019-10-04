<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface {
    public function select(array $params);

    public function where(array $params);

    public function ordering(string $orderBy, string $ordering);

    public function setField(string $key, $value);

    public function setFields(array $fields);

    public function renderChildModel();

    public function find($perPage, bool $asPaginate);

    public function findOne();

    public function findById(int $id);

    public function findByCode(string $code);

    public function likeByCode(string $code);

    public function filterStock();

    public function create(array $data);

    public function update(array $data);

    public function delete();

    public function destroy(array $data);

    public function save();
}