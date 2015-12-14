@extends('layouts/layout')

@section('content')



	@if(Session::has('message'))
		<div class="alert alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  {{ Session::get('message')}}
		</div>
	@endif





	@if (!empty($data))

						<div class="container">
								<div class="row">
									<div class="col-sm-offset-2 col-md-7">
										<div class="well well-sm">
											<div class="row">


												<div class="col-sm-6 col-md-4">

													{{ HTML::image(Auth::user()->photo, 'alt', array('class' =>'img-rounded img-responsive' )) }}
												</div>


												<div class="col-sm-6 col-md-8">
													<h4>{{Auth::user()->name}}</h4>

													<p>
														<i class="glyphicon glyphicon-envelope"></i><b> Email: </b>{{Auth::user()->email}}
														<br/>

														<i class="glyphicon glyphicon-user"></i><b> User-Id: </b> {{Auth::user()->profiles->username}}
                                                        <br>
														<i class="glyphicon glyphicon-gift"></i><b> Gender: </b> {{Auth::user()->profiles->gender}}


												</div>
											</div>


										</div>
									</div>
								</div>
							</div>









	@else
		<div class="jumbotron">


		    <p class="text-center">
		      <a class="btn btn-lg btn-primary" href="{{url('login/fb')}}"><i class="icon-facebook"></i> Login with Facebook</a>
		    </p>
		</div>
	@endif




@stop



							<style>
								body{padding-top:30px;}

								.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

								small {
									display: block;
									line-height: 1.428571429;
									color: #999;
								}
							</style>