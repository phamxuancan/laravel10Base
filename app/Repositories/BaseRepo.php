<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepo
{
    protected Model $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getWithTrashed()
    {
        return $this->model->get();
    }

    public function create(array $attribute)
    {
        return $this->model->create($attribute);
    }

    public function insert(array $attribute)
    {
        $entity = $this->create($attribute);
        $entity->save();
        return $entity;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findWithTrashed($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $attributes)
    {
        $entity = $this->findWithTrashed($id);
        if ($entity == null) return false;

        $entity->fill($attributes);
        return $entity->save();
    }

    public function delete($id)
    {
        $entity = $this->find($id);
        if ($entity == null) return false;

        return $entity->delete();
    }

    public function forceDelete($id)
    {
        $entity = $this->findWithTrashed($id);
        if ($entity == null) return false;

        return $entity->delete();
    }
}
