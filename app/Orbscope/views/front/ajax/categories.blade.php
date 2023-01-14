<option value="" selected>{{trans('orbscope.category')}} </option>
@foreach($cats as $c)
<option value="{{$c->id}}">{{VarByLang($c->name,GetLanguage())}}</option>
@endforeach


<script>


</script>