
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="appointmentUpdateLabel">Update Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="appointment-update-form">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $appointment->id }}">
          <input type="hidden" name="doctor_id" value="{{ $appointment->doctor_id }}">
          <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">

          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" name="patient" value="{{ $appointment->patients->name }}" readonly />
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-patient" style="display: none;"></span>
          </div>

          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" name="doctor" value="{{ $appointment->doctors->name }}" readonly />
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-doctor" style="display: none;"></span>
          </div>

          <div class="form-group">
            <div class="input-group">
              <input type="date" class="form-control" placeholder="Date" name="date" value="{{ date('Y-m-d', strtotime($appointment->date)) }}">
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-date" style="display: none;"></span>
          </div>

          <div class="form-group">
            <div class="input-group">
              <select class="form-control" name="time_slot">
                <option value="">Select Time Slot</option>
                @foreach($time_slot as $key => $time)
                  <option value="{{$key}}" @if($appointment->time_slot_id == $key) selected @endif>{{$time}}</option>
                @endforeach
              </select>
            </div>
            <span class="help-block error-time_slot" style="display: none;"></span>
          </div>
          
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="">Select Status</option>
              <option value="Pending" @if($appointment->status == "Pending") selected @endif>Pending</option>
              <option value="Scheduled" @if($appointment->status == "Scheduled") selected @endif>Scheduled</option>
              <option value="Finished" @if($appointment->status == "Finished") selected @endif>Finished</option>
              <option value="Rejected" @if($appointment->status == "Rejected") selected @endif>Rejected</option>
            </select>
            <span class="help-block error-status" style="display: none;"></span>
          </div>
         
          <div class="form-group">
            <button type="button" class="btn btn-primary submit-btn btn-block update-appointment-form">Update Status</button>
          </div>
        </form>
      </div>
    </div>
  </div>
