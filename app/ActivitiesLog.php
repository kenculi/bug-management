<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitiesLog extends Model
{
    const TABLE_NAME  = 'activities_log';
    const PRIMARY_KEY = 'id';
    protected $guarded =[];
    public $timestamps = false;
    protected $table      = self::TABLE_NAME;
    protected $primaryKey = self::PRIMARY_KEY;
    public $updatedField = [
        1 => "Tóm tắt",
        2 => "Mô tả",
        3 => "Trạng thái",
        4 => "Người thực hiện",
        5 => "Nhãn",
        6 => "Ưu tiên",
        7 => "Đính kèm",
        8 => "Sao chép lỗi",
        9 => "Xoá lỗi"
    ];

    public function userloged()
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

    public static function getAllByProject($projectId = 0)
    {
        $result = self::select()
            ->where("project_id", (int)$projectId)
            ->get();
        return $result;
    }

    public function getUpdatedField()
    {
        return $this->updatedField[$this->field];
    }
}
