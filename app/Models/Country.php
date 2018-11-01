<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Country extends Model
{
    const TABLE_NAME  = 'country';
    const PRIMARY_KEY = 'id';

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;

    public static function getAll()
    {
        $cacheKey = self::getAllCountriesCacheKey();
        $value    = Cache::get($cacheKey, function () {
            return self::select()
                ->orderBy('id', 'ASC')
                ->get();
        });
        if (! Cache::has($cacheKey)) {
            Cache::forever($cacheKey, $value);
        }

        return $value;
    }

    public static function getName($id)
    {
        $cacheKey = self::getCountryNameCacheKey($id);
        $value    = Cache::get($cacheKey, function () use ($id) {
            $data = self::select()
                ->where(self::PRIMARY_KEY, '=', $id)
                ->first();

            return $data ? $data->country_name : '';
        });
        if (! Cache::has($cacheKey)) {
            Cache::forever($cacheKey, $value);
        }

        return $value;
    }

    public static function getAllCountriesCacheKey()
    {
        return self::TABLE_NAME.'GET_ALL_CAREERS';
    }

    public static function getCountryNameCacheKey($id)
    {
        return self::TABLE_NAME.'GET_CAREER_NAME'.$id;
    }
}
