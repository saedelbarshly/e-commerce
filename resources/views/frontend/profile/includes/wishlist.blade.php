<div class="row">
  <div class="col-12">
    <div class="card dashboard-table mt-0">
      <div class="card-body table-responsive-sm">
        <div class="top-sec">
          <h3>{{ trans('common.MyWishlist') }}</h3>
        </div>
        <div class="table-responsive-xl">
          <table class="table cart-table wishlist-table">
           <thead>
            <tr class="table-head">
              <th scope="col">{{ trans('common.image') }}</th>
              <th scope="col">{{ trans('common.product_name') }}</th>
              <th scope="col">{{ trans('common.price') }}</th>
              <th scope="col">{{ trans('common.actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($wishlists as $wishlist)
            <tr>
              <td class="text-center">
                <a href="#"><img src="{{ $wishlist->product->photoLink() }}" alt=""></a>
              </td>
              <td class="text-center">
                <a href="{{ route('product.details', ['product'=> $wishlist->product->id ]) }}">
                  {{$wishlist->product['name_'.$lang] }}
                </a>
              </td>
              <td class="text-center">
                <h2>
                  <span>{{ $wishlist->product->price }}</span>
                </h2>
              </td>
              <td class="text-center">
                <form action="{{ route('wishlist.delete', ['wishlist'=>$wishlist->id ]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="icon me-3">
                    <i class="ti-close"></i>
                  </button>
                </form>
              </td>
            </tr>
            @empty
            @endforelse
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
