@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Step 1: Edit School Year
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing {{ $schoolyear->school_year}} School Year </h4>
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                    	   <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>School Year</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Edit School Year</th>

                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>{{ $schoolyear->school_year }}</td>
                                                        <td>{{ $schoolyear->start_date->toFormattedDateString() }}</td>
                                                        <td>{{ $schoolyear->end_date->toFormattedDateString() }}</td>
                                                        <td><strong><a href="{{asset('/schoolsetup/editschoolyear/'.$schoolyear->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                                        </td>
                                                       
                                                    </tr>
                                                
                                                    
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                <div class="hr hr-18 dotted hr-double"></div>
                <br>

				<div class="alert-danger">
					
						<ul>
							@foreach($errors->all() as $error)

								<li> {{ $error }}</li>

							@endforeach

						</ul>

				</div>


@endsection
