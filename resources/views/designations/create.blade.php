@include('includes/header_start')
@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Designations</h3>
    </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->
     @php
        $count = 1;
     @endphp

     <div class="page-content-wrapper" id="designations">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title m-0">Create Designation</h5>
                        </div>
                        <div class="card-body">
                            {{-- form --}}
                            <form action="{{ route('designations.store') }}" method="POST" class="mt-3">
                                @csrf
                                <div class="form-row">
                                    {{-- Organization --}}
                                    @if (App\Models\Organization::count() > 0)
                                    <div class="form-group col-md-4">
                                        <label>Organization</label>
                                        {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), App\Models\Organization::first()->id, ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Organization ---', 'required']) !!}
                                    </div>
                                    @else
                                        <h6 class="text-danger">Create Organization First To Proceed</h6>
                                    @endif
                                    {{-- NAME --}}
                                    <div class="form-group col-md-4">
                                        <label>Name</label>
                                        <input data-parsley-type="name" type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required/>
                                    </div>
                                    {{-- CODE --}}
                                    <div class="form-group col-md-4">
                                        <label>Code</label>
                                        <input data-parsley-type="code" type="text" class="form-control" name="code" id="code" placeholder="Enter code"/>
                                    </div>
                                    <div class="form-group col-md-12 text-right">
                                        <button class="btn btn-dark btn-sm btn-clone">
                                            <i class="fa fa-plus fa-fw"></i> | Add New Campus
                                        </button>
                                    </div> 
                                </div> 
                                    
                                {{-- duplicating form --}}
                                <div id="dynamic_data">
                                    <div class="form-row">
                                        {{-- CAMPUS --}}
                                        @if (App\Models\Organization::count() > 0)
                                            <div class="mt-4 pt-2 mr-2 ml-2">
                                                <button class="btn btn-danger btn-sm disabled rounded-0" type="button">
                                                    <i class="fa fa-times fa-fw fa-lg"></i>
                                                </button>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Campus</label>
                                                {!! Form::select('designation_details['. $count .'][organization_campus_id]', App\Models\OrganizationCampus::pluck('name', 'id'), null, ['id' => 'campus_id_'.$count, 'class' => 'form-control select2', 'placeholder' => '--- Select Campus ---', 'required', 'onchange'=>'onOrganizationCampusSelect(event)', 'data-row' => $count]) !!}
                                            </div>
                                        @else
                                            <h6 class="text-danger">Create Campuses First To Proceed</h6>
                                        @endif
                                        {{-- DEPARTMENT --}}
                                        <div id="department_id_{{$count}}" class="col-md-6"></div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('designations.index') }}" class="btn btn-light btn-sm mr-1">
                                        <i class="fa fa-times fa-fw text-danger"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        <i class="fa fa-cloud-upload fa-fw"></i>
                                        <b>|</b>
                                        Save Designation
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    @include('includes/footer_start')
    
    <script type="text/javascript">
        var count = {!! $count !!};
    </script>

    <script src="{{ asset('js/designation.js') }}"></script>

    @include('includes/footer_end')

