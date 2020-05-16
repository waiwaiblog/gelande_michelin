
@if(app('env')=='local')
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">


@endif
@if(app('env')=='production')
    <link rel="stylesheet" href="{{ secure_asset('/css/styles.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
@endif

@extends('../layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('レビュー一覧') }}</div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('review.index') }}">
                            <div class="form-row justify-content-center">
                                <div class="col-md-4 mb-3">
                                    <label class="mr-sm-2 sr-only" for="a">AreaSearch</label>
                                    <select class="custom-select mr-sm-2" id="a" name="a">
                                        <option value="">エリア検索</option>
                                        @foreach($areas as $area)
                                        <option value="{{ $area->id }}" @if($a == $area->id) selected @endif>{{ $area->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mr-sm-2 sr-only" for="s">StarSearch</label>
                                    <select class="custom-select mr-sm-2" id="s" name="s">
                                        <option value="">星の数</option>
                                        @for($i=5; $i>=1; $i--)
                                            <option value="{{ $i }}" @if($s == $i) selected @endif>★ x {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="col-md-8 mb-3">
                                    <label class="mr-sm-2 sr-only" for="g">ゲレンデ名検索</label>
                                    <input name="g" class="form-control mr-sm-2" id="g" type="search" placeholder="ゲレンデ名検索" aria-label="Search" value="{{ $g }}">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="mr-sm-2 sr-only" for="search">検索</label>
                                    <button class="btn btn-info btn-block mr-sm-2" id="search" type="submit">検索</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    @foreach($reviews as $review)
                    <div class="gelande-card">
                        <aside>
                            @if($review->image == null)
                                <img src="img/noimage.jpeg" class="button">
                            @else
                                <img src="/storage/profile_images/{{ $review->image }}" class="button" style="object-fit: cover">
                            @endif
                        </aside>
                        <article>
                            <h2>{{ $review->title }}</h2>
                            <h3>{{ $review->gelande_name }}</h3>
                            <ul>
                                <li><i class="i fas fa-mountain" style="color:cornflowerblue"></i><span>{{ $review->area_name }}</span></li>
                                <li>
                                    @for($i=1; $i<=$review->star; $i++)
                                        <i class="fas fa-star" style="color:gold"></i>
                                    @endfor
                                </li>
                                <li><i class="i fas fa-pen"></i><span>{{ date('Y/n/j', strtotime($review->created_at)) }}</span></li>
                            </ul>
                            <p>{{ $review->comment }}</p>
                            <p class="gelande">by {{ $review->name }}
                                @if($review->user_id == $user->id)
                                <a href="{{ route('review.edit',[ 'id' => $review->id ]) }}"><i class="i fas fa-edit"></i></a></p>
                                @endif
                        </article>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection
