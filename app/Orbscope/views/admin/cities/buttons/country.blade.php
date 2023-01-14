@php
    $name = @App\Orbscope\Models\Country::find($country_id)->name;
    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No Country Found";
    }
@endphp
