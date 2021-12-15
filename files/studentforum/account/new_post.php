<?php

    $page_title = "New Post";
    include "includes/header.inc.php";

?>

<link rel="stylesheet" id="elementor-post-2501-css" href="../wp-content/uploads/sites/2/elementor/css/post-25012922.css?ver=1631331499" media="all" />
        



            <div id="site-content" class="content-sm-space site-content">
                <div class="tophive-container">
                    <div class="tophive-grid">
                        <main id="main" class="content-area tophive-col-12">
                            <div class="content-inner">
                                <article id="post-2501" class="post-2501 page type-page status-publish hentry">
                                    <div class="entry-content">
                                        <div data-elementor-type="wp-page" data-elementor-id="2501" class="elementor elementor-2501" data-elementor-settings="[]">
                                            <div class="elementor-section-wrap">
                                                <section
                                                    class="elementor-section elementor-top-section elementor-element elementor-element-9ff44f0 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                                    data-id="9ff44f0"
                                                    data-element_type="section"
                                                >
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div
                                                            class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-dc812ea"
                                                            data-id="dc812ea"
                                                            data-element_type="column"
                                                            data-settings='{"background_background":"classic"}'
                                                        >
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div
                                                                    class="elementor-element elementor-element-4414cc0 elementor-widget elementor-widget-th-bbpress-topic-post"
                                                                    data-id="4414cc0"
                                                                    data-element_type="widget"
                                                                    data-widget_type="th-bbpress-topic-post.default"
                                                                >
                                                                    <div class="elementor-widget-container">
                                                                        <div class="tophive-bbpress-new-post-form">
                                                                            <h2 class="form-title">Write New Post</h2>
                                                                            <div class="form-description">
                                                                                Start a conversation, ask a question or share your idea.
                                                                                <br />
                                                                                This post will be sent to other subscribers of the chosen forum to get interactive.
                                                                            </div>
                                                                            <form action="controls/add-topic.php" id="new-post" method="post">
                                                                                <div class="form-group">
                                                                                    <label for="thbbpressposttitle">Title</label>
                                                                                    <input type="text" id="thbbpressposttitle" name="topic_title" placeholder="Provide a short and descriptive title" required/>
                                                                                </div>
																				
                                                                                <div class="form-group">
																					<label for="bbp_topic_title">Description (Large images disallowed) :</label>
																					<input name="description" type="hidden" id="mydescription">
																					<div id="editor-container"></div>
                                                                                </div>
																				
                                                                                <div class="form-group">
                                                                                    <label for="thbbpressposttopics">Forum (Important)</label>
                                                                                    <select id="thbbpressposttopics" name="forum_id" required>
																						<?php

																						// get all subscribed forums
																							$subscribed_forums = select_all_where_desc('subscriptions', 'user_id', $_SESSION['user_id'], 'id');
																							$no_of_subs = count($subscribed_forums);

																							$subscribed_forum_ids = array();


																							if($no_of_subs > 0) {
																								echo '<option value="">Select a forum</option>';

																								foreach ($subscribed_forums as $subscribed_forum) {

																									// get forum id and use to fetch forum details
																									$forum_id = $subscribed_forum['forum_id'];

																									// use forum id to get forum details
																									$forum = select_all_where('forums', 'forum_id', $forum_id);

																									// get forum details
																									$forum_name = $forum[0]['forum_name'];

																									echo '<option value="'.$forum_id.'">'.$forum_name.'</option>';

																								}


																							}
																							else {
																								echo '<option value="" disabled class="disabled">You have not subscribed to any forums</option>';
																							}


																						?>
                                                                                        
                                                                                    </select>
                                                                                </div>
                                                                                <!-- <div class="form-group">
						<label for="thbbpressposttags">Tags (optional)</label>
						<input type="text" id="thbbpressposttags" name="thbbpressposttags" placeholder="Input tags seperated by commas">
					</div> -->
                                                                                <div class="form-group">
                                                                                    <!-- <input type="button" class="" value="Submit" /> -->
																					<button type="submit" name="create-topic" class="text-white">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                            <div class="response-text ec-mt-3 strong"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-2a6cad6" data-id="2a6cad6" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div
                                                                    class="elementor-element elementor-element-fce59b2 elementor-widget elementor-widget-heading"
                                                                    data-id="fce59b2"
                                                                    data-element_type="widget"
                                                                    data-widget_type="heading.default"
                                                                >
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">Tips on Posting</h2>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="elementor-element elementor-element-e0f42e6 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                                                    data-id="e0f42e6"
                                                                    data-element_type="widget"
                                                                    data-widget_type="icon-list.default"
                                                                >
                                                                    <div class="elementor-widget-container">
                                                                        <ul class="elementor-icon-list-items">
                                                                            <li class="elementor-icon-list-item">
                                                                                <span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fab fa-microblog"></i> </span>
                                                                                <span class="elementor-icon-list-text">
                                                                                    Be as specific as possible in your post topic, so other subscribers know what you have a question about or want to discuss.
                                                                                </span>
                                                                            </li>
                                                                            <li class="elementor-icon-list-item">
                                                                                <span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fab fa-microblog"></i> </span>
                                                                                <span class="elementor-icon-list-text">
                                                                                    Pick the most relevant forum or community for your post. This enables your topic to get the required interations. If you’re not sure, make your best guess.
                                                                                </span>
                                                                            </li>
                                                                            <li class="elementor-icon-list-item">
                                                                                <span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fab fa-microblog"></i> </span>
                                                                                <span class="elementor-icon-list-text">
                                                                                    Limit the number of photos, videos, and GIFs you include in one post. Too many visuals may make the page slow to load.
                                                                                </span>
                                                                            </li>
                                                                            <li class="elementor-icon-list-item">
                                                                                <span class="elementor-icon-list-icon"> <i aria-hidden="true" class="fab fa-microblog"></i> </span>
                                                                                <span class="elementor-icon-list-text">Topic should be short, precise and descriptive enough to get the attention of colleagues and other subscribers.</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .entry-content -->
                                </article>
                                <!-- #post-47 -->
                            </div>
                            <!-- #.content-inner -->
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
