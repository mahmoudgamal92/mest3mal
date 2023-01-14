
<label class="col-md-3 control-label">{{trans('orbscope.category')}} <span class="required" aria-required="true"> * </span> </label>
    <div class="col-md-9">
        <select class="form-control select2" data-placeholder="{{trans('orbscope.category')}}" id="cat_id" name="cat_id" required>
            <option></option>
            @foreach($data as $city)
                <option value="{{$city->id}}">{{VarByLang($city->name,GetLanguage())}}</option>
            @endforeach
        </select>
    </div>