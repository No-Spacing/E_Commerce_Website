<div class="modal fade modal-lg" id="messageUsModal" tabindex="-1" role="dialog" aria-labelledby="messageUsModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Message Us!</h5>
      </div>
      <div class="modal-body">
        <form id="messageForm" action="#">
          <div class="">
              <label class="h6 mb-2" for="message">Message</label>
              <span class="text-danger">@error('message'){{ $message }} @enderror</span>
              <textarea class="form-control" id="message" name="message" type="textarea" rows="6" placeholder="Enter your message to our Doctor" required></textarea>
              <p class="mt-2">Note: We will reply to your provided email as much as possible.</p>
          </div>
        </form>
      </div>
      <div class="container modal-footer pt-2">    
          <button type="submit" form="messageForm" class="btn btn-primary">Send</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>