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

// Created to generate the ER Diagram
    protected $id = 1;
    protected $purchase_id = 1;
    protected $item_id = 1;
    protected $supplier_id = 1;
    protected $quantity = 1;
    protected $order_date = 1;
    protected $created_by = 1;
    protected $updated_at = 1;
    public function __construct(Reports $reports)
    {
        $this->reports = $reports;
    }

    public function insertReport($data)
    {
        try {
            $report = new Reports();
            $report->title = $data->report_category;
            $report->created_by = $request->session()->get('userID');
            $report->save();

            if ($report->save()) {
                $item['status'] = response()->json([
                    'status' => 'SUCCESS',
                    'code' => 200,
                    'message' => Config::get('custom_messages.NEW_ITEM_ADDED')
                ], 200);

                $item['result'] = Item::all();
                return $item;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $item['status'] = response()->json([
                'status' => 'FAILED',
                'code' => 422,
                'error' => Config::get('custom_messages.ERROR_WHILE_ITEM_ADDING'),
                'message' => $e->getMessage()
            ], 420);
        }
    }
    
}