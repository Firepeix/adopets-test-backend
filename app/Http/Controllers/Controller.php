<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\TransformerAbstract;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $manager;
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->setManager();
    }

    private function setManager(): void
    {
        $this->manager = new Manager();
        $this->manager->setSerializer(new DataArraySerializer());
    }

    public function item($item, TransformerAbstract $transformer): array
    {
        return $this->manager->createData(new Item($item, $transformer))->toArray();
    }

    public function collection(\Illuminate\Support\Collection $collection, TransformerAbstract $transformer): array
    {
        return $this->manager->createData(new Collection($collection, $transformer))->toArray();
    }

    public function paginate(Builder $builder, TransformerAbstract $transformer): array
    {
        $builder = $builder->paginate();
        $resource = new Collection($builder->getCollection(), $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($builder));
        return $this->manager->createData($resource)->toArray();
    }

    protected function getDeletedResponse()
    {
        return $this->response::json(['success' => true]);
    }
}
