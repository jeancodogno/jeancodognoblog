function load_post(first = false){
    isLoading = true;
    var data = {
        'action': 'load_post',
        'id_post': id_post,
        'security': security_key
    };

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url_load_post,
        data: data
    }).done(function(json, statusText, xhr){
        if(json.status_code === 200) {
            var v = json.data;
            $('#post').removeClass('d-none');
            $('#post').find('.post-title').html(v.title);
            $('#post').find('.post-content').html(v.content);
            $('#post').find('.link-category').html(v.category);
            $('#post').find('.post-time').attr('datetime', v.time).html(v.date);
            $('#post').find('.post-ncomments').html(v.ncomments);
            $('#post').find('.post-link').attr('href',v.link);
            if(v.has_thumb){
                var img = $('<img width="100%">').addClass('border-radius').attr('src', v.thumb);
                $('#post').find('.post-link-image').html(img);
            }else
            $('#post').find('.post-link-image').remove();

            var data = {
                'action': 'load_comments',
                'id': id_post,
                'security': security_key
            };
        
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: url_load_post,
                data: data
            }).done(function(json, statusText, xhr){
                
            });
        } else {
            
        }
        $('#loading-posts').addClass('d-none');
        $('#post').removeClass('d-none');
    });
}

$(document).ready(function(){
    load_post(true);
})