<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait hasUuid
{
    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->uuid = $model->uuid ?: (string) Str::orderedUuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
