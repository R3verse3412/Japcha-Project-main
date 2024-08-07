<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Timer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="timerInput">Set Timer Interval <span>(in seconds or add m for minutes):</span></label>
            <input type="text" id="timerInput" placeholder="1 (second) / 1m (minute)" style="padding: 5px;">
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="setTimerBtn" data-toggle="tooltip" data-placement="top" title="use m at the end of number for minutes" data-dismiss="modal">Set Timer</button>
      </div>
    </div>
  </div>
</div>