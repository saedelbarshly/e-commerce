<!-- form -->
<div class="row">
    <div class="divider">
        <div class="divider-text">{{trans('common.products')}}</div>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
        {{Form::text('name_ar','',['id'=>'name_ar','class'=>'form-control' , 'required'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
        {{Form::text('name_en','',['id'=>'name_en','class'=>'form-control' , 'required'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="description_ar">{{trans('common.description_ar')}}</label>
        {{Form::textarea('description_ar','',['rows'=>'3','id'=>'description_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="description_en">{{trans('common.description_en')}}</label>
        {{Form::textarea('description_en','',['rows'=>'3','id'=>'description_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="metadata_ar">{{trans('common.metadata_ar')}}</label>
        {{Form::textarea('metadata_ar','',['rows'=>'3','id'=>'metadata_ar','class'=>'form-control', 'required'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="metadata_en">{{trans('common.metadata_en')}}</label>
        {{Form::textarea('metadata_en','',['rows'=>'3','id'=>'metadata_en','class'=>'form-control', 'required'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="keywords_ar">{{trans('common.keywords_ar')}}</label>
        {{Form::textarea('keywords_ar','',['rows'=>'3','id'=>'keywords_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="keywords_en">{{trans('common.keywords_en')}}</label>
        {{Form::textarea('keywords_en','',['rows'=>'3','id'=>'keywords_en','class'=>'form-control'])}}
    </div>
</div>
<!--/ form -->
