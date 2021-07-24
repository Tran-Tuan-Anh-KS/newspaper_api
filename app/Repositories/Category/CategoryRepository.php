<?php

namespace App\Repositories\Category;

use App\Eloquent\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
  public function model()
  {
    return Category::class;
  }
}
