@extends(AdminCore())
@section('content')
    <link rel="stylesheet" href="{{url('orbscope/admin')}}/datatables/dataTables.bootstrap{{GetLangAdds()}}.css">
    <script src="{{url('orbscope/admin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('orbscope/admin/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('vendor/datatables/buttons.server-side.js')}}"></script>
    <div class='row'>
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                </div>




                <div class="portlet-body" style="padding-top: 85px;">

                    {!! $dataTable->table(['class'=> 'table table-striped table-bordered table-hover'],true) !!}
                </div>
            </div>
        </div>



    </div>

    <div class="modal fade" id="multi_delete">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open([
                 'method' => 'post',
                 'url' => ['admin/user/set_balance']
                 ]) !!}
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">{{trans('front.balance')}} </h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label" >{{trans('orbscope.amount_money')}} </label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" step="any" name="amount">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="balance_id" id="order_id">
                    <input type="submit"  value="{{trans('orbscope.approval')}}" class="btn btn-danger delete_done">
                    <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    {!! $dataTable->scripts() !!}




    <script>
        $(document).on("click", "#set_editor", function () {
            $('#multi_delete').modal('show');
            var brow = $(this).data('id');
            $(".modal-footer #order_id").val( brow );

            //
            // As pointed out in comments,da
            // it is superfluous to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    </script>
@endsection


