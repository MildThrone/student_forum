<?php

    $page_title = "Topic";

	if(!isset($_GET['topic_id']) || empty($_GET['topic_id'])) {

		// redirect to home
		header("Location: home.php");
		exit();
	}
	else {

		include "includes/header.inc.php";

		// get forum id
		$topic_id = trim($_GET['topic_id']);

		// get topic details
		$topic = select_all_where('topics', 'topic_id', $topic_id);

		$topic_title = $topic[0]['topic_title'];
		$description = $topic[0]['description'];
		$forum_id = $topic[0]['forum_id'];
		$user_id = $topic[0]['user_id'];
		$date_posted_raw = $topic[0]['date_posted'];
		$date_posted = date("d M Y, h:i a", strtotime($topic[0]['date_posted']));

		// get the details of user who created the topic
		$user = select_all_where('users', 'id', $user_id);
		$user_firstname = $user[0]['first_name'];
		$user_pic = $user[0]['profile_pic'];
        $user_type = $user[0]['type'];

		// get forum details
		$forum = select_all_where('forums', 'forum_id', $forum_id);
		$forum_name = $forum[0]['forum_name'];

	}

?>








            <div id="site-content" class="content-md-space site-content">
                <div class="tophive-container">
                    <div class="tophive-grid">
                        <main id="main" class="content-area tophive-col-12">



						<?php


							if(isset($_GET['add']) && $_GET['add']=='success') {
																																							
								echo '<div class="alert alert-success fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>Reply submitted successfully.</p>
											</div>';
										
							}

							if(isset($_GET['error'])) {
								$error = $_GET['error'];

								switch ($error) {
									case 'empty':
										echo '<div class="alert alert-danger fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>All fields are required to reply.</p>
											</div>';
										break;

									case 'failed':
										echo '<div class="alert alert-danger fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>An error ocured, could not reply. Please try again.</p>
											</div>';
										break;
									
									default:
										# code...
										break;
								}
																																
								
										
							}

						?>










                            <div class="youzify youzify-page youzify-forum youzify-wild-content youzify-tabs-list-colorful youzify-page-btns-border-oval youzify-wg-border-radius">
                                <main class="youzify-page-main-content">
                                    <div class="youzify-main-column">
                                        <div id="bbpress-forums">
                                            <div class="youzify-bbp-topic-head">
                                                <div class="bbp-breadcrumb">
                                                    <p>
                                                        <a href="home.php" class="bbp-breadcrumb-home">Home</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span>
                                                        <a href="#" class="bbp-breadcrumb-root">Forums</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span>
                                                        <a href="forum.php?id=<?php echo $forum_id; ?>" class="bbp-breadcrumb-forum"><?php echo $forum_name; ?></a> <span class="bbp-breadcrumb-sep">&rsaquo;</span>
                                                        <a href="#" class="bbp-breadcrumb-forum"><?php echo $topic_title; ?></a> <span class="bbp-breadcrumb-sep">&rsaquo;</span>
                                                        <span class="bbp-breadcrumb-current"><?php echo $topic_title; ?></span>
                                                    </p>
                                                </div>
                                                <div class="youzify-bbp-topic-head-meta">
                                                    <div class="youzify-bbp-topic-head-meta-item youzify-bbp-head-meta-last-updated">
                                                        topic created by
                                                        <a href="#" title="" class="bbp-author-link">
                                                            <span class="bbp-author-avatar">
                                                                <img
                                                                    alt
                                                                    src="img/<?php echo $user_pic; ?>"
                                                                    class="avatar avatar-20 photo jetpack-lazy-image"
                                                                    height="20"
                                                                    width="20"
                                                                    loading="lazy"/>
																	
                                                            </span>
                                                            <span class="bbp-author-name"><?php echo $user_firstname; ?></span>
                                                        </a>
                                                        <a href="#" title=""><?php echo $date_posted; ?></a>
                                                    </div>
                                                    <div class="youzify-bbp-topic-head-meta-item"><i class="fas fa-microphone-alt"></i>1 voice</div>
                                                    <div class="youzify-bbp-topic-head-meta-item"><i class="far fa-comments"></i><?php echo no_of_rows_where('replies', 'topic_id', $topic_id); ?> replies</div>
                                                </div>
                                            </div>

                                            <ul id="topic-2768-replies" class="forums bbp-replies">
                                                <li class="bbp-header">
                                                    <div class="bbp-reply-author">Author</div>
                                                    <!-- .bbp-reply-author -->

                                                    <div class="bbp-reply-content">
                                                        <span class="youzify-single-topic-lead-title">Posts</span>
                                                    </div>
                                                    <!-- .bbp-reply-content -->
                                                </li>
                                                <!-- .bbp-header -->

                                                <li class="bbp-body">
                                                    <div id="post-2768" class="bbp-reply-header">
                                                        <div class="bbp-meta">
                                                            <span class="bbp-reply-post-date"><i class="far fa-calendar-alt"></i><?php echo date("F d, Y", strtotime($date_posted_raw)). " at " . date("h:i a", strtotime($date_posted_raw)); ?></span>

                                                            <a href="#new-topic-0" class="bbp-reply-permalink">Reply</a>

                                                            <span class="bbp-admin-links"></span>
                                                        </div>
                                                        <!-- .bbp-meta -->
                                                    </div>
                                                    <!-- #post-2768 -->

                                                    <div class="loop-item-0 user-id-1 bbp-parent-forum-67 bbp-parent-topic-75 bbp-reply-position-1 odd topic-author post-2768 topic type-topic status-publish hentry topic-tag-envato-elements">
                                                        <div class="bbp-reply-author">
                                                            <a href="#" title="" class="bbp-author-link">
                                                                <span class="bbp-author-avatar">
                                                                    <img
                                                                        alt
                                                                        src="img/<?php echo $user_pic; ?>"
                                                                        class="avatar avatar-80 photo jetpack-lazy-image"
                                                                        height="80"
                                                                        width="80"
                                                                        loading="lazy"
																		/>
																		
                                                                </span>
                                                                <span class="bbp-author-name"><?php echo $user_firstname; ?></span>
                                                            </a>
                                                            <div class="bbp-author-role"><?php echo $user_type; ?></div>

                                                            

                                                            <div class="gamipress-bbpress-achievements">
                                                                <div class="gamipress-bbpress-achievement gamipress-bbpress-badges">
                                                                    <span title="" class="gamipress-bbpress-achievement-thumbnail gamipress-bbpress-badges-thumbnail">
                                                                        <img
                                                                            width="25"
                                                                            height="25"
                                                                            src="../../../i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329db93.png?fit=25%2C25&amp;ssl=1"
                                                                            class="gamipress-achievement-thumbnail wp-post-image jetpack-lazy-image"
                                                                            alt
                                                                            loading="lazy"
																			/>
                                                                        
																			
                                                                    </span>

                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                        <!-- .bbp-reply-author -->

                                                        <div class="bbp-reply-content">
                                                            <?php echo $description; ?>
                                                        </div>
                                                        <!-- .bbp-reply-content -->
														
                                                    </div>




                                                    <!-- .replies -->

													<?php
														$replies = select_all_where('replies', 'topic_id', $topic_id);

														if(count($replies) < 1) {
															echo '<div class="bbp-reply-content" style="text-align:center !important;">
																	There are no replies for this topic yet. <a href="#new-topic-0">Post a reply now.</a>
																</div>';
															
														} else {
															foreach ($replies as $reply) {

																// get reply details
																$date_replied = $reply['date_posted'];
																$reply_description = $reply['description'];
																$reply_user_id = $reply['user_id'];
                                                                $reply_id = $reply['reply_id'];

																// get reply user details
																$reply_user = select_all_where('users', 'id', $reply_user_id);
																$reply_user_first_name = $reply_user[0]['first_name'];
																$reply_user_profile_pic = $reply_user[0]['profile_pic'];

																?>
																
																<div id="post-2798" class="bbp-reply-header">
																	<div class="bbp-meta">
																		<span class="bbp-reply-post-date"><i class="far fa-calendar-alt"></i><?php echo date("F d, Y", strtotime($date_replied)). " at " . date("h:i a", strtotime($date_replied)); ?></span>

																		<!-- <a href="#new-topic-0">Reply</a> -->
                                                                        <?php
                                                                            if (user_liked($reply_id) == false) {
                                                                                ?>
                                                                                    <span><a href="controls/like.php?reply_id=<?php echo $reply_id; ?>" ><i class="far fa-heart ml-2" style="font-size: 12px;"></i> Like</span>
                                                                                <?php
                                                                            }
                                                                        ?>

                                                                        <span><?php echo no_of_rows_where('reply_likes', 'reply_id', $reply_id); ?> likes</span>

																		<span class="bbp-admin-links"></span>
																	</div>
																	
																</div>



																<div class="loop-item-1 user-id-12 bbp-parent-forum-75 bbp-parent-topic-2768 bbp-reply-position-2 even post-2798 reply type-reply status-publish hentry">
																	<div class="bbp-reply-author">
																		<a href="#" title="" class="bbp-author-link">
																			<span class="bbp-author-avatar">
																				<img
																					alt
																					src="img/<?php echo $reply_user_profile_pic; ?>"
																					class="avatar avatar-80 photo jetpack-lazy-image"
																					height="80"
																					width="80"
																					loading="lazy"
																					/>
																			</span>
																			<span class="bbp-author-name"><?php echo $reply_user_first_name; ?></span>
																		</a>
																		<div class="bbp-author-role"><?php echo $user_type; ?></div>

																		

																		<div class="gamipress-bbpress-achievements">
																			<div class="gamipress-bbpress-achievement gamipress-bbpress-badges">
																				<span title="" class="gamipress-bbpress-achievement-thumbnail gamipress-bbpress-badges-thumbnail">
																					<img
																						width="25"
																						height="25"
																						src="../../../i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329db93.png?fit=25%2C25&amp;ssl=1"
																						class="gamipress-achievement-thumbnail wp-post-image jetpack-lazy-image"
																						alt
																						loading="lazy"
																						data-lazy-srcset="https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?w=512&amp;ssl=1 512w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=300%2C300&amp;ssl=1 300w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=150%2C150&amp;ssl=1 150w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=50%2C50&amp;ssl=1 50w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=100%2C100&amp;ssl=1 100w"
																						data-lazy-sizes="(max-width: 25px) 100vw, 25px"
																						data-lazy-src="https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?fit=25%2C25&amp;ssl=1&amp;is-pending-load=1"
																						srcset="data:image/gif;base64, R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
																					/>
																					<noscript>
																						<img
																							width="25"
																							height="25"
																							src="../../../i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329db93.png?fit=25%2C25&amp;ssl=1"
																							class="gamipress-achievement-thumbnail wp-post-image"
																							alt=""
																							loading="lazy"
																							srcset="
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?w=512&amp;ssl=1            512w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=300%2C300&amp;ssl=1 300w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=150%2C150&amp;ssl=1 150w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=50%2C50&amp;ssl=1    50w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_swarm_2155329.png?resize=100%2C100&amp;ssl=1 100w
																							"
																							sizes="(max-width: 25px) 100vw, 25px"
																						/>
																					</noscript>
																				</span>

																				<span title="Participant" class="gamipress-bbpress-achievement-thumbnail gamipress-bbpress-badges-thumbnail">
																					<img
																						width="25"
																						height="25"
																						src="../../../i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1db93.png?fit=25%2C25&amp;ssl=1"
																						class="gamipress-achievement-thumbnail wp-post-image jetpack-lazy-image"
																						alt
																						loading="lazy"
																						data-lazy-srcset="https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?w=512&amp;ssl=1 512w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=300%2C300&amp;ssl=1 300w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=150%2C150&amp;ssl=1 150w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=50%2C50&amp;ssl=1 50w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=100%2C100&amp;ssl=1 100w"
																						data-lazy-sizes="(max-width: 25px) 100vw, 25px"
																						data-lazy-src="https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?fit=25%2C25&amp;ssl=1&amp;is-pending-load=1"
																						srcset="data:image/gif;base64, R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
																					/>
																					<noscript>
																						<img
																							width="25"
																							height="25"
																							src="../../../i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1db93.png?fit=25%2C25&amp;ssl=1"
																							class="gamipress-achievement-thumbnail wp-post-image"
																							alt=""
																							loading="lazy"
																							srcset="
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?w=512&amp;ssl=1            512w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=300%2C300&amp;ssl=1 300w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=150%2C150&amp;ssl=1 150w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=50%2C50&amp;ssl=1    50w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/hexagon-1-1.png?resize=100%2C100&amp;ssl=1 100w
																							"
																							sizes="(max-width: 25px) 100vw, 25px"
																						/>
																					</noscript>
																				</span>

																				<span title="Networker" class="gamipress-bbpress-achievement-thumbnail gamipress-bbpress-badges-thumbnail">
																					<img
																						width="25"
																						height="25"
																						src="../../../i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783db93.png?fit=25%2C25&amp;ssl=1"
																						class="gamipress-achievement-thumbnail wp-post-image jetpack-lazy-image"
																						alt
																						loading="lazy"
																						data-lazy-srcset="https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?w=512&amp;ssl=1 512w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=300%2C300&amp;ssl=1 300w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=150%2C150&amp;ssl=1 150w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=50%2C50&amp;ssl=1 50w, https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=100%2C100&amp;ssl=1 100w"
																						data-lazy-sizes="(max-width: 25px) 100vw, 25px"
																						data-lazy-src="https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?fit=25%2C25&amp;ssl=1&amp;is-pending-load=1"
																						srcset="data:image/gif;base64, R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
																					/>
																					<noscript>
																						<img
																							width="25"
																							height="25"
																							src="../../../i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783db93.png?fit=25%2C25&amp;ssl=1"
																							class="gamipress-achievement-thumbnail wp-post-image"
																							alt=""
																							loading="lazy"
																							srcset="
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?w=512&amp;ssl=1            512w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=300%2C300&amp;ssl=1 300w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=150%2C150&amp;ssl=1 150w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=50%2C50&amp;ssl=1    50w,
																								https://i1.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/iconfinder_pinboard-hexagon-social-media_764783.png?resize=100%2C100&amp;ssl=1 100w
																							"
																							sizes="(max-width: 25px) 100vw, 25px"
																						/>
																					</noscript>
																				</span>

																				<span title="Helper" class="gamipress-bbpress-achievement-thumbnail gamipress-bbpress-badges-thumbnail">
																					<img
																						width="25"
																						height="25"
																						src="../../../i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/valuedb93.png?fit=25%2C25&amp;ssl=1"
																						class="gamipress-achievement-thumbnail wp-post-image jetpack-lazy-image"
																						alt
																						loading="lazy"
																						data-lazy-srcset="https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?w=512&amp;ssl=1 512w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=300%2C300&amp;ssl=1 300w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=150%2C150&amp;ssl=1 150w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=50%2C50&amp;ssl=1 50w, https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=100%2C100&amp;ssl=1 100w"
																						data-lazy-sizes="(max-width: 25px) 100vw, 25px"
																						data-lazy-src="https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?fit=25%2C25&amp;ssl=1&amp;is-pending-load=1"
																						srcset="data:image/gif;base64, R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
																					/>
																					<noscript>
																						<img
																							width="25"
																							height="25"
																							src="../../../i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/valuedb93.png?fit=25%2C25&amp;ssl=1"
																							class="gamipress-achievement-thumbnail wp-post-image"
																							alt=""
																							loading="lazy"
																							srcset="
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?w=512&amp;ssl=1            512w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=300%2C300&amp;ssl=1 300w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=150%2C150&amp;ssl=1 150w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=50%2C50&amp;ssl=1    50w,
																								https://i0.wp.com/metafans.tophivetheme.com/profile-timeline/wp-content/uploads/sites/2/2021/06/value.png?resize=100%2C100&amp;ssl=1 100w
																							"
																							sizes="(max-width: 25px) 100vw, 25px"
																						/>
																					</noscript>
																				</span>
																			</div>
																		</div>

																		
																	</div>
																	<!-- .bbp-reply-author -->

																	<div class="bbp-reply-content">
																		<?php echo $reply_description; ?>
																	</div>
																	<!-- .bbp-reply-content -->
																</div>
																
																
																<?php
															}
														}
														
													?>

                                                    



                                                </li>
                                                <!-- .bbp-body -->

                                                <li class="bbp-footer">
                                                    <div class="bbp-reply-author">Author</div>

                                                    <div class="bbp-reply-content">
                                                        Posts
                                                    </div>
                                                    <!-- .bbp-reply-content -->
                                                </li>
                                                <!-- .bbp-footer -->
                                            </ul>
                                            <!-- #topic-2768-replies -->






											<!-- post new reply -->
                                            <div id="new-topic-0" class="bbp-topic-form">
													<div class="bbp-form youzify-bbp-box">
														<div class="youzify-bbp-box-title">
															<i class="fas fa-pencil-alt"></i>
															Reply to &ldquo;<?php echo $topic_title; ?>&rdquo;
														</div>
														<div class="youzify-bbp-box-content">
															<div>
																
															<form id="new-post" method="post" action="controls/add-reply.php">

																<div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																	<label for="bbp_topic_title">Description (Large images disallowed) :</label>
																	<input name="description" type="hidden" id="mydescription">
																	<div id="editor-container"></div>
																</div>

																<input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">

																<input type="hidden" name="forum_id" value="<?php echo $forum_id; ?>">

																
																
																<div class="bbp-submit-wrapper">
																	<button type="submit" tabindex="104" id="bbp_topic_submit" name="create-reply" class="button submit"><i class="fas fa-paper-plane"></i>Submit</button>
																</div><div class="clearfix"></div>
															</form>



																<!-- file upload starts here -->

																<form action="controls/add-reply.php" method="post" enctype="multipart/form-data">
																	<br><br>
																	<div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																		<label for="bbp_topic_title">Or upload file instead:</label>
																		<input type="file" name="document_upload" id="" required>
																	</div>

																	<input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">

																	<input type="hidden" name="forum_id" value="<?php echo $forum_id; ?>">

																	<div class="bbp-submit-wrapper">
																		<button type="submit" tabindex="104" id="" name="upload" class="button submit"><i class="fas fa-upload"></i>Upload file</button>
																	</div><div class="clearfix"></div>
																</form>
																<!-- file upload ends here -->






															</div>

														</div>
													</div>
											</div>




											
                                        </div>
                                    </div>

                                    <div class="youzify-sidebar-column youzify-forum-sidebar youzify-sidebar">
                                        <div class="youzify-column-content">


                                            <div id="bbp_login_widget-3" class="widget-content bbp_widget_login">
												<div class="bbp-logged-in">
													<a href="#" class="submit user-submit">
														<img alt src="img/<?php echo $_SESSION['profile_pic'] ?>" class="avatar avatar-40 photo jetpack-lazy-image" height="40" width="40" loading="lazy">
													</a>
													<h4><a href="#"><?php echo $_SESSION['first_name']; ?></a></h4>

													<a href="logout.php" class="button logout-link">Log Out</a>
												</div>

                                            </div>


                                            <div id="bbp_topics_widget-3" class="widget-content widget_display_topics">
                                                <h3 class="widget-title">Recent Topics</h3>
                                                <ul class="bbp-topics-widget newness">


													<?php

														// get all recent topics limit 5
														$recent_topics = select_all_where_limit_desc('topics', 'forum_id', $forum_id, 'topic_id', 5);

														foreach ($recent_topics as $recent_topic) {
															// get topic details

															$recent_topic_id = $recent_topic['topic_id'];
															$recent_topic_title = $recent_topic['topic_title'];
															$recent_topic_date_posted = date("d M Y, h:i a", strtotime($recent_topic['date_posted']));

															?>
															
															<li>
																<a class="bbp-forum-title" href="topic.php?topic_id=<?php echo $recent_topic_id; ?>"><?php echo $recent_topic_title; ?></a>

																<div><?php echo $recent_topic_date_posted; ?></div>
															</li>
															
															<?php
														}

													?>


                                                </ul>
                                            </div>
                                            <div id="bbp_stats_widget-3" class="widget-content widget_display_stats">
                                                <h3 class="widget-title">Forum Statistics</h3>
                                                <div class="youzify-forums-statistics-items" role="main">
                                                    <div class="youzify-forums-statistics-item youzify-statistics-registered-user">
                                                        <div class="youzify-forums-statistics-icon">
                                                            <i class="fas fa-users"></i>
                                                        </div>
                                                        <div class="youzify-forums-statistics-content">
                                                            <div class="youzify-forums-statistics-nbr"><?php echo no_of_rows('users'); ?></div>
                                                            <div class="youzify-forums-statistics-desc">Registered Users</div>
                                                        </div>
                                                    </div>

                                                    <div class="youzify-forums-statistics-item youzify-statistics-forums">
                                                        <div class="youzify-forums-statistics-icon">
                                                            <i class="far fa-comments"></i>
                                                        </div>
                                                        <div class="youzify-forums-statistics-content">
                                                            <div class="youzify-forums-statistics-nbr"><?php echo no_of_rows('forums'); ?></div>
                                                            <div class="youzify-forums-statistics-desc">Forums</div>
                                                        </div>
                                                    </div>

                                                    <div class="youzify-forums-statistics-item youzify-statistics-topics">
                                                        <div class="youzify-forums-statistics-icon">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </div>
                                                        <div class="youzify-forums-statistics-content">
                                                            <div class="youzify-forums-statistics-nbr"><?php echo no_of_rows('topics'); ?></div>
                                                            <div class="youzify-forums-statistics-desc">Topics</div>
                                                        </div>
                                                    </div>

                                                    <div class="youzify-forums-statistics-item youzify-statistics-replies">
                                                        <div class="youzify-forums-statistics-icon">
                                                            <i class="fas fa-comment-dots"></i>
                                                        </div>
                                                        <div class="youzify-forums-statistics-content">
                                                            <div class="youzify-forums-statistics-nbr"><?php echo no_of_rows('replies'); ?></div>
                                                            <div class="youzify-forums-statistics-desc">Replies</div>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </main>
                            </div>

                            <a class="youzify-scrolltotop"><i class="fas fa-chevron-up"></i></a>
                        </main>
                        <!-- #main -->
                    </div>
                    <!-- #.tophive-grid -->
                </div>
                <!-- #.tophive-container -->
            </div>
            <!-- #content -->






<?php include "includes/footer.inc.php"; ?>

<script>
	var quill = new Quill('#editor-container', {
	modules: {
		toolbar: [
		['bold', 'italic'],
		['link', 'blockquote', 'code-block', 'image'],
		[{ list: 'ordered' }, { list: 'bullet' }]
		]
	},
	placeholder: 'Start a conversation...',
	theme: 'snow'
	});
	
	var form = document.querySelector('#new-post');
form.onsubmit = function() {
  // Populate hidden form on submit
  var description = document.querySelector('#mydescription');
  description.value = document.querySelector('.ql-editor').innerHTML;

  
  return true;
};
	

</script>