<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 8/16/17
 * Time: 17:55
 */

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\OnlinePayment;
use App\Orbscope\Models\Withdrawal;
use Yajra\DataTables\Services\DataTable;

class WithdrawalsDatatable extends DataTable

{



    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')

            ->addColumn('user','admin.users.buttons.name')

            ->rawColumns(['user'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Withdrawal::query()->where('status','done')->select('withdrawals.*');
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
            }"


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
                'name' => "user",
                'data'    => 'user',
                'title'   => trans('orbscope.user'),
                'searchable' => true,
                'orderable'  => true,
            ],

            [
                'name' => 'email',
                'data' => 'email',
                'title' => trans('front.paybal'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => 'amount',
                'data' => 'amount',
                'title' => trans('orbscope.amount_money'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => 'recived_date',
                'data' => 'recived_date',
                'title' => trans('orbscope.date'),
                'searchable' => true,
                'orderable'  => true,
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
        return 'payments' . time();
    }
}