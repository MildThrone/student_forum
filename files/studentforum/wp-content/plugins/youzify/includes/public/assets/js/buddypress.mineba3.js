var jq=jQuery,bp_ajax_request=null,newest_activities="",activity_last_recorded=0,directoryPreferences={};function bp_get_directory_preference(e,t){var i={filter:"",scope:"",extras:""};if(!directoryPreferences.hasOwnProperty(e)){var a={};for(var s in i)i.hasOwnProperty(s)&&(a[s]=i[s]);directoryPreferences[e]=a}return BP_DTheme.store_filter_settings&&(directoryPreferences[e][t]=jq.cookie("bp-"+e+"-"+t)),directoryPreferences[e][t]}function bp_set_directory_preference(e,t,i){var a={filter:"",scope:"",extras:""};if(!directoryPreferences.hasOwnProperty(e)){var s={};for(var n in a)a.hasOwnProperty(n)&&(s[n]=a[n]);directoryPreferences[e]=s}BP_DTheme.store_filter_settings&&jq.cookie("bp-"+e+"-"+t,i,{path:"/",secure:"https:"===window.location.protocol}),directoryPreferences[e][t]=i}function bp_init_activity(){var e=bp_get_directory_preference("activity","scope"),t=bp_get_directory_preference("activity","filter");void 0!==t&&jq("#activity-filter-select").length&&jq('#activity-filter-select select option[value="'+t+'"]').prop("selected",!0),void 0!==e&&jq(".activity-type-tabs").length&&(jq(".activity-type-tabs li").each(function(){jq(this).removeClass("selected")}),jq("#activity-"+e+", .item-list-tabs li.current").addClass("selected"))}function bp_init_objects(a){jq(a).each(function(e){var t=bp_get_directory_preference(a[e],"scope"),i=bp_get_directory_preference(a[e],"filter");void 0!==i&&jq("#"+a[e]+"-order-select select").length&&jq("#"+a[e]+'-order-select select option[value="'+i+'"]').prop("selected",!0),void 0!==t&&jq("div."+a[e]).length&&(jq(".item-list-tabs li").each(function(){jq(this).removeClass("selected")}),jq("#"+a[e]+"-"+t+", #object-nav li.current").addClass("selected"))})}function bp_filter_request(e,t,i,a,s,n,r,o,c){if("activity"===e)return!1;null==i&&(i="all"),bp_set_directory_preference(e,"scope",i),bp_set_directory_preference(e,"filter",t),bp_set_directory_preference(e,"extras",r),jq(".item-list-tabs li").each(function(){jq(this).removeClass("selected")}),jq("#"+e+"-"+i+", #object-nav li.current").addClass("selected"),jq(".item-list-tabs li.selected").addClass("loading"),jq('.item-list-tabs select option[value="'+t+'"]').prop("selected",!0),"friends"!==e&&"group_members"!==e||(e="members"),bp_ajax_request&&bp_ajax_request.abort();var l={};l["bp-"+e+"-filter"]=bp_get_directory_preference(e,"filter"),l["bp-"+e+"-scope"]=bp_get_directory_preference(e,"scope");var d=encodeURIComponent(jq.param(l));bp_ajax_request=jq.post(ajaxurl,{action:e+"_filter",cookie:d,object:e,filter:t,search_terms:s,scope:i,page:n,extras:r,template:c},function(e){if("pag-bottom"===o&&jq("#subnav").length){var t=jq("#subnav").parent();jq("html,body").animate({scrollTop:t.offset().top},"slow",function(){jq(a).fadeOut(100,function(){jq(this).html(e),jq(this).fadeIn(100),youzify_init_directory_masonry()})})}else jq(a).fadeOut(100,function(){jq(this).html(e),jq(this).fadeIn(100),youzify_init_directory_masonry()});jq(".item-list-tabs li.selected").removeClass("loading")})}function youzify_init_directory_masonry(){if(jq("#youzify-members-directory")[0]&&jq("#youzify-members-list")[0]){var e=document.querySelector("#youzify-members-list");imagesLoaded(e,function(){new Masonry(e,{itemSelector:"#youzify-members-list > li"})})}if(jq("#youzify-groups-directory")[0]&&jq("#youzify-groups-list")[0]){var t=document.querySelector("#youzify-groups-list");imagesLoaded(t,function(){new Masonry(t,{itemSelector:"#youzify-groups-list li"})})}}function bp_activity_request(e,t){bp_set_directory_preference("activity","scope",e),bp_set_directory_preference("activity","filter",t),jq(".item-list-tabs li").each(function(){jq(this).removeClass("selected loading")}),jq("#activity-"+e+", .item-list-tabs li.current").addClass("selected"),jq("#object-nav.item-list-tabs li.selected, div.activity-type-tabs li.selected").addClass("loading"),jq('#activity-filter-select select option[value="'+t+'"]').prop("selected",!0),jq(".widget_bp_activity_widget h2 span.ajax-loader").show(),bp_ajax_request&&bp_ajax_request.abort();var i={"bp-activity-filter":bp_get_directory_preference("activity","filter"),"bp-activity-scope":bp_get_directory_preference("activity","scope")},a=encodeURIComponent(jq.param(i));bp_ajax_request=jq.post(ajaxurl,{action:"activity_widget_filter",cookie:a,_wpnonce_activity_filter:jq("#_wpnonce_activity_filter").val(),scope:e,filter:t},function(e){jq(".widget_bp_activity_widget h2 span.ajax-loader").hide(),jq("div.activity").fadeOut(100,function(){jq(this).html(e.contents),jq(this).fadeIn(100),bp_legacy_theme_hide_comments()}),void 0!==e.feed_url&&jq(".directory #subnav li.feed a, .home-page #subnav li.feed a").attr("href",e.feed_url),jq(".item-list-tabs li.selected").removeClass("loading")},"json")}function bp_legacy_theme_hide_comments(e){var t,i,a,s=jq("div.activity-comments");if(void 0!==e&&(s=e.find("div.activity-comments")),!s.length)return!1;var n=window.hasOwnProperty("youzify_comments_length")?window.youzify_comments_length:3;s.each(function(){jq(this).children("ul").children("li").length<n||(comments_div=jq(this),t=comments_div.parents("#activity-stream > li"),i=jq(this).children("ul").children("li"),a=" ",jq("#"+t.attr("id")+" li").length&&(a=jq("#"+t.attr("id")+" li").length),i.each(function(e){e<i.length-n&&(jq(this).hide(),e||jq(this).before('<li class="show-all"><a href="#'+t.attr("id")+'/show-all/">'+BP_DTheme.show_x_comments.replace("%d",a)+"</a></li>"))}))})}function checkAll(){var e,t=document.getElementsByTagName("input");for(e=0;e<t.length;e++)"checkbox"===t[e].type&&(""===$("check_all").checked?t[e].checked="":t[e].checked="checked")}function clear(e){if(e=document.getElementById(e)){var t=e.getElementsByTagName("INPUT"),i=e.getElementsByTagName("OPTION"),a=0;if(t)for(a=0;a<t.length;a++)t[a].checked="";if(i)for(a=0;a<i.length;a++)i[a].selected=!1}}function bp_get_cookies(){var e,t,i,a,s,n=document.cookie.split(";"),r={};for(e=0;e<n.length;e++)i=(t=n[e]).indexOf("="),a=jq.trim(unescape(t.slice(0,i))),s=unescape(t.slice(i+1)),0===a.indexOf("bp-")&&(r[a]=s);return encodeURIComponent(jq.param(r))}function bp_get_query_var(e,t){var i={};return(t=void 0===t?location.search.substr(1).split("&"):t.split("?")[1].split("&")).forEach(function(e){i[e.split("=")[0]]=e.split("=")[1]&&decodeURIComponent(e.split("=")[1])}),!(!i.hasOwnProperty(e)||null==i[e])&&i[e]}jq(document).ready(function(){var d=1;if("undefined"!=typeof BP_DTheme){bp_init_activity();var i=jq("#whats-new");if(bp_init_objects(["members","groups","blogs","group_members"]),i.length&&bp_get_querystring("r")){var e=i.val();jq("#whats-new-options").slideDown(),i.animate({height:"3.8em"}),jq.scrollTo(i,500,{offset:-125,easing:"swing"}),i.val("").focus().val(e)}else jq("#whats-new-options").hide();if(i.focus(function(){jq("#whats-new-options").slideDown(),jq(this).animate({height:"3.8em"}),jq("#aw-whats-new-submit").prop("disabled",!1),jq(this).parent().addClass("active"),jq("#whats-new-content").addClass("active");var e=jq("form#whats-new-form"),t=jq("#activity-all");e.hasClass("submitted")&&e.removeClass("submitted"),t.length&&(t.hasClass("selected")?"-1"!==jq("#activity-filter-select select").val()&&(jq("#activity-filter-select select").val("-1"),jq("#activity-filter-select select").trigger("change")):(jq("#activity-filter-select select").val("-1"),t.children("a").trigger("click")))}),jq("#whats-new-form").on("focusout",function(e){var t=jq(this);setTimeout(function(){if(!t.find(":hover").length){if(""!==i.val())return;i.animate({height:"2.2em"}),jq("#whats-new-options").slideUp(),jq("#aw-whats-new-submit").prop("disabled",!0),jq("#whats-new-content").removeClass("active"),i.parent().removeClass("active")}},0)}),jq("#aw-whats-new-submit").on("click",function(){var e,n=0,t=jq(this),r=t.closest("form#whats-new-form"),i={};return jq.each(r.serializeArray(),function(e,t){"_"!==t.name.substr(0,1)&&"whats-new"!==t.name.substr(0,9)&&(i[t.name]?jq.isArray(i[t.name])?i[t.name].push(t.value):i[t.name]=new Array(i[t.name],t.value):i[t.name]=t.value)}),r.find("*").each(function(){(jq.nodeName(this,"textarea")||jq.nodeName(this,"input"))&&jq(this).prop("disabled",!0)}),jq("div.error").remove(),t.addClass("loading"),t.prop("disabled",!0),r.addClass("submitted"),object="",item_id=jq("#whats-new-post-in").val(),content=jq("#whats-new").val(),firstrow=jq("#youzify ul.activity-list li").first(),activity_row=firstrow,timestamp=null,firstrow.length&&(activity_row.hasClass("load-newest")&&(activity_row=firstrow.next()),timestamp=activity_row.prop("class").match(/date-recorded-([0-9]+)/)),timestamp&&(n=timestamp[1]),0<item_id&&(object=jq("#whats-new-post-object").val()),e=jq.extend({action:"post_update",cookie:bp_get_cookies(),_wpnonce_post_update:jq("#_wpnonce_post_update").val(),content:content,object:object,item_id:item_id,since:n,_bp_as_nonce:jq("#_bp_as_nonce").val()||""},i),jq.post(ajaxurl,e,function(e){if(r.find("*").each(function(){(jq.nodeName(this,"textarea")||jq.nodeName(this,"input"))&&jq(this).prop("disabled",!1)}),e[0]+e[1]==="-1")r.prepend(e.substr(2,e.length)),jq("#"+r.attr("id")+" div.error").hide().fadeIn(200);else{if(0===jq("ul.activity-list").length&&(jq("div.error").slideUp(100).remove(),jq("#message").slideUp(100).remove(),jq("div.activity").append('<ul id="activity-stream" class="activity-list item-list">')),firstrow.hasClass("load-newest")&&firstrow.remove(),jq("#activity-stream").prepend(e),n||jq("#activity-stream li:first").addClass("new-update just-posted"),0!==jq("#latest-update").length){var t=jq("#activity-stream li.new-update .activity-content .activity-inner p").html(),i=jq("#activity-stream li.new-update .activity-content .activity-header p a.view").attr("href"),a=jq("#activity-stream li.new-update .activity-content .activity-inner p").text(),s="";""!==a&&(s=t+" "),s+='<a href="'+i+'" rel="nofollow">'+BP_DTheme.view+"</a>",jq("#latest-update").slideUp(300,function(){jq("#latest-update").html(s),jq("#latest-update").slideDown(300)})}jq("li.new-update").hide().slideDown(300),jq("li.new-update").removeClass("new-update"),jq("#whats-new").val(""),r.get(0).reset(),newest_activities="",activity_last_recorded=0}jq("#whats-new-options").slideUp(),jq("#whats-new-form textarea").animate({height:"2.2em"}),jq("#aw-whats-new-submit").prop("disabled",!0).removeClass("loading"),jq("#whats-new-content").removeClass("active")}),!1}),jq("div.activity-type-tabs").on("click",function(e){var t,i,a=jq(e.target).parent();if("STRONG"===e.target.nodeName||"SPAN"===e.target.nodeName)a=a.parent();else if("A"!==e.target.nodeName)return!1;return t=a.attr("id").substr(9,a.attr("id").length),i=jq("#activity-filter-select select").val(),"mentions"===t&&jq("#"+a.attr("id")+" a strong").remove(),bp_activity_request(t,i),!1}),jq("#activity-filter-select select").change(function(){var e=jq("div.activity-type-tabs li.selected"),t=jq(this).val();return bp_activity_request(e.length?e.attr("id").substr(9,e.attr("id").length):null,t),!1}),jq("div.activity").on("click",function(e){var t,i,a,s,n,r,o,c,l=jq(e.target);return l.hasClass("fav")||l.hasClass("unfav")?(l.hasClass("loading")||(t=l.hasClass("fav")?"fav":"unfav",a=(i=l.closest(".activity-item")).attr("id").substr(9,i.attr("id").length),n=bp_get_query_var("_wpnonce",l.attr("href")),l.addClass("loading"),jq.post(ajaxurl,{action:"activity_mark_"+t,cookie:bp_get_cookies(),id:a,nonce:n},function(e){l.removeClass("loading"),l.fadeOut(200,function(){jq(this).html(e),jq(this).attr("title","fav"===t?BP_DTheme.remove_fav:BP_DTheme.mark_as_fav),jq(this).fadeIn(200)}),"fav"===t?(jq(".item-list-tabs #activity-favs-personal-li").length||(jq(".item-list-tabs #activity-favorites").length||jq(".item-list-tabs ul #activity-mentions").before('<li id="activity-favorites"><a href="#">'+BP_DTheme.my_favs+" <span>0</span></a></li>"),jq(".item-list-tabs ul #activity-favorites span").html(Number(jq(".item-list-tabs ul #activity-favorites span").html())+1)),l.removeClass("fav"),l.addClass("unfav")):(l.removeClass("unfav"),l.addClass("fav"),jq(".item-list-tabs ul #activity-favorites span").html(Number(jq(".item-list-tabs ul #activity-favorites span").html())-1),Number(jq(".item-list-tabs ul #activity-favorites span").html())||(jq(".item-list-tabs ul #activity-favorites").hasClass("selected")&&bp_activity_request(null,null),jq(".item-list-tabs ul #activity-favorites").remove())),"activity-favorites"===jq(".item-list-tabs li.selected").attr("id")&&l.closest(".activity-item").slideUp(100)})),!1):l.hasClass("spam-activity")?(s=l.parents("div.activity ul li"),r=s.prop("class").match(/date-recorded-([0-9]+)/),l.addClass("loading"),jq.post(ajaxurl,{action:"bp_spam_activity",cookie:encodeURIComponent(document.cookie),id:s.attr("id").substr(9,s.attr("id").length),_wpnonce:l.attr("href").split("_wpnonce=")[1]},function(e){e[0]+e[1]==="-1"?(s.prepend(e.substr(2,e.length)),s.children("#message").hide().fadeIn(300)):(s.slideUp(300),r&&activity_last_recorded===r[1]&&(newest_activities="",activity_last_recorded=0))}),!1):l.parent().hasClass("load-more")?(bp_ajax_request&&bp_ajax_request.abort(),jq("#youzify li.load-more").addClass("loading"),o=d+1,c=[],jq(".activity-list li.just-posted").each(function(){c.push(jq(this).attr("id").replace("activity-",""))}),load_more_args={action:"activity_get_older_updates",cookie:bp_get_cookies(),page:o,exclude_just_posted:c.join(",")},load_more_search=bp_get_querystring("s"),load_more_search&&(load_more_args.search_terms=load_more_search),bp_ajax_request=jq.post(ajaxurl,load_more_args,function(e){jq("#youzify li.load-more").removeClass("loading"),d=o;var t=jq(e.contents);jq("#youzify ul.activity-list").append(t),l.parent().hide(),bp_legacy_theme_hide_comments(t),t=void 0,window.instgrm&&window.instgrm.Embeds.process()},"json"),!1):void(l.parent().hasClass("load-newest")&&(e.preventDefault(),l.parent().hide(),activity_html=jq.parseHTML(newest_activities),jq.each(activity_html,function(e,t){"LI"===t.nodeName&&jq(t).hasClass("just-posted")&&jq("#"+jq(t).attr("id")).length&&jq("#"+jq(t).attr("id")).remove()}),jq("#youzify ul.activity-list").prepend(newest_activities),newest_activities=""))}),jq("div.activity").on("click",".activity-read-more a",function(e){var t,i=jq(e.target),a=i.parent().attr("id").split("-"),s=a[3],n=a[0];return t=jq("#"+n+"-"+s+" ."+("acomment"===n?"acomment-content":"activity-inner")+":first"),jq(i).addClass("loading"),jq.post(ajaxurl,{action:"get_single_activity_content",activity_id:s},function(e){jq(t).slideUp(300).html(e).slideDown(300)}),!1}),jq("form.ac-form").hide(),jq(".activity-comments").length&&bp_legacy_theme_hide_comments(),jq("div.activity").on("click",function(e){var t,i,a,s,n,r,o,c,l,d,p,m,u,h,_=jq(e.target);return _.hasClass("acomment-reply")||_.parent().hasClass("acomment-reply")?(_.parent().hasClass("acomment-reply")&&(_=_.parent()),i=(t=_.attr("id").split("-"))[2],a=_.attr("href").substr(10,_.attr("href").length),(s=jq("#ac-form-"+i)).css("display","none"),s.removeClass("root"),jq(".ac-form").hide(),s.children("div").each(function(){jq(this).hasClass("error")&&jq(this).hide()}),"comment"!==t[1]?jq("#acomment-"+a).append(s):jq("#activity-"+i+" .activity-comments").append(s),s.parent().hasClass("activity-comments")&&s.addClass("root"),s.slideDown(200),jq.scrollTo(s,500,{offset:-100,easing:"swing"}),jq("#ac-form-"+t[2]+" textarea").focus(),!1):"ac_form_submit"===_.attr("name")?(n=(s=_.parents("form")).parent(),r=s.attr("id").split("-"),o=n.hasClass("activity-comments")?r[2]:n.attr("id").split("-")[1],content=jq("#"+s.attr("id")+" textarea"),jq("#"+s.attr("id")+" div.error").hide(),_.addClass("loading").prop("disabled",!0),content.addClass("loading").prop("disabled",!0),c={action:"new_activity_comment",cookie:bp_get_cookies(),_wpnonce_new_activity_comment:jq("#_wpnonce_new_activity_comment").val(),comment_id:o,form_id:r[2],content:content.val()},(l=jq("#_bp_as_nonce_"+o).val())&&(c["_bp_as_nonce_"+o]=l),jq.post(ajaxurl,c,function(t){if(_.removeClass("loading"),content.removeClass("loading"),t[0]+t[1]==="-1")s.append(jq(t.substr(2,t.length)).hide().fadeIn(200));else{var i=s.parent();if(s.fadeOut(200,function(){0===i.children("ul").length&&(i.hasClass("activity-comments")?i.prepend("<ul></ul>"):i.append("<ul></ul>"));var e=jq.trim(t);i.children("ul").append(jq(e).hide().fadeIn(200)),s.children("textarea").val(""),i.parent().addClass("has-comments")}),jq("#"+s.attr("id")+" textarea").val(""),p=Number(jq("#activity-"+r[2]+" a.acomment-reply span").html())+1,jq("#activity-"+r[2]+" a.acomment-reply span").html(p),d=i.parents(".activity-comments").find(".show-all a")){var e=d.text().match(/\((.*)\)/);d.html(BP_DTheme.show_x_comments.replace("%d",Number(e[1])+1))}}jq(_).prop("disabled",!1),jq(content).prop("disabled",!1)}),!1):_.hasClass("acomment-delete")?(m=_.attr("href"),u=_.parent().parent(),s=u.parents("div.activity-comments").children("form"),h=(h=m.split("_wpnonce="))[1],o=(o=(o=m.split("cid="))[1].split("&"))[0],_.addClass("loading"),jq(".activity-comments ul .error").remove(),u.parents(".activity-comments").append(s),jq.post(ajaxurl,{action:"delete_activity_comment",cookie:bp_get_cookies(),_wpnonce:h,id:o},function(e){if(e[0]+e[1]==="-1")u.prepend(jq(e.substr(2,e.length)).hide().fadeIn(200));else{var t,i,a,s=jq("#"+u.attr("id")+" ul").children("li"),n=0;if(jq(s).each(function(){jq(this).is(":hidden")||n++}),u.fadeOut(200,function(){u.remove()}),i=(t=jq("#"+u.parents("#activity-stream > li").attr("id")+" a.acomment-reply span")).html()-(1+n),t.html(i),a=u.parents(".activity-comments").find(".show-all a")){var r=a.text().match(/\((.*)\)/);r&&a.html(BP_DTheme.show_x_comments.replace("%d",Number(r[1])-1))}0===i&&jq(u.parents("#activity-stream > li")).removeClass("has-comments")}}),!1):_.hasClass("spam-activity-comment")?(m=_.attr("href"),u=_.parent().parent(),_.addClass("loading"),jq(".activity-comments ul div.error").remove(),u.parents(".activity-comments").append(u.parents(".activity-comments").children("form")),jq.post(ajaxurl,{action:"bp_spam_activity_comment",cookie:encodeURIComponent(document.cookie),_wpnonce:m.split("_wpnonce=")[1],id:m.split("cid=")[1].split("&")[0]},function(e){if(e[0]+e[1]==="-1")u.prepend(jq(e.substr(2,e.length)).hide().fadeIn(200));else{var t,i=jq("#"+u.attr("id")+" ul").children("li"),a=0;jq(i).each(function(){jq(this).is(":hidden")||a++}),u.fadeOut(200),t=u.parents("#activity-stream > li"),jq("#"+t.attr("id")+" a.acomment-reply span").html(jq("#"+t.attr("id")+" a.acomment-reply span").html()-(1+a))}}),!1):_.parent().hasClass("show-all")?(_.parent().addClass("loading"),setTimeout(function(){_.parent().parent().children("li").fadeIn(200,function(){_.parent().remove()})},600),!1):_.hasClass("ac-reply-cancel")?(jq(_).closest(".ac-form").slideUp(200),!1):void 0}),jq(document).keydown(function(e){((e=e||window.event).target?element=e.target:e.srcElement&&(element=e.srcElement),3===element.nodeType&&(element=element.parentNode),!0!==e.ctrlKey&&!0!==e.altKey&&!0!==e.metaKey)&&(27===(e.keyCode?e.keyCode:e.which)&&"TEXTAREA"===element.tagName&&jq(element).hasClass("ac-input")&&jq(element).parent().parent().parent().slideUp(200))}),jq(".dir-search, .groups-members-search").on("click",function(e){if(!jq(this).hasClass("no-ajax")){var t,i,a,s=jq(e.target);if("submit"===s.attr("type")){jq(".item-list-tabs li.selected")[0]||jq(".item-list-tabs li:first").addClass("selected"),t=jq(".item-list-tabs li.selected").attr("id").split("-")[0],i=null,a=s.parent().find("#"+t+"_search").val(),"groups-members-search"===e.currentTarget.className&&(t="group_members",i="groups/single/members");var n=bp_get_directory_preference(t,"scope");return n||(n="all"),bp_filter_request(t,bp_get_directory_preference(t,"filter"),n,"div."+t,a,1,bp_get_directory_preference(t,"extras"),null,i),!1}}}),jq("div.item-list-tabs").on("click",function(e){if(jq("body").hasClass("type")&&jq("body").hasClass("directory")&&jq(this).addClass("no-ajax"),!jq(this).hasClass("no-ajax")&&!jq(e.target).hasClass("no-ajax")){var t,i,a,s="SPAN"===e.target.nodeName?e.target.parentNode:e.target,n=jq(s).parent();if("LI"===n[0].nodeName&&!n.hasClass("last"))return"activity"===(i=(t=n.attr("id").split("-"))[0])||(a=t[1],bp_filter_request(i,jq("#"+i+"-order-select select").val(),a,"div."+i,jq("#"+i+"_search").val(),1,bp_get_directory_preference(i,"extras"))),!1}}),jq("li.filter select").change(function(){var e,t,i,a,s,n,r;return t=(e=(jq(".item-list-tabs li.selected").length?jq(".item-list-tabs li.selected"):jq(this)).attr("id").split("-"))[0],i=e[1],a=jq(this).val(),s=!1,n=null,jq(".dir-search input").length&&(s=jq(".dir-search input").val()),(r=jq(".groups-members-search input")).length&&(s=r.val(),t="members",i="groups"),"members"===t&&"groups"===i&&(t="group_members",n="groups/single/members"),"friends"===t&&(t="members"),bp_filter_request(t,a,i,"div."+t,s,1,bp_get_directory_preference(t,"extras"),null,n),!1}),jq("#youzify").on("click",function(e){var t,i,a,s,n,r,o,c,l=jq(e.target);if(l.hasClass("button"))return!0;if(l.parent().parent().hasClass("pagination")&&!l.parent().parent().hasClass("no-ajax")){if(l.hasClass("dots")||l.hasClass("current"))return!1;i=(t=(jq(".item-list-tabs li.selected").length?jq(".item-list-tabs li.selected"):jq("li.filter select")).attr("id").split("-"))[0],a=!1,s=jq(l).closest(".pagination-links").attr("id"),n=null,jq("div.dir-search input").length&&(a=!(a=jq(".dir-search input")).val()&&bp_get_querystring(a.attr("name"))?jq(".dir-search input").prop("placeholder"):a.val()),r=jq(l).hasClass("next")||jq(l).hasClass("prev")?jq(".pagination span.current").html():jq(l).html(),r=Number(r.replace(/\D/g,"")),jq(l).hasClass("next")?r++:jq(l).hasClass("prev")&&r--,(o=jq(".groups-members-search input")).length&&(a=o.val(),i="members"),"members"===i&&"groups"===t[1]&&(i="group_members",n="groups/single/members"),"admin"===i&&jq("body").hasClass("membership-requests")&&(i="requests"),c=-1!==s.indexOf("pag-bottom")?"pag-bottom":null;var d=bp_get_directory_preference(i,"scope");return bp_filter_request(i,bp_get_directory_preference(i,"filter"),d,"div."+i,a,r,bp_get_directory_preference(i,"extras"),c,n),!1}}),jq("#send-invite-form").on("click","#invite-list input",function(){var t,i,a=jq("#send-invite-form > .invite").length;jq(".ajax-loader").toggle(),a&&jq(this).parents("ul").find("input").prop("disabled",!0),t=jq(this).val(),i=!0===jq(this).prop("checked")?"invite":"uninvite",a||jq(".item-list-tabs li.selected").addClass("loading"),jq.post(ajaxurl,{action:"groups_invite_user",friend_action:i,cookie:bp_get_cookies(),_wpnonce:jq("#_wpnonce_invite_uninvite_user").val(),friend_id:t,group_id:jq("#group_id").val()},function(e){jq("#message")&&jq("#message").hide(),a?bp_filter_request("invite","bp-invite-filter","bp-invite-scope","div.invite",!1,1,"","",""):(jq(".ajax-loader").toggle(),"invite"===i?jq("#friend-list").append(e):"uninvite"===i&&jq("#friend-list li#uid-"+t).remove(),jq(".item-list-tabs li.selected").removeClass("loading"))})}),jq("#send-invite-form").on("click","a.remove",function(){var t=jq("#send-invite-form > .invite").length,i=jq(this).attr("id");return jq(".ajax-loader").toggle(),i=(i=i.split("-"))[1],jq.post(ajaxurl,{action:"groups_invite_user",friend_action:"uninvite",cookie:bp_get_cookies(),_wpnonce:jq("#_wpnonce_invite_uninvite_user").val(),friend_id:i,group_id:jq("#group_id").val()},function(e){t?bp_filter_request("invite","bp-invite-filter","bp-invite-scope","div.invite",!1,1,"","",""):(jq(".ajax-loader").toggle(),jq("#friend-list #uid-"+i).remove(),jq("#invite-list #f-"+i).prop("checked",!1))}),!1}),jq(".visibility-toggle-link").on("click",function(e){e.preventDefault(),jq(this).attr("aria-expanded","true").parent().hide().addClass("field-visibility-settings-hide").siblings(".field-visibility-settings").show().addClass("field-visibility-settings-open")}),jq(".field-visibility-settings-close").on("click",function(e){e.preventDefault(),jq(".visibility-toggle-link").attr("aria-expanded","false");var t=jq(this).parent(),i=t.find("input:checked").parent().text();t.hide().removeClass("field-visibility-settings-open").siblings(".field-visibility-settings-toggle").children(".current-visibility-level").text(i).end().show().removeClass("field-visibility-settings-hide")}),jq("#profile-edit-form input:not(:submit), #profile-edit-form textarea, #profile-edit-form select, #signup_form input:not(:submit), #signup_form textarea, #signup_form select").change(function(){var t=!0;jq("#profile-edit-form input:submit, #signup_form input:submit").on("click",function(){t=!1}),window.onbeforeunload=function(e){if(t)return BP_DTheme.unsaved_changes}}),jq("#friend-list a.accept, #friend-list a.reject").on("click",function(){var e,t=jq(this),i=jq(this).parents("#friend-list li"),a=jq(this).parents("li div.action"),s=i.attr("id").substr(11,i.attr("id").length),n=t.attr("href").split("_wpnonce=")[1];return jq(this).hasClass("accepted")||jq(this).hasClass("rejected")||(jq(this).hasClass("accept")?(e="accept_friendship",a.children("a.reject").css("visibility","hidden")):(e="reject_friendship",a.children("a.accept").css("visibility","hidden")),t.addClass("loading"),jq.post(ajaxurl,{action:e,cookie:bp_get_cookies(),id:s,_wpnonce:n},function(e){t.removeClass("loading"),e[0]+e[1]==="-1"?(i.prepend(e.substr(2,e.length)),i.children("#message").hide().fadeIn(200)):t.fadeOut(100,function(){jq(this).hasClass("accept")?(a.children("a.reject").hide(),jq(this).html(BP_DTheme.accepted).contents().unwrap()):(a.children("a.accept").hide(),jq(this).html(BP_DTheme.rejected).contents().unwrap())})})),!1}),jq("#members-dir-list, #members-group-list, #item-header").on("click",".friendship-button a",function(){if(!jq(this).hasClass("awaiting_response_friend")){jq(this).parent().addClass("loading");var e=jq(this).attr("id"),t=jq(this).attr("href"),i=jq(this);return e=(e=e.split("-"))[1],t=(t=(t=t.split("?_wpnonce="))[1].split("&"))[0],jq.post(ajaxurl,{action:"addremove_friend",cookie:bp_get_cookies(),fid:e,_wpnonce:t},function(e){var t=i.attr("rel");parentdiv=i.parent(),"add"===t?jq(parentdiv).fadeOut(200,function(){parentdiv.removeClass("add_friend"),parentdiv.removeClass("loading"),parentdiv.addClass("pending_friend"),parentdiv.fadeIn(200).html(e)}):"remove"===t&&jq(parentdiv).fadeOut(200,function(){parentdiv.removeClass("remove_friend"),parentdiv.removeClass("loading"),parentdiv.addClass("add"),parentdiv.fadeIn(200).html(e)})}),!1}}),jq("#youzify").on("click",".group-button .leave-group",function(){if(!1===confirm(BP_DTheme.leave_group_confirm))return!1}),jq("#groups-dir-list").on("click",".group-button a",function(){var e=jq(this).parent().attr("id"),t=jq(this).attr("href"),s=jq(this);return e=(e=e.split("-"))[1],t=(t=(t=t.split("?_wpnonce="))[1].split("&"))[0],s.hasClass("leave-group")&&!1===confirm(BP_DTheme.leave_group_confirm)||jq.post(ajaxurl,{action:"joinleave_group",cookie:bp_get_cookies(),gid:e,_wpnonce:t},function(i){var a=s.parent();jq("body.directory").length?jq(a).fadeOut(200,function(){a.fadeIn(200).html(i);var e=jq("#groups-personal span"),t=1;s.hasClass("leave-group")?(a.hasClass("hidden")&&a.closest("li").slideUp(200),t=0):s.hasClass("request-membership")&&(t=!1),e.length&&!1!==t&&(t?e.text(1+(e.text()>>0)):e.text((e.text()>>0)-1))}):window.location.reload()}),!1}),jq("#groups-list li.hidden").each(function(){"none"===jq(this).css("display")&&jq(this).css("cssText","display: list-item !important")}),jq("#youzify").on("click",".pending",function(){return!1}),jq("body").hasClass("register")){var t=jq("#signup_with_blog");t.prop("checked")||jq("#blog-details").toggle(),t.change(function(){jq("#blog-details").toggle()})}jq(".message-search").on("click",function(e){if(!jq(this).hasClass("no-ajax")){var t,i=jq(e.target);if("submit"===i.attr("type")||"button"===i.attr("type")){var a=bp_get_directory_preference(t="messages","scope"),s=bp_get_directory_preference(t,"filter"),n=bp_get_directory_preference(t,"extras");return bp_filter_request(t,s,a,"div."+t,jq("#messages_search").val(),1,n),!1}}}),jq("#send_reply_button").click(function(){var t=jq("#messages_order").val()||"ASC",i=jq("#message-recipients").offset(),a=jq("#send_reply_button");return jq(a).addClass("loading").prop("disabled",!0),jq.post(ajaxurl,{action:"messages_send_reply",cookie:bp_get_cookies(),_wpnonce:jq("#send_message_nonce").val(),content:jq("#message_content").val(),send_to:jq("#send_to").val(),subject:jq("#subject").val(),thread_id:jq("#thread_id").val()},function(e){e[0]+e[1]==="-1"?jq("#send-reply").prepend(e.substr(2,e.length)):(jq("#send-reply #message").remove(),jq("#message_content").val(""),"ASC"===t?jq("#send-reply").before(e):(jq("#message-recipients").after(e),jq(window).scrollTop(i.top)),jq(".new-message").hide().slideDown(200,function(){jq(".new-message").removeClass("new-message")})),jq(a).removeClass("loading").prop("disabled",!1)}),!1}),jq("body.messages #item-body div.messages").on("change","#message-type-select",function(){var e=this.value,t=jq('td input[type="checkbox"]'),i="checked";switch(t.each(function(e){t[e].checked=""}),e){case"unread":t=jq('tr.unread td input[type="checkbox"]');break;case"read":t=jq('tr.read td input[type="checkbox"]');break;case"":i=""}t.each(function(e){t[e].checked=i})}),jq("#select-all-messages").click(function(e){this.checked?jq(".message-check").each(function(){this.checked=!0}):jq(".message-check").each(function(){this.checked=!1})}),jq("#messages-bulk-manage").attr("disabled","disabled"),jq("#messages-select").on("change",function(){jq("#messages-bulk-manage").attr("disabled",jq(this).val().length<=0)}),starAction=function(){var t=jq(this);return jq.post(ajaxurl,{action:"messages_star",message_id:t.data("message-id"),star_status:t.data("star-status"),nonce:t.data("star-nonce"),bulk:t.data("star-bulk")},function(e){1===parseInt(e,10)&&("unstar"===t.data("star-status")?(t.data("star-status","star"),t.removeClass("message-action-unstar").addClass("message-action-star"),t.find(".bp-screen-reader-text").text(BP_PM_Star.strings.text_star),1===BP_PM_Star.is_single_thread?t.attr("data-bp-tooltip",BP_PM_Star.strings.title_star):t.attr("data-bp-tooltip",BP_PM_Star.strings.title_star_thread)):(t.data("star-status","unstar"),t.removeClass("message-action-star").addClass("message-action-unstar"),t.find(".bp-screen-reader-text").text(BP_PM_Star.strings.text_unstar),1===BP_PM_Star.is_single_thread?t.attr("data-bp-tooltip",BP_PM_Star.strings.title_unstar):t.attr("data-bp-tooltip",BP_PM_Star.strings.title_unstar_thread)))}),!1},jq("#message-threads").on("click","td.thread-star a",starAction),jq("#message-thread").on("click",".message-star-actions a",starAction),jq("#message-threads td.bulk-select-check :checkbox").on("change",function(){var e=jq(this),t=e.closest("tr").find(".thread-star a");e.prop("checked")?"unstar"===t.data("star-status")?BP_PM_Star.star_counter++:BP_PM_Star.unstar_counter++:"unstar"===t.data("star-status")?BP_PM_Star.star_counter--:BP_PM_Star.unstar_counter--,0<BP_PM_Star.star_counter&&0===parseInt(BP_PM_Star.unstar_counter,10)?jq('option[value="star"]').hide():jq('option[value="star"]').show(),0<BP_PM_Star.unstar_counter&&0===parseInt(BP_PM_Star.star_counter,10)?jq('option[value="unstar"]').hide():jq('option[value="unstar"]').show()}),jq("#select-all-notifications").click(function(e){this.checked?jq(".notification-check").each(function(){this.checked=!0}):jq(".notification-check").each(function(){this.checked=!1})}),jq("#notification-bulk-manage").attr("disabled","disabled"),jq("#notification-select").on("change",function(){jq("#notification-bulk-manage").attr("disabled",jq(this).val().length<=0)}),jq("#select-all-invitations").on("click",function(){this.checked?jq(".invitation-check").each(function(){this.checked=!0}):jq(".invitation-check").each(function(){this.checked=!1})}),jq("#invitation-bulk-manage").attr("disabled","disabled"),jq("#invitation-select").on("change",function(){jq("#invitation-bulk-manage").attr("disabled",jq(this).val().length<=0)}),jq("#close-notice").on("click",function(){return jq(this).addClass("loading"),jq("#sidebar div.error").remove(),jq.post(ajaxurl,{action:"messages_close_notice",notice_id:jq(".notice").attr("rel").substr(2,jq(".notice").attr("rel").length),nonce:jq("#close-notice-nonce").val()},function(e){jq("#close-notice").removeClass("loading"),e[0]+e[1]==="-1"?(jq(".notice").prepend(e.substr(2,e.length)),jq("#sidebar div.error").hide().fadeIn(200)):jq(".notice").slideUp(100)}),!1}),jq("#wp-admin-bar ul.main-nav li, #nav li").mouseover(function(){jq(this).addClass("sfhover")}),jq("#wp-admin-bar ul.main-nav li, #nav li").mouseout(function(){jq(this).removeClass("sfhover")}),jq("#wp-admin-bar-logout, a.logout").on("click",function(){jq.removeCookie("bp-activity-scope",{path:"/",secure:"https:"===window.location.protocol}),jq.removeCookie("bp-activity-filter",{path:"/",secure:"https:"===window.location.protocol}),jq.removeCookie("bp-activity-oldestpage",{path:"/",secure:"https:"===window.location.protocol});var t=["members","groups","blogs","forums"];jq(t).each(function(e){jq.removeCookie("bp-"+t[e]+"-scope",{path:"/",secure:"https:"===window.location.protocol}),jq.removeCookie("bp-"+t[e]+"-filter",{path:"/",secure:"https:"===window.location.protocol}),jq.removeCookie("bp-"+t[e]+"-extras",{path:"/",secure:"https:"===window.location.protocol})})}),jq("body").hasClass("no-js")&&jq("body").attr("class",jq("body").attr("class").replace(/no-js/,"js")),"undefined"!=typeof wp&&void 0!==wp.heartbeat&&void 0!==BP_DTheme.pulse&&(wp.heartbeat.interval(Number(BP_DTheme.pulse)),jq.fn.extend({"heartbeat-send":function(){return this.bind("heartbeat-send.buddypress")}}));var a=0;jq(document).on("heartbeat-send.buddypress",function(e,t){a=0,jq("#youzify ul.activity-list li").first().prop("id")&&(timestamp=jq("#youzify ul.activity-list li").first().prop("class").match(/date-recorded-([0-9]+)/),timestamp&&(a=timestamp[1])),(0===activity_last_recorded||Number(a)>activity_last_recorded)&&(activity_last_recorded=Number(a)),t.bp_activity_last_recorded=activity_last_recorded,last_recorded_search=bp_get_querystring("s"),last_recorded_search&&(t.bp_activity_last_recorded_search_terms=last_recorded_search)}),jq(document).on("heartbeat-tick",function(e,t){t.bp_activity_newest_activities&&(newest_activities=t.bp_activity_newest_activities.activities+newest_activities,activity_last_recorded=Number(t.bp_activity_newest_activities.last_recorded),jq("#youzify ul.activity-list li").first().hasClass("load-newest")||jq("#youzify ul.activity-list").prepend('<li class="load-newest"><a href="#newest">'+BP_DTheme.newest+"</a></li>"))})}});