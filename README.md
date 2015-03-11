# Basic Laravel Repositories
A basic repository structure for Laravel currently implementing Eloquent.

## Installing via composer
Add `"simnom/laravel-repositories": "0.0.1"` to your composer.json file and run `composer update`

## Usage
The basic repository and interface allows for extension within a Laravel application so additional methods can be added with ease. Just specify the model you wish to interact with.

At it's most basic level create an interface:

```
<?php namespace App\Models\Products\Interfaces;

use Simnom\Repositories\Interfaces\BaseInterface;

interface CategoryRepositoryInterface extends BaseInterface {}
```
And your own repository file:
```
<?php namespace App\Models\Products\Repositories;

use App\Models\Products\Interfaces\CategoryRepositoryInterface;
use Simnom\Repositories\Eloquent\BaseRepository;

class CategoryEloquentRepository extends BaseRepository implements CategoryRepositoryInterface {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Products\Category';
    }
}
```
From here adding additional model specific methods is trivial. Simply add the method to your project repository and reflect this in the interface, for example:

```
...
interface CategoryRepositoryInterface extends BaseInterface {
...
    public function getCategoriesInMoreComplexWay($params);
}
```
```
class CategoryEloquentRepository extends BaseRepository implements CategoryRepositoryInterface {
...
    public function getCategoriesInMoreComplexWay($params)
    {
        return $this->model->where('x', 'y')
            ->where('aa', '!=', 'bb')
            ->get()
```

### TODO
 - Add some tests
 - Add pagination methods
 - Add additional ORMs if required


#### Notes

This is my first foray into package creation, go easy ;-)

Credit to Mirza Pasic's article at http://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5 for the basis of this package