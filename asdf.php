<script>
var page = 1; //페이지 변수를 1로 초기화

var searchKey = ''; //검색기능을 위해 검색 변수 초기화



$.ajax({
    type: 'POST',
    url: "controller.php",
    dataType: "json",
    data: {
        'page': page,
        'searchKeyword': searchKey
    },
    success: function(result) {

        respone = result.lists; //반환값중 데이터목록을 response변수에 삽입
        paging = result.paging; //페이징관련 데이터들을 paging변수에 삽입

        // $("#").empty(); //데이터가 삽입될 객체를 비워준다. (들어가있던 전데이터들을 지워주기위해)

        if (respone.length == 0) { //가져온 데이터가 없으면 목록이 없다는 문구를 삽입.

            $("#list").append("<td colspan=20 style='padding:30px;'>데이터가 없습니다.</td>");

        } else { //데이터가있으면 목록을 each로 반복

            _.each(respone, function(item) {

                var contentHtml = _.template($('데이터가 삽입될 템플릿').html(), item); //언더스코어를 이용 템플릿을 제작

                $("#list").append(contentHtml);

            });

        }

        //이부분이 페이징처리

        $(".pagination").empty(); //페이징에 필요한 객체내부를 비워준다.



        if (paging.page != 1) { // 페이지가 1페이지 가아니면

            $(".pagination").append("<li class=\"goFirstPage\"><a><<</a></li>"); //첫페이지로가는버튼 활성화

        } else {

            $(".pagination").append("<li class=\"disabled\"><a><<</a></li>"); //첫페이지로가는버튼 비활성화

        }



        if (paging.block != 1) { //첫번째 블럭이 아니면

            $(".pagination").append("<li class=\"goBackPage\"><a><</a></li>"); //뒤로가기버튼 활성화

        } else {

            $(".pagination").append("<li class=\"disabled\"><a><</a></li>"); //뒤로가기버튼 비활성화

        }



        for (var i = paging.startPage; i <= paging.endPage; i++) { //시작페이지부터 종료페이지까지 반복문

            if (paging.page == i) { //현재페이지가 반복중인 페이지와 같다면

                $(".pagination").append("<li class=\"disabled active\"><a>" + i + "</a></li>"); //버튼 비활성화

            } else {

                $(".pagination").append("<li class=\"goPage\" data-page=\"" + i + "\"><a>" + i +
                    "</a></li>"); //버튼 활성화

            }

        }



        if (paging.block < paging.totalBlock) { //전체페이지블럭수가 현재블럭수보다 작을때

            $(".pagination").append("<li class=\"goNextPage\"><a>></a></li>"); //다음페이지버튼 활성화

        } else {

            $(".pagination").append("<li class=\"disabled\"><a>></a></li>"); //다음페이지버튼 비활성화

        }



        if (paging.page < paging.totalPage) { //현재페이지가 전체페이지보다 작을때

            $(".pagination").append("<li class=\"goLastPage\"><a>>></a></li>"); //마지막페이지로 가기 버튼 활성화

        } else {

            $(".pagination").append("<li class=\"disabled\"><a>>></a></li>"); //마지막페이지로 가기 버튼 비활성화

        }



        //첫번째 페이지로 가기 버튼 이벤트

        $(".goFirstPage").click(function() {

            page = 1;

            pageFlag = 1;

            $("상단 ajax를 함수로 만들어 재귀호출");

            pageFlag = 0;

        });



        //뒷페이지로 가기 버튼 이벤트

        $(".goBackPage").click(function() {

            page = Number(paging.startPage) - 1;

            pageFlag = 1;

            $("상단 ajax를 함수로 만들어 재귀호출");

            pageFlag = 0;

        });



        //클릭된 페이지로 가기 이벤트

        $(".goPage").click(function() {

            page = $(this).attr("data-page");

            pageFlag = 1;

            $("상단 ajax를 함수로 만들어 재귀호출");

            pageFlag = 0;

        });



        //다음페이지로 가기 클릭이벤트

        $(".goNextPage").click(function() {

            page = Number(paging.endPage) + 1;

            pageFlag = 1;

            $("상단 ajax를 함수로 만들어 재귀호출");

            pageFlag = 0;

        });



        //마지막페이지로 가기 클릭이벤트

        $(".goLastPage").click(function() {

            page = paging.totalPage;

            pageFlag = 1;

            $("상단 ajax를 함수로 만들어 재귀호출");

            pageFlag = 0;

        });

    }

});
</script>

$result['paging'] = array(

'startPage' => $startPage,                //시작페이지

'endPage' => $endPage,                 //종료페이지

'totalBlock' => $totalBlock,              //전체 페이지 블럭 갯수

'totalPage' => $totalPage,                // 전체 페이지 갯수

'blockPageNum' => $blockPageNum,    //한페이지에 나올 블럭갯수

'rowsByPage' => $rowsByPage,           //한페이지에 나올 리스트갯수

'totalCount' => $totalCount,            //전체 리스트갯수

'block' => $block,                        //현재 페이지가 어느 블럭에 포함되어있는지

'page' => $page                            //현재 페이지

);