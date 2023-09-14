<?php

use Harimayco\Menu\Models\MenuItems;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Http;
use App\Models\WhatsappMessageLog;

class Globals
{

    public function __construct()
    {
    }

    public static function replaceSpecialChar($string)
    {
        return str_replace(['(', ' ', ')', '-', '/', '\\\\', '\'\'', '.', '&'], '', $string);
    }

    public static function getFilteredData(Request $request)
    {
        $isFilteredRequest = $request->only(['isFilteredRequest']);
        if ($isFilteredRequest) {
            // dd($isFilteredRequest);
        }
    }

    public static function getTableColumnsConfiguation($table_name)
    {
        $index_table_cols_configuration = [];
        $useable_columns = \config('tablecolumns')[$table_name];
        // dd(\config('tablecolumns')[$table_name]);
        // dd($useable_columns);
        foreach ($useable_columns as $key => $value) {
            if ($value['visibility']) {
                array_push($index_table_cols_configuration, ['title' => $value['title'], 'data' => $value['data']]);
            }
        }
        // dd($index_table_cols_configuration);
        return $index_table_cols_configuration;
    }

    public static function getTableColumnsForExport($table_name)
    {
        $index_table_cols_configuration = [];
        $useable_columns = \config('tablecolumns')[$table_name];
        // dd($useable_columns);
        foreach ($useable_columns as $key => $value) {
            if ($value['exportable']) {
                array_push($index_table_cols_configuration, $value['table_name'] . '.' . $value['data']);
            }
        }
        return $index_table_cols_configuration;
    }

    public static function getTableColumnsForExportWithoutTableName($table_name)
    {
        $index_table_cols_configuration = [];
        $useable_columns = \config('tablecolumns')[$table_name];
        foreach ($useable_columns as $key => $value) {
            if ($value['exportable']) {
                array_push($index_table_cols_configuration, $value['data']);
            }
        }
        return $index_table_cols_configuration;
    }

    public static function getFormattedTableColumnsForExport($table_name)
    {
        $index_table_cols_configuration = [];
        $useable_columns = \config('tablecolumns')[$table_name];
        foreach ($useable_columns as $key => $value) {
            if ($value['exportable']) {
                // $index_table_cols_configuration[$value['table_name'] . '.' . $value['data']] = $value['title'];
                array_push($index_table_cols_configuration, $value['title']);
            }
        }
        return $index_table_cols_configuration;
    }
    public static function getFormattedTableColumnsNamesForExport($table_name, $keys , $column = 'title')
    {
        $index_table_cols_configuration = [];
        $useable_columns = \config('tablecolumns')[$table_name];
        foreach ($keys as $key => $value) {
            if (isset($useable_columns[$value])) {
                if ($useable_columns[$value]['exportable']) {
                    //print_r($useable_columns[$value]);
                    // $index_table_cols_configuration[$value['table_name'] . '.' . $value['data']] = $value['title'];
                    array_push($index_table_cols_configuration, $useable_columns[$value][$column]);
                }
            }
        }
        return $index_table_cols_configuration;
    }

    public static function getTableSearchableColumns($table_name)
    {
        $searchable_columns = [];
        $useable_columns = \config('tablecolumns')[$table_name];
        foreach ($useable_columns as $key => $value) {
            if ($value['searchable']) {
                $data = ['column_name' => $value['data'], 'table_name' => $value['table_name']];
                array_push($searchable_columns, $data);
            }
        }
        return $searchable_columns;
    }
    public static function menuItems($menu_id)
    {
        \Log::info($menu_id);
        $permissions = MenuItems::where('menu', $menu_id)->get();
        return $permissions;
    }
    public static function menuPermissions($system_menu_id)
    {
        $permissions = Permission::where('system_menu_id', $system_menu_id)->get();
        return $permissions;
    }

    public $pwwbExportList;

    public static function newRst()
    {
        return 'test';
    }

    public static function SayHello($globalResult)
    {

        $pwwbExportList = $globalResult;
        return $pwwbExportList;
    }

    public static function sendWAPPMessage($numbers , $textMessage , $type){
        if(is_array($numbers) and count($numbers)>0){

            foreach($numbers as $number){
                $number['id'] = (string)$number['id'];

                $payload = array("app"=>
                    array(
                        "id"=>config("services.whatsapp_number") ,
                        "time"=>(string)time(),
                        "data"=>array(
                            "recipient"=> $number,
                            "message" =>array(
                                array(
                                    "time"=>(string)time(),
                                    "type"=> $type,
                                    "value"=>$textMessage['message']
                                )
                            )
                        )
                    )
                );
                
                if($type == 'document'){
                    $payload['app']['data']['message'][0] = array(
                                                                "time"=>(string)time(),
                                                                "type"=> $type,
                                                                "value"=>$textMessage['file'],
                                                                "caption"=>$textMessage['message']
                                                            );
                }
                // print_r($payload);die;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, config("services.whatsapp_url"));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
                $response = curl_exec($ch);
                WhatsappMessageLog::create([
                    'message'=> $textMessage['message'],
                    'number'=>$number['id'],
                    'request'=>json_encode($payload),
                    'response'=>$response,
                    'gateway'=>config("services.whatsapp_url")
                ]);
            }
            return  true;
        }else{
            return  false;
        }
    }

}
