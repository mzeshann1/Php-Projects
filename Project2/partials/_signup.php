<!-- Signup Modal -->
<div class="modal fade" id="signup_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Signup Here</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <!-- form inside the signup modal -->
            <form action="/zeeshan_projects/Project2/partials/_signup_handle.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inp_fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="inp_fname" id="inp_fname" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="inp_lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="inp_lname" id="inp_lname" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="inp_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="inp_email" id="inp_email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="inp_contact_number" class="form-label">Contact Number</label>
                        <input type="number" class="form-control" name="inp_contact_number" id="inp_contact_number" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="inp_password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="inp_password" id="inp_password">
                    </div>
                    <div class="mb-3">
                        <label for="inp_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="inp_confirm_password" id="inp_confirm_password">
                    </div>
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6Le4NsAoAAAAANKZDOlVDZInFXjbKa291gcKmX8h"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">signup</button>
                </div>
            </form>



        </div>
    </div>
</div>