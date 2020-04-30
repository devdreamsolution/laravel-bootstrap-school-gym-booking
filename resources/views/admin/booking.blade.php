@extends('layouts.admin')

@section('content')
<a href="{{ 'view/request' }}" style="">View Customer's Booking</a>
<br>
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
		$("#add_date").datepicker().datepicker("setDate", new Date());
		$("#edit_date").datepicker().datepicker("setDate", new Date());
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		var dataTableContacts = $('#data-table-contact').DataTable( {			
			"ordering": false,
        	"serverSide": true,
        	bFilter: false,
        	bInfo: false,
	        "ajax": {
	        	url: "{{ 'admin' }}",
	        	"data" : function(d){
	        		 var info = $('#data-table-contact').DataTable().page.info();        		 
	        		 d.page = ( info.page + 1 );
	        	}
	        },
	        "columns": [
	            {
	            	"data": function(data){
	            		if (data.activity == '1')
	            			return 'swimming pool'
	            		else if (data.activity == '2')
	            			return 'indoor running tracks'
	            		else if (data.activity == '3')
	            			return 'tennis'
	            		else if (data.activity == '4')
	            			return 'football'
	            		else
	            			return 'boxing'
	            	}
	            },
	            { "data": "place" },
	            { "data": "date" },
	            { 
	            	"data": function(data){	            		
	            		return '<button type="button" class="btn btn-primary btn-xs btn-edit" data-id="'+data.id+'">Edit</button> <button type="button" class="btn btn-danger btn-xs btn-delete" data-id="'+data.id+'">Delete</button>';
	            	} 
	            }	            
	        ],
	        "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false
            }]
	    });
		$('.dataTables_length').addClass('bs-select');
	    $(document).on('click', '#btn-save-contact', function(){	
	    	$('.text-danger').remove();
	    	var createForm = $("#form-create-contact");
	    	ajaxRequest(
	    		"{{ 'admin/store' }}",
	    		'POST',
	    		createForm.serializeArray(),
	    		function(response){
	    			if(response.errors) {	    				
	    				$.each(response.errors, function (elem, messages) {
	    					createForm.find('input[name="'+elem+'"]').after('<p class="text-danger">'+messages.join('')+'</p>');
	    				});	    				
	    			} else {
	    				dataTableContacts.ajax.reload();
	    				$("#form-create-contact").trigger("reset");
	    				$("#modal-create-contact").modal('hide');
	    			}
	    	});
	    });

    	$(document).on('click', '.btn-edit', function(e){	
    		e.preventDefault();    		
    		var url = "{{ 'admin/edit/id' }}";
    		url = url.replace('id', $(this).attr('data-id'));
    		ajaxRequest(url, 'GET', [], function(response){
    			if( response.data ){
    				var editForm = $('#form-edit-contact');    				
    				$("#edit_activity").val(response.data.activity);
    				editForm.find('input[name="place"]').val(response.data.place);
    				editForm.find('input[name="date"]').val(response.data.date);
    				$("#contact_id").val(response.data.id);  
    				$("#modal-edit-contact").modal('show');
    			}
    		});
    	});

    	$(document).on('click', '#btn-update-contact', function(e){
    		var url = "{{ 'admin/update/id' }}";
    		url = url.replace('id', $("#contact_id").val()); 
    		var editForm = $("#form-edit-contact");    	
    		ajaxRequest(
	    		url,
	    		'PUT',
	    		editForm.serializeArray(),
	    		function(response){
	    			if(response.errors) {
	    				$.each(response.errors, function (elem, messages) {
	    					editForm.find('input[name="'+elem+'"]').after('<p class="text-danger">'+messages.join('')+'</p>');
	    				});
	    			} else {
	    				dataTableContacts.ajax.reload();
	    				$("#form-edit-contact").trigger("reset");
	    				$("#modal-edit-contact").modal('hide');
	    			}
	    	});	
    	});	
    	
    	$(document).on('click', '.btn-delete', function(e){ 
    		var url = "{{ 'admin/delete/id' }}";
    		url = url.replace('id', $(this).attr('data-id')); 
			swal({
				title: "Are you sure you want delete this contact?",				
				icon: "warning",
				buttons: true,
				dangerMode: true,
				buttons: ["No", "Yes"]				
			})
			.then((willDelete) => {
				if (willDelete) {
					ajaxRequest(
			    		url,
			    		'DELETE',
			    		[],
			    		function(response){
			    			dataTableContacts.ajax.reload();
	    				});
				} 
			});
    	});	

    	$('#modal-create-contact').on('hidden.bs.modal', function (e) {
		  	$("#form-create-contact").trigger("reset");
		});

		$('#modal-edit-contact').on('hidden.bs.modal', function (e) {
		  	$("#form-edit-contact").trigger("reset");
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

</script>
@endsection