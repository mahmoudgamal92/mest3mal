@php
    $name = @App\User::find($user_id)->name;

    if(!empty($name)){
     echo $name;
    }else{
        echo "No user Found";
    }
@endphp