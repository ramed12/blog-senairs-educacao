$(document).ready(function(){
    var ppp =  3; // Post per page
    var pageNumber = 1;
    var ajax_posts = $('#more_posts').data('admin-url');
    var post_not_in = $('#more_posts').data('not-in-posts');    

    
    var ppp_cat_princ = 3; // Post per page
    var pageNumber_cat_princ = 1;
    var ajax_posts_cat = $('#more_posts_category_princ').data('admin-url-cat');
    var post_not_in_cat_princ = $('#more_posts_category_princ').data('not-in-posts-cat');
    var category = $('#more_posts_category_princ').data('category');
    
    var ppp_other = 3; // Post per page
    var pageNumber_other = 1;
    var ajax_posts_toher = $('#more_posts_other').data('admin-url-other');
    var post_not_in_other = $('#more_posts_other').data('not-in-posts-other'); 


function load_posts(){  
    pageNumber++;
    var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&not_in='+ post_not_in +'&action=more_post_ajax'; 
  
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts,
        data: str,
        success: function(data){
            var $data = $(data);
            if($data.length){
                $("#ajax-posts").append($data);
                $("#more_posts").attr("disabled",false);
            } else{
                $("#more_posts").attr("disabled",true);
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

    $("#more_posts").on("click",function(){ // When btn is pressed.
        $("#more_posts").attr("disabled",true); // Disable the button, temp.
        load_posts();
    });

function load_posts_cat_princ(){  
    pageNumber_cat_princ++;
    
    var str = '&pageNumber=' + pageNumber_cat_princ + '&ppp=' + ppp_cat_princ + '&not_in='+ post_not_in_cat_princ +'&cat='+ category +'&action=more_post_ajax_cat'; 
  console.log(category);
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts_cat,
        data: str,
        success: function(data){
            var $data = $(data);
            console.log($data.length);
            if($data.length){
                $("#ajax-posts-cat").append($data);
                $("#more_posts_category_princ").attr("disabled",false);
            } else{
                $("#more_posts_category_princ").unbind("click");
                $("#more_posts_category_princ").attr("disabled",true);
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

    $("#more_posts_category_princ").on("click",function(){ // When btn is pressed.
	    $("#more_posts_category_princ").attr("disabled",true); // Disable the button, temp.
        load_posts_cat_princ();
    });
 
function load_posts_cat_other(){  
    pageNumber_other++;
    var str = '&pageNumber=' + pageNumber_other + '&ppp=' + ppp_other + '&not_in='+ post_not_in_other +'&action=more_post_ajax_other'; 
  
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts_toher,
        data: str,
        success: function(data){
            var $data = $(data);
            if($data.length){
                $("#ajax-posts-other").append($data);
                $("#more_posts_other").attr("disabled",false);
            } else{
                $("#more_posts_other").attr("disabled",true);
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

    $("#more_posts_other").on("click",function(){ // When btn is pressed.
        $("#more_posts_other").attr("disabled",true); // Disable the button, temp.
        load_posts_cat_other();
    });
});
