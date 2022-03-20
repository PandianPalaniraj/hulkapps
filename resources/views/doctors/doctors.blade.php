@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

@include('doctors/form')<!-- Create doctor form -->

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
        <h4 class="card-title"><strong>Doctors</strong></h4>
        <div class="table-responsive">
          <table class="table table-striped" id="example">
            <thead>
              <tr>
                <th> User </th>
                <th> Name </th>
                <th> Email </th>
                <th> Mobile </th>
              </tr>
            </thead>
            <tbody>
              @if(count($doctors) > 0)
                @foreach($doctors as $doc)
                  <tr>
                    <td class="py-1">
                        <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" />
                    </td>
                    <td>{{$doc->name}}</td>
                    <td>{{$doc->users->email}}</td>
                    <td>{{$doc->mobile}}</td>
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
      <script type="text/javascript">$('#doctorCreate').modal('toggle');</script>
  @endif

  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });

    $('.create_new_doctor').click(function(){
      $('#doctorCreate').modal('toggle');
    })

    $('.help-block').hide();
    $('.submit-doctor-form').click(function(e){
      e.preventDefault();
      $('.help-block').hide();
      $('.help-block').text('');
      var form = $('#doctor-create-form').serialize();
      var baseurl = "{{url("/")}}";
      url = baseurl + '/doctors';

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


