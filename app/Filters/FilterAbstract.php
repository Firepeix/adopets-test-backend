<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FilterAbstract implements FilterInterface
{
    protected $request;
    /**
     * @var Builder
     */
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setFilters();
    }

    public function build(Builder $builder): FilterInterface
    {
        $this->builder = $builder;
        return $this;
    }

    public function apply(): Builder
    {
        $this->process();
        return $this->builder;
    }

    abstract protected function setFilters() : void;

    abstract protected function process() : void;
}
