<?php

namespace App\Bootstrap\Helpers\Models;

trait Searchable
{
    public function scopeSearch($query, $search)
    {
        $originalTable = $query->getQuery()->from;
        $searchable = $this->searchable ?? [];
        return $query->where(function ($query) use ($searchable, $search, $originalTable) {
            foreach ($searchable as $filter) {
                if (str_contains($filter, '.')) {
                    $nested = explode('.', $filter);
                    for ($i = 0; $i < substr_count($filter, '.'); $i = $i + 2) {
                        $query->orWhereHas($nested[$i], function ($query) use ($nested, $search, $i) {
                            $filtered = $nested[$i + 1];
                            $query->whereRaw("unaccent(lower($filtered::text)) like unaccent(lower(?))", ["%{$search}%"]);
                        });
                    }
                    continue;
                }
                $query->orWhereRaw("unaccent(lower($filter::text)) like unaccent(lower(?::TEXT))", ["%{$search}%"]);
            }

            if ($search) {
                $search = (int) $search;
                if ($search > 0) {
                    $query->orWhereRaw("{$originalTable}.id = ?", [$search]);
                }
            }
        });
    }
}
