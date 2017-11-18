<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/17/2017
 * Time: 3:53 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Reports;
use Repo\Contracts\ReportInterface;

class ReportRepo implements ReportInterface
{
    private $reports;

    public function __construct(Reports $reports)
    {
        $this->reports = $reports;
    }

    public function insertReport($data)
    {
        try {
            $report = new Reports();
            $report->title = $data->report_category;
//            $report->created_by = $request->title;
            $report->save();

            if ($report->save()) {
                $item['status'] = response()->json([
                    'status' => 'SUCCESS',
                    'message' => Config::get('custom_messages.NEW_ITEM_ADDED')
                ], 200);

                $item['result'] = Item::all();
                return $item;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $item['status'] = response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.ERROR_WHILE_ITEM_ADDING')
            ], 200);
        }
    }
    
}