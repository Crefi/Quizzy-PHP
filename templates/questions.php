<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
  <title>Test</title>
</head>

<body style="background: #18225D;">
  <div>
    <!-- nav -->
    <nav class="navbar flex flex-wrap my-3 space-x-5 space-between md:flex-row">
      <div class="flex flex-row flex-wrap w-full px-3">
        <div class="container-logo">
          <img src="../img/LandingPage/Logo-UVT.png" alt="" class="flex " width="100">
        </div>
        <div class="flex flex-1 space-x-5 my-3 sm:flex-wrap md:flex-row w-full justify-center">
          <a class="text-white text-xl px-2" href="./">Home</a>
          <a class="text-white text-xl px-2" href="courses">Courses</a>
          <a class="text-white text-xl px-2" href="admin">AdminPanel</a>
          <a class="text-white text-xl px-2" href="quizzes">Quizzes</a>
          <a class="text-white text-xl px-2" href="leaderboard">Leaderboard</a>
          <a class="text-white text-xl px-2" href="questions">Questions</a>
          <a class="text-white text-xl px-2" href="dashboard">Dashboard</a>
        </div>
      </div>
    </nav>

    <div>
      <a class="text-white text-xl px-5">Test page</a>
    </div>

    <div id="quizForm">
      {% if questions %}
      <div class="grid grid-cols-1 gap-4">
        {% for question in questions %}
        {% if question.quiz_id == selectedQuestion %}
        <div class="bg-white rounded-lg shadow-md p-4">
          <h5 class="text-lg font-bold mb-4">Question Number: {{ question.id }}</h5>
          <p class="mb-4">Question Text: {{ question.text }}</p>
          {% if answers %}
          <ul>
            {% for answer in answers %}
            {% if answer.question_id == question.id %}
            <li class="flex items-center mb-2">
              <input type="radio" id="answer_{{ answer.id }}" name="question_{{ question.id }}"
                value="{{ answer.id }}" data-is-correct="{{ answer.is_correct ? 'true' : 'false' }}"
                class="form-radio mr-2">
              <label for="answer_{{ answer.id }}" class="text-gray-800">{{ answer.text }}</label>
            </li>
            {% endif %}
            {% endfor %}
          </ul>
          {% else %}
          <p>No answers found for this question.</p>
          {% endif %}
        </div>
        {% endif %}
        {% endfor %}
      </div>
      <div class="mt-8">
        <button type="button" id="submitBtn"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        <button type="button" id="resetBtn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4">
    Reset
  </button>
      </div>
      {% else %}
      <p class="text-white">No questions found for this quiz.</p>
      {% endif %}
    </div>

    <script>
      const urlParams = new URLSearchParams(window.location.search);
      const selectedExperience = urlParams.get('experience_points');
      const selectedPassing = urlParams.get('passing_limit');
      console.log(selectedExperience);


      console.log("Selected Experience:", selectedExperience);

  document.getElementById("resetBtn").addEventListener("click", function () {
    var answerInputs = document.querySelectorAll("div[id^='quizForm'] input[type='radio']");
    answerInputs.forEach(function (input) {
      // Set the radio buttons to their default state (unchecked)
      input.checked = false;
    });
  });
      document.getElementById("submitBtn").addEventListener("click", function () {
        // Get the user's email from localStorage
        var storedEmail = localStorage.getItem("email");

        if (storedEmail) {
          // Extract the email and add experience_points
          var userEmail = storedEmail;


          // Calculate the grade based on the selected answers
          var grade = calculateGrade() ;
          grade = grade * 100;

          if (grade > selectedPassing) {
            // Calculate the percentage of the grade
            var percentage = grade;

            // Calculate the experience points
            var experiencePoints = Math.floor((percentage / 100) * selectedExperience);

            console.log("User Email:", userEmail);
            console.log("Grade:", grade);
            console.log("Experience Points:", experiencePoints);

            // Show an alert with the email, grade, and experience points
            var alertContent = `Email: ${userEmail}\nGrade: ${grade}\nExperience Points: ${experiencePoints}`;
            alert(alertContent);

            // Perform further actions with the email and experience_points
            // For example, update the user's profile with the experience_points

            const data = {
              email: userEmail,
              experience_points: experiencePoints
            };

            var xhr = new XMLHttpRequest();
            const url = "/Quizzyv3/app/updateUserExperience";
            xhr.open('PUT', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
              console.log(this.responseText);
            };
            xhr.send(JSON.stringify(data));
          } else {
            // You didn't pass, no points awarded
            console.log("You didn't pass, no points awarded");
          }
        }
      });

      function calculateGrade() {
        // Implement your logic to calculate the grade based on the selected answers
        // Return the calculated grade as a decimal value (e.g., 0.85 for 85%)
        // You can access the selected answers using JavaScript and perform the necessary calculations
        // For example:
        var totalQuestions = document.querySelectorAll("div[id^='quizForm'] .bg-white").length;
        var correctAnswers = document.querySelectorAll("div[id^='quizForm'] input:checked[data-is-correct='true']").length;
        var grade = correctAnswers / totalQuestions;

        return grade;
      }
    </script>
  </div>
</body>

</html>
