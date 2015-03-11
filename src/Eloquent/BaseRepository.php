<?php namespace Simnom\Repositories\Eloquent;

use Simnom\Repositories\Interfaces\BaseInterface;
use Simnom\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class BaseRepository implements BaseInterface {

    /**
     * @var
     */
    protected $model;

    /**
     * @var App
     */
    protected $app;

    /**
     * @param App $app
     * @throws \Bosnadev\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function all() {
        return $this->model->all();
    }

    public function first() {
        return $this->model->first();
    }

    public function find($id, array $relations = []) {
        return $this->model->with($relations)->find($id);
    }

    public function findFirstBy($key, $value) {
        return $this->model->where($key, $value)->first();
    }

    public function findAllBy($key, $value) {
        return $this->model->where($key, $value)->get();
    }

    public function create($array) {
        return $this->model->create($array);
    }

    public function firstOrCreate($array) {
        return $this->model->firstOrCreate($array);
    }

    public function firstOrNew($array) {
        return $this->model->firstOrNew($array);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = app()->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }
}
