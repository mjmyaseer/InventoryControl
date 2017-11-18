<?php

namespace Repo;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \Repo\Contracts\CategoryInterface::class,
            \Repo\Mysql\CategoryRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\CustomerInterface::class,
            \Repo\Mysql\CustomerRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\ItemInterface::class,
            \Repo\Mysql\ItemRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\SupplierInterface::class,
            \Repo\Mysql\SupplierRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\SalesInterface::class,
            \Repo\Mysql\SalesRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\PurchaseInterface::class,
            \Repo\Mysql\PurchaseRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\LedgerInterface::class,
            \Repo\Mysql\LedgerRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\TransactionInterface::class,
            \Repo\Mysql\TransactionRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\PurchaseReturnsInterface::class,
            \Repo\Mysql\PurchaseReturnsRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\SalesReturnInterface::class,
            \Repo\Mysql\SalesReturnRepo::class
        );

        $this->app->bind(
            \Repo\Contracts\ReportInterface::class,
            \Repo\Mysql\ReportRepo::class
        );
    }
}