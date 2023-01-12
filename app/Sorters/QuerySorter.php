<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QuerySorter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var string
     */
    protected $delimiter = ',';

    /**
     * QuerySorter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->sorters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    /**
     * @return array|string|null
     */
    public function sorters()
    {
        $sorters = [];

        if ($this->request->exists('sort')) {
            $sortArray = $this->request->get('sort');
            $sorters = $this->parseSortArray($sortArray);
        }

        return $sorters;
    }

    /**
     * @param array $sort
     * @return array
     */
    protected function parseSortArray(array $sort): array
    {
        $sorters = [];
        foreach ($sort as $sortRule) {
            $sorters[$sortRule['field']] = $sortRule['order'];
        }
        return $sorters;
    }

    /**
     * @param $param
     * @return false|string[]
     */
    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}

