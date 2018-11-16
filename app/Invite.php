<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    const TABLE_NAME  = 'invite';
    const PRIMARY_KEY = 'id';
    protected $guarded =[];

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;

    public function userinvited()
    {
        return $this->belongsTo('App\Models\User', 'user_receive_id', 'id');
    }

    public static function getAllByProjectAndType($projectId = 0, $type = [])
	{
		$builder = self::select()
			->where("proj_id", (int)$projectId);
        if (!empty($type)) {
            $builder->whereIn("type", $type);
        }
		return $builder->get();
	}
}
