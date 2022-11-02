$(function () {
    let like = $(".like-toggle"); //like-toggleのついたiタグを取得し代入。
    let likeReviewId; //変数を宣言（なんでここで？）
    like.on("click", function () {
        //onはイベントハンドラー
        console.log("click");
        let $this = $(this); //this=イベントの発火した要素＝iタグを代入
        likeReviewId = $this.data("review-id"); //iタグに仕込んだdata-review-idの値を取得
        console.log(likeReviewId);
        //ajax処理スタート
        $.ajax({
            headers: {
                //HTTPヘッダ情報をヘッダ名と値のマップで記述
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }, //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
            url: "/nice", //通信先アドレスで、このURLをあとでルートで設定します
            method: "post", //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
            data: {
                //サーバーに送信するデータ
                review_id: likeReviewId, //いいねされた投稿のidを送る
            },
        })
            //通信成功した時の処理
            .done(function (data) {
                console.log("成功");
                console.log(data.review_likes_count);
                $this.toggleClass("like-toggle"); //likedクラスのON/OFF切り替え。
                $this.toggleClass("btn-success"); //likedクラスのON/OFF切り替え。
                // $this.toggleClass("unnice"); //likedクラスのON/OFF切り替え。
                $this.next(".like-counter").html(data.review_likes_count);
            })
            //通信失敗した時の処理
            .fail(function () {
                console.log("fail");
            });
    });
});
// $(function () {
//     let like = $(".unnice"); //like-toggleのついたiタグを取得し代入。
//     let likeReviewId; //変数を宣言（なんでここで？）
//     like.on("click", function () {
//         //onはイベントハンドラー
//         console.log("click");
//         let $this = $(this); //this=イベントの発火した要素＝iタグを代入
//         likeReviewId = $this.data("review-id"); //iタグに仕込んだdata-review-idの値を取得
//         console.log(likeReviewId);
//         //ajax処理スタート
//         $.ajax({
//             headers: {
//                 //HTTPヘッダ情報をヘッダ名と値のマップで記述
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             }, //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
//             url: "/unnice", //通信先アドレスで、このURLをあとでルートで設定します
//             method: "post", //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
//             data: {
//                 //サーバーに送信するデータ
//                 review_id: likeReviewId, //いいねされた投稿のidを送る
//             },
//         })
//             //通信成功した時の処理
//             .done(function (data) {
//                 console.log("成功");
//                 console.log(data.review_likes_count);
//                 $this.removeClass("btn-success"); //likedクラスのON/OFF切り替え。
//                 $this.toggleClass("btn-secondary"); //likedクラスのON/OFF切り替え。
//                 $this.next(".like-counter").html(data.review_likes_count);
//                 // $this.next(".like-counter").html(data.review_likes_count);
//             })
//             //通信失敗した時の処理
//             .fail(function () {
//                 console.log("fail");
//             });
//     });
// });
