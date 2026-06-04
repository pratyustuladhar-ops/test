<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>

                <div class="card-body">
                    <form>

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control">
                        </div>

                        <a href="/login" class="btn btn-success w-100">
                            Register
                        </a>

                    </form>

                    <div class="text-center mt-3">
                        <a href="/login">Already have an account?</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>