<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreReview;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //ログインユーザー情報取得
        $user = Auth::user();
        //areasテーブル情報取得
        $areas = Area::all();

        //検索値の取得
        $g = $request->input('g');
        $a = $request->input('a');
        $s = $request->input('s');



        //クエリの取得
        $query = DB::table('reviews');

        $query->leftJoin('users', 'reviews.user_id', '=', 'users.id');
        $query->leftJoin('areas', 'reviews.area_id', '=', 'areas.id');
        $query->select('reviews.*', 'users.name', 'users.image', 'areas.area_name');
        $query->orderBy('created_at', 'desc');

        if($g !== null) {
            //全角を半角に
            $search_split = mb_convert_kana($g, 's');
            //半角で文字を切り分けて、配列に入れる
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
            //配列をforeachでまわして、where条件を付け加える
            foreach($search_split2 as $value){
                $query->where('gelande_name', 'LIKE', '%' . $value . '%');
            }
        }
        if($a !== null) {
            $query->where('area_id', '=', $a);
        }
        if($s !== null) {
            $query->where('star', '=', $s);
        }


        $reviews = $query->get();


        return view('review.show',compact('reviews', 'user', 'areas', 'g', 'a', 's'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::get();
        $user = Auth::user();

        return view('review.create', compact('areas','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReview $request)
    {
        $review = new Review;

        $review->gelande_name = $request->input('gelande_name');
        $review->title = $request->input('title');
        $review->star = $request->input('star');
        $review->comment = $request->input('comment');
        $review->user_id = $request->input('user_id');
        $review->area_id = $request->input('area_id');

        $review->save();


        return redirect('review/')->with('flash_message','投稿しました');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //ログインユーザー情報取得
        $user = Auth::user();
        //areasテーブル情報取得
        $areas = Area::all();

        $review = Review::find($id);

        return view('review.edit', compact('review', 'user', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReview $request, $id)
    {
        $review = Review::find($id);

        $review->gelande_name = $request->input('gelande_name');
        $review->title = $request->input('title');
        $review->star = $request->input('star');
        $review->comment = $request->input('comment');
        $review->user_id = $request->input('user_id');
        $review->area_id = $request->input('area_id');

        $review->save();


        return redirect('review/')->with('flash_message', '編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);

        $review->delete();

        return redirect('review/')->with('flash_message', '削除しました');
    }
}
