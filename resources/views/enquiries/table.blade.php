
<div class="row">
    <div class="col-md-12">
       <table class="table table-bordered" id="liveSearchTable">
            <thead>
                  
            </thead>                
       </table>
    </div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <script>
        var table_cols_configuration = {!! json_encode($table_cols_configuration) !!};
        var table_name = {!! json_encode($table_name) !!};
        var datatable;
        $(document).ready(function () {
            datatable = $('#liveSearchTable').DataTable({
                "dom": 'Bfrtip',
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "liveSearchTableRender",
                    "dataType": "json",
                    "type": "POST",
                    "data":function(data){ 
                        data._token = $("input[name='_token']").val();
                        data.model = "App\\Models\\Enquiry";
                        data.table_name = table_name;
                        data.filters = {};
                        data.filters.course_id = document.getElementById('course_id').value;
                        data.filters.user_id = document.getElementById('user_id').value;
                        data.filters.enquiry_type = document.getElementById('enquiry_type_id').value;
                        data.filters.affiliated_body_id = document.getElementById('affiliated_body_id').value;
                        data.filters.start_date = document.getElementById('start_date').value;
                        data.filters.end_date = document.getElementById('end_date').value;
                        data.filters.date_filter_column = '{{ $filters_configuration['date_filter_column'] }}';

                    }
                },
               "columns": table_cols_configuration,
               "buttons": [
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        sheetName: 'Exported data'
                    } 
                ],
                // "initComplete": function() {
                //     addColNumbers();
                // },

            });
        });
        // datatable.on( 'draw', function () {
        //   rewriteColNumbers()
        // } );
        // function addColNumbers() {
        //   $('#liveSearchTable thead tr').prepend('<th>#</th>');
        //   $('#liveSearchTable tbody tr').each(function( index ) {
        //     $(this).prepend('<td>' + (index + 1) + '</td>');
        //   } );
        // }

        // function rewriteColNumbers() {
        //   $('#liveSearchTable tbody tr').each(function( index ) {
        //     $('td', this ).first().html(index + 1);
        //   } );
        // }
        $('#course_id').change(function (){
            datatable.ajax.reload();
        })

        $('#enquiry_type_id').change(function (){
            datatable.ajax.reload();
        })

        $('#user_id').change(function (){
            datatable.ajax.reload();
        })

        $('#affiliated_body_id').change(function (){
            datatable.ajax.reload();
        })
        $('#start_date').change(function (){
            datatable.ajax.reload();
        })
        $('#end_date').change(function (){
            datatable.ajax.reload();
        })

    </script>

