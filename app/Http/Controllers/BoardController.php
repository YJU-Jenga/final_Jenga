<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board; // 테이블명 지정

class BoardController extends Controller
{
// index메서드 --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function index(Request $request){ // 메인페이지, Request 클래스의 변수를 배개변수로 사용(컨트롤러로 넘어오는 Request값을 받기 위해 필요)
        $pageNum     = $request->input('page'); // view에서 넘어온 현재페이지의 파라미터 값.
        $pageNum     = (isset($pageNum)?$pageNum:1); // 페이지 번호가 없으면 1, 있다면 그대로 사용
        $startNum    = ($pageNum-1)*10; // 페이지 내 첫 게시글 번호
        $writeList   = 10; // 한 페이지당 표시될 글 갯수
        $pageNumList = 10; // 전체 페이지 중 표시될 페이지 갯수
        $pageGroup   = ceil($pageNum/$pageNumList); // 페이지 그룹 번호, ceil은 올림함수, 소수점 아래 값은 무조건 올린다
        $startPage   = (($pageGroup-1)*$pageNumList)+1; // 페이지 그룹 내 첫 페이지 번호
        $endPage     = $startPage + $pageNumList-1; // 페이지 그룹 내 마지막 페이지 번호
        $totalCount  = Board::count(); // 전체 게시글 갯수
        $totalPage   = ceil($totalCount/$writeList); // 전체 페이지 갯수

        if($endPage >= $totalPage) { // 페이지 그룹이 마지막일 때 마지막 페이지 번호, 마지막 페이지 번호가 전체 페이지 개수랑 같아지면 더 이상 표시 안 함.
        $endPage = $totalPage;
        }

        if($request->input('del')==1) { // 삭제 요청
            Board::where('id', $request->input('delId'))
            ->update(['memo'=>'삭제된글입니다.']);
        } // -> 뷰에서 삭제버튼을 클릭하면 파라미터로 1의 값이 들어오게 되는데, 1이 들어오면, 게시물의 ID가 있는 컬럼의 memo컬럼을 "삭제된 글입니다"로 수정한다

        $comments = Board::orderby('grp', 'DESC') // 테이블에서 가져온 DB 뷰에서 사용 할 수 있는 변수에 저장.
        ->orderby('sort')->skip($startNum)->take($writeList)->get();

        return view('boards.index', [ // 요청된 정보 처리 후 결과 되돌려줌, 경로를 작성할 때 \대신 .을 사용 = tasks폴더 안의 index.blade.php라는 의미
            'totalCount'=>$totalCount,
            'comments'=>$comments,
            'pageNum'=>$pageNum,
            'startPage'=>$startPage,
            'endPage'=>$endPage,
            'totalPage'=>$totalPage
            ]);
    }
// create(생성)메서드 --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create(){ // 생성, 뷰만 보여주면 됨, 값을 저장하는 것은 store에서 처리하기 때문
        return view('boards.create');
    }
// store(저장)메서드 --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
public function store(request $request)
{
    $pageNum = $request->input('page'); //댓글을 작성한 페이지로 돌아가기 위해 필요
    $mode =  $request->input('mode'); // 댓글작성인지 글작성인지 구분하기 위한 변수
    $memo = $request->input('memo');
    $creatorName = $request->input('creator_name');
    $creatorName = (isset($creatorName)?$creatorName:"익명");
    $id = $request->input('id');
    $grp = $request->input('grp');
    $sort = $request->input('sort');
    $depth =  $request->input('depth');

    if($mode==0) {
        Board::where([
            ['grp',$grp],
            ['sort','>',$sort],
        ])->increment('sort', 1);
        
        $commentPage = new Board;
        $commentPage->memo = $memo;
        $commentPage->creator_name  = $creatorName;
        $commentPage->grp = $grp; 
        $commentPage->sort = $sort+1; 
        $commentPage->depth = $depth+1;
        $commentPage->save();
    }
    else {
        $commentPage = new Board;
        $commentPage->memo = $memo;
        $commentPage->creator_name  = $creatorName;
        $commentPage->sort = 0;
        $commentPage->depth = 0;
        $commentPage->save();
        $commentPage->grp = $commentPage->id;
        $commentPage->save();
    }
    return redirect("/boards?page=$pageNum");
    }
}
