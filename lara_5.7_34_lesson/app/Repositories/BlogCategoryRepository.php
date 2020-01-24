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

}