<?php
namespace App\Contracts;

interface MediaContract
{
    /**
     * Download the new images from the provider
     * @return void
     */
    public function sync() : bool;
}
