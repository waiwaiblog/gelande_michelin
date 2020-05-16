
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
                    <div class="card-header">{{ __('プロフィール編集') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ニックネーム') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $authUser->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="inputFile" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>
                                    <div class="input-group col-md-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputFile" name="image">
                                            <label class="custom-file-label" for="inputFile" data-browse="参照">選択かドロップ</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary input-group-text" id="inputFileReset">取消</button>
                                        </div>
                                    </div>
                                </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-6 prof-img">
                                    @if($authUser->image !== null)
                                        <img src="/storage/profile_images/{{ $authUser->image }}" class="button" style="object-fit: cover">
                                    @else
                                        <img src="../img/noimage.jpeg" class="button">
                                    @endif

                                </div>
                            </div>
                            <div class="form-group row mb-0 mt-4">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-info btn-block">
                                        {{ __('ニックネームと画像を変更する') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div style="border:1px dotted lightgray"></div>


                        <form method="POST" action="{{ route('user.sendChangeEmailLink') }}">
                            @csrf
                            <div class="form-group row mt-3">
                                <div class="col-md-4 col-form-label text-md-right">登録アドレス</div>
                                <div class="col-md-6 col-form-label"><strong>{{ $authUser->email }}</strong></div>
                            </div>
                            <div class="form-group row">
                                <label for="new_email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="new_email" type="email" class="form-control @error('new_email') is-invalid @enderror" name="new_email" required autocomplete="new_email" autofocus>

                                    @error('new_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-4">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-info btn-block">
                                        {{ __('メールアドレスを変更する') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div style="border:1px dotted lightgray"></div>

                        <form method="POST" action="{{ route('user.changePassword') }}">
                            @csrf

                            <div class="form-group row mt-3">
                                <label for="current-password" class="col-md-4 col-form-label text-md-right">{{ __('現在のパスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" required autocomplete="current-password" autofocus>
                                    @error('current-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ __('新しいパスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" required autocomplete="new-password" autofocus>
                                    @error('new-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('新しいパスワード(確認)') }}</label>

                                <div class="col-md-6">
                                    <input id="new-password_confirmation" type="password" class="form-control @error('new-password_confirmation') is-invalid @enderror" name="new-password_confirmation" required autocomplete="new-password_confirmation" autofocus>
                                    @error('new-password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 mt-4">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-info btn-block">
                                        {{ __('パスワードを変更する') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script>
        bsCustomFileInput.init();

        document.getElementById('inputFileReset').addEventListener('click', function() {

            bsCustomFileInput.destroy();

            var elem = document.getElementById('inputFile');
            elem.value = '';
            var clone = elem.cloneNode(false);
            elem.parentNode.replaceChild(clone, elem);

            bsCustomFileInput.init();

        });
    </script>
@endsection
