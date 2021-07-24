<?php

namespace App\Services\Api\Admin;

use App\Eloquent\Category;
use Illuminate\Support\Facades\DB;
use App\Services\Api\Admin\BaseService;

class CategoryService extends BaseService
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory($filters = [], $limit = null)
    {
        $limit = $limit ?? config('common.default_per_page');

        $results = $this->category->orderBy('created_at', 'DESC')->paginate($limit);

        return $results;
    }

    public function showCategory($id)
    {
        $data = $this->category->findOrFail($id);

        return $data;
    }

    public function createCategory($data)
    {
        $eloquent = $this->category->create($data);

        return $eloquent;
        // try {
        //     DB::beginTransaction();
        //     $eloquent = $this->category->create($data);
        //     return $eloquent;
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        // }
    }

    public function updateCategory($data, $id)
    {

        $eloquent = $this->category->updateId($data, $id);

        return $eloquent;
    }

    public function destroy($id)
    {
        $eloquent = $this->category->deleteAtId($id);

        return $eloquent;
    }
}
