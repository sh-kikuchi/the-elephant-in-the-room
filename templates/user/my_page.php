<?php include('templates/layouts/header.php'); ?>
<div class="wrapper">
    <h2 class="text-center pt-2">My page</h2>
    <div class="flex-box justify-center">
      <div>
            <p>username:<?php echo h($signin_user['name']) ?></p>
            <p>email:<?php echo h($signin_user['email']) ?></p>
      </div>
    </div>
    <section class="flex-box justify-center">
        <div>
            <h2 class="text-center">Contents</h2>
            <ul class="tab-list flex-box justify-center">
            <li class="tab-item active">Authentication</li>
            <li class="tab-item">CRUD</li>
            <li class="tab-item">Mail</li>
            <li class="tab-item">File</li>
            </ul>
            <div class="tab-container">
                <div class="tab-content active">
                    <section class="grid-two-block">
                        <div class="flex-box justify-center align-center">
                            <div class="index-intro-img" ><img src="<?php echo Path::ROOT . 'assets/img/auth.png' ?>"/></div>
                            
                        </div>
                        <div class="index-intro-right">
                            <p class="index-intro-text">Authentication functionality is provided by default. The various authentication functions are as follows.</p>
                            <ul>
                                <li>sign-up</li>
                                <li>sign-in</li>
                                <li>sign-out</li>
                            </ul>
                        </div>
                    </section>
                </div>
                <div class="tab-content">
                    <section class="grid-two-block">
                        <div class="flex-box justify-center align-center">
                            <div class="index-intro-img" ><img src="<?php echo Path::ROOT . 'assets/img/db.png' ?>"/></div>
                        </div>
                        <div class="index-intro-right">
                            <p class="index-intro-text">In conjunction with SQL, read, create, update, and delete operations can be easily performed on the DB.</p>
                            <a href="#" class="modal-btn">CRUD DEMO</a>
                        </div>
                    </section>
                </div>
                <div class="tab-content">
                    <section class="grid-two-block">
                        <div class="flex-box justify-center align-center">
                            <div class="index-intro-img" ><img src="<?php echo Path::ROOT . 'assets/img/mail.png' ?>"/></div>
                        </div>
                        <div class="index-intro-right">
                            <p class="index-intro-text">You can use the function mb_send_mail to implement mail. For example, it is useful for sending a contact form.</p>
                            <div class="flex-box">
                                <form 
                                    id="contactForm" 
                                    class="flex-box"
                                    action="<?php echo Path::ROOT . 'mail' ?>" method="POST">
                                    <div class="mr-2">
                                        <div class="form-group">
                                            <label for="name">name</label>
                                            <input type="text" id="username" name="username" class="form-input" placeholder="Enter your name">
                                        </div>
                                        <div class="form-group">
                                            <label for="emall">email</label>
                                            <input type="text" id="mail" name="mail" class="form-input" placeholder="Enter your email address">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="label" for="comment">details of enquiry</label>
                                            <textarea 
                                                id="comment" 
                                                name="comment" 
                                                class="form-textarea"
                                                cols="40"
                                                rows="10"
                                            >
                                            </textarea>
                                        </div>
                                        <div class="flex-box justify-center">
                                            <input type="submit" class="button primary my-2" value="Send">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-content">
                    <section class="grid-two-block">
                        <div class="flex-box justify-center align-center">
                            <div class="index-intro-img" ><img src="<?php echo Path::ROOT . 'assets/img/upload.png' ?>"/></div>
                        </div>
                        <div class="index-intro-right mb-4">
                            <p class="index-intro-text">Try out file-related processes such as image uploading and PDF output.</p>
                                <h3>■ Image Upload(png/jpg)</h3>
                                <p> see storage/doc directory</p>
                                <div class="flex-box justify-center">
                                    <form method ="POST" action="<?php echo Path::ROOT . 'upload' ?>" enctype="multipart/form-data">
                                        <input type="hidden" name="max_file_size" value="1000000">
                                        <input id="upload"  type="file" name="upfile" size="40">
                                        <div class="flex-box justify-center mt-2">
                                            <button class="pa-3 error" style="color: gray">UPLOAD</button>
                                        </div>
                                        
                                    </form>
                                </div>
                                <h3>■ PDF</h3>
                                <div class="flex-box justify-center">
                                    <div class="flex-box justify-center">
                                        <form action="<?php echo Path::ROOT . 'pdf' ?>" method="POST">
                                            <label class="file-label">
                                                PDF download
                                                <input type="submit" name="pdf" class="file-input" value="pdf">
                                            </label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="overlay"></div>
    <div class="modal">
        <div class="close">×</div>
        <h2>APP DEMO</h2>
        <p>This is an example of a function that can record a visit to a music concert.</p>
        <a href="/the-elephant-in-the-room/post" class="modal-btn">DEMO</a>
    </div> 
</div>
<?php include('templates/layouts/footer.php'); ?>

