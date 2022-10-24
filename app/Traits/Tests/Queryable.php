<?php

namespace App\Traits\Tests;

trait Queryable
{
    public function buildQuery(array $parametrs, string $suffix = null): string
    {
        $query = '';
        $isFirstLevel = is_null($suffix);

        foreach ($parametrs as $key => $value) {
            if (is_array($value)) {
                $query .= $this->buildQuery($value, $isFirstLevel ? $key : "{$suffix}[{$key}]");
            } else {
                $query .= $this->addQuery($key, $value, $suffix);
            }
        }

        return $isFirstLevel ? "?{$query}" : $query ;
    }

    public function buildIdsQuery(array $ids): string
    {
        return $this->buildQuery([
            'ids' => $ids
        ]);
    }

    private function addQuery(string $key, string $value, string $suffix = null): string
    {
        return is_null($suffix) ? "&{$key}={$value}" : "&{$suffix}[{$key}]={$value}";
    }
}
