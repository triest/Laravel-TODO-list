<?php



namespace App\Filters;



use const FILTER_VALIDATE_BOOLEAN;

class ToDoListFilter extends QueryFilter
{

    public function tags(array $tags){
        $this->builder->whereHas('tags',function ($q) use ($tags){
            $q->whereIn('tags.id',$tags);
        });
    }
}

