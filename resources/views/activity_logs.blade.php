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
                                    <h3 class="page-title">History - {{ $user->display_name }}</h3>
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->
                         <style type="text/css">
                            .cd-timeline-content {
                                box-shadow: 4px 4px 10px 0px #0000002e; !important;
                            }

                            .cd-timeline-content {
                                border-radius: 5px;
                                 border: 0px !important;
                                padding: 1em;
                                position: relative;
                            }
                            h1, h2, h3, h4, h5, h6 {
                                 margin: 0 0 !important;
                            }
                            hr {
                                 margin-top: 0 !important;
                                margin-bottom: 1rem;
                                border: 0;
                                border-top: 1px solid rgba(0,0,0,.1);
                            }
                        </style>
                    <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">

                                            @if(!$model_audits->isEmpty())
                                                <section id="cd-timeline" class="cd-container">
                                                    @foreach ($model_audits as $audit_key => $audit)
                                                        <div class="cd-timeline-block">
                                                            <div class="cd-timeline-img bg-success">
                                                                <i class="mdi mdi-adjust"></i>
                                                            </div> <!-- cd-timeline-img -->

                                                            <div class="cd-timeline-content">
                                                                <table class="table table-bordered table-striped" width="100%">
                                                                    <thead>
                                                                        <th>
                                                                            COLUMNS
                                                                        </th>
                                                                        <th>
                                                                            VALUE (OLD)
                                                                        </th>
                                                                        <th>
                                                                            VALUE (NEW)
                                                                        </th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach(json_decode($audit->new_values, true) as $key => $value)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ strtoupper($key) }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ isset(json_decode($audit->old_values, true)[$key])?json_decode($audit->old_values, true)[$key]: '---' }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $value }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <blockquote class="blockquote text-right">
                                                                    <footer class="blockquote-footer">
                                                                        <b>ACTION:</b> <span class="badge badge-default">{{ strtoupper($audit->event) }}</span>
                                                                    </footer>
                                                                    <footer class="blockquote-footer">
                                                                        <b>MODEL:</b> {{ $audit->auditable_type }}
                                                                    </footer>
                                                                    <footer class="blockquote-footer">
                                                                        <b>URL:</b> {{ $audit->url }}
                                                                    </footer>
                                                                </blockquote>
                                                                <span class="cd-date">{{ date('l M d, Y h:i', strtotime($audit->created_at)) }} (UTC Format - 5-hours less)</span>
                                                            </div> <!-- cd-timeline-content -->
                                                        </div>
                                                    @endforeach
                                                </section> <!-- cd-timeline -->
                                            @else
                                                @include('includes/not_found')
                                            @endif

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->


                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

@include('includes/footer_start')

@include('includes/footer_end')
