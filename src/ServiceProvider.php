<?php

namespace Sikessem\View;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use ReflectionClass;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap View services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerServices();
    }

    /**
     * Register View services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerViews();
        $this->registerCompilers();
        $this->registerNamespaces();
        $this->registerDirectives();
        $this->registerComponents();
        $this->registerPublishables();
    }

    protected function registerServices(): void
    {
        $this->app->singleton(Manager::class);
        $this->app->instance('view.path', sikessem_view_path());
        $this->app->alias(Manager::class, 'sikessem.view');
        $this->app->alias('blade.compiler', TemplateCompiler::class);
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(sikessem_view_path('config/view.php'), 'sikessem.view');
    }

    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(sikessem_view_path('resources/langs'), 'view');
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(sikessem_view_path('resources/views'), 'view');
    }

    protected function registerNamespaces(): void
    {
        Blade::componentNamespace(Manager::COMPONENT_NAMESPACE, 'view');
        Blade::anonymousComponentNamespace(Manager::ANONYMOUS_COMPONENT_NAMESPACE, 'view');
    }

    protected function registerDirectives(): void
    {
        $directivesClass = new ReflectionClass(Directives::class);
        foreach ($directivesClass->getMethods() as $directiveMethod) {
            if ($directiveMethod->isStatic() && $directiveMethod->isPublic()) {
                $directiveName = $directiveMethod->getName();
                /** @var callable */
                $directive = [Directives::class, $directiveName];
                Blade::directive($directiveName, $directive);
            }
        }
    }

    protected function registerCompilers(): void
    {
        $app = $this->app;
        /** @var TemplateCompiler */
        $compiler = $app->make('blade.compiler');
        $compiler->precompiler(function ($string) use ($app) {
            /** @var ComponentCompiler */
            $precompiler = $app->make(ComponentCompiler::class);

            return $precompiler->compile($string);
        });
    }

    protected function registerComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponentPath(sikessem_view_path('src/Components'));
            $this->registerComponentPath(sikessem_view_path('resources/views/components'), anonymous: true);
        });
    }

    protected function registerPublishables(): void
    {
        $this->publishesToGroups([
            sikessem_view_path('config/view.php') => sikessem_config_path('view.php'),
        ], ['sikessem', 'sikessem:view', 'sikessem:view-config']);

        $this->publishesToGroups([
            sikessem_view_path('resources/langs') => sikessem_lang_path('view'),
        ], ['sikessem', 'sikessem:view', 'sikessem:view-langs']);

        $this->publishesToGroups([
            sikessem_view_path('resources/views') => sikessem_resource_path('view'),
        ], ['sikessem', 'sikessem:view', 'sikessem:view-views']);
    }

    /**
     * @param  string[]|null  $groups
     */
    protected function publishesToGroups(array $paths, ?array $groups = null): void
    {
        if (is_null($groups)) {
            $this->publishes($paths);

            return;
        }

        foreach ($groups as $group) {
            $this->publishes($paths, $group);
        }
    }

    protected function registerComponentPath(string $path, string $base = '', bool $anonymous = false): void
    {
        if (file_exists($path)) {
            is_dir($path) ?
            $this->registerComponentDirectory($path, $base, $anonymous) :
            $this->registerComponentFile($path, $base, $anonymous);
        }
    }

    protected function registerComponentDirectory(string $directory, string $base = '', bool $anonymous = false): void
    {
        if ($files = scandir($directory)) {
            $separator = $anonymous ? '.' : '\\';
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $path = "$directory/$file";
                    $this->registerComponentPath($path, is_dir($path) ? "{$base}$separator{$file}" : $base, $anonymous);
                }
            }
        }
    }

    protected function registerComponentFile(string $file, string $base, bool $anonymous = false): void
    {
        if (($anonymous && Str::of($file)->is('*.blade.php')) || (! $anonymous && Str::of($file)->is('*.php'))) {
            $component = basename($file, $anonymous ? '.blade.php' : '.php');
            $separator = $anonymous ? '.' : '\\';
            $base = Str::of($base)->trim($separator);
            if (! $component || $component === 'index') {
                $component = $base;
            } else {
                $component = Str::of("{$base}$separator{$component}")->trim($separator);
            }
            $this->registerComponent($component->toString(), anonymous: $anonymous);
        }
    }

    protected function registerComponent(string $class, ?string $alias = null, bool $anonymous = false): void
    {
        Facade::component($class, $alias, $anonymous);
    }

    /**
     * @param  string[]  $aliases
     */
    protected function registerComponentAliases(string $class, array $aliases = [], ?string $suffix = null): void
    {
        foreach ($aliases as $alias) {
            $this->registerComponent($class, is_null($suffix) ? $alias : "$alias-$suffix");
        }
    }
}
