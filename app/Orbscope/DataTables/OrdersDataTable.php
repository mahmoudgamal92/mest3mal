<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 14/02/2018
 * Time: 02:45 ص
 */

namespace App\Orbscope\DataTables;

use App\Orbscope\Models\Order;
use App\Orbscope\Models\Project;
use Yajra\DataTables\Services\DataTable;


class OrdersDataTable extends DataTable
{

    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('show','admin.orders.buttons.show')
            ->addColumn('status_button','admin.orders.buttons.status')
            ->rawColumns(['show','status_button'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Order::query()->with('owner')->with('seller')->with('ad')->select('orders.*');
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        $html =  $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters([
                'dom' => 'Blfrtip',
                "lengthMenu" => [[10, 25, 50, -1], [10, 25, 50, trans('orbscope.all_records')]],
                'buttons' => [

                    ['extend' => 'print', 'className' => 'btn default', 'text' => '<i class="fa fa-print"></i> '.trans('orbscope.print')],
                    ['extend' => 'csv', 'className' => 'btn  default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('orbscope.export_csv')],
                    ['extend' => 'reload', 'className' => 'btn default', 'text' => '<i class="fa fa fa-refresh"></i> '.trans('orbscope.reload')],

                ],
                'initComplete' => "function () {
                this.api().columns([0,1,2]).every(function () {
                var column = this;
                var input = document.createElement(\"input\");
                $(input).attr( 'style', 'width: 100%');
                $(input).attr( 'class', 'form-control');
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
            }",
                'order' => [[1, 'asc']]

            ]);
        if(GetLanguage() == 'ar'){
            $html = $html->parameters([
                'language' => [
                    'url' => url('/vendor/datatables/arabic.json')
                ]
            ]);
        }
        return $html;

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => "order_number",
                'data'    => 'order_number',
                'title'   => trans('front.order_number'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "seller.name",
                'data'    => 'seller.name',
                'title'   => trans('front.seller'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "owner.name",
                'data'    => 'owner.name',
                'title'   => trans('front.buyer'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "ad.title",
                'data'    => 'ad.title',
                'title'   => trans('front.ad'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "amount",
                'data'    => 'amount',
                'title'   => trans('orbscope.amount_money'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "status_button",
                'data'    => 'status_button',
                'title'   => trans('orbscope.status'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => 'show',
                'data' => 'show',
                'title' => trans('orbscope.show'),
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],
        ];




    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CountriesDataTable_' . time();
    }
}