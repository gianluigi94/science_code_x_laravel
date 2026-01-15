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
    protected string $resourceClass; //passerò nei controller la resource ogni volta la resource che mi servirà in quel momento

   /**
 * Crea la collection estesa impostando la Resource per ogni elemento.
 * __construct viene eseguito automaticamente quando si instanzia la classe.
 *
 * @link https://www.php.net/manual/en/language.oop5.decon.php
 * @param mixed $records
 * @param string $resourceClass
 */

    public function __construct($records, string $resourceClass)
    {
        parent::__construct($records); //passo alla classe padre: ResourceCollection i dati ottenuti dal model in questione
        $this->resourceClass = $resourceClass;
    }

    /**
     * Converte la risorsa Abilita in array JSON.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $class = $this->resourceClass;

        return $this->collection
            ->map(fn($item) => new $class($item)) //applica una funzione per ogni elemento della lista istanziando la resource
            ->all();
    }
}
