<a data-toggle="modal" data-target="#myModal{{$id}}" href="#" class="btn btn-danger">{{trans('orbscope.delete')}}</a>
<div class="modal fade" id="myModal{{$id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">{{trans('orbscope.delete')}} {{ $title }} ! </h4>
            </div>
            <div class="modal-body">
                {{trans('orbscope.ask-delete')}} : {{$title}}
            </div>
            <div class="modal-footer">
                {!! Form::open([
               'method' => 'post',
               'url' => ['admin/delete/auction/'.$id]
               ]) !!}
                {!! Form::submit(trans('orbscope.approval'), ['class' => 'btn btn-danger']) !!}
                <a class="btn btn-default" data-dismiss="modal">{{trans('orbscope.cancel')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>