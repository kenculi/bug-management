<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    const TABLE_NAME  = 'invite';
    const PRIMARY_KEY = 'id';

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;

    public function userinvited()
    {
        return $this->belongsTo('App\Models\User', 'user_receive_id', 'id');
    }

    public static function getAllByProject($projectId = 0)
	{
		$result = self::select()
			->where("proj_id", (int)$projectId)
			->where("type", 2)
			->get();
		return $result;
	}
}
