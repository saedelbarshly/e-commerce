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
              <th>{{trans('common.elementName')}}</th>
              <th>{{trans('common.elementType')}}</th>
              <th>{{trans('common.actions')}}</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @forelse($items as $item)
            <tr id="row_{{$item->id}}">
              <td>
                {{$item['title_ar']}}<br>
                {{$item['title_en']}}
              </td>
              <td>
                <b class="badge badge-pill badge-light-primary"> {{ trans('common.'.$item['type']) . ' :' }} </b> <br>
                @if($item['type'] == 'link')
                  <a href="{{$item['link']}}" target="_blank">{{$item['link']}}</a>
                @elseif($item['type'] == 'staticPage')
                  <b class="badge badge-pill badge-light-success"> {{ $item->page->title_ar }} </b>
                @elseif($item['type'] == 'category')
                  <b class="badge badge-pill badge-light-secondary"> {{ $item->category->name_ar }} </b>
                @endif
              </td>
              <td class="text-center">
                <a href="javascript:;" data-bs-target="#edititem{{$item->id}}" data-bs-toggle="modal"
                  class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-original-title="{{trans('common.edit')}}" title="{{trans('common.edit')}}">
                  <i data-feather='edit'></i>
                </a>
                <?php $delete = route('admin.items.delete',['menu' => $menu->id,'item'=>$item->id]); ?>
                <button type="button" class="btn btn-icon btn-danger"
                  onclick="confirmDelete('{{$delete}}','{{$item->id}}')" data-bs-toggle="tooltip"
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

      @foreach($items as $item)
      <div class="modal fade text-md-start" id="edititem{{$item->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
          <div class="modal-content">
            <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
              <div class="text-center mb-2">
                <h1 class="mb-1">{{trans('common.edit')}}</h1>
              </div>
              {{Form::open(['url'=>route('admin.items.update',['menu'=>$menu->id, 'item'=>$item->id]), 'id'=>'edititemForm', 'class'=>'row gy-1 pt-75'])}}
              <div class="col-12 col-md-6">
                <label class="form-label" for="title_ar">{{trans('common.title_ar')}}</label>
                {{Form::text('title_ar',$item->title_ar,['id'=>'title_ar', 'class'=>'form-control'])}}
                @error('title_ar')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="title_en">{{trans('common.title_en')}}</label>
                {{Form::text('title_en',$item->title_en,['id'=>'title_en', 'class'=>'form-control'])}}
                @error('title_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="type">{{trans('common.elementType')}}</label>
                <select class="form-control" id="type" name="type" onchange=updateItem(this.value,{{$item->id}})>
                  <option disabled>--{{ trans('common.elementType') }}--</option>
                  <option value="staticPage" {{ ($item->type == "staticPage") ? 'selected' : ''}}>{{ trans('common.staticPage') }}</option>
                  <option value="category" {{ ($item->type == "category") ? 'selected' : ''}}>{{ trans('common.category') }}</option>
                  <option value="link" {{ ($item->type == "link") ? 'selected' : ''}}>{{ trans('common.link') }}</option>
                </select>
                @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="mainElement">{{trans('common.mainElement'). ' ؟'}} </label>
                {{Form::select('mainElement',[ '0' => trans('common.mainElement') ]+ $mainItems , $item->mainElement,['id'=>'mainElement',
                'class'=>'form-control'])}}
                @error('mainElement')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-12 col-md-12 {{ ($item->type == 'staticPage') ? '' : 'd-none' }}" id="UpdatePage_id_{{ $item->id }}">
                <label class="form-label" for="page_id">{{trans('common.staticPage')}} </label>
                {{Form::select('page_id',$pages ,$item->page_id,['id'=>'page_id', 'class'=>'form-control'])}}
                @error('page_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-12 col-md-12 {{ ($item->type == 'category') ? '' : 'd-none' }}" id="UpdateCategory_{{ $item->id }}">
                <label class="form-label" for="category_id">{{trans('common.category')}} </label>
                {{Form::select('category_id',$categories , $item->category_id ,['id'=>'category_id', 'class'=>'form-control'])}}
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-12 col-md-12 {{ ($item->type == 'link') ? '' : 'd-none' }}" id="UpdateLink_{{ $item->id }}">
                <label class="form-label" for="link">{{trans('common.link')}}</label>
                {{Form::text('link',$item->link,['id'=>'link', 'class'=>'form-control'])}}
                @error('link')
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

      {{ $items->links('vendor.pagination.default') }}


    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop

@section('page_buttons')
<a href="javascript:;" data-bs-target="#createitem" data-bs-toggle="modal" class="btn btn-primary">
  {{trans('common.CreateNew')}}
</a>

<div class="modal fade text-md-start" id="createitem" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
        <div class="text-center mb-2">
          <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
        </div>
        {{Form::open(['url'=>route('admin.items.store',['menu'=>$menu->id]), 'id'=>'createitemForm', 'class'=>'row gy-1 pt-75'])}}
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
        <div class="col-12 col-md-6">
          <label class="form-label" for="type">{{trans('common.elementType')}}</label>
          <select class="form-control" id="type" name="type" onchange = showElemet(this.value)>
            <option selected disabled>--{{ trans('common.elementType') }}--</option>
            <option value="staticPage">{{ trans('common.staticPage') }}</option>
            <option value="category">{{ trans('common.category') }}</option>
            <option value="link">{{ trans('common.link') }}</option>
          </select>
          @error('type')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="mainElement">{{trans('common.mainElement'). ' ؟'}} </label>
          {{Form::select('mainElement',[ '0' => trans('common.mainElement') ]+ $mainItems ,'' ,['id'=>'mainElement', 'class'=>'form-control'])}}
          @error('mainElement')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12 col-md-12 d-none" id="page_id">
          <label class="form-label" for="page_id">{{trans('common.staticPage')}} </label>
          {{Form::select('page_id',$pages ,'' ,['id'=>'page_id', 'class'=>'form-control'])}}
          @error('page_id')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12 col-md-12 d-none" id="category">
          <label class="form-label" for="category_id">{{trans('common.category')}} </label>
          {{Form::select('category_id',$categories ,'' ,['id'=>'category_id', 'class'=>'form-control'])}}
          @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12 col-md-12 d-none" id="link">
          <label class="form-label" for="link">{{trans('common.link')}}</label>
          {{Form::text('link','',['id'=>'link', 'class'=>'form-control'])}}
          @error('link')
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
@section("scripts")
<script>
  function showElemet(val) {
    if (val == "staticPage") {
      $('#page_id').show();
      $('#page_id').removeClass("d-none");
      $('#category').hide();
      $('#link').hide();
    } else if (val == "category") {
      $('#page_id').hide();
      $('#category').show();
      $('#category').removeClass("d-none");
      $('#link').hide();
    } else if (val == "link") {
      $('#page_id').hide();
      $('#category').hide();
      $('#link').show();
      $('#link').removeClass("d-none");
    }
  }
</script>
<script>
  function updateItem(val, id){
    if (val == "staticPage") {
    $('#UpdatePage_id_'+id).show();
    $('#UpdatePage_id_'+id).removeClass("d-none");
    $('#UpdateCategory_'+id).hide();
    $('#UpdateLink_'+id).hide();
    } else if (val == "category") {
    $('#UpdatePage_id_'+id).hide();
    $('#UpdateCategory_'+id).show();
    $('#UpdateCategory_'+id).removeClass("d-none");
    $('#UpdateLink_'+id).hide();
    } else if (val == "link") {
    $('#UpdatePage_id_'+id).hide();
    $('#UpdateCategory_'+id).hide();
    $('#UpdateLink_'+id).show();
    $('#UpdateLink_'+id).removeClass("d-none");
    }
  }
</script>
@stop
