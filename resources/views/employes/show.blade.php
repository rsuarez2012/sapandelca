@extends('layouts.app')
@section('content')
<div class="x_content">
    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
      <div class="profile_img">
        <div id="crop-avatar">
          <!-- Current avatar -->
          <img class="img-responsive avatar-view" src="{{asset('images/team-1.jpg') }}" alt="Avatar" title="Change the avatar">
        </div>
      </div>
      <h3>{{ $client->first_name.' '.$client->last_name }}</h3>

      <ul class="list-unstyled user_data">
      	<li>
          <i class="fa fa-credit-card user-profile-icon"></i> {{ $client->dni }}
        </li>
        <li>
          <i class="fa fa-mobile user-profile-icon"></i> {{ $client->telephone }}
        </li>
        <li>
          <i class="fa fa-exchange user-profile-icon"></i> 
			@if($client->client_type != '1')
				{{ "Persona Juridica" }}
			@else
				{{ "Persona Natural" }}
			@endif
        </li>
        <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $client->address }}
        </li>

        

        <li class="m-top-xs">
          <i class="fa fa-external-link user-profile-icon"></i>
          <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
        </li>
      </ul>
      <button type="button" class="btn btn-round btn-success btn-sm edit-modal" data-toggle="modal"  data-id="{{ $client->id }}" title="Editar Perfil"><i class="fa fa-edit m-right-xs fa-2x"></i> </button>
               
        <a href="{{ url()->previous() }}" class="btn btn-round btn-warning btn-sm" title="Regresar">
        	<i class="fa fa-arrow-circle-o-left fa-2x"></i>
        </a>
                               
      <br />
  	</div>
  	<div class="col-md-9 col-sm-9 col-xs-12">

      <div class="profile_title">
        <div class="col-md-6">
          <h3>Actividad Reciente</h3>
        </div>
        <div class="col-md-6">
          <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
          </div>
        </div>
      </div>
      <!-- start of user-activity-graph -->
      <div id="graph_bar" style="width:100%; height:280px;"></div>
      <!-- end of user-activity-graph -->
	</div>
</div>
<!--modal Editar-->
<div class="x_content">

  <!-- modals -->
  <!-- Large modal -->
  

  <div class="modal fade" id="editclient"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">prueba</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('clientes.update', 'test')}}" class="row" method="POST">
            	{{ csrf_field() }}
            	{{ method_field('patch') }}
                <input type="hidden" id='id' name="id" value="">
                @include('clients.partials.form')
			</form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
//alert("hola");
$(document).ready(function(){
	var protocol = $(location).attr('protocol');
    var url = $(location).attr('host');
    var full_url = protocol + '//' + url;
    /*** allow ajax requests  ***/
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.edit-modal').on('click', function() {
    	//var id = e.target.value;
    	//var id = $(this).data('id');
    	var id = $(this).attr('data-id');
    	console.log(id);

    	$.ajax({
    		type:'GET',
    		//data:{id:id},
    		url:'/clientes/'+id+'/edit',
    		dataType: 'json',

    		success:function(data){
    			console.log(data);
    			$('#editclient').modal('show');
	    		$(".modal-title").html("Editar cliente");
	    		$('.modal-body #id').val(id);
		          $('.modal-body #first_name').val(data.first_name);
		          $('.modal-body #last_name').val(data.last_name);
		          $('.modal-body #dni').val(data.dni);
		          $('.modal-body #client_type').val(data.client_type);
		          $('.modal-body #address').val(data.address);
			    		$('.modal-body #telephone').val(data.telephone);
	    		
    		},
    	})

    });	
});
</script>
@endsection