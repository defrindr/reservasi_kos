<?php

namespace App\Http\Services;

interface BaseService
{
  /**
   * Display a listing of the resource.
   */
  public function fetch($search = null, $orderBy = null, $orderDirection = 'asc', $limit = 10, $paginate = true);

  /**
   * Store a newly created resource in storage.
   */
  public function store(array $payload);

  /**
   * Display the specified resource.
   */
  public function show(string $id);

  /**
   * Update the specified resource in storage.
   */
  public function update(array $payload, string $id);

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id);
}
