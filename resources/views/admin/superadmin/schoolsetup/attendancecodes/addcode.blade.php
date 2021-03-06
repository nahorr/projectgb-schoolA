@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                                Add Attendance Codes
                                <hr>
                                @include('flash::message')
                                
                            </h1>
                        </div><!-- /.page-header -->

                        	<form class="form-group" action="{{ url('/schoolsetup/attendancecodes/postcode') }}" method="POST">
                            
									{{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="widget-box ">
                                                <div class="widget-header">
                                                    <h4 class="widget-title">Add Attendance Codes for {{$schoolyear->school_year}} School Year </h4>
                                                    <span class="widget-toolbar">
                                                        <a href="{{asset('/schoolsetup/attendancecodes/showcodes')}}">
                                                            <i class="ace-icon fa fa-cog"></i>
                                                            Edit Attendance Codes
                                                        </a>

                                                    </span>
                                                    
                                                    
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">

                                                    <label for="school-year">Attendance Codes</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    
                                                                    <input class="form-control" id="code_name" type="text" name="code_name" placeholder="Present, Absent , or Late"  required="" />
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        
                                                        <div class="clearfix form-actions">
															<div class="col-md-offset-3 col-md-9">
																
																<input type="submit" value="Submit">

																&nbsp; &nbsp; &nbsp;
																<button class="btn" type="reset">
																	<i class="ace-icon fa fa-undo bigger-110"></i>
																	Reset
																</button>
															</div>
														</div>
                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>



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
