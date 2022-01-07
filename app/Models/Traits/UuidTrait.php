<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}