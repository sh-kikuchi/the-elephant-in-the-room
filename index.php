
<?php include('pages/layouts/header.php'); ?>
    <section id="index-firstview">
        <div class="index-fv-title">
            <h1>THE <br><span class="elephant-letter"> ELEPHANT </span><br>IN THE ROOM</h1>
        </div>
            <div class="square index-fv-img" ><img src="assets/img/elephant.jpg"/>
        </div>
    </section>
    <section class="flex-box justify-center pb-4">
        <div style="width:450px">
            <div>
                <h2 class="text-center">Overview</h2>
                <div>
                    <p>Code management, which is based on object-orientation and describes programmes separately according to their function, is adopted. This facilitates code re-use and is expected to increase development efficiency. It also ensures maintainability and aims for a comfortable code life.</p>
                    <ul>
                        <li>Pages: views</li>
                        <li>Logics: business logic (bridge between models and views)</li>
                        <li>Models: DB operations (classes)</li>
                    </ul>
                </div>
            </div>
            <div>
                <h2 class="text-center">Project</h2>
                <div>
                    <p>I hope to personally sublimate the 'remembrance' from my experiences and learning so far, and hope that it will become a 'preparedness' for future development. I want to make it my motto that working on development with 'integrity' leads to 'strength of character'. We would like to continue to upgrade it as a tool for this purpose.</p>
                </div>
            </div>
            <div>
                <h2 class="text-center">Directory</h2>
                <div>
                    <h3 class="text-left">■ assets</h3>
                    <div>
                        <p>A place where JavaScript, CSS, images, PDFs, etc. can be stored. Allows management of materials used in creating applications.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ database</h3>
                        <div>
                            <p>A directory that collects database-related information and allows not only DB linkage, but also the use of PHP commands to take backups of existing tables in CSV files, and vice versa, and to import data from CSV files into tables.</p>
                        </div>
                </div>
                <div>
                    <h3 class="text-left">■ interfaces</h3>
                    <div>
                        <p>At present, the directory is prepared so that type definitions can be set up for various processes in Trait.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ models</h3>
                    <div>
                        <p>A place to prepare classes describing the processing of DB operations (CRUD). As the class name is UpperCamel type (e.g. UserAuth), the file name also matches this.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ pages</h3>
                    <div>
                        <p>Location where files for views are stored.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ rules</h3>
                    <div>
                        <p>For putting together classes for validation processes. It is recommended to write functions for storing error messages and retaining the originally entered values when an error occurs.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ storage</h3>
                    <div>
                        <p>This can be used as a storage place for files uploaded in the application.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ tests</h3>
                    <div>
                        <p>This directory is intended for unit tests such as PHP-Unit, and the test code is managed here.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ util</h3>
                    <div>
                        <h4 class="text-center">【trait】</h4>
                        <p>Prepare a trait folder and, within it, files that can be used across classes.</p>
                        <ul>
                            <li>Email</li>
                            <li>PDF</li>
                            <li>File</li>
                            <li>Session</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-center">【functions】</h4>
                        <p>Write the process you want to use in the PAGES file that plays the role of a view, directly under the util folder.</p>
                        <ul>
                            <li>formatting system</li>
                            <li>Anti-XSS measures: escaping process.</li>
                            <li>Token generation for CSRF protection.</li>
                            <li>pagination display</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-left">■ vendor</h3>
                    <div>
                        <p>A folder generated when doing `composer install` and usually the target of `.gitignore`. It is where external packages are managed and officially provides the following by default (see `composer.json`). (See `composer.json`.) However, users can freely select their own packages, so this is only for reference.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include('pages/layouts/footer.php'); ?>
