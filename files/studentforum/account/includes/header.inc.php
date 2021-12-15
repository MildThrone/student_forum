<?php
    session_start();
    include "dbh/dbh.php";
    include "dbh/db_functions.php";
    // include "controls/db_functions.php";

    if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        header("Location: index.php?error=login");
        exit();
    }
    
?>




<!DOCTYPE html>
<html lang="en-US">
    

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=yes" />
        <title>Student Forum | <?php echo isset($page_title) ? $page_title : ""; ?></title>
        <meta name="robots" content="max-image-preview:large" />
        <link rel="dns-prefetch" href="http://fonts.googleapis.com/" />
        <link rel="dns-prefetch" href="http://s.w.org/" />
        <link rel="dns-prefetch" href="http://i0.wp.com/" />
        <link rel="dns-prefetch" href="http://i1.wp.com/" />
        <link rel="dns-prefetch" href="http://i2.wp.com/" />
        <link rel="dns-prefetch" href="http://c0.wp.com/" />
        <link rel="alternate" type="application/rss+xml" title="Profile Timeline &raquo; Feed" href="../feed/index.html" />
        <link rel="alternate" type="application/rss+xml" title="Profile Timeline &raquo; Comments Feed" href="../comments/feed/index.html" />




        <!-- custom bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">






        <style>
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 0.07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }
        </style>
        <link rel="stylesheet" id="wp-block-library-css" href="../../../c0.wp.com/c/5.8.1/wp-includes/css/dist/block-library/style.min.css" media="all" />
        <style id="wp-block-library-inline-css">
            .has-text-align-justify {
                text-align: justify;
            }
        </style>
        <link rel="stylesheet" id="bp-login-form-block-css" href="../wp-content/plugins/buddypress/bp-core/css/blocks/login-form.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-member-block-css" href="../wp-content/plugins/buddypress/bp-members/css/blocks/member.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-members-block-css" href="../wp-content/plugins/buddypress/bp-members/css/blocks/members.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-dynamic-members-block-css" href="../wp-content/plugins/buddypress/bp-members/css/blocks/dynamic-members.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-latest-activities-block-css" href="../wp-content/plugins/buddypress/bp-activity/css/blocks/latest-activities.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-friends-block-css" href="../wp-content/plugins/buddypress/bp-friends/css/blocks/friends.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-group-block-css" href="../wp-content/plugins/buddypress/bp-groups/css/blocks/group.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-groups-block-css" href="../wp-content/plugins/buddypress/bp-groups/css/blocks/groups.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-dynamic-groups-block-css" href="../wp-content/plugins/buddypress/bp-groups/css/blocks/dynamic-groups.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="bp-sitewide-notices-block-css" href="../wp-content/plugins/buddypress/bp-messages/css/blocks/sitewide-notices.mineba3.css?ver=9.1.1" media="all" />
        <link rel="stylesheet" id="mediaelement-css" href="../../../c0.wp.com/c/5.8.1/wp-includes/js/mediaelement/mediaelementplayer-legacy.min.css" media="all" />
        <link rel="stylesheet" id="wp-mediaelement-css" href="../../../c0.wp.com/c/5.8.1/wp-includes/js/mediaelement/wp-mediaelement.min.css" media="all" />
        <link rel="stylesheet" id="gamipress-css-css" href="../wp-content/plugins/gamipress/assets/css/gamipress.min3c94.css?ver=2.1.0" media="all" />
        <link rel="stylesheet" id="youzify-opensans-css" href="https://fonts.googleapis.com/css?family=Open+Sans%3A400%2C600&amp;ver=1.1.0" media="all" />
        <link rel="stylesheet" id="youzify-css" href="../wp-content/plugins/youzify/includes/public/assets/css/youzify.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="youzify-headers-css" href="../wp-content/plugins/youzify/includes/public/assets/css/youzify-headers.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="youzify-scheme-css" href="../wp-content/plugins/youzify/includes/public/assets/css/schemes/youzify-crimson-scheme.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="dashicons-css" href="../../../c0.wp.com/c/5.8.1/wp-includes/css/dashicons.min.css" media="all" />
        <link rel="stylesheet" id="youzify-social-css" href="../wp-content/plugins/youzify/includes/public/assets/css/youzify-social.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="youzify-icons-css" href="../wp-content/plugins/youzify/includes/admin/assets/css/all.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="youzify-customStyle-css" href="../wp-content/plugins/youzify/includes/admin/assets/css/custom-scriptf658.css?ver=5.8.1" media="all" />
        <style id="youzify-customStyle-inline-css">
            .youzify-hdr-v1 .youzify-cover-content .youzify-inner-content,
            #youzify-profile-navmenu .youzify-inner-content,
            .youzify-vertical-layout .youzify-content,
            .youzify .youzify-boxed-navbar,
            .youzify .wild-content,
            #youzify-members-directory,
            #youzify-groups-list,
            .youzify-page-main-content,
            .youzify-header-content,
            .youzify-cover-content {
                max-width: 1220px !important;
            }

            .youzify-page {
                background-color: #fdecdc !important;
            }

            .youzify-page {
                margin-top: -30px !important;
            }

            .youzify-page {
                margin-bottom: -30px !important;
            }
        </style>
        <link rel="stylesheet" id="th-wp-widget-styles-css" href="../wp-content/plugins/tophive-core/widgets/wordpress/assets/stylesf658.css?ver=5.8.1" media="all" />
        <link rel="stylesheet" id="th-elementor-css-css" href="../wp-content/plugins/tophive-core/widgets/elementor/assets/stylef658.css?ver=5.8.1" media="all" />
        <link rel="stylesheet" id="th-widget-css-css" href="../wp-content/plugins/tophive-core/widgets/tophiveWidgets/assets/css/frontendf658.css?ver=5.8.1" media="all" />
        <link rel="stylesheet" id="rich-text-quill-css-css" href="../wp-content/plugins/tophive-core/widgets/elementor/assets/quill.snowf658.css?ver=5.8.1" media="all" />
        <link rel="stylesheet" id="youzify-reviews-css" href="../wp-content/plugins/youzify/includes/public/assets/css/youzify-reviews.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="th-buddypress-css" href="../wp-content/themes/metafans/assets/css/compatibility/buddypressf658.css?ver=5.8.1" media="all" />
        <link rel="stylesheet" id="th-bbpress-css" href="../wp-content/themes/metafans/assets/css/compatibility/bbpressf658.css?ver=5.8.1" media="all" />
        <link rel="stylesheet" id="youzify-bbpress-css" href="../wp-content/plugins/youzify/includes/public/assets/css/youzify-bbpress.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="youzify-membership-css" href="../wp-content/plugins/youzify/includes/public/assets/css/youzify-membership.minf488.css?ver=1.1.0" media="all" />
        <link rel="stylesheet" id="youzify-membership-customStyle-css" href="../wp-content/plugins/youzify/includes/admin/assets/css/custom-scriptf658.css?ver=5.8.1" media="all" />
        <link rel="stylesheet" id="elementor-icons-css" href="../wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.minb683.css?ver=5.12.0" media="all" />
        <link rel="stylesheet" id="elementor-frontend-css" href="../wp-content/plugins/elementor/assets/css/frontend.mincd45.css?ver=3.4.3" media="all" />
        <style id="elementor-frontend-inline-css">
            @font-face {
                font-family: eicons;
                src: url(../wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons0b93.eot?5.10.0);
                src: url(https://metafans.tophivetheme.com/profile-timeline/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.eot?5.10.0#iefix) format("embedded-opentype"),
                    url(https://metafans.tophivetheme.com/profile-timeline/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff2?5.10.0) format("woff2"),
                    url(https://metafans.tophivetheme.com/profile-timeline/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff?5.10.0) format("woff"),
                    url(https://metafans.tophivetheme.com/profile-timeline/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.ttf?5.10.0) format("truetype"),
                    url(https://metafans.tophivetheme.com/profile-timeline/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.svg?5.10.0#eicon) format("svg");
                font-weight: 400;
                font-style: normal;
            }
        </style>
        <link rel="stylesheet" id="elementor-post-31-css" href="../wp-content/uploads/sites/2/elementor/css/post-31095c.css?ver=1631297474" media="all" />
        <link rel="stylesheet" id="elementor-global-css" href="../wp-content/uploads/sites/2/elementor/css/global095c.css?ver=1631297474" media="all" />
        <link rel="stylesheet" id="elementor-post-2500-css" href="../wp-content/uploads/sites/2/elementor/css/post-250072de.css?ver=1631305482" media="all" />
        <link rel="stylesheet" id="mc-google-fonts-css" href="https://fonts.googleapis.com/css2?family=Roboto%3Awght%40300%3B400%3B500%3B700&amp;display=swap&amp;ver=5.8.1" media="all" />
        <link rel="stylesheet" id="font-awesome-css" href="../wp-content/plugins/elementor/assets/lib/font-awesome/css/font-awesome.min1849.css?ver=4.7.0" media="all" />
        <link rel="stylesheet" id="tophive-google-font-css" href="http://fonts.googleapis.com/css?family=Open+Sans%3A300%2C300i%2C400%2C400i%2C600%2C600i%2C700%2C700i%2C800%2C800i&amp;ver=2.4.0" media="all" />
        <link rel="stylesheet" id="tophive-style-css" href="../wp-content/themes/metafans/style.min8d5a.css?ver=2.4.0" media="all" />

        <link rel="stylesheet" href="css/style.css" />

        <link rel="stylesheet" id="tophive-themify-icons-css" href="../wp-content/themes/metafans/assets/fonts/themify/css/themify-icons8d5a.css?ver=2.4.0" media="all" />
        <link rel="stylesheet" id="tophive-tophive-pro-a0043cf3fa56da5b5659622aa83c1908-css" href="../wp-content/uploads/sites/2/tophive-pro/tophive-pro-a0043cf3fa56da5b5659622aa83c19088be4.css?ver=20211008033827" media="all" />
        <link
            rel="stylesheet"
            id="google-fonts-1-css"
            href="https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7COpen+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=auto&amp;ver=5.8.1"
            media="all"
        />
        <link rel="stylesheet" id="elementor-icons-shared-0-css" href="../wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min52d5.css?ver=5.15.3" media="all" />
        <link rel="stylesheet" id="elementor-icons-fa-regular-css" href="../wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min52d5.css?ver=5.15.3" media="all" />
        <link rel="stylesheet" id="elementor-icons-fa-solid-css" href="../wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min52d5.css?ver=5.15.3" media="all" />
        <link rel="stylesheet" id="jetpack_css-css" href="../../../c0.wp.com/p/jetpack/10.1/css/jetpack.css" media="all" />
        <script src="../../../c0.wp.com/c/5.8.1/wp-includes/js/jquery/jquery.min.js" id="jquery-core-js"></script>
        <script src="../../../c0.wp.com/c/5.8.1/wp-includes/js/jquery/jquery-migrate.min.js" id="jquery-migrate-js"></script>
        <script id="bp-confirm-js-extra">
            var BP_Confirm = { are_you_sure: "Are you sure?" };
        </script>
        <script src="../wp-content/plugins/buddypress/bp-core/js/confirm.mineba3.js?ver=9.1.1" id="bp-confirm-js"></script>
        <script src="../wp-content/plugins/buddypress/bp-core/js/widget-members.mineba3.js?ver=9.1.1" id="bp-widget-members-js"></script>
        <script src="../wp-content/plugins/buddypress/bp-core/js/jquery-query.mineba3.js?ver=9.1.1" id="bp-jquery-query-js"></script>
        <script src="../wp-content/plugins/buddypress/bp-core/js/vendor/jquery-cookie.mineba3.js?ver=9.1.1" id="bp-jquery-cookie-js"></script>
        <script src="../wp-content/plugins/buddypress/bp-core/js/vendor/jquery-scroll-to.mineba3.js?ver=9.1.1" id="bp-jquery-scroll-to-js"></script>
        <script id="bp-legacy-js-js-extra">
            var BP_DTheme = {
                accepted: "Accepted",
                close: "Close",
                comments: "comments",
                leave_group_confirm: "Are you sure you want to leave this group?",
                mark_as_fav: "Like",
                my_favs: "My Favorites",
                rejected: "Rejected",
                remove_fav: "Unlike",
                show_all: "Show all",
                show_all_comments: "Show all comments for this thread",
                show_x_comments: "Show all comments (%d)",
                unsaved_changes: "Your profile has unsaved changes. If you leave the page, the changes will be lost.",
                view: "View",
                store_filter_settings: "",
            };
        </script>
        <script src="../wp-content/plugins/youzify/includes/public/assets/js/buddypress.mineba3.js?ver=9.1.1" id="bp-legacy-js-js"></script>
        <script src="../wp-content/plugins/buddypress/bp-groups/js/widget-groups.mineba3.js?ver=9.1.1" id="groups_widget_groups_list-js-js"></script>
        <script src="../wp-content/plugins/tophive-core/widgets/elementor/assets/jquery.lazy.minf658.js?ver=5.8.1" id="th-elementor-lazy-js-js"></script>
        <script src="../wp-content/plugins/tophive-core/widgets/tophiveWidgets/assets/js/frontendf658.js?ver=5.8.1" id="th-widget-js-js"></script>
        <script src="../wp-content/plugins/tophive-core/widgets/elementor/assets/quill.min8603.js?ver=4.0.6" id="rich-text-quill-js"></script>
        <script src="../wp-content/plugins/tophive-core/widgets/elementor/assets/scriptf658.js?ver=5.8.1" id="th-elementor-js-js"></script>
        <script src="../wp-content/themes/metafans/assets/js/compatibility/buddypressf658.js?ver=5.8.1" id="th-buddyrpess-js"></script>
        <link rel="https://api.w.org/" href="../wp-json/index.html" />
        <link rel="alternate" type="application/json" href="../wp-json/wp/v2/pages/2500.json" />
        <link rel="EditURI" type="application/rsd+xml" title="RSD" href="../xmlrpc0db0.php?rsd" />
        <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="../wp-includes/wlwmanifest.xml" />
        <meta name="generator" content="WordPress 5.8.1" />
        <link rel="canonical" href="index.html" />
        <link rel="shortlink" href="../index118f.html?p=2500" />
        <link rel="alternate" type="application/json+oembed" href="../wp-json/oembed/1.0/embedd79f.json?url=https%3A%2F%2Fmetafans.tophivetheme.com%2Fprofile-timeline%2Fforum%2F" />
        <link rel="alternate" type="text/xml+oembed" href="../wp-json/oembed/1.0/embed1498?url=https%3A%2F%2Fmetafans.tophivetheme.com%2Fprofile-timeline%2Fforum%2F&amp;format=xml" />

        <script type="text/javascript">
            var ajaxurl = "../wp-admin/admin-ajax.html";
        </script>

        <style type="text/css">
            img#wpstats {
                display: none;
            }
        </style>
        <style type="text/css">
            /* If html does not have either class, do not show lazy loaded images. */
            html:not(.jetpack-lazy-images-js-enabled):not(.js) .jetpack-lazy-image {
                display: none;
            }
        </style>
        <script>
            document.documentElement.classList.add("jetpack-lazy-images-js-enabled");
        </script>
        <link rel="icon" href="img/logo.png" sizes="32x32" />
        <link rel="icon" href="img/logo.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="img/logo.png" />
        <meta name="msapplication-TileImage" content="https://i2.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/fav-9.png?fit=260%2C260&#038;ssl=1" />
    </head>

    <body
        class="bp-legacy page-template-default page page-id-2500 wp-custom-logo youzify-crimson-scheme not-logged-in content main-layout-content site-full-width menu_sidebar_slide_left no-cookie-bar woo_bootster_search elementor-default elementor-kit-31 elementor-page elementor-page-2500 no-js"
    >
        <div id="page" class="site box-shadow footer-relative">
            <a class="skip-link screen-reader-text" href="#site-content">Skip to content</a>
            <header id="masthead" class="site-header header-v2">
                <div id="masthead-inner" class="site-header-inner">
                    <div class="header-main header--row layout-full-contained" id="cb-row--header-main" data-row-id="main" data-show-on="desktop mobile">
                        <div class="header--row-inner header-main-inner light-mode">
                            <div class="tophive-container">
                                <div class="tophive-grid cb-row--desktop hide-on-mobile hide-on-tablet tophive-grid-middle">
                                    <div class="row-v2 row-v2-main no-center">
                                        <div class="col-v2 col-v2-left">
                                            <div class="item--inner builder-item--logo" data-section="title_tagline" data-item-id="logo">
                                                <div class="site-branding logo-top no-tran-logo no-sticky-logo">
                                                    <a href="../index.html" class="logo-link" rel="home">
                                                        <img
                                                            class="site-img-logo"
                                                            src="img/logo3.png"
                                                            alt="School Logo"
                                                        />
                                                    </a>
                                                </div>
                                                <!-- .site-branding -->
                                            </div>
                                            <div class="item--inner builder-item--primary-menu has_menu" data-section="header_menu_primary" data-item-id="primary-menu">
                                                <nav class="site-navigation-main-desktop site-navigation primary-menu primary-menu-main nav-menu-desktop primary-menu-desktop style-plain">
                                                    <ul id="site-navigation-main-desktop-primary-menu" class="primary-menu-ul menu nav-menu">
                                                        <li id="menu-item--main-desktop-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-40 <?php if($page_title=='Home'){echo 'current-menu-item page_item page-item-2500 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor';} ?>">
                                                            <a href="home.php"><span class="link-before">Home</span></a>
                                                        </li>

                                                        <!-- <li id="menu-item--main-desktop-41" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-41">
                                                            <a href="whats_new.php"><span class="link-before">What's new</span></a>
                                                        </li>
                                                        <li id="menu-item--main-desktop-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-42">
                                                            <a href="forums.php"><span class="link-before">Forums</span></a>
                                                        </li> -->

                                                        


                                                        <li id="menu-item--main-desktop-2517" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2517">
                                                            <a href="new_post.php"><span class="link-before">Post</span></a>
                                                        </li>

                                                        <li id="menu-item--main-desktop-41" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-41">
                                                            <a href="profile.php"><span class="link-before">Profile</span></a>
                                                        </li>
                                                        <li id="menu-item--main-desktop-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-42">
                                                            <a href="logout.php"><span class="link-before">Logout</span></a>
                                                        </li>
                                                        <li>
                                                            <form action="search.php" method="GET">
                                                                <input name="query">
                                                                <button type="submit"><i class="fas fa-search"></i></button>
                                                            </form>
                                                        </li>

                                                        <!-- <li
                                                            id="menu-item--main-desktop-2507"
                                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-2507"
                                                        >
                                                            <a href="index.html" aria-current="page">
                                                                <span class="link-before">Account<span class="nav-icon-angle">&nbsp;</span></span>
                                                            </a>
                                                            <ul class="sub-menu sub-lv-0">
                                                                <li
                                                                    id="menu-item--main-desktop-2515"
                                                                    class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-2500 current_page_item menu-item-2515"
                                                                >
                                                                    <a href="profile.php" aria-current="page"><span class="link-before">Profile</span></a>
                                                                </li>
                                                                <li id="menu-item--main-desktop-2510" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2510">
                                                                    <a href="logout.php"><span class="link-before">Logout</span></a>
                                                                </li>
                                                                
                                                            </ul>
                                                        </li> -->
                                                        
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="col-v2 col-v2-right">
                                            <div class="item--inner builder-item--social_search_box" data-section="social_search_box" data-item-id="social_search_box">
                                                <div class="header-social_search_box-item item--social_search_box">
                                                    <form role="search" class="header-search-form no_select_cats" action="">
                                                        <!-- <div class="search-form-fields">
                                                            <span class="screen-reader-text">Search for:</span>

                                                            <input style="color:black !important;" autocomplete="off" type="search" class="search-field" placeholder="Search community"  name="search_community" title="Search for:" />
                                                        </div> -->
                                                        Welcome, <?php echo $_SESSION['first_name']. " " . $_SESSION['other_names']; ?>
                                                        
                                                    </form>
                                                    <!-- <div class="search-box-result"><p class="ec-mb-0">Search result</p></div> -->
                                                </div>
                                            </div>
                                            <div class="item--inner builder-item--signin_signup" data-section="signin_signup" data-item-id="signin_signup">
                                                <div class="header-signin_signup-item item--signin_signup">
                                                    <div class="user-account-segment">
                                                        <a href="logout.php" class="ec-d-flex signin-items"><button class="button button-signin">Logout</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cb-row--mobile hide-on-desktop tophive-grid tophive-grid-middle">
                                    <div class="row-v2 row-v2-main no-center">
                                        <div class="col-v2 col-v2-left">
                                            <div class="item--inner builder-item--nav-icon" data-section="header_menu_icon" data-item-id="nav-icon">
                                                <a class="menu-mobile-toggle item-button is-size-desktop-small is-size-tablet-medium is-size-mobile-small">
                                                    <span class="hamburger hamburger--squeeze">
                                                        <span class="hamburger-box">
                                                            <span class="hamburger-inner"></span>
                                                        </span>
                                                    </span>
                                                    <span class="nav-icon--label hide-on-tablet hide-on-mobile"></span>
                                                </a>
                                            </div>
                                            <div class="item--inner builder-item--logo" data-section="title_tagline" data-item-id="logo">
                                                <div class="site-branding logo-top no-tran-logo no-sticky-logo">
                                                    <a href="../index.html" class="logo-link" rel="home">
                                                        <img
                                                            class="site-img-logo"
                                                            src="../../../i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/Logo-041ab3a.png?fit=665%2C167&amp;ssl=1"
                                                            alt="Profile Timeline"
                                                        />
                                                    </a>
                                                </div>
                                                <!-- .site-branding -->
                                            </div>
                                        </div>
                                        <div class="col-v2 col-v2-right">
                                            <div class="item--inner builder-item--signin_signup" data-section="signin_signup" data-item-id="signin_signup">
                                                <div class="header-signin_signup-item item--signin_signup">
                                                    <div class="user-account-segment">
                                                        <div class="ec-d-flex signin-items"><button class="button button-signin show-signin-form-modal">Sign In</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="header-menu-sidebar" class="header-menu-sidebar menu-sidebar-panel dark-mode">
                        <div id="header-menu-sidebar-bg" class="header-menu-sidebar-bg">
                            <div id="header-menu-sidebar-inner" class="header-menu-sidebar-inner">
                                <a class="close is-size-medium close-panel close-sidebar-panel" href="#">
                                    <span class="hamburger hamburger--squeeze">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"><span class="screen-reader-text">Menu</span></span>
                                        </span>
                                    </span>
                                    <span class="screen-reader-text">Close</span>
                                </a>
                                <div class="builder-item-sidebar mobile-item--primary-menu mobile-item--menu">
                                    <div class="item--inner" data-item-id="primary-menu" data-section="header_menu_primary">
                                        <nav class="site-navigation-sidebar-mobile site-navigation primary-menu primary-menu-sidebar nav-menu-mobile primary-menu-mobile style-plain">
                                            <ul id="site-navigation-sidebar-mobile-primary-menu" class="primary-menu-ul menu nav-menu">
                                                <li id="menu-item--sidebar-mobile-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-40">
                                                    <a href="home.php"><span class="link-before">Home</span></a>
                                                </li>
                                                <li id="menu-item--sidebar-mobile-41" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-41">
                                                    <a href="whats_new.php"><span class="link-before">What's New</span></a>
                                                </li>
                                                <li id="menu-item--sidebar-mobile-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-42">
                                                    <a href="forums.php"><span class="link-before">Forums</span></a>
                                                </li>
                                                <li id="menu-item--sidebar-mobile-2517" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2517">
                                                    <a href="new-post.php"><span class="link-before">Post</span></a>
                                                </li>
                                                <li
                                                    id="menu-item--sidebar-mobile-2507"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-2500 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-2507"
                                                >
                                                    <a href="#" aria-current="page">
                                                        <span class="link-before">Account<span class="nav-icon-angle">&nbsp;</span></span>
                                                    </a>
                                                    <ul class="sub-menu sub-lv-0">
                                                        <li id="menu-item--sidebar-mobile-2515" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-2500 current_page_item menu-item-2515">
                                                            <a href="profile.php" aria-current="page"><span class="link-before">Profile</span></a>
                                                        </li>
                                                        <li id="menu-item--sidebar-mobile-2510" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2510">
                                                            <a href="logout.php"><span class="link-before">Logout</span></a>
                                                        </li>
                                                        
                                                    </ul>
                                                </li>
                                                
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="footer ec-d-flex ec-justify-content-between"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="tophive-popup-modal" id="tophive-signin-signup">
                <div class="tophive-popup-content-wrapper">
                    <span class="ec-float-right tophive-popup-modal-close">
                        <a href="#">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z" />
                                <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z" />
                            </svg>
                        </a>
                    </span>
                    <div class="ec-d-block login-segment">
                        <h3 class="ec-text-center ec-mb-4">Sign in</h3>
                        <p class="ec-text-center ec-mb-2"></p>
                        <form name="th-modal-login" class="th-modal-login" method="post">
                            <p class="ec-text-center login-notices"></p>
                            <ul class="form-fields">
                                <li>
                                    <div class="th-form-field">
                                        <div class="th-form-field">
                                            <label for="username">Email </label>
                                        </div>
                                        <div class="th-form-field">
                                            <input size="30" placeholder="Email" type="text" required="required" id="username" class="" name="email" />
                                        </div>
                                    </div>
                                </li>
                                <li class="form-field">
                                    <div class="th-form-field">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="th-form-field">
                                        <input size="30" placeholder="Password" type="password" required="required" id="password" class="th-form-field" name="password" />
                                    </div>
                                </li>
                            </ul>

                            <p>
                                <label>
                                    <input type="checkbox" name="rememberme" />
                                    Remember me
                                </label>
                                <a class="ec-float-right" href="../lost-password/index.html?action=lostpassword">Lost your password?</a>
                            </p>
                            <p class="ec-mx-4">
                                <input type="hidden" name="th-modal-login-nonce" value="e858d0f292" />
                                <button type="submit" class="components-button tophive-infinity-button">Login</button>
                            </p>
                            <!-- <p class="ec-mb-0 ec-text-center">
                                Registration is disabled
                            </p> -->
                        </form>
                        <p class="ec-text-center ec-mt-3"></p>
                    </div>
                </div>
            </div>