
var page = 1;
var last_el = null;
var isLoading = false;

function load_posts(first = false){
    isLoading = true;
    var data = {
        'action': 'load_posts',
        'page': page,
        'security': security_key
    };

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url_load_posts,
        data: data
    }).done(function(json, statusText, xhr){
       
        if(json.status_code === 200) {
            $.each(json.data, function(k, v){
                var default_post = $('#default-post').clone();
                default_post.attr('id', 'post'+v.id);
                default_post.removeClass('d-none');
                default_post.find('.post-title').html(v.title);
                default_post.find('.post-excerpt').html(v.excerpt);
                default_post.find('.link-category').html(v.category);
                default_post.find('.link-category').attr('href', v.category_link);
                default_post.find('.post-time').attr('datetime', v.time).html(v.date);
                default_post.find('.post-ncomments').html(v.ncomments);
                default_post.find('.post-link').attr('href',v.link);
                if(v.has_thumb){
                    var img = $('<img width="100%">').addClass('border-radius').attr('src', v.thumb).attr('alt', v.title);
                    default_post.find('.post-link-image').html(img);
                }else
                    default_post.find('.post-link-image').remove();
                    
                last_el = default_post;
                $('#posts').append(default_post);
            });
            isLoading = false;
            page++;
            
        } else {
            if(first)
                $('#posts').append("Nenhum post encontrado.");
        }
        $('#loading-posts').addClass('d-none');
        $('#posts').removeClass('d-none');
    });
}

$(document).ready(function(){
    // load_posts(true);

    $(document).on("scroll",function(){
        if(last_el != null && isLoading == false){
            if(window.scrollY >= last_el[0].offsetTop - 100){
                load_posts();
            }
        }
    });
})