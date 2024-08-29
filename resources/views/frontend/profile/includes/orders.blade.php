<div class="row">
  <div class="col-12">
    <div class="card dashboard-table mt-0">
      <div class="card-body table-responsive-sm">
        <div class="top-sec">
          <h3>{{ trans('common.MyOrders') }}</h3>
        </div>
        <div class="table-responsive-xl">
          <table class="table cart-table order-table">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('common.date') }}</th>
                <th>{{ trans('common.client') }}</th>
                <th>{{ trans('common.total') }}</th>
                <th class="text-center">{{ trans('common.actions') }}</th>
              </tr>
            </thead>
            <tbody>
             @forelse($orders as $order)
            <tr id="row_{{$order->id}}">
              <td>{{$order->id}}</td>
              <td>
                {{$order->date_time}}
              </td>
              <td>
                {{$order->client->name ?? '-'}}
              </td>
              <td>
                {{trans('common.total')}}: {{$order->totals()['subtotal']}}
                <br>{{trans('common.discount')}}: {{$order->totals()['discount']}}
              </td>

              <td class="text-center">
                <a href="{{ route('profile.myOrder', $order->id) }}" class="btn btn-icon btn-info"
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ trans('common.from_details') }}">
                  <i data-feather='list'></i>
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="22" class="p-3 text-center ">
                <h2>{{ trans('common.nothingToView') }}</h2>
              </td>
            </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
