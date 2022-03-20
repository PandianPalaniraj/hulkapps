<div class="modal fade" id="doctorCreate" tabindex="-1" role="dialog" aria-labelledby="doctorCreateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="doctorCreateLabel">New Doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="doctor-create-form" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Name" name="name">
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-name"></span>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Mobile" name="mobile">
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-mobile"></span>

          </div>
          
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Email" name="email">
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-email"></span>
          </div>
          
          <div class="form-group">
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-password"></span>
          </div>
          
          <div class="form-group">
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
              <div class="input-group-append">
              </div>
            </div>
            <span class="help-block error-password"></span>
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block submit-doctor-form">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>