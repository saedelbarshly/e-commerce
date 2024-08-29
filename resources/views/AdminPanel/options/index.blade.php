@extends('AdminPanel.layouts.master')
@section('content')
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-2">
                        <thead class="text-center">
                            <tr>
                                <th class="text-center">{{trans('common.name')}}</th>
                                <th class="text-center">{{trans('common.optionType')}}</th>
                                <th class="text-center">{{trans('common.ordering')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($options as $option)
                            <tr id="row_{{$option->id}}">
                                <td>
                                    {{$option['name_ar']}}<br>
                                    {{$option['name_en']}}
                                </td>
                                <td>
                                    {{$option->optionType['name_ar']}}<br>
                                    {{$option->optionType['name_en']}}
                                </td>
                                <td class="text-center">
                                    {{$option->ordering}}
                                </td>
                                <td class="text-center">
                                   <a href={{ route('admin.options.edit',['option'=>$option->id] ) }} class="btn btn-icon btn-info" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.options.delete',['option'=>$option->id]); ?>
                                    <button option="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$option->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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
                {{ $options->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@stop

@section('page_buttons')
    <a href="{{ route('admin.options.create') }}" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
@stop
