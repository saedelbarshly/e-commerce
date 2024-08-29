@extends('AdminPanel.layouts.master')
@section('content')


<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{$title}}</h4>
      </div>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="table-responsive">
        <table class="table table-bordered mb-2">
          <thead>
            <tr class="text-center">
              <th>{{trans('common.menuTitle')}}</th>
              <th>{{trans('common.menuLocation')}}</th>
              <th>{{trans('common.actions')}}</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @forelse($menus as $menu)
            <tr id="row_{{$menu->id}}">
              <td>
                {{$menu['title_ar']}}<br>
                {{$menu['title_en']}}
              </td>
              <td>
                  <b class="badge badge-pill badge-light-primary"> {{ trans('common.'.$menu['place']) }} </b>
              </td>
              <td class="text-center">
                <a href="{{ route('admin.items', ['menu'=>$menu->id]) }}" class="btn btn-icon btn-success" data-bs-original-title="{{trans('common.details')}}" title="{{trans('common.details')}}">
                  <i data-feather='align-justify'></i>
                </a>
                <a href="javascript:;" data-bs-target="#editmenu{{$menu->id}}" data-bs-toggle="modal"
                  class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-original-title="{{trans('common.edit')}}" title="{{trans('common.edit')}}">
                  <i data-feather='edit'></i>
                </a>
                <?php $delete = route('admin.menus.delete',['menu'=>$menu->id]); ?>
                <button type="button" class="btn btn-icon btn-danger"
                  onclick="confirmDelete('{{$delete}}','{{$menu->id}}')" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                  <i data-feather='trash-2'></i>
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="p-3 text-center ">
                <h2>{{trans('common.nothingToView')}}</h2>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @foreach($menus as $menu)
      <div class="modal fade text-md-start" id="editmenu{{$menu->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
          <div class="modal-content">
            <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
              <div class="text-center mb-2">
                <h1 class="mb-1">{{trans('common.edit')}}</h1>
              </div>
              {{Form::open(['url'=>route('admin.menus.update',['menu'=>$menu->id]), 'id'=>'editmenuForm', 'class'=>'row
              gy-1 pt-75'])}}
              <div class="col-12 col-md-6">
                <label class="form-label" for="title_ar">{{trans('common.title_ar')}}</label>
                {{Form::text('title_ar',$menu->title_ar,['id'=>'title_ar', 'class'=>'form-control'])}}
                @error('title_ar')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="title_en">{{trans('common.title_en')}}</label>
                {{Form::text('title_en',$menu->title_en,['id'=>'title_en', 'class'=>'form-control'])}}
                @error('title_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="place">{{trans('common.menuLocation')}}</label>
                <select class="form-control" id="place" name="place">
                  <option disabled>--{{trans('common.selectMenuLocation')}}--</option>
                  <option value="header" {{ ($menu->place == "header") ? 'selected' : '' }}> {{trans('common.header')}}</option>
                  <option value="footer1" {{ ($menu->place == "footer1") ? 'selected' : '' }}> {{trans('common.footer1')}}</option>
                  <option value="footer2" {{ ($menu->place == "footer2") ? 'selected' : '' }}> {{trans('common.footer2')}}</option>
                </select>
                @error('place')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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

      {{ $menus->links('vendor.pagination.default') }}


    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop

@section('page_buttons')
<a href="javascript:;" data-bs-target="#createmenu" data-bs-toggle="modal" class="btn btn-primary">
  {{trans('common.CreateNew')}}
</a>

<div class="modal fade text-md-start" id="createmenu" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
        <div class="text-center mb-2">
          <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
        </div>
        {{Form::open(['url'=>route('admin.menus.store'), 'id'=>'createmenuForm', 'class'=>'row gy-1 pt-75'])}}
        <div class="col-12 col-md-6">
          <label class="form-label" for="title_ar">{{trans('common.title_ar')}}</label>
          {{Form::text('title_ar','',['id'=>'title_ar', 'class'=>'form-control'])}}
          @error('title_ar')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="title_en">{{trans('common.title_en')}}</label>
          {{Form::text('title_en','',['id'=>'title_en', 'class'=>'form-control'])}}
          @error('title_en')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="place">{{trans('common.menuLocation')}}</label>
          <select class="form-control" id="place" name="place">
            <option selected disabled>--{{trans('common.selectMenuLocation')}}--</option>
            <option value="header"> {{trans('common.header')}}</option>
            <option value="footer1"> {{trans('common.footer1')}}</option>
            <option value="footer2"> {{trans('common.footer2')}}</option>
          </select>
          @error('place')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
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
@stop
