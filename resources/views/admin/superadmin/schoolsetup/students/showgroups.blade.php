@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Step 5: Add/Edit Students
                               <div class="pull-right"><strong><a href="{{asset('/schoolsetup/logs/studentsloginactivities') }}"><i class="fa fa-history"></i>Login Activities - Students</a></div> 
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing {{ $schoolyear->school_year}} Groups</h4>
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                    	   <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Group Name</th>
                                                    <th># of Students</th>
                                                    <th>Select a Group</th>
                                                   
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($groups as $group)

                                                    <tr>
                                                        <td>{{ $group->name }}</td>
                                                        <td>{{ $group->students()->count() }}</td>
                                                        <td><strong><a href="{{asset('/schoolsetup/students/showstudents/'.$group->id) }}"><i class="fa fa-check-square fa-2x" aria-hidden="true">
                                                            
                                                        </i> Select </a></strong>
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
