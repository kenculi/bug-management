<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const TABLE_NAME  = 'comment';
    const PRIMARY_KEY = 'id';
    protected $guarded =[];

    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;

    public function usercommented()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public static function getAllByIssue($issueId = 0)
	{
		$result = self::select()
			->where("issue_id", (int)$issueId)
			->get();
		return $result;
	}
}
