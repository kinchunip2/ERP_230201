<?php

namespace Modules\Account\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Account\Repositories\ChartAccountRepository;
use Modules\Account\Repositories\ChartAccountRepositoryInterface;
use Modules\Account\Repositories\AccountCategoryRepository;
use Modules\Account\Repositories\AccountCategoryRepositoryInterface;
use Modules\Account\Repositories\ContraRepository;
use Modules\Account\Repositories\ContraRepositoryInterface;
use Modules\Account\Repositories\TransferRepository;
use Modules\Account\Repositories\TransferRepositoryInterface;
use Modules\Account\Repositories\JournalRepository;
use Modules\Account\Repositories\JournalRepositoryInterface;
use Modules\Account\Repositories\OpeningBalanceHistoryRepository;
use Modules\Account\Repositories\OpeningBalanceHistoryRepositoryInterface;
use Modules\Account\Repositories\VoucherRepository;
use Modules\Account\Repositories\VoucherRepositoryInterface;
use Modules\Account\Repositories\IncomeRepository;
use Modules\Account\Repositories\IncomeRepositoryInterface;
use Modules\Account\Repositories\BankAccountRepository;
use Modules\Account\Repositories\BankAccountRepositoryInterface;
use Modules\Account\Repositories\ProfitLossRepository;
use Modules\Account\Repositories\IncomeStatementReportRepositoryInterface;
use Modules\Account\Repositories\LedgerReportRepositoryInterface;
use Modules\Account\Repositories\LedgerReportRepository;
use Modules\Account\Repositories\CashbookRepository;
use Modules\Account\Repositories\CashbookRepositoryInterface;
use Modules\Account\Repositories\AccountBalanceRepository;
use Modules\Account\Repositories\AccountBalanceRepositoryInterface;


class AccountServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Account';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'account';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(ChartAccountRepositoryInterface::class, ChartAccountRepository::class);
        $this->app->bind(AccountCategoryRepositoryInterface::class, AccountCategoryRepository::class);
        $this->app->bind(JournalRepositoryInterface::class, JournalRepository::class);
        $this->app->bind(ContraRepositoryInterface::class, ContraRepository::class);
        $this->app->bind(TransferRepositoryInterface::class, TransferRepository::class);
        $this->app->bind(OpeningBalanceHistoryRepositoryInterface::class, OpeningBalanceHistoryRepository::class);
        $this->app->bind(VoucherRepositoryInterface::class, VoucherRepository::class);
        $this->app->bind(IncomeRepositoryInterface::class, IncomeRepository::class);
        $this->app->bind(BankAccountRepositoryInterface::class, BankAccountRepository::class);
        $this->app->bind(IncomeStatementReportRepositoryInterface::class, ProfitLossRepository::class);
        $this->app->bind(LedgerReportRepositoryInterface::class, LedgerReportRepository::class);
        $this->app->bind(CashbookRepositoryInterface::class, CashbookRepository::class);
        $this->app->bind(AccountBalanceRepositoryInterface::class, AccountBalanceRepository::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
