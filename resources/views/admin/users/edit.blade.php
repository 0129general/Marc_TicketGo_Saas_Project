@extends('layouts.admin')

@section('page-title')
    {{ __('Edit Profile') }} ({{ $user->name }})
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">{{ __('Users') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit') }}</li>
@endsection
@php
    $logos = \App\Models\Utility::get_file('public/');
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('admin.users.update',$user->id)}}" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('Name') }}</label><x-required></x-required>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" placeholder="{{ __('Full name of the user') }}" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required value="{{ $user->name }}" autofocus>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">{{ __('Email') }}</label><x-required></x-required>
                                <div class="col-sm-12 col-md-12">
                                    <input type="email" placeholder="{{ __('Email address (should be unique)') }}" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required value="{{ $user->email }}">

                                </div>
                            </div>
                        </div>


                        @if (\Auth::user()->id != $user->id || \Auth::user()->parent == 1)
                        <div class="col-12 form-group">
                            {{ Form::label('categories', __('Category'), ['class' => 'col-form-label']) }}<x-required></x-required>
                            {{ Form::select('categories[]', $categories, $category_list, ['class' => 'form-control multi-select', 'id' => 'choices-multiple', 'multiple' => true]) }}
                        </div>

                        {{--------------------------------------------------------------------------------------------}}

                        <div class="col-12 form-group">

                            {{ Form::label('subcategories', __('Sub Category'),['class'=>'col-form-label']) }}<x-required></x-required>
                             
                            {{ Form::select('subcategories[]', $subcategories, $subcategory_list, ['class' => 'form-control multi-select', 'id' => 'choices-multiple1', 'multiple' => true]) }}

                        </div>

                        {{-- ---------------------------------------------------------------------------------------- --}}


                        @endif

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-label">{{ __('Picture') }}</label>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group col-lg-12 col-md-12">
                                        {{-- <small class="form-label mb-2 d-block">{{ __('Please upload a valid image file. Size of image should not be more than 2MB.') }}</small> --}}
                                        <div class="choose-file form-group">
                                            <label for="file" class="form-label">
                                                <div>{{ __('Choose File Here') }}</div>
                                                {{-- <input type="file" class="form-control {{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar" id="file" data-filename="avatar_selection"> --}}

                                                <input type="file" name="avatar" id="file" class="form-control {{ $errors->has('avatar') ? ' is-invalid' : '' }}" data-filename="avatar_selection" onchange="document.getElementById('blah3').src = window.URL.createObjectURL(this.files[0])">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('avatar') }}
                                                </div>
                                            </label>
                                            <p class="avatar_selection"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label"></label>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group col-lg-12 col-md-12">
                                        <div class="user-main-image">
                                            <a href="{{(!empty($user->avatar))? ($logos.$user->avatar): $logos."/avatar.png"}}" target="_blank">
                                                <img src="{{(!empty($user->avatar))? ($logos.$user->avatar): $logos."/avatar.png"}}" class="img-fluid rounded-circle card-avatar" width="35" id="blah3">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label"></label>
                                <div class="col-sm-12 col-md-12 text-end">
                                    <button class="btn btn-primary btn-block btn-submit"><span>{{ __('Update') }}</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
