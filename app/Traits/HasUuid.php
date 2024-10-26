<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    /**
     * Boot function to auto-generate UUID.
     */
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }

    /**
     * Override the incrementing property.
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Override the key type.
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
