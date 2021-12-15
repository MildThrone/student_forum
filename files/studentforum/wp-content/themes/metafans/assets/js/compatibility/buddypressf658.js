/**
 * 
 * Tophive Responsive Menu Jquery plugin
 * @author Tophive
 * @version 1.0.0
 * 
 */
jQuery(document).ready(function () { 
    
    //we reconstruct menu on window.resize
    jQuery(window).on("resize", function (e) {                                                 
        var parentWidth = jQuery("#nav-bar-filter").parent().width() - 100;
        console.log(parentWidth);
        var ulWidth = jQuery("#more-nav").outerWidth();                  
        var menuLi = jQuery("#nav-bar-filter > li");                 
        var liForMoving = new Array();      
        //take all elements that can't fit parent width to array
        menuLi.each(function () {                       
            ulWidth += jQuery(this).outerWidth(); 
            console.log(ulWidth);
            if (ulWidth > parentWidth) {
                liForMoving.push(jQuery(this));
            }
        });                         
        if (liForMoving.length > 0) {   //if have any in array -> move em to "more" ul
            e.preventDefault();                     
            liForMoving.forEach(function (item) {
                item.clone().appendTo(".subfilter");
                item.remove();
            });                         
        }
        else if (ulWidth < parentWidth) { //check if we can put some 'li' back to menu
            liForMoving = new Array();
            var moved = jQuery(".subfilter > li");
            for (var i = moved.length - 1; i >= 0; i--) { //reverse order
                var tmpLi = jQuery(moved[i]).clone();
                tmpLi.appendTo(jQuery("#nav-bar-filter"));
                ulWidth += jQuery(moved[i]).outerWidth();
                if (ulWidth < parentWidth) {                                
                    jQuery(moved[i]).remove();
                }
                else {
                    ulWidth -= jQuery(moved[i]).outerWidth();
                    tmpLi.remove();
                }                           
            }                       
        }                       
        if (jQuery(".subfilter > li").length > 0) { //if we have elements in extended menu - show it
            jQuery("#more-nav").show();
        }
        else {
            jQuery("#more-nav").hide();
        }
    });

    jQuery(window).trigger("resize"); //call resize handler to build menu right

    jQuery(document).on('click', '#more-nav > li > a', function( e ){
        e.preventDefault();
        jQuery(this).parent().toggleClass('more-nav-open');
    });

    if( jQuery('#th_bbp_reply').length ){
        var quillEditor = new Quill('#th_bbp_reply', {
          modules: {
            toolbar: [
              [{ header: [1, 2, 3, 4, false] }],
              ['bold', 'italic', 'underline'],
              ['link', 'blockquote', 'code-block', 'image'],
              [{ list: 'ordered' }, { list: 'bullet' }]
            ]
          },
          placeholder: 'Your topic description...',
          theme: 'snow'  // or 'bubble'
        });
    }
    jQuery( document ).on( 'click', '#th_bbp_reply_submit', function(e){
        e.preventDefault();
        var that = jQuery(this);
        that.text('Please Wait...');
        that.attr('disabled', true);
        var data = jQuery('.th-bbpress-reply-form').serializeArray();
        var text = quillEditor.root.innerHTML;
        data[data.length] = { name: "bbp_reply_content", value: text };
        var newData = {};
        data.filter( function( item ) {
           newData[item.name] = item.value;
        });

        console.log(newData);
        jQuery.ajax({
            url: Tophive_JS.ajaxurl,
            type: 'POST',
            data: {
                'action' : 'th_bbp_new_reply',
                'data' : newData
            },
            success : function( res ){
                console.log(res);
                if( res.errors ){
                    jQuery('.th_bpp_reply_messages').html( '<span class="errors">' + res.errors.toString() + '</span>' );
                    that.attr('disabled', false);
                }else{
                    jQuery('.th_bpp_reply_messages').html( '<span class="success">' + res.success['text'] + '</span>' );
                    window.location.href = res.success['goto'];
                }
                that.text('Submit');
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    });

    jQuery(document).on('click', '.activity-inner a:not(.media-popup-thumbnail)', function(e){
        e.preventDefault();
        var url = jQuery(this).attr('href');
        window.open(url);
    });

    jQuery('#bold_btn').on('click', function() {
      //jQuery('#textarea, #textarea-show').toggleClass('bold');
        document.execCommand('bold');
    });
    jQuery('#italic_btn').on('click', function() {
        //jQuery('#textarea, #textarea-show').toggleClass('italic');
        document.execCommand('italic');
    });
    jQuery('#whats-new-avatar').on('click', function(){
        jQuery('#whats-new-attachments').hide(0, function(){
            jQuery('#whats-new-content').show(0, function(){
                jQuery('#whats-new-attachments').show();
            });
        });
        
        jQuery('.whats-new-header-media-section').hide(0);
        jQuery('.advanced-th-bp-activity-form').focus();
        jQuery('.whats-new-intro-header').css({ 'font-size': '21px', 'font-weight' : '400' });
        jQuery('.whats-new-intro-header').hide();
    });
    jQuery(document).mouseup(function(e) 
    {
        var container = jQuery("#whats-new-form");
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            if( !jQuery('.whats-new-previewer').has('.media-uploading') ){
                jQuery('#whats-new-content').hide(0);
                jQuery('.whats-new-header-media-section').show(0);
                jQuery('#whats-new-attachments').hide(0);
                jQuery('.whats-new-intro-header').css({ 'font-size': '13px', 'font-weight' : '500' });
                jQuery('.whats-new-intro-header').show(0);
            }
        }
    });
    jQuery('.advanced-th-bp-activity-form').on( 'keypress', function(){
        if( jQuery('.advanced-th-bp-activity-form').text().length > 0 ){
            jQuery('#aw-whats-new-submit').removeAttr('disabled');
        }else{
            jQuery('#aw-whats-new-submit').attr('disabled');
        }
    });
    jQuery('.advanced-th-bp-activity-form').bind("paste", function(e){
        jQuery('#aw-whats-new-submit').removeAttr('disabled');
        var url = e.originalEvent.clipboardData.getData('text');
        if(validURL(url)){
            jQuery('#whats-new-post-url-preview').val(url);
            if( jQuery(this).parent().find('.url-scrap-view').length == 0 ){
                jQuery(this).after('<div class="url-scrap-view loading"><svg class="sharing-spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="10" fill="none" stroke-width="3"></circle></svg></div>');
            }
            jQuery.ajax({
                url: Tophive_JS.ajaxurl,
                type: 'POST',
                data: {
                    'action' : 'tophive_bp_get_scrapped_html',
                    'url' : url
                },
                success : function( data ){
                    console.log(data);
                    jQuery('.url-scrap-view').html(data).removeClass('loading');
                },
            })
        }
    } );
    function validURL(str) {
      var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
      return !!pattern.test(str);
    }
    jQuery('#whats-new-attachments p.image, #whats-new-attachments p.video').on('click', function(){
        jQuery('.whats-new-previewer').toggleClass('previewer-toggle');
    });
});

jQuery('.activity-update-form').append('<h2>go pro</h2>');

jQuery(function() {
    jQuery(document).on('click', ".th-bp-post-like-button a",  function(e){
        e.preventDefault();
        var _that = jQuery(this);
        var activityID = jQuery(this).data('id');
        var userID = jQuery(this).data('user');
        var nonce = jQuery(this).data('nonce');
        jQuery.ajax({
            url: Tophive_JS.ajaxurl,
            type: 'POST',
            data: {
                'action' : 'tophive_bp_likes_response',
                'activity_id' : activityID,
                'userid' : userID,
                'security' : nonce
            },
            success : function( data ){
                console.log(data);
                _that.find('.like_icon').html( data.icon );
                _that.find('.like_link').html( data.text );
                _that.find('.like_count').html( data.likes );
            },
        })
    });
    jQuery(document).on('click', '.th-bp-header-notification-container .th-bp-notif-logo', function( e ){
        e.preventDefault();
        jQuery('.th-bp-header-notification-container ul').toggleClass('show_dd');
    });
    jQuery(document).on('click', '.th-bp-header-messenger-container .th-bp-inbox-logo', function( e ){
        e.preventDefault();
        jQuery('.th-bp-header-messenger-container ul').toggleClass('show_dd');
    });
    jQuery('.whats-new-close').on('click', function(){
        resetActivityForm();
    });
    jQuery('#whats-new-form').on('submit', function( e ){
        var formData = jQuery('#whats-new-form').serializeArray();
        var text = jQuery('#th-bp-whats-new').text();
        var urlPreview = jQuery('#whats-new-post-url-preview').val();
        formData.push(
            { name: 'whats-new-post-content', value: text },
            { name: 'whats-new-post-url-preview', value: urlPreview }
        );
        var newData = {};
        formData.filter( function( item ) {
           newData[item.name] = item.value;
        });
        jQuery.ajax({
            url: Tophive_JS.ajaxurl,
            type: 'POST',
            data: {
                'action' : 'th_bp_post_update',
                'data' : newData,
                'nonce' : newData._wpnonce_post_update
            },
            beforeSend: function(){
                jQuery('#whats-new-form').addClass('submitting');
            },
            success : function( res ){
                console.log(res);
                if( res.success ){
                    jQuery('ul.activity-list').prepend(res.activity).hide().fadeIn();
                    resetActivityForm();
                }else if( res.error ){
                    jQuery('#whats-new-form').removeClass('submitting');
                    alert(res.error);
                }
            }
        });
        console.log(newData);
        return false;
    });
    function resetActivityForm(){
        jQuery('#whats-new-form').removeClass('submitting');
        jQuery('#whats-new-content').hide(200);
        jQuery('#whats-new-attachments').hide();
        jQuery('.whats-new-header-media-section').show(200);
        jQuery('.whats-new-intro-header').css({ 'font-size': '13px', 'font-weight' : '500' });
        jQuery('.whats-new-intro-header').show();
        //removes texts
        jQuery('.advanced-th-bp-activity-form').text('');
        jQuery('.media-uploading').remove();
        jQuery('.url-scrap-view').remove();
        jQuery('#whats-new-post-url-preview').val('');
        jQuery('#whats-new-post-media').val('');
    }
    jQuery(document).on('click', '#whats-new-textarea .url-scrap-view .cross', function(){
        jQuery('#whats-new-post-url-preview').val('');
        jQuery('#whats-new-textarea .url-scrap-view').remove();
    });
    jQuery( document ).on( 'change', '#upload-media', function(){
        imagesPreview(this, 'div.whats-new-previewer');
    });
    var imagesPreview = function(input, placeToInsertImagePreview) {
        var ids = jQuery('#whats-new-post-media').val();
        if (input.files) {
            var file = input.files[0];
            var fileName = input.files[0].name;
            var formData = new FormData();
            var uniqid = Date.now();
            formData.append('action', 'activity_upload');
            formData.append('file_name', fileName);
            formData.append('upload_file', file);
            jQuery.ajax({
                url: Tophive_JS.ajaxurl,
                type: 'POST',
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    jQuery('.previewer-uploader').before('<p class="media-uploading" id="'+ uniqid +'"></p>');
                },
                success : function( data ){
                    console.log(data);
                    jQuery('#' + uniqid).addClass('done').append(data.html);
                    jQuery('#' + uniqid).append('<span class="remove-media" data-media-id="'+ uniqid +'" data-attachment-id="'+ data.id +'">✕</span>');
                    if( ids == '' ){
                        var allids = data.id;
                    }else{
                        var allids = ids + ', ' + data.id;
                    }
                    jQuery('#whats-new-post-media').val(allids);
                    jQuery('#aw-whats-new-submit').removeAttr('disabled');
                },
            });
        }
    };
    jQuery(document).on('click', '.remove-media', function(){
        var attachment_id = jQuery(this).attr('data-attachment-id');
        var media_id = jQuery(this).attr('data-media-id');
        var ids = jQuery('#whats-new-post-media').val();

        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'th_bp_remove_media',
                att_id : attachment_id
            },
            beforeSend: function(){
                jQuery('#' + media_id ).fadeOut(200);
                var newIds = removeValue( ids, media_id, ',' );
                jQuery('#whats-new-post-media').val(newIds);
            },
            success : function (response) {
                if( response !== null ){
                    jQuery('#' + media_id).remove();
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    });
    var removeValue = function(list, value, separator) {
        separator = separator || ",";
        var values = list.split(separator);
        for(var i = 0 ; i < values.length ; i++) {
            if(values[i] == value) {
                values.splice(i, 1);
            return values.join(separator);
            }
        }
        return list;
    }
    jQuery(document).mouseup(function(e) 
    {
        var notifier = jQuery('.th-bp-header-notification-container ul.show_dd');
        if (!notifier.is(e.target) && notifier.has(e.target).length === 0) 
        {
            notifier.removeClass('show_dd');
        }
        var messenger = jQuery('.th-bp-header-messenger-container ul.show_dd');
        if (!messenger.is(e.target) && messenger.has(e.target).length === 0) 
        {
            messenger.removeClass('show_dd');
        }

    });

    jQuery('.header-social_search_box-item input.search-field').on('blur input', function(event) {
        var text = this.value.trim();
        var _that = jQuery(this);
        if( text !== '' ){
            jQuery(this).parents().find('.search-box-result').slideDown(400, function() {
                //ajax
                jQuery.ajax({
                    url     : Tophive_JS.ajaxurl,
                    type    : 'post',
                    data    : {
                        action : 'th_bp_bb_social_search',
                        text : text
                    },
                    success : function (response) {
                        _that.parents().find('.search-box-result').html(response);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr);
                    }
                });
            });
        }else{
            jQuery(this).parents().find('.search-box-result').slideUp(200, function() {
                jQuery(this).parents().find('.search-box-result').html(text);
            });
        }
    });
    jQuery(document).on('click', '.media-popup-thumbnail', function(e){
        e.preventDefault();
        var current_slider = jQuery(this).closest('.bp-image-single').attr('id');
        var full_url = jQuery(this).attr('href');
        
        setCurrentId( current_slider );
        jQuery('.th-media-viewer-container').addClass('show');
        setTheImage(full_url);

        var media_id = jQuery(this).attr('data-id');
        var activity_id = jQuery(this).attr('data-activity');
        setMediaAuthor( media_id, activity_id );
        setComments( media_id, activity_id );
    });
    jQuery('.th-media-viewer-container .close').on('click', function(e){
        e.preventDefault();
        jQuery('.th-media-viewer-container').removeClass('show');
    });
    jQuery(document).on('click', '.image-viewer-next-prev .img-prev', function(){
        var url = jQuery(this).data('prev');
        var current_id = jQuery(this).attr('data-current-id');
        SliderRotator( url, current_id, 'prev' );
    });
    jQuery(document).on('click', '.image-viewer-next-prev .img-next', function(){
        var url = jQuery(this).data('next');
        var current_id = jQuery(this).attr('data-current-id');
        SliderRotator( url, current_id, 'next' );
    });
    function SliderRotator( url, current_id, type ){
        if( type === 'prev' ){
            var idd = getPrevImageId(current_id);
        }
        if( type === 'next' ){
            var idd = getNextImageId(current_id);
        }
        var mid = getMediaId( idd );
        var aid = getActivityId( idd );
        var img_url = getImageUrl( idd );
        console.log(img_url);
        if( img_url !== undefined ){
            setCurrentId( idd );
            setTheImage(getImageUrl( idd ));
            setComments( mid, aid );
            setMediaAuthor( mid, aid );
        }

    }
    function setMediaAuthor( media_id, activity_id ){
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'th_bp_media_author',
                media_id : media_id,
                activity_id : activity_id
            },
            success : function (response) {
                jQuery('.th-media-viewer-container .th-media-comments .author_section').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    }
    function setCurrentId( id ){
        jQuery('.image-viewer-next-prev span').attr('data-current-id', id);
    }
    function getNextImageId( current_id ){
        if( current_id < 0 ){
            current_id == 0;
        }
        var next_id = +current_id + 1;
        var imageCount = getTotalImages();
        console.log(imageCount);
        if( next_id <= 0 ){
            return 1;
        }else if( next_id >= imageCount ){
            return imageCount;
        }else{
            return next_id;
        }
    }
    function getImageUrl( id ){
        return jQuery('.bp-image-single#' + id ).find('.media-popup-thumbnail').attr('href');
    }
    function getMediaId( id ){
        return jQuery('.bp-image-single#' + id ).find('.media-popup-thumbnail').attr('data-id');
    }
    function getActivityId( id ){
        return jQuery('.bp-image-single#' + id ).find('.media-popup-thumbnail').attr('data-activity');
    }
    function getPrevImageId( current_id ){
        if( current_id < 0 ){
            current_id == 0;
        }
        var prev_id = +current_id - 1;
        var imageCount = getTotalImages();
        if( prev_id <= 0 ){
            return 1;
        }else if( prev_id >= imageCount ){
            return imageCount;
        }else{
            return prev_id;
        }
    }
    function getTotalImages(){
        return jQuery('.bp-image-single').length;
    }
    function setTheImage( url ){
        var image_html = '<img src=' + url + ' alt="image_popup"/>';
        jQuery('.th-media-viewer-container .th-media-view').html(image_html);
    }
    
    jQuery(document).on('click', '.th-bp-media-comment-button .bp-media-reactions', function( e ){
        e.preventDefault();
        var media_id = jQuery(this).attr('data-media-id');
        var activity_id = jQuery(this).attr('data-activity-id');

        postCommentReaction( 'love', media_id, activity_id );
    });
    jQuery(document).on('click', '.th-bp-post-like-button .reaction_icons img', function(){
        if( !Tophive_JS.logged_in ){
            return;
        }
        var _that = jQuery(this);
        var reaction_type = _that.attr('data-type');
        var activity_id = _that.attr('data-activity-id');

        if( reaction_type === 'haha' ){
            _that.parents('.th-bp-post-like-button').find('a').attr('data-reaction', '').attr( 'data-reaction' , reaction_type).html( '<img src="' + Tophive_JS.haha_img + '" /> ' + Tophive_JS.haha_text );
        }else if( reaction_type === 'wow' ){
            _that.parents('.th-bp-post-like-button').find('a').attr('data-reaction', '').attr( 'data-reaction' , reaction_type).html( '<img src="' + Tophive_JS.wow_img + '" /> ' + Tophive_JS.wow_text );
        }else if( reaction_type === 'angry' ){
            _that.parents('.th-bp-post-like-button').find('a').attr('data-reaction', '').attr( 'data-reaction' , reaction_type).html( '<img src="' + Tophive_JS.angry_img + '" /> ' + Tophive_JS.angry_text );
        }else if( reaction_type === 'cry' ){
            _that.parents('.th-bp-post-like-button').find('a').attr('data-reaction', '').attr( 'data-reaction' , reaction_type).html( '<img src="' + Tophive_JS.cry_img + '" /> ' + Tophive_JS.cry_text );
        }else if( reaction_type === 'love' ){
            _that.parents('.th-bp-post-like-button').find('a').attr('data-reaction', '').attr( 'data-reaction' , reaction_type).html( '<img src="' + Tophive_JS.love_img + '" /> ' + Tophive_JS.love_text );
        }else if( reaction_type === 'like' ){
            _that.parents('.th-bp-post-like-button').find('a').attr('data-reaction', '').attr( 'data-reaction' , reaction_type).html( '<img src="' + Tophive_JS.like_img + '" /> ' + Tophive_JS.like_text );
        }
        postActivityReaction( reaction_type, activity_id );
    });
    jQuery(document).on('click', '.reactions-meta', function(){
        var _that = jQuery(this);
        var activity_id = _that.attr('data-activity-id');
        jQuery(document).find('.th-activity-reaction-viewer').addClass('show');
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'th_bp_activity_all_reaction',
                activity_id : activity_id
            },
            success : function (response) {

                jQuery(document).find('.th-activity-reaction-viewer .reactions').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    });
    jQuery(document).on('click', '.th-activity-reaction-viewer .close', function(){
        jQuery('.th-activity-reaction-viewer').removeClass('show');
    });
    jQuery(document).on('click', '.th-activity-reaction-viewer .reactions ul.reaction_tabs li a', function(e){
        e.preventDefault();
        var tab_id = jQuery(this).attr('href');
        jQuery('.th-activity-reaction-viewer .reactions ul.reaction_tabs li a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.th-activity-reaction-viewer .reactions .reaction_container .single-reactions').hide();
        jQuery('.th-activity-reaction-viewer .reactions .reaction_container .single-reactions' + tab_id).show();
    });
    jQuery(document).on('click', '.th-bp-post-like-button a', function(){
        var _that = jQuery(this);
        var present_class = _that.attr('data-reaction');
        if( present_class !== '' ){
            var reaction_type = 'decrement';
            _that.parents('.th-bp-post-like-button').find('a').attr( 'data-reaction', '' ).html( Tophive_JS.like_base_img + Tophive_JS.like_base_text );
        }else{
            var reaction_type = 'like';
            _that.parents('.th-bp-post-like-button').find('a').attr('data-reaction', reaction_type).html( '<img src="' + Tophive_JS.like_img + '" /> ' + Tophive_JS.like_text );
        }
        var activity_id = _that.attr('data-id');

        postActivityReaction( reaction_type, activity_id );
    });
    function hideReactions( reaction ){
        jQuery(reaction).parent().hide();
        setTimeout(function(){
            jQuery(reaction).parent().show();
        }, 5);
    }
    function postActivityReaction( reaction_type, activity_id ){
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'th_bp_activity_reaction',
                reaction_type: reaction_type,
                activity_id : activity_id
            },
            success : function (response) {
                // jQuery('.th-bp-media-comment-button').remove();
                // jQuery('.comment_section').prepend(response);
                // if( response == true ){
                //     setComments( media_id, activity_id );
                // }else{
                    console.log( response );
                // }
                jQuery('#activity-' + activity_id ).find('.reactions-meta').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });        
    }
    /*---------------- Comments Section ----------------*/
    function getComments(){}
    function setComments( media_id, activity_id ){
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'th_bp_media_comments',
                media_id : media_id,
                activity_id : activity_id
            },
            beforeSend: function(){
                jQuery('.th-media-viewer-container .th-media-comments .comment_section').html('<span class="comments_loading"></span>');   
            },
            success : function (response) {
                jQuery('.th-media-viewer-container .th-media-comments .comment_section').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    }
    function tophiveActivityComments( activity_id, comment_text, comment_id = '', type = 'postComment' ){
        if( comment_text !== '' ){
            jQuery.ajax({
                url     : Tophive_JS.ajaxurl,
                type    : 'post',
                data    : {
                    action : 'tophive_bp_activity_comment',
                    comment_text : comment_text,
                    activity_id : activity_id,
                    comment_id : comment_id,
                    type : type
                },
                beforeSend: function(){
                    jQuery('.activity-' + activity_id + ' .comments-text' ).attr('disabled', 'disabled');   
                },
                success : function (response) {
                    console.log( response );
                    // jQuery('.th-media-viewer-container .th-media-comments .comment_section').html(response);
                    if( response.html ){
                        jQuery('#activity-' + activity_id + ' .activity-comments' ).html(response.html);   
                    }
                    if( response.count ){
                        jQuery('.activity-comments-meta-' + activity_id ).html(response.count);   
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    console.log(xhr);
                }
            });
        }
    }
    jQuery(document).on('click', '.th_media_comment_submit', function(){
        var comment_text = jQuery(document).find('.media_comment_box .comment_text textarea').val();
        var media_id = jQuery(this).attr('data-media-id');
        var activity_id = jQuery(this).attr('data-activity-id');
        var type = jQuery(this).attr('data-type');
        jQuery(this).attr('disabled', true);
        postNewComment( comment_text, media_id, activity_id );
    });
    /***
    ** Activity Comments 
    * Since v1.0.0
    */
    jQuery(document).on('submit', '.tophive-bp-comment-form', function (e) {
        var text = jQuery(this).find('.comments-text').val();
        var activity_id = jQuery(this).attr('data-activity-id');
        var comment_id = jQuery(this).attr('data-comment-id');
        var type = jQuery(this).attr('data-type');
        var comment_box = jQuery(this).find('.comments-text');
        tophiveActivityComments( activity_id, text, comment_id, type );
        return false;
    });
    jQuery(document).on('keypress', '.tophive-bp-comment-form .comments-text', function (e) {
        if(e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            var activity_id = jQuery(this).parent().attr('data-activity-id');
            var comment_id = jQuery(this).parent().attr('data-comment-id');
            var type = jQuery(this).parent().attr('data-type');
            var text = e.target.value;
            // console.log( activity_id ,text);
            tophiveActivityComments( activity_id, text, comment_id, type );
        }
    });
    /* ---------------- Show More Comments Button --------------*/
    jQuery(document).on('click', '.show-more-comments', function(e){
        e.preventDefault();
        var show = jQuery(this).attr('data-show');
        var activity_id = jQuery(this).attr('data-activity-id');
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'tophive_bp_more_comments',
                show : show,
                activity_id : activity_id
            },
            success : function (response) {
                jQuery('#activity-' + activity_id + ' .activity-comments' ).html(response);   
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });

    });
    /*----------------- Show Comment Reply form -----------------*/
    jQuery(document).on('click', '.comment-reply-form-toggle', function(e){
        e.preventDefault();
        var id = jQuery(this).attr('href');
        jQuery(id).toggleClass('show');
    });
    jQuery(document).on('click', '.th-bp-post-comment-button a', function(e){
        e.preventDefault();
        var id = jQuery(this).attr('data-activity-id');
        console.log(id);
        jQuery('.'+id).find('textarea').focus();
    });
    jQuery(document).on('click', '.activity-comments-toggle', function(e){
        e.preventDefault();
        var id = jQuery(this).attr('href');
        // console.log(id);
        jQuery(id).slideToggle(200);
        jQuery(id + ' + .show-more-comments').slideToggle(100);
    });
    function postNewComment( comment_text, media_id, activity_id ){
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'th_bp_media_comments_post',
                comment_text : comment_text,
                media_id : media_id,
                activity_id : activity_id
            },
            success : function (response) {
                if( response == true ){
                    setComments( media_id, activity_id );
                }else{
                    console.log( response );
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    }
    function postCommentReaction( reaction_type, media_id, activity_id ){

        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'th_bp_media_reaction',
                reaction_type: reaction_type,
                media_id : media_id,
                activity_id : activity_id
            },
            success : function (response) {
                jQuery('.th-bp-media-comment-button').remove();
                jQuery('.comment_section').prepend(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    }
    // Comments delete
    jQuery(document).on('click', '.comment-options ul li a', function(e){
        e.preventDefault();
        var r = confirm(Tophive_JS.delete_comment);
        if( r == true ){
            var comment_id = jQuery(this).attr('data-comment-id');
            var activity_id = jQuery(this).attr('data-activity-id');
            var reply_id = jQuery(this).attr('data-reply-id');
            deleteComment( activity_id, comment_id, reply_id );
        }
    });
    function deleteComment( activity_id, comment_id, reply_id ){
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'tophive_bp_delete_comment',
                activity_id: activity_id,
                comment_id: comment_id,
                reply_id : reply_id
            },
            success : function (response) {
                console.log(response);
                if( response.html ){
                    jQuery('#activity-' + activity_id + ' .activity-comments' ).html(response.html);   
                }
                if( response.count ){
                    jQuery('.activity-comments-meta-' + activity_id ).html(response.count);   
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    }
    // End comment delete
    function editComment(){}
    jQuery(document).keyup(function(e) {
        if(e.key === "Escape") {
            jQuery('.th-media-viewer-container').removeClass('show');
        }
        if( e.keyCode == 37 ){
            jQuery(document).find('.image-viewer-next-prev .img-prev').click();
        }
        if( e.keyCode == 39 ){
            jQuery(document).find('.image-viewer-next-prev .img-next').click();
        }
    });

    jQuery(document).on('click', '.th-bp-logged-out a', function( e ){
        e.preventDefault();
        jQuery('#tophive-signin-signup').addClass('open');
    });
    jQuery(document).on( 'click', '.v-menu-toggler svg', function( e ){
        jQuery(this).parents('.tophive-vertical-nav').toggleClass('open');
        jQuery('body').toggleClass('v-nav-open');
    });
    jQuery(document).on( 'click', '.th-bp-post-share-button a.activity-share', function(e){
        e.preventDefault();
        jQuery(this).parent().find('.sharing-options').toggleClass( 'open' );
    });
    jQuery(document).on( 'click', 'a.timeline-share', function(e){
        var loading_icon = '<svg class="sharing-spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="4"></circle></svg>';
        var share_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="arcs"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>';
        var ok_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>';
        e.preventDefault();
        var _that = jQuery(this);
        var activity_id = _that.attr('href');
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'tophive_bp_share_activity',
                activity_id: activity_id
            },
            beforeSend: function(){
                _that.parents('.sharing-options').removeClass('open');
                _that.parents('.th-bp-post-share-button').find('a.activity-share .share_icon').html(loading_icon);
            },
            success : function (response) {
                console.log(response);
                if(response){
                    _that.parents('.th-bp-post-share-button').find('a.activity-share .share_icon').html(ok_icon);
                }
                setTimeout(function(){
                    _that.parents('.th-bp-post-share-button').find('a.activity-share .share_icon').html(share_icon);
                }, 2000);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    });
    jQuery(document).on('click', '.bp-th-friends-button', function(e){
        e.preventDefault();
        var loading_icon = '<svg class="sharing-spinner" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="4"></circle></svg>';
        var user_id = jQuery(this).attr('data-user-id');
        var _that = jQuery(this);
        jQuery.ajax({
            url     : Tophive_JS.ajaxurl,
            type    : 'post',
            data    : {
                action : 'tophive_bp_friends_action',
                user_id: user_id
            },
            beforeSend: function(){
                _that.html(loading_icon);
            },
            success : function (response) {
                console.log(response);
                if( response.result === true ){
                    _that.html(response.text);
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    });

    jQuery(document).on('click', '.activity-read-more a', function(e){
        e.preventDefault();
    });
});


