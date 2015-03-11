<?php namespace Simnom\Repositories\Interfaces;

interface BaseInterface
{

    public function all();

    public function first();

    public function find($id, array $array = []);

    public function findFirstBy($key, $value);

    public function create($array);

    public function firstOrCreate($array);

    public function firstOrNew($array);

}
