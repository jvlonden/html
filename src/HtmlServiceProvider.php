<?php
namespace VanLonden\Html;

use VanLonden\Html\Support\DOMBuilder;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(DOMBuilder::class)->needs(\DOMDocument::class)->give(function(){return new \DOMDocument();});
    }
}