<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    const TABLE_NAME  = 'label';
    const PRIMARY_KEY = 'id';

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;

    public static function getAllLabel($getColumns = [])
	{
		$result = self::select($getColumns)
			->get();
		return $result;
	}
}
