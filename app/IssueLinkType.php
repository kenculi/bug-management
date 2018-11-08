<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueLinkType extends Model
{
    const TABLE_NAME  = 'issuelinktype';
    const PRIMARY_KEY = 'id';

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;

    public static function getAllLinkType($getColumns = [])
    {
        $result = self::select($getColumns)->get();
        return $result;
    }
}
