<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(function ($query) {
            $query->where('is_deleted', 0)
                ->orWhere('is_active', 1)
                ->orWhere('is_deleted', false);
        })->orderBy('id', 'ASC');
    }
}
