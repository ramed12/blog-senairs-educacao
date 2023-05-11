$('.youtube-video').on('click',function(){
    var url = $(this).data('youtube'); 
    var id = $(this).data('iframe'); 
    $(this).addClass('d-none');
    iframe = "<div class=\"ratio ratio-16x9\"><iframe frameborder='frameborder' width='100%' src='https://www.youtube.com/embed/"+ url +"?rel=0&showinfo=0&autoplay=0'></iframe></div>";
   $('.data-video-'+id).append( iframe ); 
});