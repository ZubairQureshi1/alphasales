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
                                    <h3 class="page-title">Invoice</h3>
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="invoice-title">
                                                        <h4 class="pull-right font-16"><strong>Voucher Code # {{$fee['voucher_code']}}</strong></h4>
                                                        <h3 class="mt-0">
                                                            <img src="{{asset('assets/images/logo_dark.png')}}" alt="logo" height="26"/>
                                                        </h3>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <address>
                                                                <strong>Billed To:</strong><br>
                                                               <label>Student Name : </label> {{$student['student_name']}}<br>
                                                               <label>Student Roll # : </label>
                                                                {{$student['roll_no']}}<br>
                                                                <label>Course : </label>
                                                                {{$student['course_name']}}<br>
                                                                <label>Session : </label>
                                                                {{$student['session_name']}}
                                                            </address>
                                                        </div>
                                                        <div class="col-6 text-right">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 m-t-30">

                                                        </div>
                                                        <div class="col-6 m-t-30 text-right">
                                                            <address>
                                                                <strong>Due Date:</strong>
                                                                {{$fee['due_date']}}<br><br>
                                                            </address>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="panel panel-default">
                                                        <div class="p-2">
                                                            <h3 class="panel-title font-20"><strong>Fee summary</strong></h3>
                                                        </div>
                                                        <div class="">
                                                            <div class="table-responsive">
                                                                <table class="table" id="invoiceTable">
                                                                    <thead>
                                                                    <tr>
                                                                        <td><strong>Detail</strong></td>
                                                                        <td class="text-center"><strong>Charges</strong></td>

                                                                        <td class="text-right"><strong>Totals</strong></td>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                                    <tr>
                                                                        <td>Package </td>
                                                                        <td class="text-center">{{$fee['net_total']}}</td>

                                                                        <td class="text-right">{{$fee['net_total']}}</td>
                                                                     @foreach ($fine as $index => $key)
                                                                        @if($fine[$index]['status_name']=='Un-Paid')
                                                                             <tr>
                                                                             <td >
                                                                         {{$fine[$index]['name']}}

                                                                             </td>

                                                                             <td class="text-center">
                                                                         {{$fine[$index]['amount']}}
                                                                             </td>
                                                                                <td class="text-right">
                                                                         {{$fine[$index]['amount']}}
                                                                             </td>

                                                                             <td class="text-right"><button type="button" class="btn btn-danger btn-sm"  onclick="deleteRow(this)">x</button></td>
                                                                            </tr>
                                                                            @elseif($fine[$index]['status_name']=='VoucherPrinted')
                                                                             <tr>
                                                                             <td >
                                                                         {{$fine[$index]['name']}}

                                                                             </td>

                                                                             <td class="text-center">
                                                                         {{$fine[$index]['amount']}}
                                                                             </td>
                                                                                <td class="text-right">
                                                                         {{$fine[$index]['amount']}}
                                                                             </td>

                                                                             <td class="text-right">

                                                                                <label style="color:red">Voucher Already Printed</label>
                                                                                <button type="button" class="btn btn-danger btn-sm"  onclick="deleteRow(this)">x</button></td>
                                                                            </tr>
                                                                             @endif

                                                                             @endforeach

                                                                         @foreach ($headFineStudents as $index => $key)
                                                                        @if($headFineStudents[$index]['status_name']=='Un-Paid')
                                                                             <tr>
                                                                             <td >
                            {{$headFineStudents[$index]->headFine()->get()->toArray()[0]['name']}}

                                                                             </td>

                                                                             <td class="text-center">
                                                                         {{$headFineStudents[$index]->headFine()->get()->toArray()[0]['amount']}}
                                                                             </td>
                                                                                <td class="text-right">
                                                                         {{$headFineStudents[$index]->headFine()->get()->toArray()[0]['amount']}}
                                                                             </td>

                                                                             <td class="text-right"><button type="button" class="btn btn-danger btn-sm"  onclick="deleteRow(this)">x</button></td>
                                                                            </tr>
                                                                            @elseif($headFineStudents[$index]['status_name']=='VoucherPrinted')
                                                                             <tr>
                                                                             <td >
                                                                         {{$headFineStudents[$index]->headFine()->get()->toArray()[0]['name']}}

                                                                             </td>

                                                                             <td class="text-center">
                                                                         {{$headFineStudents[$index]->headFine()->get()->toArray()[0]['amount']}}
                                                                             </td>
                                                                                <td class="text-right">
                                                                         {{$headFineStudents[$index]->headFine()->get()->toArray()[0]['amount']}}
                                                                             </td>

                                                                             <td class="text-right">

                                                                                <label style="color:red">Voucher Already Printed</label>
                                                                                <button type="button" class="btn btn-danger btn-sm"  onclick="deleteRow(this)">x</button></td>
                                                                            </tr>
                                                                             @endif

                                                                             @endforeach
                                                                        <tr>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line text-center">
                                                                            <strong>Subtotal</strong></td>
                                                                        <td class="thick-line text-right">$670.99</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="no-line"></td>
                                                                        <td class="no-line"></td>
                                                                        <td class="no-line text-center">
                                                                            <strong>Total</strong></td>
                                                                        <td class="no-line text-right"><h4 class="m-0">$685.99</h4></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="d-print-none">
                                                                <div class="pull-right">
                                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div> <!-- end row -->

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->


                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

@include('includes/footer_start')
<script src="{{ asset('js/accounts/account.js')  }}"></script>

@include('includes/footer_end')