@extends('layouts.admin')

@section('content')
<table id="data-table-contact" class="table table-striped">
	<thead>
	    <tr>
	        <th>Activity Name</th>
	        <th>Place</th>
	        <th>Date</th>
	        <th>User Name</th>
	    </tr>
	</thead>
	<tbody>
		<?php echo $xml; ?>
	</tbody>
	<tfoot>
	    <tr>
	        <th>Activity Name</th>
	        <th>Place</th>
	        <th>Date</th>
	        <th>User Name</th>
	    </tr>
	</tfoot>
</table>
@endsection

@section('extra-js')
<script>
	$(document).ready(function(){
		
	}
</script>
@endsection