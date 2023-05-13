<?php
namespace App\Services;

abstract class BaseService
{
    protected $repo;

    public function getAll($request)
    {
        return $this->repo->getAll($request);
    }

    public function __construct()
    {
        $this->setRepository();
    }

    abstract public function getRepository();

    public function setRepository()
    {
        $this->repo = app()->make(
            $this->getRepository()
        );
    }

    public function create(array $attribute)
    {
        return $this->repo->create($attribute);
    }

    public function insert(array $attributes)
    {
        return $this->repo->insert($attributes);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->repo->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
