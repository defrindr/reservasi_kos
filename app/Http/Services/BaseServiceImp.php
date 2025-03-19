<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseServiceImp implements BaseService
{
  protected Model $model;

  protected Builder $query;

  public function __construct(Model $model)
  {
    $this->model = $model;
    $this->query = $model->query();
  }

  public function hookSearch($query, $search)
  {
    return $query->where('name', 'like', "%$search%");
  }

  /**
   * Display a listing of the resource.
   */
  public function fetch($search = null, $orderBy = null, $orderDirection = 'asc', $limit = 10, $paginate = true)
  {
    $query = $this->query;

    if ($search) {
      $query->where(function ($q) use ($search) {
        $q = $this->hookSearch($q, $search);
      });
    }

    if ($orderBy) {
      $query->orderBy($orderBy, $orderDirection);
    }

    return $paginate ? $query->paginate($limit) : $query->get();
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(array $payload)
  {
    return $this->model->create($payload);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    return $this->query->findOrFail($id);
  }

  public function update(array $payload, string $id)
  {
    $model = $this->model->find($id);
    $model->fill($payload);

    return $model->save();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $project = $this->query->findOrFail($id);

    return $project->delete();
  }
}
