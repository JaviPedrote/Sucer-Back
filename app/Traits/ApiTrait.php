<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;


trait ApiTrait{
        // SCOPES PARA CONSULTAS DINÁMICAS

    /**
     * Scope "included": carga relaciones especificadas en la petición
     * Ejemplo: ?included=announcements,announcements.user
     */
    public function scopeIncluded(Builder $query)
    {
        // Si no hay relaciones permitidas o no se envió parámetro 'included', terminar
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        // Convertimos el string en array de relaciones solicitadas
        $relations = explode(',', request('included'));

        // Creamos una colección con las relaciones permitidas
        $allowIncluded = collect($this->allowIncluded);

        // Filtramos solo aquellas relaciones que estén en la lista de permitidos
        foreach ($relations as $key => $relationship) {
            if (! $allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        // Ejecutamos eager loading de las relaciones filtradas
        $query->with($relations);
    }

    /**
     * Scope "fitter": aplica filtros dinámicos en la consulta
     * Ejemplo: ?filter[name]=foo&filter[slug]=bar
     */
    public function scopeFitter(Builder $query)
    {
        // Si no hay campos permitidos para filtrar o no se envió 'filter', terminar
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        // Obtenemos el array asociativo de filtros de la petición
        $filters = request('filter');

        // Convertimos los campos permitidos en colección
        $allowFilter = collect($this->allowFilter);

        // Recorremos cada filtro y, si está permitido, lo aplicamos con LIKE
        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    /**
     * Scope "sort": ordena dinámicamente la consulta
     * Ejemplo: ?sort=name,-id  (asc por name, desc por id)
     */
    public function scopeSort(Builder $query)
    {
        // Si no hay campos permitidos para ordenar o no se envió 'sort', terminar
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        // Separamos los campos de orden por comas
        $sortsFields = explode(',', request('sort'));

        // Colección de campos permitidos para ordenar
        $allowSort = collect($this->allowSort);

        // Recorremos cada campo solicitado
        foreach ($sortsFields as $sortField) {
            // Por defecto ascendente
            $direction = 'asc';

            // Si comienza con '-', invertimos a descendente
            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            // Si el campo está en la lista de permitidos, aplicamos orderBy
            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {

        if (request('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        // Si no, devolvemos todos los resultados
        return $query->get();
    }
}
