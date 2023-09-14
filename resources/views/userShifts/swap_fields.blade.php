<div class="col-md-6 col-sm-12 div-swap-for">
    <div class="card m-b-30">
        <div class="card-body div-border-rad">
            <div class="box box-primary">
                <div class="box-body">
                    <strong class="card-title">Swap For</strong>
                    <hr>
                    <div class="swap-for-content">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                {{ Form::select('swap_for_user_id', $users, null, ['class' => 'select2 select2']) }}
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <input class="form-control" data-date-format="YYYY-MM-DD" id="start_date" name="start_date" type="date"/>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <input class="form-control" data-date-format="YYYY-MM-DD" id="end_date" name="end_date" type="date"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-success"><i class="mdi mdi-filter">Filter</i></button>
                            </div>
                        </div>  
                        @include('layouts/loading')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-12 div-swap-with">
    <div class="card m-b-30">
        <div class="card-body div-border-rad">
            <div class="box box-primary">
                <div class="box-body">
                    <strong class="card-title">Swap With</strong>
                    <hr>
                    <div class="swap-for-content">
                        <div class="row">
                            <div class="col-12">
                                {{ Form::select('swap_for_user_id', $users, null, ['class' => 'select2 select2']) }}
                            </div>
                        </div>   <br><br><br>  
                        @include('layouts/loading')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>