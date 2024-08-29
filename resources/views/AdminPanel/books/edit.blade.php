@extends('AdminPanel.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- profile -->
            <div class="card">
                <div class="card-body py-2 my-25">
                    {{Form::open(['files'=>'true','class'=>'validate-form'])}}
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4 text-center">
                                <label class="form-label" for="photo">{{trans('common.frontPage')}}</label>
                                @if($book->photoLink() != '')
                                    <span class="mb-2">
                                        <img src="{{$book->photoLink()}}" alt="avatar" width="100%">
                                    </span>
                                @endif
                                <div class="file-loading mt-1"> 
                                    <input class="files" name="photo" type="file">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <label class="form-label" for="backPage">{{trans('common.backPage')}}</label>
                                @if($book->backPageLink() != '')
                                    <span class="mb-2">
                                        <img src="{{$book->backPageLink()}}" alt="avatar" width="100%">
                                    </span>
                                @endif
                                <div class="file-loading mt-1"> 
                                    <input class="files" name="backPage" type="file">
                                </div>
                            </div>
                        </div>

                        <!-- form -->
                        <div class="row pt-3">
                            <div class="col-12 col-sm-3 mb-1">
                                <label class="form-label" for="name_ar">{{trans('common.name_ar')}} <span class="text-danger">*</span></label>
                                {{Form::text('name_ar',$book->name_ar,['id'=>'name_ar','class'=>'form-control','required'])}}
                                @if($errors->has('name_ar'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('name_ar') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-3 mb-1">
                                <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                                {{Form::text('name_en',$book->name_en,['id'=>'name_en','class'=>'form-control'])}}
                                @if($errors->has('name_en'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('name_en') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-3 mb-1">
                                <label class="form-label" for="name_fr">{{trans('common.name_fr')}}</label>
                                {{Form::text('name_fr',$book->name_fr,['id'=>'name_fr','class'=>'form-control'])}}
                                @if($errors->has('name_fr'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('name_fr') }}</b>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12 col-sm-3 mb-1">
                                <label class="form-label" for="publisher">{{trans('common.publisher')}} <span class="text-danger">*</span></label>
                                {{Form::select('publisher_id',[''=>''] + getPublishersList(session()->get('Lang')),$book->publisher_id,['id'=>'publisher','class'=>'form-control selectpicker','data-live-search'=>'true','required'])}}
                                @if($errors->has('publisher_id'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('publisher_id') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-3 mb-1">
                                <label class="form-label" for="writer">{{trans('common.writer')}} <span class="text-danger">*</span></label>
                                {{Form::select('writer_id',getWritersList(session()->get('Lang')),$book->writer_id,['id'=>'writer','class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                            </div>
                            <div class="col-12 col-sm-3 mb-1">
                                <label class="form-label" for="Section">{{trans('common.Section')}} <span class="text-danger">*</span></label>
                                {{Form::select('section_id',getSectionsList(session()->get('Lang')),$book->section_id,['id'=>'Section','class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                            </div>
                            <div class="col-12 col-sm-2 mb-1">
                                <label class="form-label" for="language">{{trans('common.language')}}</label>
                                {{Form::select('language',[
                                                            'ar' => trans('common.lang1Name'),
                                                            'en' => trans('common.lang2Name'),
                                                            'fr' => trans('common.lang3Name')
                                                            ],$book->language,['id'=>'language','class'=>'form-control selectpicker'])}}
                            </div>
                            <div class="col-12 col-sm-2 mb-1">
                                <label class="form-label" for="country">{{trans('common.country')}}</label>
                                {{Form::select('country',getCountriesList(session()->get('Lang'),'id'),$book->country,['id'=>'country','class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                            </div>
                            <div class="col-12 col-sm-2 mb-1">
                                <label class="form-label" for="pages">{{trans('common.pages')}}</label>
                                {{Form::number('pages',$book->pages,['id'=>'pages','class'=>'form-control'])}}
                            </div>
                            <div class="col-12"></div>
                            <div class="col-12 col-md-2">
                                <label class="form-label" for="hardCopy">{{trans('common.hardCopy')}}</label>
                                <div class="form-check form-check-success form-switch">
                                    {{Form::checkbox('hardCopy','1',$book->hardCopy == '1' ? true : false,['id'=>'hardCopy', 'class'=>'form-check-input','onchange'=>'showHidePriceBoxes()'])}}
                                    <label class="form-check-label" for="hardCopy"></label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 mb-1 hard_prices" id="hard_price">
                                <label class="form-label" for="hard_price">{{trans('common.hard_price')}}</label>
                                {{Form::number('hard_price',$book->hard_price,['id'=>'hard_price','class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-sm-2 mb-1 hard_prices" id="hard_offer">
                                <label class="form-label" for="hard_offer">{{trans('common.hard_offer')}}</label>
                                {{Form::number('hard_offer',$book->hard_offer,['id'=>'hard_offer','class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-2">
                                <label class="form-label" for="pdfCopy">{{trans('common.pdfCopy')}}</label>
                                <div class="form-check form-check-success form-switch">
                                    {{Form::checkbox('pdfCopy','1',$book->pdfCopy == '1' ? true : false,['id'=>'pdfCopy', 'class'=>'form-check-input','onchange'=>'showHidePriceBoxes()'])}}
                                    <label class="form-check-label" for="pdfCopy"></label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 mb-1 pdf_prices" id="pdf_price">
                                <label class="form-label" for="pdf_price">{{trans('common.pdf_price')}}</label>
                                {{Form::number('pdf_price',$book->pdf_price,['id'=>'pdf_price','class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-sm-2 mb-1 pdf_prices" id="pdf_offer">
                                <label class="form-label" for="pdf_offer">{{trans('common.pdf_offer')}}</label>
                                {{Form::number('pdf_offer',$book->pdf_offer,['id'=>'pdf_offer','class'=>'form-control'])}}
                            </div>

                            <div class="col-12"></div>
                            <div class="col-12 col-sm-2 mb-1" id="Dimensions">
                                <label class="form-label" for="Dimensions">{{trans('common.Dimensions')}} <span class="text-danger">*</span></label>
                                {{Form::text('Dimensions',$book->Dimensions,['id'=>'Dimensions','class'=>'form-control','required'])}}
                            </div>
                            <div class="col-12 col-sm-2 mb-1" id="weight">
                                <label class="form-label" for="weight">{{trans('common.weight')}} {{trans('common.KiloGram')}} <span class="text-danger">*</span></label>
                                {{Form::number('weight',$book->weight,['step'=>'0.01','id'=>'weight','class'=>'form-control','required'])}}
                            </div>

                            <div class="col-12 col-sm-2 mb-1" id="booksNo">
                                <label class="form-label" for="booksNo">{{trans('common.booksNo')}}</label>
                                {{Form::number('booksNo',$book->booksNo,['id'=>'booksNo','class'=>'form-control'])}}
                            </div>

                            <div class="col-12 col-md-1">
                                <label class="form-label" for="available">{{trans('common.available')}}</label>
                                <div class="form-check form-check-success form-switch">
                                    {{Form::checkbox('available','1',$book->available == '1' ? true : false,['id'=>'available', 'class'=>'form-check-input'])}}
                                    <label class="form-check-label" for="available"></label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 mb-1" id="stock">
                                <label class="form-label" for="stock">{{trans('common.stock')}}</label>
                                {{Form::number('stock',$book->stock,['id'=>'stock','class'=>'form-control'])}}
                            </div>

                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="des_ar">{{trans('common.des_ar')}}</label>
                                {{Form::textarea('des_ar',$book->des_ar,['id'=>'des_ar','class'=>'form-control','rows'=>'2'])}}
                                @if($errors->has('des_ar'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('des_ar') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="des_en">{{trans('common.des_en')}}</label>
                                {{Form::textarea('des_en',$book->des_en,['id'=>'des_en','class'=>'form-control','rows'=>'2'])}}
                                @if($errors->has('des_en'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('des_en') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="des_fr">{{trans('common.des_fr')}}</label>
                                {{Form::textarea('des_fr',$book->des_fr,['id'=>'des_fr','class'=>'form-control','rows'=>'2'])}}
                                @if($errors->has('des_fr'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('des_fr') }}</b>
                                    </span>
                                @endif
                            </div>


                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="full_des_ar">{{trans('common.full_des_ar')}}</label>
                                {{Form::textarea('full_des_ar',$book->full_des_ar,['id'=>'full_des_ar','class'=>'form-control editor_ar','rows'=>'3'])}}
                                @if($errors->has('full_des_ar'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('full_des_ar') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="full_des_en">{{trans('common.full_des_en')}}</label>
                                {{Form::textarea('full_des_en',$book->full_des_en,['id'=>'full_des_en','class'=>'form-control editor_ar','rows'=>'3'])}}
                                @if($errors->has('full_des_en'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('full_des_en') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="full_des_fr">{{trans('common.full_des_fr')}}</label>
                                {{Form::textarea('full_des_fr',$book->full_des_fr,['id'=>'full_des_fr','class'=>'form-control editor_ar','rows'=>'3'])}}
                                @if($errors->has('full_des_fr'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('full_des_fr') }}</b>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="index_ar">{{trans('common.index_ar')}}</label>
                                {{Form::textarea('index_ar',$book->index_ar,['id'=>'index_ar','class'=>'form-control editor_ar','rows'=>'3'])}}
                                @if($errors->has('index_ar'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('index_ar') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="index_en">{{trans('common.index_en')}}</label>
                                {{Form::textarea('index_en',$book->index_en,['id'=>'index_en','class'=>'form-control editor_ar','rows'=>'3'])}}
                                @if($errors->has('index_en'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('index_en') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="index_fr">{{trans('common.index_fr')}}</label>
                                {{Form::textarea('index_fr',$book->index_fr,['id'=>'index_fr','class'=>'form-control editor_ar','rows'=>'3'])}}
                                @if($errors->has('index_fr'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('index_fr') }}</b>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">{{trans('common.Save changes')}}</button>
                            </div>
                        </div>
                        <!--/ form -->
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
    $( document ).ready(function() {
        showHidePriceBoxes();
    });
    function showHidePriceBoxes(){
        var hardCopy = document.getElementById('hardCopy');
        var pdfCopy = document.getElementById('pdfCopy');

        if (hardCopy.checked) {
            $(".hard_prices").fadeIn(200 ,'linear');
        } else {
            $(".hard_prices").fadeOut(200 ,'linear');
        }

        if (pdfCopy.checked) {
            $(".pdf_prices").fadeIn(200 ,'linear');
        } else {
            $(".pdf_prices").fadeOut(200 ,'linear');
        }
    }
</script>
@stop