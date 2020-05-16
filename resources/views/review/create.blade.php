@if(app('env')=='local')
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">


@endif
@if(app('env')=='production')
    <link rel="stylesheet" href="{{ secure_asset('/css/styles.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
@endif

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('レビュー投稿') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('review.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="gelande_name" class="col-md-4 col-form-label text-md-right">{{ __('ゲレンデ名') }}</label>

                                <div class="col-md-6">
                                    <input id="gelande_name" type="text" class="form-control @error('gelande_name') is-invalid @enderror" name="gelande_name" value="{{ old('gelande_name') }}" required autocomplete="gelande_name" autofocus>

                                    @error('gelande_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('タイトル') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="area_id" class="col-md-4 col-form-label text-md-right">{{ __('エリア') }}</label>

                                <div class="col-md-6">
                                    <label class="mr-sm-2 sr-only" for="area_id">Preference</label>
                                    <select class="custom-select mr-sm-2 @error('area_id') is-invalid @enderror" id="area_id" name="area_id">
                                        <option hidden>選択してください</option>
                                        @foreach($areas as $area)
                                                <option value="{{ $area->id }}" @if(old('area_id') == $area->id) selected @endif>{{ $area->area_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="star" class="col-md-4 col-form-label text-md-right">{{ __('星') }}</label>

                                <div class="col-md-6">
                                    <label class="mr-sm-2 sr-only" for="star">Preference</label>
                                    <select class="custom-select mr-sm-2 @error('star') is-invalid @enderror" id="star" name="star">
                                        <option hidden>選択してください</option>
                                        @for($i=5; $i>=1; $i--)
                                        <option value="{{ $i }}" @if(old('star') == $i) selected @endif>★ x {{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('star')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('内容') }}</label>

                                <div class="col-md-6">
                                    <textarea rows="9" id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment">{{ old('comment') }}</textarea>
                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mt-4">
                                <div class="col-md-8 offset-md-2">
                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                    <button type="submit" class="btn btn-info btn-block">
                                        {{ __('投稿する') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
