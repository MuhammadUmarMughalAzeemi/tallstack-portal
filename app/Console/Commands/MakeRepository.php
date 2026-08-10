<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create repository and interface';

    public function handle()
    {
        $name = \Illuminate\Support\Str::studly($this->argument('name'));
        $plural = \Illuminate\Support\Str::pluralStudly($name);

        $basePath = app_path("Repositories/{$plural}");

        $interfacePath = "{$basePath}/Interfaces/{$name}RepositoryInterface.php";
        $repoPath = "{$basePath}/{$name}Repository.php";

        // Create directories
        File::ensureDirectoryExists("{$basePath}/Interfaces");

        // Create files
        File::put($interfacePath, $this->interfaceTemplate($name, $plural));
        File::put($repoPath, $this->repositoryTemplate($name, $plural));

        $this->updateServiceProvider($name, $plural);
        $this->updateUserService($name, $plural);

        $this->info("Repository created successfully for {$name}");
    }

    private function interfaceTemplate($name, $plural)
    {
        return "<?php

namespace App\\Repositories\\{$plural}\\Interfaces;

use App\\Repositories\\Base\\Interfaces\\BaseRepositoryInterface;

interface {$name}RepositoryInterface extends BaseRepositoryInterface
{

}";
    }

    private function repositoryTemplate($name, $plural)
    {
        return "<?php

namespace App\\Repositories\\{$plural};

use App\\Models\\{$name};
use App\\Repositories\\Base\\BaseRepository;
use App\\Repositories\\{$plural}\\Interfaces\\{$name}RepositoryInterface;

class {$name}Repository extends BaseRepository implements {$name}RepositoryInterface
{
    /**
     * {$name}Repository constructor.
     *
     * @param {$name} \$model
     */
    public function __construct({$name} \$model)
    {
        parent::__construct(\$model);
    }
}";
    }

    private function updateServiceProvider($name, $plural): void
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');

        if (!File::exists($providerPath)) {
            $this->warn("AppServiceProvider.php not found!");
            return;
        }

        $content = File::get($providerPath);

        $interfaceClass = "{$name}RepositoryInterface";
        $repositoryClass = "{$name}Repository";
        $interfaceFull = "App\\Repositories\\{$plural}\\Interfaces\\{$interfaceClass}";
        $repositoryFull = "App\\Repositories\\{$plural}\\{$repositoryClass}";

        // Check if binding already exists
        if (str_contains($content, $interfaceFull)) {
            $this->info("Binding for {$interfaceClass} already exists in AppServiceProvider");
            return;
        }

        // Add imports if they don't exist
        $interfaceImport = "use {$interfaceFull};";
        $repositoryImport = "use {$repositoryFull};";

        // Find the last use statement or namespace to add imports
        $usePattern = '/(use [^;]+;[\s]*)+/';
        if (preg_match($usePattern, $content, $matches)) {
            $lastUsePos = strrpos($content, $matches[0]);
            $content = substr_replace($content, $matches[0] . "\n" . $interfaceImport . "\n" . $repositoryImport . "\n", $lastUsePos, strlen($matches[0]));
        } else {
            // If no use statements found, add after namespace
            $pattern = '/namespace App\\\Providers;\s*/';
            $content = preg_replace($pattern, '$0' . "\n" . $interfaceImport . "\n" . $repositoryImport . "\n", $content, 1);
        }

        // Add the binding in register method
        $bindingCode = "\n        \$this->app->bind({$interfaceClass}::class, {$repositoryClass}::class);";

        // Find where to add binding (after existing bindings or at the end of register method)
        $registerPattern = '/public function register\(\): void\s*\{([^}]*)\}/s';
        if (preg_match($registerPattern, $content, $matches)) {
            $registerBody = $matches[1];

            // Check if there are existing bindings
            if (trim($registerBody)) {
                // Add after existing content
                $newRegisterBody = $registerBody . $bindingCode;
            } else {
                // Add as first binding
                $newRegisterBody = $bindingCode;
            }

            $content = str_replace($matches[0], "public function register(): void {{$newRegisterBody}\n    }", $content);
        } else {
            // If register method doesn't have void return type or different format
            $registerPattern = '/public function register\(\)\s*\{([^}]*)\}/s';
            if (preg_match($registerPattern, $content, $matches)) {
                $registerBody = $matches[1];

                if (trim($registerBody)) {
                    $newRegisterBody = $registerBody . $bindingCode;
                } else {
                    $newRegisterBody = $bindingCode;
                }

                $content = str_replace($matches[0], "public function register() {{$newRegisterBody}\n    }", $content);
            } else {
                // If register method not found, add it
                $registerMethod = "\n    public function register(): void\n    {\n        {$bindingCode}\n    }\n";
                $pattern = '/<\?php\s*/';
                $content = preg_replace($pattern, '$0' . $registerMethod, $content, 1);
            }
        }

        File::put($providerPath, $content);
        $this->info("✓ Binding added to AppServiceProvider: {$interfaceClass} → {$repositoryClass}");
    }

    private function updateUserService($name, $plural): void
    {
        $userServicePath = app_path('Services/UserServices/UserService.php');

        if (!File::exists($userServicePath)) {
            $this->warn("UserService.php not found at: {$userServicePath}");
            return;
        }

        $content = File::get($userServicePath);

        $repositoryInterface = "{$name}RepositoryInterface";
        $repositoryInterfaceFull = "App\\Repositories\\{$plural}\\Interfaces\\{$repositoryInterface}";
        $propertyName = lcfirst($repositoryInterface);

        // Check if repository already exists in the service
        if (str_contains($content, $repositoryInterfaceFull)) {
            $this->info("{$repositoryInterface} already exists in UserService");
            return;
        }

        // 1. Add use statement
        $useStatement = "use {$repositoryInterfaceFull};";

        // Find the last use statement position
        $usePattern = '/(use [^;]+;[\s]*)+/';
        if (preg_match($usePattern, $content, $matches)) {
            $lastUsePos = strrpos($content, $matches[0]);
            $content = substr_replace($content, $matches[0] . "\n" . $useStatement . "\n", $lastUsePos, strlen($matches[0]));
        } else {
            // If no use statements, add after namespace
            $pattern = '/namespace App\\\Services\\\UserServices;\s*/';
            $content = preg_replace($pattern, '$0' . "\n" . $useStatement . "\n", $content, 1);
        }

        // 2. Add property
        $propertyCode = "\n    protected \${$propertyName};\n";

        // Find the last property (look for protected/private properties before constructor)
        $propertyPattern = '/\n    protected \$[a-zA-Z0-9]+;/';
        if (preg_match_all($propertyPattern, $content, $propertyMatches)) {
            $lastProperty = end($propertyMatches[0]);
            $lastPropertyPos = strrpos($content, $lastProperty);
            $content = substr_replace($content, $lastProperty . $propertyCode, $lastPropertyPos, strlen($lastProperty));
        } else {
            // If no properties found, add after class opening brace
            $pattern = '/class UserService\s*\{\s*/';
            $content = preg_replace($pattern, '$0' . $propertyCode, $content, 1);
        }

        // 3. Add parameter to constructor
        $parameterCode = "\n        {$repositoryInterface} \${$propertyName},";

        // Find the constructor parameters
        $constructorPattern = '/public function __construct\(([^)]*)\)/s';
        if (preg_match($constructorPattern, $content, $matches)) {
            $params = $matches[1];
            // Add parameter before the last parameter (or as first if none)
            if (trim($params)) {
                $content = preg_replace(
                    $constructorPattern,
                    "public function __construct({$parameterCode}\n        {$params})",
                    $content,
                    1
                );
            } else {
                $content = preg_replace(
                    $constructorPattern,
                    "public function __construct({$parameterCode}\n    )",
                    $content,
                    1
                );
            }
        }

        // 4. Add parameter to PHPDoc
        $phpDocParam = "     * @param {$repositoryInterface} \${$propertyName}\n";

        // Find the constructor PHPDoc block
        $docPattern = '/\/\*\*\s*\n([^*]*\*[^\/]*)*\s*\*\/\s*\n\s*public function __construct/s';
        if (preg_match($docPattern, $content, $docMatches)) {
            $docBlock = $docMatches[0];
            // Find where to insert the new param (usually before the last @param or before closing)
            $paramPattern = '/\* @param [^\n]+\n/';
            if (preg_match_all($paramPattern, $docBlock, $paramMatches)) {
                $lastParam = end($paramMatches[0]);
                $lastParamPos = strrpos($docBlock, $lastParam);
                $newDocBlock = substr_replace($docBlock, $lastParam . $phpDocParam, $lastParamPos, strlen($lastParam));
                $content = str_replace($docBlock, $newDocBlock, $content);
            } else {
                // If no params in PHPDoc, add after the opening
                $newDocBlock = preg_replace('/\/\*\*\s*\n/', '$0' . $phpDocParam, $docBlock, 1);
                $content = str_replace($docBlock, $newDocBlock, $content);
            }
        }

        // 5. Assign property in constructor
        $assignmentCode = "\n        \$this->{$propertyName} = \${$propertyName};";

        // Find where to add assignment (usually at the end of constructor assignments)
        $assignmentPattern = '/\$this->[a-zA-Z0-9]+ = \$[a-zA-Z0-9]+;/';
        if (preg_match_all($assignmentPattern, $content, $assignmentMatches)) {
            $lastAssignment = end($assignmentMatches[0]);
            $lastAssignmentPos = strrpos($content, $lastAssignment);
            $content = substr_replace($content, $lastAssignment . $assignmentCode, $lastAssignmentPos, strlen($lastAssignment));
        } else {
            // If no assignments, add after opening brace of constructor
            $constructorOpenPattern = '/public function __construct\([^\)]*\)\s*\{\s*/s';
            $content = preg_replace($constructorOpenPattern, '$0' . $assignmentCode, $content, 1);
        }

        // Save the updated content
        File::put($userServicePath, $content);
        $this->info("✓ {$repositoryInterface} automatically injected into UserService");
    }
}
