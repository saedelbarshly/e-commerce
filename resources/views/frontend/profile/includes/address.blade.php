<div class="row">
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="top-sec">
          <h3>{{ trans('common.AddressBook') }}</h3>
          {{-- <a href="#" class="btn btn-sm btn-solid">+ add new</a> --}}
        </div>
        <div class="address-book-section">
          <div class="row g-4">

            @foreach ($userAddresses as $address)

            <div class="select-box active col-xl-4 col-md-6">
              <div class="address-box">
                <div class="top">
                  <h6>{{ $address->first_name }}
                  </h6>
                </div>
                <div class="middle">
                  <div class="address">
                    <p>{{ $address->address }}</p>
                    <p>{{ $address->city }}</p>
                    <p>{{ $address->countryData() }}</p>
                  </div>
                  <div class="number">
                    <p>{{ trans('common.phone') }}: <span>{{ $address->phone }}</span></p>
                  </div>
                </div>
                <div class="bottom">
                  {{-- <a href="javascript:void(0)" data-bs-target="#edit-address" data-bs-toggle="modal" --}}
                  {{-- class="bottom_btn">{{ trans('common.edit') }}</a> --}}
                  <a href="{{ route('profile.removeAddress', ['id'=>$address->id]) }}" class="bottom_btn">
                    {{ trans('common.DeleteAddress') }}
                  </a>
                </div>
              </div>
            </div>
            @endforeach



          </div>
        </div>
      </div>
    </div>
  </div>
</div>
