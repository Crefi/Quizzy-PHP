<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Register</title>
  <script>
    function storeData() {
      // Get the input values
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

      // Store the values in localStorage
      localStorage.setItem("email", email);
      localStorage.setItem("password", password);
    }
  </script>
</head>
<body style="background: #18225D;">

  <nav class="flex flex-wrap my-3 space-x-5 space-between md:flex-row">
    <!-- Your navigation code -->
  </nav>

  <div class="flex-row px-10 mx-10 items-center w-auto justify-center">
    <div class="flex flex-col flex-wrap  items-center self-center">
      <form class="flex flex-col md:w-1/2 lg:w-1/2 items-center justify-center rounded-lg bg-white p-10 pt-1 mb-10"
            action="/Quizzyv3/app/auth" method="POST">
        <!-- form group -->
        <div class="text-4xl block text-center mx-auto py-8 mt-10">
          <h1 class="font-bold">Authenticate to Quizzy</h1>
        </div>

        <div class="block p-3 w-full">
          <h1 class="text-2xl my-2">Email</h1>
          <input class="w-full bg-slate-200 text-xl px-5 py-2 rounded-md" name="email" id="email" type="email" placeholder="Enter email...">
        </div>
        <div class="block p-3 w-full">
          <h1 class="text-2xl my-2">Password</h1>
          <input class="w-full bg-slate-200 text-xl px-5 py-2 rounded-md" name="password" id="password" type="password" placeholder="Enter password...">
        </div>

        <input type="hidden" name="role" value="{{role}}">

        <div class="block mx-auto mb-3 py-3 mt-3">
          <button style="background-color: #007074;" class="text-white font-semibold text-3xl rounded-md py-2 px-20 block mx-auto"
                  type="submit" onclick="storeData()">Login</button>
          <p class="px-8 mt-3 text-xl">Don't have an account? <a style="color: #007074;" class="font-semibold" href="register">Sign Up</a></p>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
