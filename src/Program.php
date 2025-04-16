<?php

declare(strict_types=1);

namespace Sikessem\View;

use InvalidArgumentException;
use RuntimeException;

class Program
{
    protected string $projectRoot;

    protected array $composerJson;

    protected string $name;

    protected string $description;

    protected array $commands = [];

    public function __construct(protected string $binFile, protected string $userRoot)
    {
        if (! is_file($binFile)) {
            throw new InvalidArgumentException("$binFile is not a file");
        }

        if (! is_dir($userRoot)) {
            throw new InvalidArgumentException("$userRoot is not a directory");
        }

        $this->binFile = realpath($binFile);
        $this->userRoot = realpath($userRoot);
        $this->projectRoot = dirname(__DIR__);

        $this->configure();
    }

    public function configure(): void
    {
        $this->composerJson = $this->loadComposerJson($this->userRoot);
        /** @var array{name: string, version: string, description: string} */
        $project = $this->projectRoot === $this->userRoot
        ? $this->composerJson
           : $this->loadComposerJson($this->projectRoot);

        $this->setProject($project);
    }

    public function setProject(array $project): static
    {
        return $this
            ->setName($project['name'])
            ->setDescription($project['description']);
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function loadComposerJson(string $dir): mixed
    {
        return $this->loadJson($dir.DIRECTORY_SEPARATOR.'composer.json', true);
    }

    protected function loadJson(string $file, bool $assoc = false): mixed
    {
        if (! is_file($file)) {
            throw new InvalidArgumentException("$file is not a file");
        }

        $file = realpath($file);
        $data = file_get_contents($file);

        if (! json_validate($data)) {
            throw new RuntimeException("Invalid `composer.json` file ($file)");
        }

        return json_decode($data, $assoc);
    }

    /**
     * @param  null|array<string>  $argv
     **/
    public function run(?int $argc = null, ?array $argv = null): never
    {
        extract($this->parseArgs($argc, $argv));
        $binFile = realpath($argv0);

        if ($binFile !== $this->binFile && basename($this->binFile) !== basename($binFile) && dirname($binFile) !== dirname(__DIR__)) {
            $this->sendError('Cannot run %s from %s', $this->binFile, $argv0);
        }

        $code = $this->execute($args);

        exit($code);
    }

    /**
     * @param  null|array<string>  $args
     **/
    public function execute(array $args): int
    {
        return 0;
    }

    public function parseArgs(int $argc, array $argv): array
    {
        /** @var array<string> */
        $argv ??= $_SERVER['argv'] ?? [];
        $argc ??= $argc ?? count($argv);

        if ($argc !== count($argv)) {
            $this->sendError('Wrong arguments count');
        }

        if ($argc < 1) {
            $this->sendError('No argument given');
        }

        return ['argv0' => array_shift($argv), 'args' => $argv];
    }

    public function command(string $name, ?callable $action = null): ?callable
    {
        if (isset($action)) {
            return $this->commands[$name] = $action;
        }

        $name = realpath($name);
        $name = substr($name, strlen($this->userRoot));
        $name = trim($name, DIRECTORY_SEPARATOR);

        foreach ($this->commands as $pattern => $action) {
            if (preg_match("/^$pattern$/", $name, $matches)) {
                return $action;
            }
        }

        return null;
    }

    public function executeCommand(string $name, array $args): mixed
    {
        if ($process = $this->command($name)) {
            return $process(...$args);
        }
        $this->sendError("Command $name not found");
    }

    public function sendError(string $message, mixed ...$args): never
    {
        $this->printError($message, ...$args);
        exit(1);
    }

    public function printError(string $message, mixed ...$args): void
    {
        $this->print(STDOUT, $message, ...$args);
    }

    public function print($stream, $message, mixed ...$args): void
    {
        $message .= PHP_EOL;

        if (empty($args)) {
            fwrite($stream, $message);
        } else {
            fprintf($stream, $message, ...$args);
        }
    }
}
