<!--Login Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Login Here</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- form inside the login modal -->
            <form action="/zeeshan_projects/Project2/partials/_login_handle.php" method="post">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="inp_log_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="inp_log_email" id="inp_log_email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="inp_log_password" class="form-label">Password</label>
                        <input type="password" name="inp_log_password" class="form-control" id="inp_log_password" required>
                    </div>
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6Le4NsAoAAAAANKZDOlVDZInFXjbKa291gcKmX8h" ></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
