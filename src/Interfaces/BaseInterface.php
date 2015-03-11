<?php namespace Simnom\Repositories\Interfaces;

interface BaseInterface
{

    public function all();

    public function first();

    public function find($id, array $relations = []);

    public function findFirstBy($key, $value, $relations);

    public function findAllBy($key, $value, $relations);

    public function create($array);

    public function update($id, $array);

    public function delete($id);

    public function firstOrCreate($array);

    public function firstOrNew($array);

}
