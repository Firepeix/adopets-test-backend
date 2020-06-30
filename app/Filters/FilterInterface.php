<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * @return Builder
     */
    public function apply() : Builder;

    public function build(Builder $builder): FilterInterface;
}
