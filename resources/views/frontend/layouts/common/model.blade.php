@if(getSettingImageLink("popupModal") != '')
<div class="modal fade bd-example-modal-lg newyear-modal" id="newyear" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-12">

              <button type="button" class="btn-close blabla" data-bs-dismiss="modal" aria-label="Close" s>
                <span class="p-0 m-0" aria-hidden="true">&times;</span>
              </button>
              <div class="content">
                <img src="{{ getSettingImageLink("popupModal") }}" alt="newyear" width="100%">
                {{-- <h1>Happy</h1>
                  <h1>new year</h1>
                  <h2>sale</h2>
                  <div class="discount">get
                    <span>30%</span>
                    off
                    <span class="plus">+</span>
                    <span>FREE SHIPPING</span>
                  </div>
                  <div class="btn btn-solid">31 DEC - 10th JAN</div>
                  <p>*check shipping conditions in our website</p> --}}
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif