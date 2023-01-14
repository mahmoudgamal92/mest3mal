<?php
    use App\Orbscope\Controllers\SettingsController;
    use App\Orbscope\Controllers\LogsController as Log;
    use Illuminate\Support\Facades\Lang;

    // Get Website Settings
    function GetSettings()
    {
        // New Object From Setting Controller
        $settingsController = new SettingsController;
        //Get Setting
        $settings = $settingsController->GetSetting();
        return $settings;
    }

    function check_click($id){
        $clik=\App\Orbscope\Models\Click_ads::where('ad_id',$id)->where('user_id',auth()->id())->count();

        return $clik;
    }
     //user_balance
    function user_balance(){
      if (auth()->check()){
          $mytime = \Carbon\Carbon::now();
          $start=strtotime($mytime);
          $gharge=\App\Orbscope\Models\OnlinePayment::where('user_id',auth()->id())->sum('price');
          $profit=\App\Orbscope\Models\Payment::where('reciver_id',auth()->id())->where('status','done')->where('time','<',$start)->sum('net');
          $pay=\App\Orbscope\Models\Payment::where('user_id',auth()->id())->where('status','!=','cancel')->sum('amount');
          $withdrawl=\App\Orbscope\Models\Withdrawal::where('user_id',auth()->id())->where('status','!=','faild')->sum('amount');
          return ($profit+$gharge) - ($pay + $withdrawl);
        }else{
          return 0;
      }
    }

    function suspended_balance(){
        if (auth()->check()){
            $mytime = \Carbon\Carbon::now();
            $start=strtotime($mytime);
            //$gharge=\App\Orbscope\Models\OnlinePayment::where('user_id',auth()->id())->sum('price');
            $supended=\App\Orbscope\Models\Payment::where('reciver_id',auth()->id())->where('status','done')->where('time','>',$start)->sum('net');
            return $supended;
        }else{
            return 0;
        }
    }


    function Favorites($id){

        $wish=\App\Orbscope\Models\Wishlist::where('ad_id',$id)->where('user_id',auth()->id())->get();


        if (count($wish)==0){

            return 'add';

        }else{
            return 'remove';

        }

    }

    function check_offers($id){

       $ofer=\App\Orbscope\Models\Auction::where('id',$id)->where('user_id',auth()->id())->count();

       if ($ofer==0){

           $ofer=\App\Orbscope\Models\Offer::where('auction_id',$id)->where('user_id',auth()->id())->count();

       }else{

           $ofer==0;
       }




       return $ofer;

    }

    function generateBarcodeNumber() {
        $number = mt_rand(1000, 9999); // better than rand()

        // call the same function if the barcode exists already
        if (barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function generatePaymentNumber() {
        $number = mt_rand(1000, 9999); // better than rand()

        // call the same function if the barcode exists already
        if (paymentNumberExists($number)) {
            return generatePaymentNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

        function paymentNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return \App\Orbscope\Models\Payment::where('pay_number',$number)->exists();
    }

    function generateOrderNumber() {
        $number = mt_rand(1000, 9999); // better than rand()

        // call the same function if the barcode exists already
        if (orderNumberExists($number)) {
            return generateOrderNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return \App\Orbscope\Models\Ad::where('ad_number',$number)->exists();
    }

    function orderNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return \App\Orbscope\Models\Order::where('order_number',$number)->exists();
    }



    //online status
    function onUser($id){


        if ($id==null || empty($id)){

            return 'offline';
        }else{

            $user= \App\User::find($id);

            if ($user->isOnline()==true){

                return 'online';
            }else{

                return 'offline';
            }
        }


    }

    //stars
    function orderStars($n){
        if ($n==5){

            return '. <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>.';

        }elseif ($n==4){

            return '. <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>.';

        }elseif ($n==3){

            return '.<i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>.';

        }
        elseif ($n==2){

            return '.<i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>.';

        }
        elseif ($n==1){

            return '.<i class="fa fa-star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>.';

        }
        else{

            return '.<i class="fa fa-star emty_star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i> 
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star emty_star" aria-hidden="true"></i>.';
        }
    }

    function stars($n){
    if ($n==5){

        return '. <span class="fa fa-star checked" aria-hidden="true"></span> 
                                                   <span class="fa fa-star checked" aria-hidden="true"></span>
                                                   <span class="fa fa-star checked" aria-hidden="true"></span>
                                                   <span class="fa fa-star checked" aria-hidden="true"></span>
                                                    <span class="fa fa-star checked" aria-hidden="true"></span>.';

    }elseif ($n==4){

        return '. <span class="fa fa-star checked" aria-hidden="true"></span> 
                                                    <span class="fa fa-star checked" aria-hidden="true"></span> 
                                                    <span class="fa fa-star checked" aria-hidden="true"></span>
                                                    <span class="fa fa-star checked" aria-hidden="true"></span>
                                                    <span class="fa fa-star" aria-hidden="true"></span>.';

    }elseif ($n==3){

        return '.<span class="fa fa-star checked" aria-hidden="true"></span> 
                                                    <span class="fa fa-star checked" aria-hidden="true"></span> 
                                                    <span class="fa fa-star checked" aria-hidden="true"></span>
                                                   <span class="fa fa-star" aria-hidden="true"></span>
                                                   <span class="fa fa-star" aria-hidden="true"></span>.';

    }
    elseif ($n==2){

        return '.<span class="fa fa-star checked" aria-hidden="true"></span>
                                                    <span class="fa fa-star checked" aria-hidden="true"></span>
                                                    <span class="fa fa-star" aria-hidden="true"></span> 
                                                    <span class="fa fa-star" aria-hidden="true"></span>
                                                    <span class="fa fa-star" aria-hidden="true"></span>.';

    }
    elseif ($n==1){

        return '.<span class="fa fa-star checked" aria-hidden="true"></span> 
                                                   <span class="fa fa-star" aria-hidden="true"></span> 
                                                   <span class="fa fa-star" aria-hidden="true"></span> 
                                                    <span class="fa fa-star" aria-hidden="true"></span> 
                                                    <span class="fa fa-star" aria-hidden="true"></span> .';

    }
    else{

        return '.<span class="fa fa-star" aria-hidden="true"></span>  
                                                    <span class="fa fa-star" aria-hidden="true"></span> 
                                                    <span class="fa fa-star" aria-hidden="true"></span> 
                                                    <span class="fa fa-star" aria-hidden="true"></span> 
                                                    <span class="fa fa-star" aria-hidden="true"></span> .';
    }
}


    //user_rate
    function user_rate($id){
           $rate=\App\Orbscope\Models\Review::where('user_id',$id)->avg('rate');
           if ($rate==null){
               $final =0;
           }else{
               $final=intval($rate);
           }

           return $final;

    }
    //service rate
    function service_rate($id){

        $order=\App\Orbscope\Models\Order::where('service_id',$id)->avg('rate');

        if ($order==null){
            $final =0;
        }else{
            $final=intval($order);
        }

        return $final;
    }

    function service_review($id){
        $order=\App\Orbscope\Models\Order::where('service_id',$id)->where('rate','!=',null)->count();

        if ($order==null){
            $final =0;
        }else{
            $final=intval($order);
        }

        return $final;
    }



    function user_review($id){
        $review=\App\Orbscope\Models\Review::where('user_id',$id)->count();

        return $review;
    }






    // Return Data By Language
    function SettingsByLang($var, $lang)
    {
        $data = json_decode(GetSettings()->$var)->$lang;
        return $data;
    }



    // Get Language
    function GetLanguage()
    {
        // New Object From Setting Controller
        $languageValue = new SettingsController;

        //Get Current Language
        $language = $languageValue->GetLanguage();
        return $language;

    }

    // Get Language Direction
    function GetDirection()
    {
        if(GetLanguage() == 'ar')
        {
            $dir = 'rtl';
        }
        else
        {
            $dir = 'ltr';
        }
        return $dir;
    }

    // Get Language adds style
    function GetLangAdds()
    {
        if(GetLanguage() == 'ar')
        {
            $adds = '-rtl';
        }
        else
        {
            $adds = '';
        }
        return $adds;
    }

    function month_ar($month){

        if ($month=='1'){

            return'كانون الثاني';
        }elseif ($month=='2'){

            return'شباط';
        }elseif ($month=='3'){
            return 'آذار';
        }elseif ($month=='4'){
            return 'نيسان';
        }elseif ($month=='5'){
            return 'أيار';
        }elseif ($month=='6'){
            return 'حزيران';
        }elseif ($month=='7'){
            return 'تموز';
        }elseif ($month=='8'){
            return 'آب';
        }elseif ($month=='9'){
            return 'أيلول';
        }elseif ($month=='10'){
            return 'تشرين الأول';
        }elseif ($month=='11'){
            return 'تشرين الثاني';
        }elseif ($month=='12'){
            return 'كانون الأول';
        }else{
            return $month;
        }


    }

    // Get Images Path
    function GetImage($val=null)
    {
        if(!empty($val) and file_exists(base_path('uploads/'.$val)))
        {
            return url('uploads/'.$val);
        }else{
            return url(url('/').'/orbscope/orbscope.png');
        }
    }

    // Get Images Path
    function ShowImage($val=null)
    {
        if(!empty($val) and file_exists(base_path('uploads/'.$val)))
        {
            return url('uploads/'.$val);
        }else{
            return url(url('/').'/orbscope/orbscope.jpg');
        }
    }

    // Get Admin Path
    function AdminPath()
    {
        // New Object From Setting Controller
        $settingsController = new SettingsController;
        //Get Setting
        $AdminPath = $settingsController->GetSetting()->admin_path;
        return $AdminPath;
    }

    // Return Variable By Language
    function VarByLang($var, $lang)
    {
        if(!empty($var) && $var != ''){
            $data = json_decode($var)->$lang;
        }else{
            $data = '';
        }
        return $data;
    }

    // Get Active Admin Link
    function ActiveAdminLink($name)
    {
        return Active::checkRoute($name);
    }

    // Get Active Admin Menu
    function ActiveAdminMenu($name)
    {
        return Active::check(AdminUrl($name),true);
    }

    function ActiveTeacherMenu($name)
    {
        return Active::check(TeacherUrl($name),true);
    }

    // Json Encoding Variable
    function EncodeVar($var)
    {
        return json_encode($var,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    // Replace Array Keys Of another Array values
    function ReplaceArrayKeys($data,$fields)
    {
        foreach ($data as $array){
            for($i=0; $i < count($array); $i++){
                $new_key = $fields[$i];
                $array[$new_key] = $array[$i];
                unset($array[$i]);
            }

            $insert[] = $array;
        }
       return $insert;
    }

    // Get Action Log Message
    function LogAction($type,$id = null,$en=null)
    {
        if($type == 'add'){
            $ar_action = 'تم اضافة بيان جديد =>'.' '.$id;
            if ($en==null){
                $en=$id;
            }
            $en_action = 'Added Record .'.' '.$en;
            $action = $name = array('ar'=>$ar_action,'en'=>$en_action);
            $message = EncodeVar($action);
        }elseif($type == 'edit'){
            $ar_action = 'تم تعديل البيان =>'.' '.$id;
            $en_action = 'Updated Record No.'.' '.$en;
            $action = $name = array('ar'=>$ar_action,'en'=>$en_action);
            $message = EncodeVar($action);
        }elseif($type=='delete'){
            $ar_action = 'تم حذف البيان'.' '.$id;
            $en_action = 'Deleted Record No.'.' '.$en;
            $action = $name = array('ar'=>$ar_action,'en'=>$en_action);
            $message = EncodeVar($action);
        }
        return $message;
    }

    // Get Route Log
    function LogRoute($route)
    {
        $ar_route   = Lang::get('orbscope.'.$route, array(), 'ar');
        $en_route   = Lang::get('orbscope.'.$route, array(), 'en');
        $route_name = array('ar'=>$ar_route,'en'=>$en_route);
        return $message = EncodeVar($route_name);
    }

    /*
     *  Save Log
     */
    function SaveLog($type,$id = null,$route){
       $log =  Log::SaveLog(
            [
                'action' =>LogAction($type,$id),
                'type'   =>$type,
                'table'  =>$route,
                'route'  =>LogRoute($route),
                'data'   =>'',
            ]
        );
       return $log;
    }

    // Check If Key In Array
    function InArray($key,$array,$return = null,$checkValues = null){
      if(empty($checkValues)) {
          if (array_key_exists($key, $array)) {
             return $data[] = $array[$key];
          } else {
             return $data[] = $return;
          }
      }else{
          if (array_key_exists($key, $array)) {
             return CheckValue($array[$key], $checkValues, $return);
          }else{
              return $data[] = $return;
          }
      }
    }

    // Check If Array Value In Array Of Values
    function CheckValue($array,$values,$return){
        if(!empty($array))
        {
            foreach ($values as $value){
            if($array == $value){
                return $array;
            }else{
                  $array =  $return;
                 return $array;
            }
            }
        }else{
            return $return;
        }
    }

    function docx2text($filename) {
        return readZippedXML($filename, "word/document.xml");
    }

    function readZippedXML($archiveFile, $dataFile) {
    // Create new ZIP archive
        $zip = new ZipArchive;

    // Open received archive file
        if (true === $zip->open($archiveFile)) {
            // If done, search for the data file in the archive
            if (($index = $zip->locateName($dataFile)) !== false) {
                // If found, read it to the string
                $data = $zip->getFromIndex($index);
                // Close archive file
                $zip->close();
                // Load XML from a string
                // Skip errors and warnings
                $xml = new DOMDocument();
                $xml->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                // Return data without XML formatting tags
                return strip_tags($xml->saveXML());
            }
            $zip->close();
        }

    // In case of failure return empty string
        return "";
    }

    function rtf_isPlainText($s) {
        $arrfailAt = array("*", "fonttbl", "colortbl", "datastore", "themedata");
        for ($i = 0; $i < count($arrfailAt); $i++)
            if (!empty($s[$arrfailAt[$i]])) return false;
        return true;
    }



    function clean_ascii_characters($string) {
        $string = str_replace(array('-', '–'), '-', $string);
        $string = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
        return $string;
    }

    function wish($id,$type){

            $like=\App\Orbscope\Models\Wishlist::where('user_id',auth()->user()->id)->where('type',$type)->where($type,$id)->get();


        if (count($like )>0){
            return 'yes';

        }else{

            return 'no';
        }
    }
