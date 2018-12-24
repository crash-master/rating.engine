<style>
  #mediaModal{
    z-index: 999999;
  }

  #mediaModal .modal-dialog{
    max-width: 1200px !important;
  }

  #mediaModel .media-container{
    width: 100%;
  }

  #mediaModal .media-item{
    width: 150px;
    height: 150px;
    display: inline-block;
    margin-left: 10px;
    opacity: .6;
    cursor: pointer;
    transition-duration: .2s;
    -webkit-background-size: cover;
    background-size: cover;
    background-position: center center;
  }

  #mediaModal .media-item:hover{
    opacity: 1;
  }
</style>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none media-model-btn" data-toggle="modal" data-target="#mediaModal"></button>

<!-- Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">MEDIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="media-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>