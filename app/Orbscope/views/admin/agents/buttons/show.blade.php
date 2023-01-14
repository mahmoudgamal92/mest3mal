@php
    $name = @App\Orbscope\Models\AgentType::find($agent_type)->name;
    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No type Found";
    }
@endphp
