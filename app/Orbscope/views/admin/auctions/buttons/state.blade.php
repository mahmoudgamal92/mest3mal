@php
    $name = @App\Orbscope\Models\Country::find($state_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No state Found";
    }
@endphp
