<?php namespace Simnom\Repositories\Eloquent;

use Simnom\Repositories\Interfaces\BaseInterface;
use Simnom\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

/**
 * Repository RepositoryInterface
 * @package Simnom\Repositories\Eloquent
 */
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

    /**
     * Return all records for model
     * @return mixed
     */
    public function all() {
        return $this->model->all();
    }

    /**
     * Return first record for model
     * @return mixed
     */
    public function first() {
        return $this->model->first();
    }

    /**
     * Find a record by ID with relations
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     */
    public function find($id, array $relations = []) {
        return $this->model->with($relations)->find($id);
    }

    /**
     * Find record by column/value with relations
     *
     * @param string $key
     * @param string $value
     * @param array $relations
     * @return mixed
     */
    public function findFirstBy($key, $value, array $relations = []) {
        return $this->model->where($key, $value)->with($relations)->first();
    }

    /**
     * Find all records by column/value with relations
     *
     * @param string $key
     * @param string $value
     * @param array $relations
     * @return mixed
     */
    public function findAllBy($key, $value, array $relations = []) {
        return $this->model->where($key, $value)->get();
    }

    /**
     * Create a new record
     *
     * @param array $data
     * @return mixed
     */
    public function create($data) {
        return $this->model->create($data);
    }

    /**
     * Update a record
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data) {
        return $this->model->find($id)->update($data);
    }

    /**
     * Delete a record (by id)
     * @param int $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

    /**
     * Find first matching records or create (and save) new record
     *
     * @param array $columns
     * @return mixed
     */
    public function firstOrCreate($columns) {
        return $this->model->firstOrCreate($columns);
    }


    /**
     * Find first matching record or make new instance of model (not saved)
     *
     * @param array $columns
     * @return mixed
     */
    public function firstOrNew($columns) {
        return $this->model->firstOrNew($columns);
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
