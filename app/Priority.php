<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    const TABLE_NAME  = 'priority';
    const PRIMARY_KEY = 'id';

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;

    public static function getAllPriority($getColumns = [])
	{
		$result = self::select($getColumns)
			->orderBy('sequence', 'ASC')
			->get();
		return $result;
	}
}
