@extends('AdminPanel.layouts.master')
@section('content')
<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{$title}}</h4>
      </div>
      <div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <div class="table-responsive">
        <table class="table table-bordered mb-2">
          <thead class="text-center">
            <tr>
              <th class="text-center">{{trans('common.name')}}</th>
              <th class="text-center">{{trans('common.image')}}</th>
              <th class="text-center">{{trans('common.type')}}</th>
              <th class="text-center">{{trans('common.price')}}</th>
              <th class="text-center">{{trans('common.quantity')}}</th>
              <th class="text-center">{{trans('common.status')}}</th>
              <th class="text-center">{{trans('common.actions')}}</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @forelse($products as $product)
            <tr id="row_{{$product->id}}">
              <td>
                {{$product['name_ar']}}<br>
                {{$product['name_en']}}
              </td>
              <td class="text-center">
                <img src="{{ $product->photoLink() }}" alt="image" class="img-responsive rounded" width="100px">
              </td>
              <td class="text-center">
                {{$product->type}}
              </td>
              <td class="text-center">
                {{$product->price}}
              </td>
              <td class="text-center">
                <label class="badge badge-light-success">
                {{$product->quantity}}
                </label>
              </td>
              <td class="text-center">
                {{($product->status == 1) ? 'مفعل' : 'غير مفعل'}}
              </td>
              <td class="text-center">
                <a href={{ route('admin.products.edit', $product->id) }} class="btn btn-icon btn-info" data-bs-original-title="{{trans('common.edit')}}">
                  <i data-feather='edit'></i>
                </a>
                <?php $delete = route('admin.products.delete',['product'=>$product->id]); ?>
                <button type="button" class="btn btn-icon btn-danger"
                  onclick="confirmDelete('{{$delete}}','{{$product->id}}')" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                  <i data-feather='trash-2'></i>
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="p-3 text-center ">
                <h2>{{trans('common.nothingToView')}}</h2>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @foreach($products as $product)
      <div class="modal fade text-md-start" id="editproduct{{$product->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
          <div class="modal-content">
            <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
              <div class="text-center mb-2">
                <h1 class="mb-1">{{trans('common.edit')}}</h1>
              </div>
              {{Form::open(['url'=>route('admin.products.update',['product'=>$product->id]), 'id'=>'editproductForm',
              'class'=>'row gy-1 pt-75','files'=>true])}}
              <div class="col-12 col-md-6">
                <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                {{Form::text('name_ar',$product->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                {{Form::text('name_en',$product->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="ordering">{{trans('common.ordering')}}</label>
                {{Form::number('ordering',$product->ordering,['id'=>'ordering', 'step'=>'1',
                'class'=>'form-control','required', 'min'=>0])}}
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="keywords_ar">{{trans('common.keywords_ar')}}</label>
                {{Form::textarea('keywords_ar',$product->keywords_ar,['id'=>'keywords_ar','class'=>'form-control','required',
                'rows'=>3])}}
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="keywords_en">{{trans('common.keywords_en')}}</label>
                {{Form::textarea('keywords_en',$product->keywords_en,['id'=>'keywords_en','class'=>'form-control','required',
                'rows'=>3])}}
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="image">{{trans('common.image')}}</label>
                {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 text-center mt-2 pt-50">
                <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                  {{trans('common.Cancel')}}
                </button>
              </div>
              {{Form::close()}}
            </div>
          </div>
        </div>
      </div>
      @endforeach


      {{ $products->links('vendor.pagination.default') }}


    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop

@section('page_buttons')
<a href="{{ route('admin.products.create') }}"  class="btn btn-primary">
  {{trans('common.CreateNew')}}
</a>
{{-- <a href="javascript:;" data-bs-target="#createproduct" data-bs-toggle="modal" class="btn btn-primary">
  {{trans('common.CreateNew')}}
</a> --}}
{{-- <div class="modal fade text-md-start" id="createproduct" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
        <div class="text-center mb-2">
          <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
        </div>
        {{Form::open(['url'=>route('admin.products.store'), 'id'=>'createproductForm', 'class'=>'row gy-1 pt-75',
        'files'=>'true'])}}
        <div class="col-12 col-md-6">
          <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
          {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control','required'])}}
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
          {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="ordering">{{trans('common.ordering')}}</label>
          {{Form::number('ordering','',['id'=>'ordering', 'step'=>'1', 'class'=>'form-control','required', 'min'=>0])}}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="keywords_ar">{{trans('common.keywords_ar')}}</label>
          {{Form::textarea('keywords_ar','',['id'=>'keywords_ar','class'=>'form-control','required', 'rows'=>3])}}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="keywords_en">{{trans('common.keywords_en')}}</label>
          {{Form::textarea('keywords_en','',['id'=>'keywords_en','class'=>'form-control','required', 'rows'=>3])}}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="image">{{trans('common.image')}}</label>
          {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 text-center mt-2 pt-50">
          <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
            {{trans('common.Cancel')}}
          </button>
        </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</div> --}}
@stop
