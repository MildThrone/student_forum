<?php

    $page_title = "Forum";

	if(!isset($_GET['id']) || empty($_GET['id'])) {

		// redirect to home
		header("Location: home.php");
		exit();
	}
	else {

		include "includes/header.inc.php";

		// get forum id
		$forum_id = trim($_GET['id']);

		// get forum details
		$forum = select_all_where('forums', 'forum_id', $forum_id);

		$forum_name = $forum[0]['forum_name'];
		$purpose = $forum[0]['purpose'];
		$date_created = date("d M Y, h:i a", strtotime($forum[0]['date_created']));
		$user_id = $forum[0]['user_id'];

		// get user details
		$user = select_all_where('users', 'id', $user_id);
		$user_firstname = $user[0]['first_name'];
		$user_pic = $user[0]['profile_pic'];

		// get no of rows of topics and replies

	}

?>










            <div id="page-cover" class="page-header--item page-cover" style="background-image: url('../../../demo.tophivetheme.com/metafans/classic/wp-content/uploads/sites/10/2021/02/99.-Roman-scaled904e.jpg?t=1612295157923');">
                <div class="tophive-breadcrumbs-container">
                    <div class="tophive-container">
                        <div class="tophive-breadcrumbs">
                            <a href="home.php">Home</a> &raquo; <span><a href="#">Forum</a></span> &raquo; <span><a href="#">Forum Conversations</a></span> &raquo;
                            <span class="current"><?php echo $forum_name; ?></span>
                        </div>
                    </div>
                </div>
                <div class="page-cover-inner tophive-container">
                    <h1 class="page-cover-title"><?php echo $forum_name; ?></h1>
                    <div class="page-cover-tagline-wrapper"><div class="page-cover-tagline"><?php echo $purpose; ?></div></div>
                </div>
            </div>
            
			
            <div id="site-content" class="content-sm-space site-content">
                <div class="tophive-container">
					
                    <div class="tophive-grid">
                        <main id="main" class="content-area tophive-col-12">



						<?php

							if(isset($_GET['unsub']) && $_GET['unsub']=='success') {
																																
								echo '<div class="alert alert-success fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>You have unsubscribed from this forum.</p>
											</div>';
										
							}

							if(isset($_GET['sub']) && $_GET['sub']=='success') {
																																
								echo '<div class="alert alert-success fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>You have subscribed to this forum.</p>
											</div>';
										
							}

							if(isset($_GET['add']) && $_GET['add']=='success') {
																																
								echo '<div class="alert alert-success fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>Topic created successfully.</p>
											</div>';
										
							}

							if(isset($_GET['error'])) {
								$error = $_GET['error'];

								switch ($error) {
									case 'empty':
										echo '<div class="alert alert-danger fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>All fields are required to create topic.</p>
											</div>';
										break;

									case 'failed':
										echo '<div class="alert alert-danger fade show">
												<span class="close" data-dismiss="alert">&times;</span>
												<p>An error ocured, could not create topic. Please try again.</p>
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
                                                        <a href="home.php" class="bbp-breadcrumb-home">Home</a>
                                                        <span class="bbp-breadcrumb-sep">&rsaquo;</span>
                                                        <a href="#" class="bbp-breadcrumb-root">Forum</a>
                                                        <span class="bbp-breadcrumb-sep">&rsaquo;</span>
                                                        <a href="#" class="bbp-breadcrumb-forum">Forum Conversations</a>
                                                        <span class="bbp-breadcrumb-sep">&rsaquo;</span>
                                                        <span class="bbp-breadcrumb-current"><?php echo $forum_name; ?>
														<?php
															// check if subscribed
															
															if(user_subscribed($forum_id) == false) {
																?>
																<span id="subscription-toggle"><span id="subscribe-75"  ><a href="controls/subscribe.php?forum_id=<?php echo $forum_id; ?>" class="subscription-toggle" data-bbp-object-id="75" data-bbp-object-type="0" data-bbp-nonce="15ca297831" rel="nofollow">Subscribe</a></span></span>
																<?php
															}
															else {

																// unsubscribe option
																?>
																<span id="subscription-toggle"><span id="subscribe-75" class="is-subscribed"><a href="controls/unsubscribe.php?forum_id=<?php echo $forum_id; ?>" class="subscription-toggle" data-bbp-object-id="75" data-bbp-object-type="0" data-bbp-nonce="567dbd8517" rel="nofollow">Unsubscribe</a></span></span>
																<?php
															}


                                                            // Check user like
                                                            if(user_liked($forum_id) == false) {
                                                                ?>
<!--                                                                <span id="subscription-toggle"><span id="subscribe-75"  ><a href="controls/subscribe.php?forum_id=--><?php //echo $forum_id; ?><!--" class="subscription-toggle" data-bbp-object-id="75" data-bbp-object-type="0" data-bbp-nonce="15ca297831" rel="nofollow">Like</a></span></span>-->
<!--                                                                <span><a href="controls/like.php?forum_id=--><?php //echo $forum_id; ?><!--"><i class="fas fa-heart mr-2"></i>Like</span>-->
                                                                <?php
                                                            }
														?>
														</span>

														

                                                    </p>
                                                </div>
                                                <div class="youzify-bbp-topic-head-meta">
                                                    <div class="youzify-bbp-topic-head-meta-item youzify-bbp-head-meta-last-updated">
                                                        Forum created by
                                                        <a href="#" title="<?php echo $user_firstname; ?>" class="bbp-author-link">
                                                            <span class="bbp-author-avatar">
                                                                <img
                                                                    alt="sssd"
                                                                    src="img/profile.jpg"
                                                                    class="avatar avatar-14 photo jetpack-lazy-image"
                                                                    height="14"
                                                                    width="14"
                                                                    loading="lazy"
                                                                    
                                                                />
                                                            </span>
                                                            <span class="bbp-author-name"><?php echo $user_firstname; ?>,</span>
                                                        </a>
                                                        <a href="#" title="A new trial post"><?php echo $date_created; ?></a>.
                                                    </div>

                                                    <div class="youzify-bbp-topic-head-meta-item"><i class="fas fa-pencil-alt"></i><?php echo no_of_rows_where('topics', 'forum_id', $forum_id); ?> topics</div>
                                                    <div class="youzify-bbp-topic-head-meta-item"><i class="far fa-comments"></i><?php echo no_of_rows_where('replies', 'forum_id', $forum_id); ?> replies</div>
<!--                                                    <div class="youzify-bbp-topic-head-meta-item"><i class="far fa-thumbs-up"></i>--><?php //echo no_of_rows_where('likes', 'forum_id', $forum_id); ?><!-- likes</div>-->
                                                </div>
                                            </div>

											<!-- get all topics -->
											<?php


												$topics = select_all_where_desc('topics', 'forum_id', $forum_id, 'topic_id');

												if(count($topics) < 1) {
													// echo '<p>There are no topics in this forum. <a href="new-post.php?forum_id='.$forum_id.'">Start a new coversation now</a></p>';
													echo '<p>There are no topics in this forum. Start a new conversation now</p><br>';
												}

												else{

													// get topic details
													?>

													<ul id="bbp-forum-75" class="bbp-topics">

													<?php

													$topic_count = 1;
													foreach ($topics as $topic) {
														
														$topic_id = $topic['topic_id'];
														$topic_title = $topic['topic_title'];
														$forum_id = $topic['forum_id'];
														$user_id = $topic['user_id'];

														// get user details
														$topic_user = select_all_where('users', 'id', $user_id);
														$topic_user_name = $topic_user[0]['first_name']; 
														$topic_user_pic = $topic_user[0]['profile_pic']; 

														// get user details
														$topic_forum = select_all_where('forums', 'forum_id', $forum_id);
														$topic_forum_name = $topic_forum[0]['forum_name'];

														



														?>


														
															<li class="bbp-body">
																<ul id="bbp-topic-2768" class="loop-item-0 user-id-1 bbp-parent-forum-75 odd <?php if($topic_count==1){echo 'sticky';} ?> post-2768 topic type-topic status-publish hentry topic-tag-envato-elements">
																	<li class="bbp-topic-title">
																		<div class="youzify-forums-topic-item">
																			<div class="youzify-forums-topic-icon"><i class="fas fa-thumbtack"></i></div>
																			<div class="youzify-forums-topic-head">
																				<a class="youzify-forums-topic-title" href="topic.php?topic_id=<?php echo $topic_id; ?>"><?php echo $topic_title; ?></a>

																				<div class="youzify-forums-topic-meta">
																					<div class="youzify-forums-topic-author">
																						<a href="#" title="" class="bbp-author-link">
																							<span class="bbp-author-avatar">
																								<img
																									alt
																									src="img/<?php echo $topic_user_pic; ?>"
																									class="avatar avatar-20 photo jetpack-lazy-image"
																									height="20"
																									width="20"
																									loading="lazy"
																									
																								/>
																								
																								
																							</span>
																							<span class="bbp-author-name"><?php echo $topic_user_name; ?></span>
																						</a>
																					</div>
																					<div class="youzify-forums-topic-forum">
																						<i class="far fa-folder-open"></i>
																						<a href="#"><?php echo $forum_name; ?></a>
																					</div>
																				</div>
																			</div>
																		</div>

																		<p class="youzify-bbp-topic-meta"></p>
																	</li>

																	<li class="bbp-topic-voice-count"><i class="fas fa-microphone-alt" area-hidden="true"></i>1</li>

																	<li class="bbp-topic-reply-count"><i class="far fa-comments" area-hidden="true"></i><?php echo no_of_rows_where('replies', 'topic_id', $topic_id); ?></li>


																	<?php
																		// get last reply details
																		$no_of_replies = no_of_rows_where('replies', 'topic_id', $topic_id);

																		if($no_of_replies < 1) {
																			echo 'No replies for this topic<br><br><a href="topic.php?topic_id='.$topic_id.'">View this topic</a>';
																		}
																		else {

																		

																			$last_reply = select_all_where_limit_desc('replies', 'topic_id', $topic_id, 'reply_id', 1);
																			$last_reply_user_id = $last_reply[0]['user_id'];
																			$last_reply_date_posted = $last_reply[0]['date_posted'];

																			// get last reply user details
																			$last_reply_user = select_all_where('users', 'id', $last_reply_user_id);
																			$last_reply_user_name = $last_reply_user[0]['first_name'];
																			$last_reply_user_pic = $last_reply_user[0]['profile_pic'];


																			?>
																			
																			
																			<li class="youzify-bbp-freshness">
																				<div class="youzify-bbp-freshness-data">
																					<div class="youzify-bbp-freshness-author-img">
																						<a href="#" title="" class="bbp-author-link">
																							<span class="bbp-author-avatar">
																								<img
																									alt
																									src="img/<?php echo $last_reply_user_pic; ?>"
																									class="avatar avatar-40 photo jetpack-lazy-image"
																									height="40"
																									width="40"
																									loading="lazy"
																								/>
																								
																							</span>
																						</a>
																					</div>

																					<div class="youzify-bbp-freshness-content">
																						<div class="youzify-bbp-freshness-author">
																							<a href="topic.php?topic_id=<?php echo $topic_id; ?>" title="" class="bbp-author-link"><span class="bbp-author-name"><?php echo $last_reply_user_name; ?></span></a>
																						</div>

																						<div class="youzify-bbp-freshness-time">
																							<a href="topic.php?topic_id=<?php echo $topic_id; ?>" title="Latest reply">
																								<?php echo date("d M Y, h:i a", strtotime($last_reply_date_posted)); ?>
																							</a>
																						</div>
																					</div>
																				</div>
																			</li>
																			
																			
																			
																			<?php
																		
																		}
																	?>

																	
																</ul>
															</li>
														



														<?php


														$topic_count++;

													}
													?>
													
													</ul>

													<?php

													?>
													
													
													
													
													
													
													<?php

												}


											?>

                                            

                                            <!-- <div id="no-topic-0" class="bbp-no-topic">
                                                <div class="bbp-template-notice">
                                                    <p>You must be logged in to create new topics.</p>
                                                </div>
                                            </div> -->

											<!-- check if user is subscribed -->
											<?php
												$issubscribed = user_subscribed($forum_id);

												if($issubscribed== false){
													echo '<p>Oops... Please subscribe to this forum to be able to start a conversation.</p>';
												}
												else {

													?>

													<div id="new-topic-0" class="bbp-topic-form">
														<form id="new-post" method="post" action="controls/add-topic.php">
															<div class="bbp-form youzify-bbp-box">
																<div class="youzify-bbp-box-title">
																	<i class="fas fa-pencil-alt"></i>
																	Create New Topic in &ldquo;<?php echo $forum_name; ?>&rdquo;
																</div>
																<div class="youzify-bbp-box-content">
																	<div>
																		<div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																			<label for="bbp_topic_title">Topic Title (Maximum Length : 80) :</label>
																			<input type="text" id="bbp_topic_title" value="" tabindex="101" size="40" name="topic_title" maxlength="80" required/>
																		</div>

																		<div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																			<label for="bbp_topic_title">Description (Large images disallowed) :</label>
																			<input name="description" type="hidden" id="mydescription">
																			<div id="editor-container"></div>
																		</div>

																		<input type="hidden" name="forum_id" value="<?php echo $forum_id; ?>">

																		
																		
																		<div class="bbp-submit-wrapper">
																			<button type="submit" tabindex="104" id="bbp_topic_submit" name="create-topic" class="button submit"><i class="fas fa-paper-plane"></i>Submit</button>
																		</div>
																		<div class="clearfix"></div><br>
																	</div>

																</div>
															</div>
														</form>
													</div>
													
													<?php
												}
											?>
											

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

<!-- Main Quill library -->
<!-- <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script> -->

<!-- Theme included stylesheets -->
<!-- <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->
<!-- <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet"> -->

<!-- Core build with no theme, formatting, non-essential modules -->
<!-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> -->


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



