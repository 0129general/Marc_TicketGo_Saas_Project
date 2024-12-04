@extends('layouts.admin')

@section('page-title')
    {{ __('Edit Knowledge') }} ({{ $knowledge->title }})
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.knowledge') }}">{{ __('Knowledge') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit') }}</li>
@endsection
@php
$setting = App\Models\Utility::settings();
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                        @if (isset($setting['is_enabled']) && $setting['is_enabled'] == 'on')
                        <div class="float-end" style="margin-top: 18px;">
                            <a class="btn btn-primary btn-sm float-end ms-2" href="#" data-size="lg" data-ajax-popup-over="true" data-url="{{ route('generate',['knowledge']) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Generate') }}" data-title="{{ __('Generate Content with AI') }}"><i class="fas fa-robot"> {{ __('Generate with AI') }}</i></a>
                        </div>
                        @endif
                    </div>
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.knowledge.update', $knowledge->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('Title') }}</label><x-required></x-required>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" placeholder="{{ __('Title of the Knowledge') }}" name="title"
                                        class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        value="{{ $knowledge->title }}" required autofocus>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('Category') }}</label>
                                <div class="col-sm-12 col-md-12">
                                    <select class="form-select" name="category">
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="form-group col-md-6">
                                <label class="form-label">{{ __('Description') }}</label>
                                <div class="col-sm-12 col-md-12">
                                    <textarea name="description"
                                        class="form-control summernote-simple {{ $errors->has('description') ? ' is-invalid' : '' }}">{!! $knowledge->description !!}</textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group col-md-12">
                                <label class="require form-label">{{ __('Description') }}</label>
                                <textarea name="description" id="description" class="form-control summernote-simple {{(!empty($errors->first('description')) ? 'is-invalid' : '')}}">{!! $knowledge->description !!}</textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label"></label>
                                <div class="col-sm-12 col-md-12 text-end">
                                    <button
                                        class="btn btn-primary btn-block btn-submit"><span>{{ __('Update') }}</span></button>
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
    {{-- <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="{{ asset('js/editorplaceholder.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            // contentsLangDirection: 'rtl',
            extraPlugins: 'editorplaceholder',
            editorplaceholder: '{{ __('Start Text here..') }}'
        });
    </script> --}}
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
    <script>
        if ($(".summernote-simple").length > 0) {
            $('.summernote-simple').summernote({
                dialogsInBody: !0,
                minHeight: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['list', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'unlink']],
                ],
                height: 250,
            });
        }
    </script>
@endpush
@push('css-page')
<link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
@endpush
