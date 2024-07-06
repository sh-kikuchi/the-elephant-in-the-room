<?php include('templates/layouts/header.php'); ?>
<div class="wrapper">
    <section class="flex-box justify-center">
       
        <div>
            <h2 class="text-center">Contents</h2>
            <ul class="tab-list flex-box justify-center">
            <li class="tab-item active">Auth</li>
            <li class="tab-item">CRUD</li>
            <li class="tab-item">Mail</li>
            <li class="tab-item">File</li>
            </ul>
            <div class="tab-container">
                <div class="tab-content active">
                    <section>
                        <div>
                            <h4 class="text-center mt-3">Auth</h4>
                            <div class="flex-box justify-center">
                                <ul>
                                    <li>username:<?php echo h($signin_user['name']) ?></li>
                                    <li>email:<?php echo h($signin_user['email']) ?></li>
                                </ul>
                            </div>
                            <p class="text-center">If you want to sign out, please select it from the hamburger menu.</p>
                        </div>
                    </section>
                </div>
                <div class="tab-content">
                    <section>
                        <h4 class="text-center mt-3">Sample App</h4>
                        <p class="text-center ma-3">I created a simple demo app using JSON Placeholder.<br> You can perform basic CRUD operations, so please check it out.<p>
                        <div class="flex-box justify-center">
                            <a href="#" class="modal-btn">Go to Sample App</a>
                        </div>
                    </section>
                </div>
                <div class="tab-content">
                    <section>
                        <div>
                            <h4 class="text-center mt-3">Mail Test</h4>
                            <div class="flex-box justify-center">
                                <form 
                                    id="contactForm" 
                                    action="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/mail" method="POST">
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
                                            <textarea 
                                                id="comment" 
                                                name="comment" 
                                                class="form-textarea"
                                                placeholder="Please enter text."
                                                cols="40"
                                                rows="10"
                                            >
                                            </textarea>
                                        </div>
                                        <div class="flex-box justify-center">
                                            <button type="submit"  class="pa-3 my-2 primary">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-content">
                    <section>
                        <div >
                           <h4 class="text-center mt-3">File Upload(png/jpg)</h4>
                            <div class="flex-box justify-center">
                                <form method ="POST" action="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/upload" enctype="multipart/form-data">
                                    <input type="hidden" name="max_file_size" value="1000000">
                                    <input id="upload"  type="file" name="upfile" size="40">
                                    <div class="flex-box justify-center mt-2">
                                        <button class="pa-3 error">UPLOAD</button>
                                    </div>
                                </form>
                            </div>
                            <p class="text-center"> see storage/doc directory</p>
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
        <h2>Preparation</h2>
        <p>Please set up the database connection and prepare the Users and Posts tables. Follow the Readme.md to insert data into each table. Make sure to have the data inserted.</p>
        <a href= "<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/post" class="modal-btn">OK</a>
    </div> 
</div>
<?php include('templates/layouts/footer.php'); ?>

