<!-- <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="addsubjects" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Course
                    <strong>
                        Subjects
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('students.getSubjects')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                             <label text-left for="subject">Subjects:</label>
                                        
                             <select class="form-group select2 select2-multiple" multiple="multiple" name="subject" id="subject">
                                <option value="">--Select subjects--</option>
                                 @foreach($subject as $row){
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                 }
                                @endforeach
                                                
                             </select>
                         </div>
                            
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 -->