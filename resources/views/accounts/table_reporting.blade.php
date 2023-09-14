
<div class="row on-print" id="cfe_info">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body div-border-black">
                <div class="row">
                    <div class="col-2">
                        <a class="image-popup-no-margins" href="">
                            <img class="img-thumbnail" src="" width="120" height="120">
                        </a>
                    </div>
                    <div class="col-8">
                        <div class="text-center" style="">
                            <h4>CFE College of Commerce & Sciences</h4>
                            <strong>Address: 5 - Babar Block, New Garden Town, Lahore, Punjab</strong><br>
                            <div>
                                <h4 style="max-width: 60%;margin: 0 auto;padding: 10px;margin-bottom: 0.5%;text-transform: uppercase;" class="div-border-black" id="reporting_title"></h4>
                            </div>
                            <strong style="margin-top: -50px;">As On: <label id="as_on_value"></label></strong>
                        </div>
                    </div>
                    <div class="col-2">
                        <img class="img-thumbnail pull-right" src="{{ asset('assets/images/logo_dark.png') }}" style="width:150px; height:75px;">
                    </div>
                </div>
                <div class="row margin-top-20">
                    <div class="col-4">
                        <strong>Session: </strong> <label id="session_value"></label><br>
                        <strong>Section: </strong> <label id="section_value"></label><br>
                        <strong>Part: </strong><label id="part_value"></label><br>
                    </div>
                    <div class="col-4">
                        <strong>Course Name: </strong> <label id="course_value"></label><br>
                        <strong>Student Category: </strong><label id="category_value"></label><br>
                        <strong>Date (From - To): </strong> <label id="date_value"></label><br>
                    </div>
                    <div class="col-4">
                        <strong>Head Category: </strong> <label id="head_category_value"></label><br>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="table-rep-plugin">
    <div class="table-responsive b-0">
        <table cellspacing="0" id="accounts_reporting_table" class="tablet table table-striped table-responsive table-bordered">
            <thead>
                <tr>
                    <th>
                        Roll No
                    </th>
                    <th>
                        Old Roll No
                    </th>
                    <th>
                        Student Name
                    </th>
                    <th>
                        Student Type
                    </th>
                    <th>
                        Session Name
                    </th>
                    <th>
                        Course Name
                    </th>
                    <th>
                        Section Name
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="row" id="report_loading" hidden style="margin-left: 2px;
    background: #b1b1b1;
    padding: 10px;
    color: white;
    margin-right: 2px;">
    <div class="col-4"></div>
    <div class="col-4" style="text-align:  center;">
        <a><i class="ion-loop fa-spin"></i> Please Wait!</a>
    </div>
    <div class="col-4"></div>
</div>