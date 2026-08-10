<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeBaseRepository extends Command
{
    protected $signature = 'make:base-repository';
    protected $description = 'Create Base Repository and Interface';

    public function handle()
    {
        $basePath = app_path("Repositories/Base");
        $interfacePath = "{$basePath}/Interfaces/BaseRepositoryInterface.php";
        $repoPath = "{$basePath}/BaseRepository.php";

        // Check if already exists
        if (File::exists($repoPath) && File::exists($interfacePath)) {
            $this->error("Base Repository already exists!");
            return 1;
        }

        // Create directories
        File::ensureDirectoryExists("{$basePath}/Interfaces");

        // Create files
        File::put($interfacePath, $this->interfaceTemplate());
        File::put($repoPath, $this->repositoryTemplate());

        $this->updateServiceProvider();

        $this->info("✓ Base Repository created successfully!");
        $this->info("✓ Interface created successfully!");

        return 0;
    }

    private function interfaceTemplate()
    {
        return '<?php

namespace App\Repositories\Base\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $attributes): Model;
    public function update(array $attributes, int $id): object;
    public function find(int $id, array $with = []);
    public function findBy(array $data, array $with = [], string $orderBy = "id", string $sortBy = "asc");
    public function findOneBy(array $data, array $with = [], array $withCount = []);
    public function delete(int $id): bool;
    public function insert(array $attributes): bool;
    public function all(array $columns = ["*"], array $with = [], string $orderBy = "id", string $sortBy = "asc");
    public function allWhere(array $columns = ["*"], array $where = [], array $with = [], string $orderBy = "id", string $sortBy = "asc"): mixed;
    public function newModelInstance();
    public function updateOrCreate(array $search, array $attributes);
}';
    }

    private function repositoryTemplate()
    {
        return '<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Base\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes) : Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): object
    {
        return tap($this->model->find($id))->update($attributes);
    }

    /**
     * @param int $id
     * @param array $with
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(int $id, array $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @param array $data
     * @param array $with
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function findBy(array $data, array $with = [], string $orderBy = "id", string $sortBy = "asc")
    {
        return $this->model->where($data)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @param array $data
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    public function findOneBy(array $data, array $with = [], array $withCount = [])
    {
        return $this->model->where($data)->with($with)->withCount($withCount)->first();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function insert(array $attributes): bool
    {
        return $this->model->query()->insert($attributes);
    }

    /**
     * @param array $columns
     * @param array $with
     * @param string $orderBy
     * @param string $sortBy
     * @return Builder[]|Collection
     */
    public function all(array $columns = ["*"], array $with = [], string $orderBy = "id", string $sortBy = "asc")
    {
        return $this->model->with($with)->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param array $columns
     * @param array $where
     * @param array $with
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function allWhere(
        array $columns = ["*"],
        array $where = [],
        array $with = [],
        string $orderBy = "id",
        string $sortBy = "asc"
    ): mixed {
        return $this->model->query()->select($columns)->where($where)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @return mixed
     */
    public function newModelInstance()
    {
        return new $this->model();
    }

    /**
     * @param array $search
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreate(array $search, array $attributes)
    {
        return $this->model->updateOrCreate($search, $attributes);
    }
}';
    }


    private function updateServiceProvider(): void
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');

        if (!File::exists($providerPath)) {
            $this->warn("AppServiceProvider.php not found!");
            return;
        }

        $content = File::get($providerPath);

        // Check if binding already exists
        if (str_contains($content, 'BaseRepositoryInterface')) {
            $this->info("Binding already exists in AppServiceProvider");
            return;
        }

        // Add imports if they don't exist
        $interfaceImport = "use App\\Repositories\\Base\\Interfaces\\BaseRepositoryInterface;";
        $repositoryImport = "use App\\Repositories\\Base\\BaseRepository;";

        if (!str_contains($content, $interfaceImport)) {
            // Find the last use statement or namespace
            $pattern = '/(use [^;]+;[\s]*)+/';
            if (preg_match($pattern, $content, $matches)) {
                $lastUsePos = strrpos($content, $matches[0]);
                $content = substr_replace($content, $matches[0] . "\n" . $interfaceImport . "\n" . $repositoryImport . "\n", $lastUsePos, strlen($matches[0]));
            } else {
                // If no use statements found, add after namespace
                $pattern = '/namespace App\\\Providers;\s*/';
                $content = preg_replace($pattern, '$0' . "\n" . $interfaceImport . "\n" . $repositoryImport . "\n", $content, 1);
            }
        }

        // Add the binding with short class names
        $bindingCode = "\n        \$this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);";

        // Find the register method and add the binding
        $pattern = '/public function register\(\): void\s*\{\s*/';
        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, '$0' . $bindingCode, $content, 1);
        } else {
            // If register method doesn't have void return type
            $pattern = '/public function register\(\)\s*\{\s*/';
            $content = preg_replace($pattern, '$0' . $bindingCode, $content, 1);
        }

        File::put($providerPath, $content);
        $this->info("✓ Auto-binding added to AppServiceProvider");
        $this->info("✓ Imports added automatically");
    }
}
