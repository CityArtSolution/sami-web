<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\Translator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        // ✅ تخصيص ديركتيفات Blade
        Blade::directive('hasPermission', function ($permissions) {
            return "<?php if(Auth::user()->can({$permissions})): ?>";
        });

        Blade::directive('endhasPermission', function () {
            return '<?php endif; ?>';
        });

        // ✅ تخصيص تحميل الترجمة
        $this->app->singleton('translation.loader', function ($app) {
            return new CustomTranslationLoader($app['files'], $app['path.lang']);
        });

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];
            $locale = $app['config']['app.locale'];
            $trans = new Translator($loader, $locale);
            $trans->setFallback($app['config']['app.fallback_locale']);
            return $trans;
        });

        /*
        |--------------------------------------------------------------------------
        | ✅ توجيه مسار public إلى public_html
        |--------------------------------------------------------------------------
        | هذا يجعل كل عمليات الرفع والقراءة تتم من مجلد public_html بدل project/public
        */
        $realPublicPath = '/home/city2tec/public_html';

        // إعادة تعريف public_path()
        app()->bind('path.public', function() use ($realPublicPath) {
            return $realPublicPath;
        });

        // تعديل إعدادات disk "public" في Laravel
        config([
            'filesystems.disks.public.root' => $realPublicPath,
            'filesystems.disks.public.url'  => env('APP_URL') . '/storage',
            'filesystems.links' => [
                public_path('storage') => storage_path('app/public'),
            ],
        ]);

        // فرض https في الإنتاج (اختياري)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
