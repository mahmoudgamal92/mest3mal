@php
    $name = @App\Orbscope\Models\Resource::find($order_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No resource Found";
    }
@endphp