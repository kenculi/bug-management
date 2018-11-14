<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\ActivitiesLog as ActivityLogModel;

class ActivityLog
{
    /**
     * writeLog
     * @param  string  $content [description]
     * @param  integer $group   [1: project; 2: issue]
     * @return no return
     */
    public static function writeLog($content = [], $group = 1)
    {
        if (!$content) {
            return false;
        }

        $data = [
            'user_id'       => Auth::user()->id,
            'project_id'    => 1,
            'type'          => $group,
            'field'         => $content['field'],
            'issue_id'      => $content['issue_id'],
            'note'          => $content['note'],
        ];
        ActivityLogModel::create($data);
    }
}
