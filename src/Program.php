<?php

declare(strict_types=1);

namespace Sikessem\View;

use InvalidArgumentException;
use RuntimeException;

final class Program
{
    protected string $projectRoot;

    protected array $composerJson;

    protected string $name;

    protected string $description;

    protected array $commands = [];

    protected array $icons = [
        'success' => '✅', 'error' => '❌', 'warning' => '⚠️',
        'info' => 'ℹ️', 'question' => '❓', 'debug' => '🐞',
        'rocket' => '🚀', 'fire' => '🔥', 'star' => '⭐',
        'heart' => '❤️', 'thumbsUp' => '👍', 'thumbsDown' => '👎',
        'clock' => '⏳', 'lightning' => '⚡', 'skull' => '💀',
        'bulb' => '💡', 'hammer' => '🔨', 'wrench' => '🔧',
        'file' => '📄', 'folder' => '📁', 'lock' => '🔒',
        'unlock' => '🔓', 'bell' => '🔔', 'coffee' => '☕',
    ];

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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function execute(array $args): int
    {
        $this->output("Project: {$this->name}\n\t{$this->description}".PHP_EOL);
        if (! count($args)) {
            $code = $this->scan('❯ ');
            $this->output($code);
        }

        return 0;
    }

    /**
     * @return (array|mixed|null)[]
     *
     * @psalm-return array{argv0: mixed|null, args: array}
     */
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
            if (preg_match("/^{$pattern}$/", $name, $matches)) {
                return $action;
            }
        }

        return null;
    }

    public function sendError(string $message, string ...$args): never
    {
        $this->output($message, ...$args);
        $this->end(1);
    }

    public function output(string $message, mixed ...$args): void
    {
        $this->print(STDOUT, $message, ...$args);
    }

    /**
     * @param  resource  $stream
     */
    public function print($stream, string $message, mixed ...$args): void
    {
        $message .= PHP_EOL;

        if (empty($args)) {
            fwrite($stream, $message);
        } else {
            fprintf($stream, $message, ...$args);
        }
    }

    public function scan(?string $prompt = null): string|false
    {
        return isset($prompt) ? readline($prompt) : trim(fgets(STDIN));
    }

    public function end(int $code = 0): never
    {
        exit($code);
    }

    public function icon(string $name): string
    {
        return $this->icons[$name] ?? '';
    }

    protected function loadComposerJson(string $dir): mixed
    {
        return $this->loadJson($dir.DIRECTORY_SEPARATOR.'composer.json', true);
    }

    protected function loadJson(string $file, bool $assoc = false): mixed
    {
        if (! is_file($file)) {
            throw new InvalidArgumentException("{$file} is not a file");
        }

        $file = realpath($file);
        $data = file_get_contents($file);

        if (! json_validate($data)) {
            throw new RuntimeException("Invalid `composer.json` file ({$file})");
        }

        return json_decode($data, $assoc);
    }
}
