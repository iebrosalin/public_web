<?php


namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Nexmo\Call\Collection;

class BlogCategoryRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


    /**
     * @return Collection
     */
    public function getForComboBox()
    {

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title'
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * @param int|null $perPage
     * @return mixed
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->paginate($perPage, $columns);

        return $result;
    }
}