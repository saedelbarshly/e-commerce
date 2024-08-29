@extends('AdminPanel.layouts.master')
@section('content')

    {{Form::open(['url'=>route('admin.books.booksBulkDelete'),'id'=>'assignClientsForm'])}}

        <!-- Bordered table start -->
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{$title}}
                            <br>
                            <small>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll" />
                                    <label class="form-check-label" for="selectAll"> {{trans('common.Select All')}} </label>
                                </div>
                            </small>
                        </h4>
                        <button type="submit" class="btn btn-danger btn-sm me-1 float-right">
                            {{trans('common.delete')}}
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-2">
                            <thead>
                                <tr>
                                    <th>{{trans('common.name')}}</th>
                                    <th>{{trans('common.publisher')}}</th>
                                    <th>{{trans('common.writer')}}</th>
                                    <th>{{trans('common.Section')}}</th>
                                    <th>{{trans('common.language')}}</th>
                                    <th class="text-center">{{trans('common.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($books as $book)
                                <tr id="row_{{$book->id}}">
                                    <td class="text-wrap">
                                        <div class="form-check me-3 me-lg-1">
                                            <input class="form-check-input" type="checkbox" id="book{{$book->id}}" name="books[]" value="{{$book->id}}" />
                                            <label class="form-check-label" for="book{{$book->id}}">
                                                {{$book->name_ar}}<br>
                                                {{$book->name_en}}<br>
                                                {{$book->name_fr}}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{$book->publisher->name ?? '-'}}
                                    </td>
                                    <td>
                                        {{$book->writer['name_'.session()->get('Lang')] ?? ''}}
                                    </td>
                                    <td>
                                        {{$book->section['name_'.session()->get('Lang')] ?? ''}}
                                    </td>
                                    <td>
                                        {{$book->languageText()}}
                                    </td>
                                    <td class="text-center text-nowrap">

                                        <a href="{{route('admin.books.reviews',['id'=>$book->id])}}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.reviews')}}">
                                            <i data-feather='list'></i>
                                        </a>
                                        <a href="{{route('admin.books.edit',['id'=>$book->id])}}" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <?php $delete = route('admin.books.delete',['id'=>$book->id]); ?>
                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$book->id}}')">
                                            <i data-feather='trash-2'></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-3 text-center ">
                                            <h2>{{trans('common.nothingToView')}}</h2>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $books->links('vendor.pagination.default') }}


                </div>
            </div>
        </div>
        <!-- Bordered table end -->
    {{Form::close()}}



@stop

@section('page_buttons')
    <a href="{{route('admin.books.create')}}" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
@stop

@section('scripts')
<script src="{{asset('AdminAssets/app-assets/js/scripts/pages/modal-add-role.js')}}"></script>
@stop