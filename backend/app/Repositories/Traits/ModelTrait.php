<?php

namespace App\Repositories\Traits;

use Carbon\Carbon;

trait ModelTrait
{
    public function select(array $select)
    {
        $this->model = $this->model->select($select);
        return $this;
    }

    public function where(array $where)
    {
        $this->model = $this->model->where($where);
        return $this;
    }

    public function ordering(string $orderBy = 'id', string $ordering = 'desc')
    {
        $this->model = $this->model->orderBy($orderBy, $ordering);
        return $this;
    }

    public function setField(string $key, $value)
    {
        $this->model->$key = $value;
        return $this;
    }

    public function setFields(array $fields)
    {
        if (count($fields) > 0) {
            foreach ($fields as $field => $value) {
                $this->setField($field, $value);
            }
        }

        return $this;
    }

    public function find($perPage = 10, bool $asPaginate = true)
    {
        $this->renderChildModel();

        if ($asPaginate) {
            return $this->model->paginate($perPage);
        }

        return $this->model->take($perPage)->get();
    }

    public function findOne()
    {
        $this->renderChildModel();
        return $this->model->first();
    }

    public function findById(int $id)
    {
        $this->renderChildModel();
        $results = $this->model->where('id', $id)->first();

        return $results;
    }

    public function findByCode(string $code)
    {
        $this->renderChildModel();
        $results = $this->model->where('code', $code)->first();

        return $results;
    }

    public function likeByCode(string $code)
    {
        $this->renderChildModel();
        $results = $this->model->where('code', 'like', '%'.$code.'%')->first();

        return $results;
    }
    
    public function filterStock(){
        $this->renderChildModel();
        $results = $this->model->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->where("start_time", ">=", Carbon::now()->format('H:i:s'))->where('quantity', '>', 0)->count();
    
        return $results;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data)
    {
        return $this->model->update($data);
    }

    public function delete()
    {
        return $this->model->delete();
    }

    public function destroy(array $data)
    {
        return $this->model->destroy($data);
    }

    public function save()
    {
        return [
            'saved' => $this->model->save(),
            'data' => $this->model,
        ];
    }
}