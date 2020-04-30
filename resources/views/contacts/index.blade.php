@extends('layouts.app')

@section('content')
@if(auth()->user()->is_admin == 1)
<a href="{{ url('admin') }}">
	Go To Admin Page
</a>
<br>
<br>
@endif

<div class="row">
	<div class="col-md-4">
		<select class="browser-default custom-select" id="search_name"  name="sear_name">
	        <option value="1"> swimming pool </option>
	        <option value="2"> indoor running tracks </option>
	        <option value="3"> tennis </option>
	        <option value="4"> football </option>
	        <option value="5"> boxing </option>
	    </select>
	</div>
	<div class="col-md-3">
		<input class="form-control" id="search_place" type="text" name="search_place">
	</div>
	<div class="col-md-3">
		<input class="form-control" id="search_date" type="text" name="search_date">
	</div>
	<div class="col-md-2">
		<button class="btn btn-primary" id="search_btn" onclick="search();"><i class="fa fa-search"> Search </i></button>
	</div>
</div>
<br>
<table id="data-table-contact" class="table table-striped">
	<thead>
	    <tr>
	        <th>Activity</th>
	        <th>Place</th>
	        <th>Date</th>
	        <th>Actions</th>
	    </tr>
	</thead>
	<tbody>

	</tbody>
	<tfoot>
	    <tr>
	        <th>Activity</th>
	        <th>Place</th>
	        <th>Date</th>
	        <th>Actions</th>
	    </tr>
	</tfoot>
</table>
@endsection

@section('extra-js')
<script>
	$(document).ready(function(){
		var booking_id = '';

		$("#search_date").datepicker().datepicker("setDate", new Date());

		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});		
		
	    $(document).on('click', '#btn-save-contact', function(){	
	    	$("#modal-create-contact").modal('hide');
	    	ajaxRequest(
	    		"booking",
	    		'POST',
	    		{'booking_id': booking_id},
	    		function(response){
	    			if (response)
	    				alert('Success');
	    			else
	    				alert('Faild');
	    	});
	    });

    	$(document).on('click', '.btn-booking', function(e){
    		booking_id = $(this).attr('data-id');
    		$("#modal-create-contact").modal('show');
    	});

    	

    	$('#modal-create-contact').on('hidden.bs.modal', function (e) {
		  	$("#form-create-contact").trigger("reset");
		});
	});

	function ajaxRequest(url, type, data, successFunction){
		$.ajax({
    		url: url,
    		method: type,
    		data: data,
    		success: successFunction
    	});
	}

	function search() {
		var place =  $('#search_place').val();
		var name =  $('#search_name :selected').val();
		var date =  $('#search_date').val();

		ajaxRequest(
    		"search",
    		'POST',
    		{'place': place, 'name': name, 'date': date},
    		function(response){
    			$('tbody').html(response);
    	});
	}

</script>

@endsection