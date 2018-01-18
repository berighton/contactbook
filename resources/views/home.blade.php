@extends('layouts.app')@section('content')
<div class="container">
	<div class="row mt-5">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Contact list</div>
				<div class="panel-body">
					<div class="input-group">
						<div class="input-group-btn">
							<button type="button" id="showCreateContactModal" class="btn btn-info">Create contact
							</button>
						</div>
						<input type="text" class="form-control" name="search" id="search-text" aria-label="..." value="{{$search}}">
						<div class="input-group-btn">
							<a class="btn btn-default search-btn" href="#" role="button">Search</a>
						</div>
					</div>
				</div>
				<table class="table table-hover" id="contact-list">
					<thead>
						<tr>
							<td>Name</td>
							<td>Surname</td>
							<td>Email</td>
							<td>Phone</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						@if(count($contacts)>0) @foreach($contacts as $contact)
						<tr class="contact{{$contact->id}}">
							<td class="fname">{{$contact->fname}}</td>
							<td class="lname">{{$contact->lname}}</td>
							<td class="email">{{$contact->email}}</td>
							<td class="phone">{{$contact->phone}}</td>
							<td>
								<a href="javascript: void(0)" class="edit" data-contact="{{$contact->id}}" data-name="{{$contact->fname}}" data-surname="{{$contact->lname}}" data-email="{{$contact->email}}" data-phone="{{$contact->phone}}" data-cf='{{$contact->extra_fields}}'>Edit</a>
								<a href="javascript: void(0)" class="delete btn-delete " data-id="{{$contact->id}}">Delete</a>
							</td>
						</tr>
						@endforeach @endif
					</tbody>
				</table>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title" id="myModalLabel">Contact Editor</h4>
							</div>
							<div class="modal-body">
								<form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">
									<div class="form-group error">
										<label for="inputTask" class="col-sm-3 control-label">Name</label>
										<div class="col-sm-9">
											<input required="required" type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Surname</label>
										<div class="col-sm-9">
											<input required="required" type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Email</label>
										<div class="col-sm-9">
											<input required="required" type="email" class="form-control" id="email" name="email" placeholder="Email" value="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Phone</label>
										<div class="col-sm-9">
											<input required="required" type="number" class="form-control" id="phone" name="phone" placeholder="Phone" value="">
										</div>
									</div>
								</form>
								<a class="btn btn-primary" id="add-custom-field" data-cf-count="0">Add custom field</a>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
								</button>
								<input type="hidden" id="contact_id" name="contact_id" value="0">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>@endsection
