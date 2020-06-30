<?php


namespace App\Filters\Backoffice\Store;


use App\Filters\FilterAbstract;

class ProductFilter extends FilterAbstract
{
    private $name;
    private $description;
    private $category;

    protected function setFilters(): void
    {
        $this->name = $this->request->get('name');
        $this->description = $this->request->get('description');
        $this->category = $this->request->get('category');
    }

    protected function process(): void
    {
        $this->filterName();
        $this->filterDescription();
        $this->filterCategory();
    }

    private function filterName()
    {
        if ($this->name !== null) {
            $this->builder = $this->builder->where('name', 'like', "%$this->name%");
        }
    }

    private function filterDescription()
    {
        if ($this->description !== null) {
            $this->builder = $this->builder->where('description', 'like', "%$this->description%");
        }
    }

    private function filterCategory()
    {
        if ($this->category !== null) {
            $this->builder = $this->builder->where('category', 'like', "%$this->category%");
        }
    }
}
