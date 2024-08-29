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
                        <thead>
                            <tr>
                                <th>{{trans('common.name')}}</th>
                                <th>{{trans('common.rate')}}</th>
                                <th>{{trans('common.comment')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                            <tr id="row_{{$review->id}}">
                                <td>
                                    {{$review->user->name ?? '-'}}
                                </td>
                                <td class="text-wrap">
                                    {{$review->rate}} / 5
                                </td>
                                <td class="text-wrap">
                                    {{$review->comment}}
                                </td>
                                <td class="text-center text-nowrap">
                                    @if($review->status == '0')
                                        <a href="{{route('admin.books.reviewAction',['id'=>$book->id,'review_id'=>$review->id,'action'=>'accept'])}}" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.accept')}}">
                                            <i data-feather='check-circle'></i>
                                        </a>
                                    @endif
                                    @if($review->status == '1')
                                        <a href="{{route('admin.books.reviewAction',['id'=>$book->id,'review_id'=>$review->id,'action'=>'decline'])}}" class="btn btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.decline')}}">
                                            <i data-feather='x-circle'></i>
                                        </a>
                                    @endif
                                    <?php $delete = route('admin.books.reviewAction',['id'=>$book->id,'review_id'=>$review->id,'action'=>'delete']); ?>
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

                {{ $reviews->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop