 
$(document).ready(function(){
    
    var token = <?php echo constant('INSTA_KEY') ?>;
    var fields = 'id,media_type,media_url,thumbnail_url,timestamp,permalink,caption';
    var limit = 9; // Set a number of display items

    $.ajax ( {
        url: 'https://graph.instagram.com/me/media?fields='+ fields +'&access_token='+ token +'&limit='+ limit,
        type: 'GET',
        success: function( response ) {
            for( var x in response.data ) { 
                var link = response.data[x]['permalink'],
                    caption = response.data[x]['caption'],
                    image = response.data[x]['media_url'],
                    image_video = response.data[x]['thumbnail_url'],
                    html = '';
                if ( response.data[x]['media_type'] == 'VIDEO' ) { 
                   
                    html += '<div class="col-4 float-start">';
                    html += '<a class="insta-link" href="' + link + '" rel="noopener" target="_blank">';
                    html += '<img src="' + image_video + '" loading="lazy" alt="' + caption + '" class="img-fluid" style="object-fit: cover;width:120px;height:120px" />';
                    html += '</a>';
                    html += '</div>'; 
                } else { 
                    html += '<div class="col-4 float-start">';
                    html += '<a class="insta-link" href="' + link + '" rel="noopener" target="_blank">';
                    html += '<img src="' + image + '" loading="lazy" alt="' + caption + '" class="img-fluid"  style="object-fit: cover;width:120px;height:120px" />';
                    html += '</a>';
                    html += '</div>';
                } 
                $('#instafeed').append(html);
            }
        },
        error: function(data) { 
            var html = '<div class="class-no-data">No Images Found</div>'; 
            $('#instafeed').append(html); 
            }
    }); 
});