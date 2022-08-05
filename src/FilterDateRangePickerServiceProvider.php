<?php

namespace GiocoPlus\FilterDateRangePicker2;

use GiocoPlus\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class FilterDateRangePickerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(FilterDateRangePickerExtension $extension)
    {
        if (! FilterDateRangePickerExtension::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-filterdaterangepicker2');
        }

        $this->registerPublishing();

        Admin::booting(function () {
            Admin::js('vendor/laravel-admin-ext/filterdaterangepicker/moment.min.js');
            Admin::js('vendor/laravel-admin-ext/filterdaterangepicker/moment-timezone-with-data.min.js');
            Admin::js('vendor/laravel-admin-ext/filterdaterangepicker/daterangepicker.js');
            Admin::css('vendor/laravel-admin-ext/filterdaterangepicker/daterangepicker.css');
        });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        // //静态文件的发布目录
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'laravel-admin-filterdaterangepicker2');
            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/laravel-admin-ext/filterdaterangepicker2')], 'laravel-admin-filterdaterangepicker2');
            $this->publishes([__DIR__.'/config.php' => config_path('daterangepicker.php')], 'laravel-admin-filterdaterangepicker2');
        }
    }
}
