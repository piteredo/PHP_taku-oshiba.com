//IFrame Player API の読み込み
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

$(function() {      
  $('.slider').slick({
    slidesToShow: 2,
      autoplay: false,
      arrows: true,
      centerMode: true,
      speed: 500,
      touchThreshold: 14,
      initialSlide: 1,
      prevArrow:'<div class="prev"><i class="fas fa-angle-left"></i></div>',
      nextArrow:'<div class="next"><i class="fas fa-angle-right"></i></div>',
      responsive: [{
        breakpoint: 599,
        settings: {
          slidesToShow: 1,
          initialSlide: 0,
          touchThreshold: 7,
      }
    }]
  });
  
  $('.modal').modaal({
    type: "image"
  });

  $(function() {
     $('img.lazy').lazyload(/*{
       distance: 1270
     }*/);
   });

  $('iframe').each(function(i){
    let url = $(this).attr('src');       
    if(url.indexOf("www.youtube.com")){         
      let id = url.replace("https://www.youtube.com/embed/","").replace("?rel=0","");         
      $(this).wrap('<div class="youtube_thumb" data-id="'+id+'"><i class="far fa-play-circle"></i><img src="https://i.ytimg.com/vi/'+id+'/maxresdefault.jpg"></div>');         
      $(this).remove();
    }
   
    $('.youtube_thumb').click(function(e){         
      let youtubeId = $(this).attr("data-id");         
      var ytPlayer = new YT.Player(
        e.target, // 埋め込む場所の指定
        {
          width: 560,
          height: 315,
          videoId: youtubeId, // YouTubeのID
          events: {
            'onReady': onPlayerReady
          },
          playerVars: {
            rel: 0, // 再生終了後に関連動画を表示するかどうか設定
          }
        }
      );
      $(this).children(".fa-play-circle").hide();
    });
  });
});

function onPlayerReady(event) {
  event.target.playVideo();
}