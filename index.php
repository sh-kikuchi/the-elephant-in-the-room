
<?php include('page/layouts/header.php'); ?>
    <div class="body">
      <section id="index-firstview">
        <div class="index-fv-title">
            <h1>THE <br><span class="elephant-letter"> ELEPHANT </span><br>IN THE ROOM</h1>
        </div>
            <div class="index-fv-img" ><img src="assets/img/elephant.jpg"/></div>
      </section>
      <section class="flex-box justify-center">
          <div>
              <h2 class="text-center">Contents</h2>
              <ul class="tab-list flex-box justify-center">
                <li class="tab-item active">Authentication</li>
                <li class="tab-item">CRUD</li>
                <li class="tab-item">Mail</li>
                <li class="tab-item">File Upload</li>
              </ul>
              <div class="tab-container">
                  <div class="tab-content active">
                      <section class="grid-two-block">
                          <div class="flex-box justify-center align-center">
                              <div class="index-intro-img" ><img src="assets/img/auth.png"/></div>
                          </div>
                          <div class="index-intro-right">
                              <p class="index-intro-text">Sign-in, sign-up, and sign-out are easy to implement. By default, you can sign up with your email and password.</p>
                          </div>
                      </section>
                  </div>
                  <div class="tab-content">
                      <section class="grid-two-block">
                          <div class="flex-box justify-center align-center">
                              <div class="index-intro-img" ><img src="assets/img/db.png"/></div>
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
                              <div class="index-intro-img" ><img src="assets/img/mail.png"/></div>
                          </div>
                          <div class="index-intro-right">
                              <p class="index-intro-text">You can use the function mb_send_mail to implement mail. For example, it is useful for sending a contact form.</p>
                          </div>
                      </section>
                  </div>
                  <div class="tab-content">
                      <section class="grid-two-block">
                          <div class="flex-box justify-center align-center">
                              <div class="index-intro-img" ><img src="assets/img/upload.png"/></div>
                          </div>
                          <div class="index-intro-right">
                              <p class="index-intro-text">By default, images are stored in the image folder of this framework. Of course, you can flexibly set the storage location and file extensions.</p>
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
          <h2>CRUD DEMO</h2>
          <p>This is an example of a function that can record a visit to a music concert.</p>
          <a href="pages/concert/" class="modal-btn">CRUD DEMO</a>
      </div>
<?php include('page/layouts/footer.php'); ?>
