 {{-- For Editing a specific object/row --}}

                                                    {{-- <button type="button" data-toggle="modal" data-target="#{{ $designation['replaced_name'] }}" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i></button> --}}

                                                    <a class="btn btn-primary btn-sm" href="{{ route('designation.edit', $designation->id) }}"><i class="mdi mdi-pencil"></i></a>

                                                    
                                                    {{-- <div class="modal fade update_subect_model" id="{{ $designation['replaced_name'] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0">Update<strong> designation</strong></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p></p>
                                                                    {!! Form::open(['route' => ['designations.update', $designation['id']], 'method' => 'patch']) !!}
                                                                        <div class="form-group">
                                                                     
                                                                            <label>Name</label>
                                                                            <div>
                                                                                <input data-parsley-type="name" type="text"
                                                                                       class="form-control" required
                                                                                       name="name" id="update_designation_name" 
                                                                                       value="{{ $designation['name'] }}"
                                                                                       placeholder="Enter Name"/>
                                                                                       <label>Code</label>

                                                                                       <input data-parsley-type="code" type="text"
                                                                                       class="form-control" required
                                                                                       name="code" id="update_designation_code" 
                                                                                       value="{{ $designation['code'] }}"
                                                                                       placeholder="Enter code"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal --> --}}

                                                    {{-- For Editing a specific object/row ends here --}}
                                                    {!! Form::open(['route' => ['designations.destroy', $designation['id']], 'method' => 'delete']) !!}
                                                      <button type="submit" class="btn btn-danger btn-sm"><i class="typcn typcn-delete-outline"></i></button>
                                                    {!! Form::close() !!}