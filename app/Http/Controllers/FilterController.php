<?php

namespace App\Http\Controllers;

use App\Exports\LiveSearches\DataExport;
use App\User;
use Carbon\Carbon;
use ConstantStrings;
use Globals;
use Illuminate\Http\Request;
use Auth;

class FilterController extends Controller
{

    public function index(Request $request)
    {
        $input = $request->all();
        $model = $input['model_path'];
        $model_querry = $model::query();
        $paginate_appends = [
            'model_path' => $model,
            'index_path' => $input['index_path'],
            'controller_path' => $input['controller_path'],
            'date_filter_column' => $input['date_filter_column'],
        ];

        foreach ($input as $key => $value) {

            if ($key != 'model_path' && $key != '_token' && $key != 'index_path' && $key != 'controller_path' && $key != 'page') {
                if ($input[$key] != null && $key != 'start_date' && $key != 'end_date' && $key != 'date_filter_column') {
                    $model_querry->where($key, '=', $value);
                    $paginate_appends[$key] = $value;
                }
            }
        }

        if (isset($input['start_date']) && isset($input['end_date'])) {
            $model_querry->where($input['date_filter_column'], '>=', $input['start_date'])->where($input['date_filter_column'], '<=', $input['end_date']);
        } else if (isset($input['start_date'])) {

            $model_querry->where($input['date_filter_column'], '>=', $input['start_date'])->where($input['date_filter_column'], '<=', Carbon::today()->toDateString());
        }

        $data = $model_querry->paginate(ConstantStrings::PAGINATION_RANGE)->appends($paginate_appends);
        return view($input['index_path'])->with(['filters_configuration' => $input['controller_path']::$filters_configuration, 'data' => $data]);
    }

    public function liveSearchTableRender(Request $request)
    {
        $MODEL = $request->model;
        $table_name = $request->table_name;
        $columns = Globals::getTableColumnsConfiguation($table_name);
        $totalData = 0;
        $userId = Auth::id();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')]['data'];
        $dir = $request->input('order.0.dir');
        $filters = $request->filters;

        $query = $MODEL::query();
        $has_joins = $request->has_joins;
        if ($has_joins) {
            $select = $request->joins['select'];
            foreach ($request->joins['params'] as $key => $join) {
                $query->leftJoin($key, $join['reference_in_current'], $join['conditional_sign'], $join['reference_in_join']);
            }
            if ($table_name == 'enquiry_followups' and !Auth::user()->isSuperAdmin() ) {

                $query->select($this->getSelectQuery($select))->distinct()->whereRaw("enquiries.status !='Dropped' and enquiries.status !='Sales Matured' and enquiry_followups.user_id = ".$userId );
            }else if( $table_name == 'enquiries' and !Auth::user()->isSuperAdmin() ){
                 
                $query->select($this->getSelectQuery($select))
                ->distinct()
                ->whereRaw("enquiries.user_id = ".$userId );
                
            }else{
                $query->select($this->getSelectQuery($select))->distinct();
            }
             // $sql = $query->toSql();
            // $bindings = $query->getBindings();
            // print_r($bindings);
            // dd($sql);
            // $query->select($this->getSelectQuery($select))->distinct();
        }
        // sums of columns

        $search = $request->input('search.value');
        if (empty($search)) {

            $query->where(function ($query) use ($filters, $has_joins, $table_name) {
                foreach ($filters as $key => $filter) {
                    // dd($filters);
                    $query->where(function ($multiQuery) use ($filter, $key, $has_joins, $table_name) {
                        foreach ($filter as $subFilterKey => $value) {
                            if ($value['search_through_join'] == 'true' && $value['join_table'] != null) {
                                $multiQuery->orWhere($has_joins ? ($value['join_table'] . '.' . $key) : $key, $value['conditional_operator'] == null ? '=' : $value['conditional_operator'], $value['value']);
                            } else {
                                if ($value['type'] == 'date') {
                                    if (!is_null($value['value'])) {
                                        $multiQuery->whereDate($has_joins ? ($table_name . '.' . $key) : $key, $value['conditional_operator'] == null ? '=' : $value['conditional_operator'], $value['value']);
                                    }
                                } else {
                                    $multiQuery->orWhere($has_joins ? ($table_name . '.' . $key) : $key, $value['conditional_operator'] == null ? '=' : $value['conditional_operator'], $value['value']);
                                }
                            }
                        }
                    });
                }
            });
            // $sql = $query->toSql();
            // $bindings = $query->getBindings();
            // print_r($bindings);
            // dd($sql);
        } else {

            $searchable_columns = Globals::getTableSearchableColumns($table_name);

            $query->where(function ($query) use ($filters, $has_joins, $table_name) {
                foreach ($filters as $key => $filter) {
                    $query->where(function ($multiQuery) use ($filter, $key, $has_joins, $table_name) {
                        foreach ($filter as $subFilterKey => $value) {
                            if ($value['search_through_join'] == 'true' && $value['join_table'] != null) {
                                $multiQuery->orWhere($has_joins ? ($value['join_table'] . '.' . $key) : $key, $value['conditional_operator'] == null ? '=' : $value['conditional_operator'], $value['value']);
                            } else {
                                if ($value['type'] == 'date') {
                                    if (!is_null($value['value'])) {
                                        $multiQuery->whereDate($has_joins ? ($table_name . '.' . $key) : $key, $value['conditional_operator'] == null ? '=' : $value['conditional_operator'], $value['value']);
                                    }
                                } else {

                                    $multiQuery->orWhere($has_joins ? ($table_name . '.' . $key) : $key, $value['conditional_operator'] == null ? '=' : $value['conditional_operator'], $value['value']);
                                }
                            }
                        }
                    });
                    // $query->where($key, $filter);
                }
            })->where(function ($query) use ($searchable_columns, $search) {
                foreach ($searchable_columns as $key => $column) {
                    $query->orWhere($column['table_name'] . '.' . $column['column_name'], 'LIKE', "%{$search}%");
                }
            });
        }
        // dd($query->orderBy($order, $dir)->get()->unique('id')->toArray());
        if (!isset($request->is_export)) {

            $totalData = $query->orderBy($order, $dir)->get()->unique('id')->count();

            $records = $query->orderBy($order, $dir)->get()->unique('id')->slice($start)->take($limit);
            // dd($records);
            $totalFiltered = $totalData;

            $data = array();
             //dd($records->toArray());
            $count = 1;
            if (!empty($records)) {
                // on joins sql add same parent row multiple times according to the number of rows in child table. SO we had to do below thing.
                $ids_only = $records->pluck('id');
                $added_ids = [];
                // This above array will be used to compare and see if same aray is not being added to draw on table.
                foreach ($records as $record) {
                    $arrayRecord = $record->toArray();
                    
                    $route_name = '';
                    if ($table_name == 'enquiry_followups') {
                        $currentRecordId = $record->id;
                        $route_name = 'followups';
                        // $show = '#';
                        $record->present_address = '<input type="checkbox" class="checkboxsingle" name="enqIds[]" value="'.$record->enquiry_id.'|'.$record->id.'">';
                        $show = route($route_name . '.show', $record->id);
                        $edit = route($route_name . '.addFollowUpForm', $record->id);
                        $delete = route($route_name . '.remove', $currentRecordId);
                    } else if ($table_name == 'students') {
                        $route_name = 'students';
                        $show = route($route_name . '.show', $record->id);
                        $edit = route($route_name . '.edit', $record->id);
                        $delete = route('admissions.delete', $record->admission_id);
                    } else if ($table_name == 'enquiries') {
                        $currentRecordId = $record->id;
                         //dd($record);
                        $record->previous_degree_body = '<input type="checkbox" class="checkboxsingle" name="enqIds[]" value="'.$currentRecordId.'">';
                        $record->id = $count;
                        $route_name = 'enquiries';
                        $show = route($route_name . '.show', $currentRecordId);
                        $edit = route($route_name . '.edit', $currentRecordId);
                        $delete = route($route_name . '.remove', $currentRecordId);
                    } else {
                        $route_name = $table_name;
                        $show = route($route_name . '.show', $record->id);
                        $edit = route($route_name . '.edit', $record->id);
                        $delete = '#';
                    }

                    // Permissions
                    
                    if($route_name == "students"){
                        $permissionModuleName = 'admissions';
                    }else if($route_name == "followups"){
                        $permissionModuleName = 'followups_management';
                    }else if($route_name == "enquires"){
                        $permissionModuleName = 'enquires_management';
                    }else{
                        $permissionModuleName = $route_name;
                    }
                    //$permissionModuleName = $route_name == 'students' ? //'admissions' : $route_name;
                    //$permissionModuleName = $route_name == 'followups' ? //'followups_management' : $route_name;
                    //$permissionModuleName = $route_name == 'enquires' ? //'enquires_management' : $route_name;
                    
                    if($permissionModuleName == "enquiries"){
                        $permissionModuleName = 'enquiries_management';
                    }
                    $viewPermission = !\Auth::user()->hasPermissionTo('view_' . $permissionModuleName) ? 'hidden' : '';
                    $updatePermission = !\Auth::user()->hasPermissionTo('update_' . $permissionModuleName) ? 'hidden' : '';
                    $deletePermission = !\Auth::user()->hasPermissionTo('delete_' . $permissionModuleName) ? 'hidden' : '';
                    // hidden
                    $record->options = "<div class='btn-group' role='group' aria-label='Basic example'>
                                            <a href='" . $show . "' title='SHOW' class='btn btn-sm btn-primary' " . $viewPermission . "><i class='mdi mdi-eye'></i></a>
                                            <a href='" . $edit . "' title='EDIT' class='btn btn-sm btn-info' " . $updatePermission . "><i class='mdi mdi-pencil'></i></a>
                                            <a href='" . $delete . "' title='DELETE' class='btn btn-sm btn-danger' " . $deletePermission . "><i class='mdi mdi-delete'></i></a>
                                        </div>";

                    if ($table_name == 'enquiry_followups' and Auth::user()->isSuperAdmin() ) {
                        // print_r($record); 
                         //die;
                        $record->options = substr($record->options, 0, -6);
                        $record->options .= "<button data-target='#assignToUser' data-toggle='modal' title='Assign to user' onclick='assignEnqId(".$record->enquiry_id.",".$record->id.")' class='btn btn-sm btn-primary'><i class='fa fa-user'></i></button></div>";

                    }
                    $data[] = $record->toArray();
                    array_push($added_ids, $record->id);
                    $count++;
                }
            }

            $json_data = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,

            );

            echo json_encode($json_data);
        } else {
            try {
                $column_names = [];
                foreach ($columns as $key => $value) {
                    $column_names[$value['data']] = $value['title'];
                }
                $file_name = $table_name . '_data_export' . $request->export_extension;
                \Excel::store(new DataExport(['query' => $query, 'table_name' => $table_name]), $file_name , 'public_local');
                
                //return \Storage::url('local')->url($file_name);
                return asset('public/storage').'/'.$file_name;
            } catch (\Exception $e) {
                \Log::info($e);
                dd($e);
                return request()->json('Something went wrong while exporting data.', 500);
            }
        }
    }

    public function getSelectQuery($select)
    {
        $select_raw = [];
        foreach ($select as $table_name => $table_columns) {
            if ($table_columns['selective_columns'] == 'true') {
                foreach ($table_columns['columns'] as $column_name => $value) {
                    if (isset($value['sum'])) {
                        foreach ($value['sum'] as $sum) {
                            if (isset($sum['where'])) {
                                $sum_raw_query = 'SUM(CASE WHEN ' . str_replace(['lessthan', 'greaterthan'], ['<', '>'], $sum['where']['when_clause']) . ' THEN ' . $table_name . '.' . $column_name . ' ELSE ' . $sum['where']['else_clause'] . ' END' . ') as ' . $sum['as'];
                            } else {
                                $sum_raw_query = 'SUM(' . $table_name . '.' . $column_name . ') as ' . $sum['as'];
                            }
                            // dd(\DB::raw($sum_raw_query));
                            array_push($select_raw, \DB::raw($sum_raw_query));
                        }
                    }
                    if (isset($value['count'])) {
                        // will be written in future as per the need.
                    }
                    $raw_query = $table_name . '.' . $column_name . ($value['as'] ? ' as ' . $value['as'] : '');
                    array_push($select_raw, $raw_query);
                }
            } else {
                array_push($select_raw, $table_name . '.*'); /* WIll get all the data for all columns if the array is empty*/
            }
        }
        // dd($select_raw);
        return $select_raw;
    }
}
