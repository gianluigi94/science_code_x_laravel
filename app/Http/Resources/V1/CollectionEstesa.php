<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Collection generica che avvolge ogni item con la Resource specificata.
 *
 * Uso:
 *   return new CollectionEstesa($items, UtenteResource::class);
 */
class CollectionEstesa extends ResourceCollection
{
    protected string $resourceClass;

    /**
     * @param mixed  $resource      La collezione/array/paginator da trasformare
     * @param string $resourceClass Classe della JsonResource da applicare a ogni item
     */
    public function __construct($resource, string $resourceClass)
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
    }

    public function toArray(Request $request): array
    {
        $class = $this->resourceClass;

        return $this->collection
            ->map(fn ($item) => new $class($item))
            ->all();
    }
}
