@extends('layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Attribute Information')}}</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Attribute Information')}}</h5>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('attributes.update', $attribute->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name_en">{{translate('Name English')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name English')}}" value="{{ $attribute->name_en }}" id="name_en" name="name_en" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name_ar">{{translate('Name Arabic')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name Arabic')}}" value="{{ $attribute->name_ar }}" id="name_ar" name="name_ar" class="form-control" required>
                    </div>
                </div>

                <div class="col-12">
                    <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="submit" name="button" value="save" class="btn btn-warning">{{ translate('Save') }}</button>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="Third group">
                            <button type="submit" name="button" value="update" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                       
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection




