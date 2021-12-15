<?php

    $page_title = "New Post";
    include "includes/header.inc.php";

?>








            <div id="site-content" class="content-md-space site-content">
                <div class="tophive-container">
                    <div class="tophive-grid">
                        <main id="main" class="content-area tophive-col-12">



                                    <?php
                                        if(isset($_GET['error'])) {
                                            $error = $_GET['error'];

                                            switch ($error) {
                                                case 'empty':
                                                    echo '<div class="alert alert-danger fade show">
                                                            <span class="close" data-dismiss="alert">&times;</span>
                                                            <p>All fields are required to reply.</p>
                                                        </div>';
                                                    break;

                                                case 'invalidPassword':
                                                    echo '<div class="alert alert-danger fade show">
                                                            <span class="close" data-dismiss="alert">&times;</span>
                                                            <p>Old password is invalid.</p>
                                                        </div>';
                                                    break;

                                                case 'passwordMatch':
                                                    echo '<div class="alert alert-danger fade show">
                                                            <span class="close" data-dismiss="alert">&times;</span>
                                                            <p>New passwords do not match.</p>
                                                        </div>';
                                                    break;

                                                case 'passwordLength':
                                                    echo '<div class="alert alert-danger fade show">
                                                            <span class="close" data-dismiss="alert">&times;</span>
                                                            <p>New passwords should contain at least 8 characters.</p>
                                                        </div>';
                                                    break;
                                                
                                                default:
                                                    echo '<div class="alert alert-danger fade show">
                                                            <span class="close" data-dismiss="alert">&times;</span>
                                                            <p>An error occured, try again.</p>
                                                        </div>';
                                                    
                                                    break;
                                            }
                                        }

                                        if(isset($_GET['update'])) {
                                            $error = $_GET['update'];

                                            switch ($error) {
                                                case 'success':
                                                    echo '<div class="alert alert-success fade show">
                                                            <span class="close" data-dismiss="alert">&times;</span>
                                                            <p>Password changed successfully.</p>
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
                                            

                                          


											<!-- post new reply -->
                                            <div id="new-topic-0" class="bbp-topic-form">
													<div class="bbp-form youzify-bbp-box">
														<div class="youzify-bbp-box-title">
															<i class="fas fa-pencil-alt"></i>
															Update Profile
														</div>
														<div class="youzify-bbp-box-content">
															<div>
																
															



																<!-- file upload starts here -->

																<form action="controls/update-profile.php" method="post" enctype="multipart/form-data">
																	<br><br>
																	<div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																		<label for="bbp_topic_title">Change Profile Picture:</label>
																		<input type="file" name="profile_upload" id="" required>
																	</div>


																	<div class="bbp-submit-wrapper">
																		<button type="submit" tabindex="104" id="" name="upload" class="button submit"><i class="fas fa-photo"></i>Change Profile Picture</button>
																	</div><div class="clearfix"></div>
																</form>
																<!-- file upload ends here -->






															</div>

														</div>
													</div>
											</div>

                                            <!-- post new reply -->
                                            <div id="new-topic-0" class="bbp-topic-form">
													<div class="bbp-form youzify-bbp-box">
														<div class="youzify-bbp-box-title">
															<i class="fas fa-pencil-alt"></i>
															Change Password
														</div>
														<div class="youzify-bbp-box-content">
															<div>
																
															



																<!-- file upload starts here -->

																<form action="controls/change_password.php" method="post" enctype="multipart/form-data">
																	<br><br>
																	<div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																		<label for="bbp_topic_title">Old Password:</label>
																		<input type="password" name="old_password" id="" required>
																	</div>

                                                                    <div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																		<label for="bbp_topic_title">New Password:</label>
																		<input type="password" name="new_password" id="" required>
																	</div>

                                                                    <div class="youzify-bbp-form-item youzify-bbp-form-item-text">
																		<label for="bbp_topic_title">Confirm New Password:</label>
																		<input type="password" name="new_password2" id="" required>
																	</div>

																	
																	<div class="bbp-submit-wrapper">
																		<button type="submit" tabindex="104" id="" name="change_password" class="button submit"><i class="fas fa-lock"></i>Change Password</button>
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