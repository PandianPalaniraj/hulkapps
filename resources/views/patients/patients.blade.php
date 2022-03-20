@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

@include('patients/form')<!-- Create patient form -->

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
        <h4 class="card-title">Patients</h4>
        <div class="table-responsive">
          <table id="example" class="table table-striped">
            <thead>
              <tr>
                <th> User </th>
                <th> Name </th>
                <th> Email </th>
                <th> Mobile </th>
              </tr>
            </thead>
            <tbody>
              @if(count($patients) > 0)
                @foreach($patients as $patient)
                  <tr>
                    <td class="py-1">
                        <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" />
                    </td>
                    <td>{{$patient->name}}</td>
                    <td>{{$patient->users->email}}</td>
                    <td>{{$patient->mobile}}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="4" class="text-center"><strong>No Records Found!</strong></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}

  @if(count($errors) > 0)
    <script type="text/javascript">$('#patientCreate').modal('toggle');</script>
  @endif

  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });

    $('.create_new_patient').click(function(){
      $('#patientCreate').modal('toggle');
    })

    $('.help-block').hide();
    $('.submit-patient-form').click(function(e){
      e.preventDefault();
      $('.help-block').hide();
      $('.help-block').text('');
      var form = $('#patient-create-form').serialize();
      var baseurl = "{{url("/")}}";
      url = baseurl + '/patients';

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