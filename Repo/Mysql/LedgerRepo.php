<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/7/2017
 * Time: 9:37 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Item;
use App\Http\Models\Ledger;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\ledgerInterface;

class LedgerRepo implements ledgerInterface
{
    private $ledger;

    // Created to generate the ER Diagram

    protected $id = 1;
    protected $item_id = 1;
    protected $quantity = 1;
    protected $transaction_date = 1;
    protected $unit_price = 1;
    protected $created_at = 1;
    protected $updated_at = 1;

    public function __construct(Ledger $ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * @return Ledger
     */
    public function getLedger()
    {
        $result = DB::table(Ledger::TABLE)
            ->select(Ledger::TABLE . '.item_id', Ledger::TABLE . '.quantity', Item::TABLE . '.title')
            ->leftJoin(Item::TABLE, Item::TABLE . '.id', '=', Ledger::TABLE . '.item_id')
            ->get();

        return $result;
    }

    public function getQuantityBalance($id)
    {
        $result = DB::table(Ledger::TABLE)
            ->select('quantity')
            ->where('item_id', '=', $id)
            ->get();

        if (count($result) > 0) {
            return $result;
        } else {
            return 'fail';
        }
    }

    /**
     * @param $data
     * Save all the sales to the ledger table and update quantity(Sales)
     * @return array
     */
    public function saveLedgerSales($data)
    {
        app('db')->beginTransaction();
        $referenceNumber = date("YmdHis") . rand(1, 9);

// TODO: created by
        try {
            if (isset($data['Purchase_returns'])) {

                $quantity = $this->getQuantityBalance($data['item']);
                if ($quantity != 'fail') {
                    $quantity = $quantity[0]->quantity;
                    $ledger = Ledger::where('item_id', '=', $data['item'])->first();
                } else {
                    $ledger = new Ledger();
                    $quantity = 0;
                }

                $ledger->item_id = $data['item'];
                $ledger->quantity = $quantity - $data['quantity'];
                $ledger->transaction_date = date("H-m-d");
//                $ledger->created_by = $item['created_by'];
                $ledger->save();

            }
            elseif (isset($data['Sales_returns']))
            {
                $quantity = $this->getQuantityBalance($data['item']);
                if ($quantity != 'fail') {
                    $quantity = $quantity[0]->quantity;
                    $ledger = Ledger::where('item_id', '=', $data['item'])->first();
                } else {
                    $ledger = new Ledger();
                    $quantity = 0;
                }

                $ledger->item_id = $data['item'];
                $ledger->quantity = $quantity + $data['quantity'];
                $ledger->transaction_date = date("H-m-d");
//                $ledger->created_by = $item['created_by'];
                $ledger->save();
            }
            else {

                foreach ($data['order'] as $item) {
                    $quantity = $this->getQuantityBalance($item['item']);

                    if ($quantity != 'fail') {
                        $quantity = $quantity[0]->quantity;
                        $ledger = Ledger::where('item_id', '=', $item['item'])->first();
                    } else {
                        $ledger = new Ledger();
                        $quantity = 0;
                    }

                    $ledger->item_id = $item['item'];
                    $ledger->quantity = $quantity - $item['quantity'];
                    $ledger->transaction_date = date("H-m-d");
//                $ledger->created_by = $item['created_by'];
                    $ledger->save();
                }
            }

            app('db')->commit();
            return $ledger['status'] = [
                'status' => 'success',
                'message' => 'successfully saved',
                'code' => '200'
            ];
        } catch (\Exception $ex) {
            app('db')->rollback();
            return $ledger['status'] = [
                'status' => $ex->getMessage(),
                'message' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }

    /**
     * @param $data
     * Executes the save function to the Purchase Table (Purchase)
     * @return array
     */
    public function saveLedgerPurchases($data)
    {
        app('db')->beginTransaction();
        $referenceNumber = date("YmdHis") . rand(1, 9);

// TODO: created by
        try {
            foreach ($data['order'] as $item) {
                $quantity = $this->getQuantityBalance($item['item']);

                if ($quantity != 'fail') {
                    $quantity = $quantity[0]->quantity;
                    $ledger = Ledger::where('item_id', '=', $item['item'])->first();
                } else {
                    $ledger = new Ledger();
                    $quantity = 0;
                }
                $ledger->item_id = $item['item'];
                $ledger->quantity = $quantity + $item['quantity'];
                $ledger->transaction_date = date("H-m-d");
//                $ledger->created_by = $item['created_by'];
                $ledger->save();
            }
            app('db')->commit();
            return $ledger['status'] = [
                'status' => 'success',
                'code' => '200',
                'message' => 'Successfully Saved Ledger Purchases'
            ];
        } catch (\Exception $ex) {
            app('db')->rollback();
            return $ledger['status'] = [
                'status' => $ex->getMessage(),
                'code' => '422',
                'message' => $ex->getMessage()
            ];
        }
    }
}