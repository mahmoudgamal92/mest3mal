<?php

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\Ad;
use Yajra\DataTables\Services\DataTable;

class AdsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('depart','admin.ads.buttons.depart')
            ->addColumn('cat','admin.ads.buttons.cat')
            ->addColumn('status_action','admin.ads.buttons.status')
            ->addColumn('show','admin.ads.buttons.show')
            ->addColumn('delete','admin.ads.buttons.delete')
            ->rawColumns(['depart','cat','edit','show','status_action', 'delete'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Ad::query()->with('user')->select('ads.*');
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
                this.api().columns([]).every(function () {
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
            'name' => "ad_number",
                'data'    => 'ad_number',
                'title'   => trans('front.Ads_ID'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "title",
                'data'    => 'title',
                'title'   => trans('orbscope.title'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "depart",
                'data'    => 'depart',
                'title'   => trans('orbscope.department'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "cat",
                'data'    => 'cat',
                'title'   => trans('orbscope.category'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "status_action",
                'data'    => 'status_action',
                'title'   => trans('orbscope.status'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "user.name",
                'data'    => 'user.name',
                'title'   => trans('orbscope.user'),
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
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('orbscope.delete'),
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
        return 'CitiesDataTable_' . time();
    }
}