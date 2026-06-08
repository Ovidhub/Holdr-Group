<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page', 'section_key', 'label', 'section_group', 'type', 'value', 'sort_order',
    ];

    /** In-memory cache of all sections, keyed "page.section_key". */
    protected static $map = null;

    /**
     * Read a section's value (cached for the request). Never throws:
     * returns $default if the table/row is absent.
     */
    public static function value(string $page, string $key, string $default = ''): string
    {
        if (static::$map === null) {
            static::$map = [];
            try {
                if (Schema::hasTable('page_contents')) {
                    foreach (static::query()->get() as $row) {
                        static::$map[$row->page . '.' . $row->section_key] = (string) $row->value;
                    }
                }
            } catch (\Throwable $e) {
                static::$map = [];
            }
        }

        return static::$map[$page . '.' . $key] ?? $default;
    }

    public static function flushCache(): void
    {
        static::$map = null;
    }

    protected static function booted()
    {
        static::saved(fn () => static::flushCache());
        static::deleted(fn () => static::flushCache());
    }
}
