<?php

namespace App\Services\Api\Admin;

use Carbon\Carbon;

abstract class BaseService
{
    protected $model;

    public function findBySlugOrFail($slug)
    {
        return $this->model->whereSlug($slug)->firstOrFail();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateId(array $attribute, $id)
    {
        $queryBuild = $this->model->findOrFail($id);
        $queryBuild->update($attribute);
        return $queryBuild;
    }

    public function paginate($limit = null, $orderBy, $valueOrderBy)
    {
        return $this->model->paginate($limit);
    }

    public function create(array $attribute)
    {
        return $this->model->create($attribute);
    }

    // public function updateSlug(array $attribute, $slug)
    // {
    //     $eloquent = $this->findBySlugOrFail($slug);
    //     $eloquent->update($attribute);
    //     return $eloquent;
    // }

    public function updateDeletedAt($slug)
    {
        $eloquent = $this->findBySlugOrFail($slug);

        $eloquent->update(['deleted_at' => Carbon::now()]);

        return $eloquent;
    }

    public function deleteAtId($id)
    {
        return $this->updateId(['deleted_at' => Carbon::now()], $id);
    }
}
