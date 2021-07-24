<?php

namespace App\Repositories;

interface BaseInterface
{
  public function all();

  public function paginate($limit = null);

  public function orderBy($column, $direction);

  public function where($column, $value);

  public function findOrFail($id);

  public function findBySlugOrFail($slug);

  public function create(array $attribute);

  public function updateId(array $attribute, $id);

  public function updateSlug(array $attribute, $slug);

  public function destroyId($id);

  public function destroySlug($slug);

  public function destroyDatetime($id);

  public function take($take);

  public function latest();

  public function get($columns = ['*']);

}
