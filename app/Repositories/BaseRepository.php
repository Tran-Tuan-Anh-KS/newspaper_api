<?php

namespace App\Repositories;

use Carbon\Carbon;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function model();

    public function setModel()
    {
        $this->model = app()->make(
            $this->model()
        );
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($limit = null)
    {
        $limit = $limit ?? config('common.default_per_page');

        return $this->model->paginate($limit);
    }

    public function orderBy($column, $direction)
    {
        return $this->model->orderBy($column, $direction)->get();
    }

    public function where($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }

    public function findOrFail($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findBySlugOrFail($slug)
    {
        try {
            return $this->model->whereSlug($slug)->firstOrFail();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function create(array $attribute)
    {
        return $this->model->create($attribute);
    }

    public function updateId(array $attribute, $id)
    {
        $eloquent = $this->findOrFail($id);

        return $eloquent->update($attribute);
    }

    public function updateSlug(array $attribute, $slug)
    {
        $eloquent = $this->findBySlugOrFail($slug);

        return $eloquent->update($attribute);
    }

    public function destroyId($id)
    {
        $eloquent = $this->findOrFail($id);

        return $eloquent->destroy();
    }

    public function destroySlug($slug)
    {
        $eloquent = $this->findBySlugOrFail($slug);

        return $eloquent->destroy();
    }

    public function destroyDatetime($id)
    {
        return $this->updateId(['deleted_at' => Carbon::now()], $id);
    }

    public function take($take)
    {
        return $this->model->latest()->take($take)->get();
    }

    public function latest()
    {
        return $this->model->latest();
    }

    public function get($columns = ['*'])
    {
      return $this->all($columns);
    }

}
