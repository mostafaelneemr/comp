@extends('layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Start Pages') }}</h5>
    </div>

    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Start Pages') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('startPages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Image') }}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" value="{{ $page->image }}" name="image" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="title_en">{{ translate('Title English') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Title English') }}" id="title_en" name="title_en"
                                class="form-control" value="{{ $page->title_en }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="title_ar">{{ translate('Title Arabic') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Title Arabic') }}" id="title_ar" name="title_ar"
                                class="form-control" value="{{ $page->title_ar }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label"
                            for="sub_title_en">{{ translate('Sub Title English') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Sub Title English') }}" id="sub_title_en"
                                name="sub_title_en" value="{{ $page->sub_title_en }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label"
                            for="sub_title_ar">{{ translate('Sub Title Arabic') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Sub Title Arabic') }}" id="sub_title_ar"
                                name="sub_title_ar" value="{{ $page->sub_title_ar }}" class="form-control" required>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" name="button" value="save"
                                    class="btn btn-warning">{{ translate('Save') }}</button>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="Third group">
                                <button type="submit" name="button" value="update"
                                    class="btn btn-primary">{{ translate('Update') }}</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
