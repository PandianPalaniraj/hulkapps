@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

@include('appointments/form')<!-- Create doctor form -->

@if($message = Session::get('success'))
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss = 'alert'>x</button>
    <h6>
      {{ $message }}
    </h6>
  </div>
@endif
@if($message = Session::get('error'))
  <div class="alert alert-danger col-6 mx-auto">
    <button type="button" class="close" data-dismiss = 'alert'>x</button>
    <h6>
      {{ $message }}
    </h6>
  </div>
@endif

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Appointments</h4>
        <div class="table-responsive">
          <table id="example" class="table table-striped">
            <thead>
              <tr>
                <th> Date </th>
                <th> Time Range </th>
                <th> Dcotor </th>
                <th> Patient </th>
                <th> Status </th>
                @if(getUserRole() !== 'Patient')
                <th> Action </th>
                @endif
              </tr>
            </thead>
            <tbody>
              @if(count($appointments) > 0)
                @foreach($appointments as $value)
                  <tr>
                    <td>{{ date('d-m-y', strtotime($value->date)) }}</td>
                    <td>{{ $value->time_slot->time_slot }}</td>
                    <td>{{ $value->doctors->name }}</td>
                    <td>{{ $value->patients->name }}</td>
                    <td>{{ $value->status }}</td>
                    @if(getUserRole() !== 'Patient')
                      <td>
                        <button class="btn btn-outline-primary update-status" data-id="{{ $value->id }}" type="button">Update Status</button>
                      </td>
                    @endif
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="8" class="text-center"><strong>No Records Found!</strong></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="appointmentUpdate" tabindex="-1" role="dialog" aria-labelledby="appointmentUpdateLabel" aria-hidden="true">
  </div>
@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}

  @if(count($errors) > 0)
    <script type="text/javascript">$('#appointmentCreate').modal('toggle');</script>
  @endif
  
 
  <script>

    $(document).ready(function() {
      $('#example').DataTable();
    });

    $('.create_new_appointment').click(function(){
      $('#appointmentCreate').modal('toggle');
    })


    $('.help-block').hide();
    $('.submit-appointment-form').click(function(e){
      e.preventDefault();
      $('.help-block').hide();
      $('.help-block').text('');
      var form = $('#appointment-create-form').serialize();
      var baseurl = "{{url("/")}}";
      url = baseurl + '/appointments';

      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        },
          url: url,
          type: 'POST',
          data: form,

          success:function(data){
            console.log(data)
            if (data.status == 'error') {
                var errors = data.errors;
                $.each(errors, function(key, value){
                    $('.error-'+key).show();
                    $('.error-'+key).text(value);
                });
            }else{
              window.location.reload();
            }
          }
      })
    })

    $(document).on('click','.update-status',function(){
        var form = $('#appointment-update-form').serialize();
        var baseurl = "{{url("/")}}";
        var id = $(this).data('id');
        url = baseurl + '/appointments/edit/'+id;

        $.ajax({
          url: url,
          type: 'GET',
          success:function(data){
            $('#appointmentUpdate').html(data);
            $('#appointmentUpdate').modal('toggle');
          }
      })
    });

    $(document).on('click','.update-appointment-form',function(e){
      e.preventDefault();
      $('.help-block').hide();
      $('.help-block').text('');
      var form = $('#appointment-update-form').serialize();
      var baseurl = "{{url("/")}}";
      url = baseurl + '/appointments/update';

      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        },
          url: url,
          type: 'POST',
          data: form,

          success:function(data){
            console.log(data)
            if (data.status == 'error') {
                var errors = data.errors;
                $.each(errors, function(key, value){
                    $('.error-'+key).show();
                    $('.error-'+key).text(value);
                });
            }else{
              window.location.reload();
            }
          }
      })
    })
  </script>
@endpush