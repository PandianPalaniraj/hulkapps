<div class="modal fade" id="appointmentCreate" tabindex="-1" role="dialog" aria-labelledby="appointmentCreateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="appointmentCreateLabel">New Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="appointment-create-form">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <div class="input-group">
              @if(getUserRole() == 'Patient')
                <input type="hidden" name="patient" value="{{ getPatientId() }}">
              @else
                <select class="form-control" name="patient">
                  <option value="">Select Patient</option>
                  @foreach($patients as $key => $patient)
                    <option value="{{$key}}">{{$patient}}</option>
                  @endforeach
                </select>
              @endif
            </div>
            <span class="help-block error-patient"></span>
          </div>
          <div class="form-group">
            <div class="input-group">
              <select class="form-control" name="doctor">
                <option value="">Select Doctor</option>
                @foreach($doctors as $key => $doc)
                  <option value="{{$key}}">{{$doc}}</option>
                @endforeach
              </select>
            </div>
            <span class="help-block error-doctor"></span>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="date" class="form-control" placeholder="Date" name="date">
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-date"></span>
          </div>
         <div class="form-group">
            <div class="input-group">
              <select class="form-control" name="time_slot">
                <option value="">Select Time Slot</option>
                @foreach($time_slot as $key => $time)
                  <option value="{{$key}}">{{$time}}</option>
                @endforeach
              </select>
            </div>
            <span class="help-block error-time_slot"></span>
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block submit-appointment-form">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

