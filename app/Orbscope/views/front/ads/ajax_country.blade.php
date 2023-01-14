<div class="form-group categori">
    <label class="field-heading" for="city_id">{{trans('orbscope.city')}}</label>
    <div class="form-group categories-sort">
        <select name="city_id" class="form-control w-100" required>
            @foreach($city as $c)
                <option value="{{$c->id}}" >{{VarByLang($c->name,GetLanguage())}}</option>
            @endforeach
        </select>
    </div>
</div>