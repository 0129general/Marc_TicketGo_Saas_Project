@extends('layouts.admin')

@section('page-title')
    {{ __('Create FAQ') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.faq') }}">{{ __('FAQ') }}</a></li>
    <li class="breadcrumb-item">{{ __('Create') }}</li>
@endsection

@php

$setting = App\Models\Utility::settings();

@endphp


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row">
                    @if (isset($setting['is_enabled']) && $setting['is_enabled'] == 'on')
                    <div class="float-end" style="margin-top: 18px;margin-left: -24px;">
                        <a class="btn btn-primary btn-sm float-end ms-2" href="#" data-size="lg" data-ajax-popup-over="true" data-url="{{ route('generate',['faq']) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Generate') }}" data-title="{{ __('Generate Content with AI') }}"><i class="fas fa-robot"> {{ __('Generate with AI') }}</i></a>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" class="needs-validation" class="needs-validation" novalidate action="{{route('admin.faq.store')}}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('Title') }}</label><x-required></x-required>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" placeholder="{{ __('Title of the Faq') }}" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" required value="{{ old('title') }}" autofocus>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('Description') }}</label><x-required></x-required>
                                <div class="col-sm-12 col-md-12">
                                    <textarea name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter Description') }}" >{{ old('description') }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label"></label>
                                <div class="col-sm-12 col-md-12 text-end">
                                    <button class="btn btn-primary btn-block btn-submit"><span>{{ __('Add') }}</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="{{ asset('js/editorplaceholder.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            // contentsLangDirection: 'rtl',
            extraPlugins: 'editorplaceholder',
            editorplaceholder: '{{__('Start Text here..')}}'
        });
    </script>
@endpush
