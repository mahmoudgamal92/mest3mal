<option value="" selected="">{{trans('orbscope.city')}}</option>
@foreach($cities as $ci)
<option value="{{$ci->id}}">{{VarByLang($ci->name,GetLanguage())}}</option>
@endforeach