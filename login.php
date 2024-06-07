<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<style>
  .logo {
    max-width: 80px;
    /* Mengatur lebar maksimal gambar */
    height: auto;
    /* Menjaga aspek rasio gambar */
  }
</style>

<body>


  <section class="vh-100" style="background-color: #edf2fb;">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-lg-12 col-xl-11 justify-content-center">
          <div class="card text-black" style="border-radius: 25px; width: 750px; margin-left: 250px;">
            <div class="card-body p-md-2">
              <div class="row justify-content-center">
                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3">
                  <img src="image/udang_remove.png" class="logo">
                  Login Sistem Prediksi
                </p>
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <br>
                  <form action="proses/login.php" method="post">
                    <!-- Username input -->
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form1Example13"> <i class="bi bi-person-circle"></i> Username</label>
                      <input type="username" id="form1Example13" class="form-control form-control-lg py-2" name="username" autocomplete="off" placeholder="masukkan username" style="border-radius:25px ;" required="required" />

                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form1Example23"><i class="bi bi-chat-left-dots-fill"></i> Password</label>
                      <input type="password" id="form1Example23" class="form-control form-control-lg py-2" name="password" autocomplete="off" placeholder="masukkan password" style="border-radius:25px ;" required="required" />

                    </div>
                    <!-- Submit button -->
                    <!-- <button type="submit" class="btn btn-primary btn-lg">Login in</button> -->
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <input type="submit" value="Login" name="login" class="btn btn-info btn-lg text-light my-2 py-2" style="width:100% ; border-radius: 30px; font-weight:600;" />
                    </div>

                  </form><br>
                  <p align="center">Belum punya akun? <a href="form_register.php" class="text-info" style="font-weight:600;text-decoration:none;">Register</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>







  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>