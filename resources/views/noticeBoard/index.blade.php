@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom/admission.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Date-Sheet</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="sessions">
    <div class="container-fluid">
        <div class="m-b-10">
            <div class="card">
                <div class="card-body">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                                <div class="col-sm-12"> 
                                        <strong> <i class="fa fa-table" aria-hidden="true"></i> Notice Board :</strong>
                                </div>
                             </div>
                             {!! Form::open(['route' => 'notice_board.store']) !!}
                             <div class="row m-t-10">
                                 <div class="form-group col-md-4">
                                    {!! Form::label('title', 'Title:') !!}
                                    {!! Form::text('title',null, ['id' => 'title_id','class' => 'form-control', 'placeholder' => 'Title']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    {!! Form::label('description', 'Description:') !!}
                                    {!! Form::text('description',null, ['id' => 'description_id','class' => 'form-control', 'placeholder' => 'Description']) !!}
                                </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-2">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper" id="sessions">
    <div class="container-fluid">
        <div class="m-b-10">
            <div class="card">
                <div class="card-body">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($notice_board as $value)
                                    <tr>
                                    <td>{{$value->title}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>
                                    <a href="edit_notice_board/{{$value['id']}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="delete_notice_board/{{$value['id']}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>                                    
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/footer_start')

<!-- Required datatable js -->
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
<!-- Datatable init js -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
        var template = '{{json_encode(config('constants'))}}';
        var constants = JSON.parse(template.replace(/&quot;/g,'"'));

    </script>
    <!-- <script src="{{ asset('js/admission/admission.js')  }}"></script> -->

@include('includes/footer_end')