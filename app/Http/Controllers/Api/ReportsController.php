<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Transformers\ReportTransformer;
use App\Transformers\UserTransformer;

class ReportsController extends Controller
{
    public function show(User $user, Report $report)
    {
        // 测试中
        $user = $this->user();  // 获取当前用户

        $report = Report::where([
            'user_id' => $user->id,
            ])->get()->first();// 获取所有对应用户班级的通知

        // $arr['user_id'] = $report->user_id;
        // $arr['subject_id'] = $report->subject_id;
        // $arr['title'] = $report->title;

        return $this->response->item($report,new ReportTransformer());//返回作业的信息
        // return $arr;
        // return 1;
    }

    public function studentShow()
    {
        $user = $this->user();
        $report = Report::where([
            'user_id' => $user->id,
        ])->orderBy('created_at', 'desc')->get();

        return $report;
    }
}
