    
<div class="row">
    <a href="" id="file_path" hidden></a>
    <div class="col-md-12">
        <table class="table table-striped table-bordered nowrap table-responsive" id="liveSearchTable" width="100%">
            <thead>
            </thead>
            <tbody></tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script>
    var table_cols_configuration = {!! json_encode($table_cols_configuration) !!};

    var model_path = {!! json_encode($model_path) !!};
    var table_name = {!! json_encode($table_name) !!};
    console.log(table_cols_configuration);
    var datatable;
    var filters = {};
    console.log(model_path);
    $(document).ready(function() {
        var btnbj = [{
                    "text": '<i class="fa fa-recycle"></i> | Reload',
                    "className": 'btn btn-dark btn-sm margin-right-5',
                    action: function(e, dt, node, config) {
                        dt.ajax.reload();
                    },
                    },
                    {
                    "text": '<i class="fa fa-upload"></i> | Import',
                    "className": 'btn btn-dark btn-sm margin-right-5',
                    action: function(e, dt, node, config) {
                        $("#importEnqModel").modal("show");
                    }},
                    {
                    "extend": 'collection',
                    "text": '<i class="mdi mdi-file-export"></i> | Export',
                    "className": 'btn btn-dark btn-sm',
                    "buttons": [{
                            "text": '<i hidden id="export_loading" class="fa fa-spinner fa-spin"></i> <i class="mdi mdi-file-excel"> | .XLSX',
                            "className": 'btn btn-default btn-sm',
                            action: function(e, dt, node, config) {
                                var params = dt.ajax.params();
                                params.is_export = true;
                                params.export_extension = '.xlsx';
                                document.getElementById('export_loading').hidden = false;
                                $.ajax({
                                    url: "liveSearchDataExport",
                                    // dataType: "json",
                                    type: "POST",
                                    data: params,
                                    success: function(data) {
                                        document.getElementById(
                                            'export_loading').hidden = true;
                                        document.getElementById('file_path')
                                            .href = data;
                                        document.getElementById('file_path')
                                            .click();
                                    },
                                    error: function(data) {}
                                });
                            }
                        },
                        /*
                                                    {
                                                        "text": '<i class="mdi mdi-file-excel"> | .XLS',
                                                        "className": 'btn btn-default btn-sm',
                                                        action: function ( e, dt, node, config ) {
                                                        }
                                                    }*/
                    ]
                },
            ];
         <?php if (Auth::user()->isSuperADmin()) { ?>
            if(table_name  == 'enquiry_followups' ){
                btnbj.push({
                        "text": '<div title="Assign to user" onclick="assignEnqId()"><i class="fa fa-user"></i> | Assign </div>',
                        "className": 'btn btn-dark btn-sm ml-1',
                        action: function(e, dt, node, config) {
                             
                        },
                        });
            }
        <?php } ?>
        date_filter_column = '{{ $filters_configuration['date_filter_column'] }}';
        console.log(date_filter_column);
        has_joins = '{{ $filters_configuration['has_joins'] }}';
        joins = '{{ json_encode($filters_configuration['joins']) }}';
        // setupFilterObject();
        datatable = $('#liveSearchTable').DataTable({
            "dom": 'Bflrtip',
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            lengthMenu: [
            [10, 25, 50,100,500, -1],
            [10, 25, 50,100,500, 'All'],
        ],
            "ajax": {
                "url": "liveSearchTableRender",
                "dataType": "json",
                "type": "POST",
                "data": function(data) {
                    setupFilterObject();
                    data._token = $("input[name='_token']").val();
                    data.model = model_path;
                    data.table_name = table_name;
                    data.date_filter_column = date_filter_column;
                    data.filters = filters;
                    data.has_joins = has_joins;
                    if (data.has_joins) {
                        data.joins = JSON.parse(joins.replace(/&quot;/g, '"'));
                    }
                },
            },
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // converting to interger to find total
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                var footer = '<tr>'
                this.api().columns().every(function() {
                    var column = this;
                    var sum = column.data().reduce(function(a, b) {
                        var x = parseFloat(a) || 0;
                        var y = parseFloat(b) || 0;
                        return x + y;
                    }, 0);
                    footer += '<th>' + (sum == 0 ? '---' : sum) + '</th>';
                });
                footer += '</tr>';
                // debugger;
                if (table_name == 'admissions') {
                    $('tfoot').html(footer)
                }
            },
            columnDefs: [
                { targets: [0], orderable: false}
            ],
            "columns": table_cols_configuration,
            order: [[3, 'desc']],
            "buttons": btnbj,
        });
        addChangeEvent();
    });

    function setupFilterObject() {
        filters = {};
        var allowedFilters = document.getElementsByClassName('data-filters');
        for (var i = 0; i < allowedFilters.length; i++) {
            if (filters[allowedFilters[i].name] == undefined) {
                filters[allowedFilters[i].name] = {};
            }
            if (allowedFilters[i].selectedOptions) {
                for (var j = 0; j < allowedFilters[i].selectedOptions.length; j++) {
                    filters[allowedFilters[i].name][j] = {};
                    filters[allowedFilters[i].name][j]['value'] = allowedFilters[i].selectedOptions[j].value;
                    filters[allowedFilters[i].name][j]['type'] = allowedFilters[i].type;
                    filters[allowedFilters[i].name][j]['search_through_join'] = allowedFilters[i].hasAttribute(
                        'search_through_join');
                    filters[allowedFilters[i].name][j]['join_table'] = allowedFilters[i].getAttribute('join_table');
                    filters[allowedFilters[i].name][j]['conditional_operator'] = allowedFilters[i].getAttribute(
                        'conditional_operator');
                }
            } else {
                var length = Object.keys(filters[allowedFilters[i].name]).length;
                filters[allowedFilters[i].name][length] = {};
                filters[allowedFilters[i].name][length]['value'] = allowedFilters[i].value;
                filters[allowedFilters[i].name][length]['type'] = allowedFilters[i].type;
                filters[allowedFilters[i].name][length]['search_through_join'] = allowedFilters[i].hasAttribute(
                    'search_through_join');
                filters[allowedFilters[i].name][length]['join_table'] = allowedFilters[i].getAttribute('join_table');
                filters[allowedFilters[i].name][length]['conditional_operator'] = allowedFilters[i].getAttribute(
                    'conditional_operator');
            }
        }
        console.log(filters);
    }

    function addChangeEvent() {

        var allowedFilters = document.getElementsByClassName('data-filters');
        for (var i = 0; i < allowedFilters.length; i++) {
            if (allowedFilters[i].id != 'global_session_id' && allowedFilters[i].id !=
                'global_organization_campus_id') {
                $('#' + allowedFilters[i].id).on('change', function(event) {
                    dataTableReload(event);
                });
            }

        }
    }

    function dataTableReload(event) {
        datatable.ajax.reload();
    }
</script>
