<?php


namespace App\Models;


use App\Filters\QueryFilter;
use App\Sorters\QuerySorter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * @param Builder $builder
     * @param QueryFilter $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }

    /**
     * @param Builder $builder
     * @param QuerySorter $sorters
     * @return Builder
     */
    public function scopeSort(Builder $builder, QuerySorter $sorters)
    {
        return $sorters->apply($builder);
    }
}
