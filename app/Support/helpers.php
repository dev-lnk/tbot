<?php

if (! function_exists('report_app')) {
    /**
     * @throws Throwable
     */
    function report_app(Throwable $e): void
    {
        throw_if(!app()->isProduction(), $e) ?? report($e);
    }
}