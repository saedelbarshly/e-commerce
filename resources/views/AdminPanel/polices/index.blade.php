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
                        <thead class="text-center">
                            <tr>
                                <th>{{trans('common.description_ar')}}</th>
                                <th>{{trans('common.description_en')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($polices as $police)
                            <tr id="row_{{$police->id}}">
                                <td class="text-wrap" style="max-width: 300px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                  {!! $police->description_ar !!}
                                </td>
                                <td class="text-wrap" style="max-width: 300px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                  {!! $police->description_en !!}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#editpolice{{$police->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info my-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.polices.delete',['police'=>$police->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger my-1" onclick="confirmDelete('{{$delete}}','{{$police->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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

                @foreach($polices as $police)
                    <div class="modal fade text-md-start" id="editpolice{{$police->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.polices.update',['police'=>$police->id]), 'id'=>'editpoliceForm', 'class'=>'row gy-1 pt-75'])}}
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="ranking">{{trans('common.ranking')}}</label>
                                        {{Form::number('ranking',$police->ranking,['id'=>'ranking', 'class'=>'form-control'])}}
                                        @error('ranking')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                      </div>
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="description_ar">{{trans('common.description_ar')}}</label>
                                        {{Form::textarea('description_ar',$police->description_ar,['id'=>'description_ar', 'class'=>'form-control editor_ar'])}}
                                        @error('description_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                      </div>
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="description_en">{{trans('common.description_en')}}</label>
                                        {{Form::textarea('description_en',$police->description_en,['id'=>'description_en', 'class'=>'form-control editor_en'])}}
                                        @error('description_en')
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
                {{ $polices->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createpolice" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createpolice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.polices.store'), 'id'=>'createpoliceForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="ranking">{{trans('common.ranking')}}</label>
                            {{Form::number('ranking','',['id'=>'ranking', 'class'=>'form-control'])}}
                            @error('ranking')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="description_ar">{{trans('common.description_ar')}}</label>
                            {{Form::textarea('description_ar','',['id'=>'description_ar', 'class'=>'form-control editor_ar'])}}
                            @error('description_ar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="description_en">{{trans('common.description_en')}}</label>
                            {{Form::textarea('description_en','',['id'=>'description_en', 'class'=>'form-control editor_en'])}}
                            @error('description_en')
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
