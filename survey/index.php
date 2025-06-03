<!DOCTYPE html>
<html>
<head>
    <title>Survey Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <script>
// This function runs when the form is submitted
function validateForm() {
    // Get the form by its name
    const form = document.forms["surveyForm"];

    // Get values from the personal detail fields
    const fullName = form["full_name"].value.trim();
    const email = form["email"].value.trim();
    const dob = form["dob"].value;
    const contact = form["contact"].value.trim();

    // Check if any personal detail is missing or not filled in
    if (fullName == null || fullName === "" ||
        email == null || email === "" ||
        dob == null || dob === "" ||
        contact == null || contact === "") {
        alert("Please fill in all personal details.");
        return false; // Stop form submission
    }

    // Calculate the user's age using the date of birth
    const age = getAge(dob);

    // Check if age is within the allowed range
    if (age < 5 || age > 120) {
        alert("Age must be between 5 and 120.");
        return false;
    }

    // List of rating question field names
    const ratings = ["watch_movies", "listen_radio", "eat_out", "watch_tv"];

    // Loop through each rating question to check if an option is selected
    for (let i = 0; i < ratings.length; i++) {
        const questionName = ratings[i]; // e.g., "watch_movies"
        let isChecked = false; // Flag to track if any option is selected

        // Check each of the 5 radio buttons for this question
        for (let j = 0; j < 5; j++) {
            if (form[questionName][j].checked) {
                isChecked = true; // Found a selected option
                break; // No need to check further
            }
        }

        // If no option was selected for this question
        if (!isChecked) {
            alert("Please select a rating for all questions.");
            return false;
        }
    }

    // If all checks pass, allow the form to submit
    return true;
}

// This function calculates the user's age based on their date of birth
function getAge(dob) {
    const birthDate = new Date(dob); // Convert input string to Date object
    const today = new Date(); // Get today's date

    let age = today.getFullYear() - birthDate.getFullYear(); // Initial age calculation
    const monthDiff = today.getMonth() - birthDate.getMonth(); // Difference in months

    // Adjust age if birthday hasn't occurred yet this year
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--; // Subtract one year
    }

    return age; // Return the final age
}
</script>

</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <b>_Surveys</b>
                <span class="float-end">
                    <a href="index.php" class="text-white me-3">FILL OUT SURVEY</a>
                    <a href="results.php" class="text-white">VIEW SURVEY RESULTS</a>
                </span>
            </div>
            <div class="card-body">
                <form name="surveyForm" method="post" action="submit.php" onsubmit="return validateForm()">
                    <h5 class="mb-3">Personal Details :</h5>
                    <div class="mb-3">
                        <input type="text" name="full_name" class="form-control" placeholder="Full Names">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="date" name="dob" class="form-control" placeholder="Date of Birth">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number">
                    </div>

                    <h5 class="mb-2">What is your favorite food?</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="favorite_food" value="Pizza" required>
                        <label class="form-check-label">Pizza</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="favorite_food" value="Pasta">
                        <label class="form-check-label">Pasta</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="favorite_food" value="Pap and Wors">
                        <label class="form-check-label">Pap and Wors</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="favorite_food" value="Other">
                        <label class="form-check-label">Other</label>
                    </div>

                    <h5 class="mt-4 mb-2">Rate the following from 1 (Strongly Agree) to 5 (Strongly Disagree):</h5>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>I like to watch movies</td>
                                <td><input type="radio" name="watch_movies" value="1"></td>
                                <td><input type="radio" name="watch_movies" value="2"></td>
                                <td><input type="radio" name="watch_movies" value="3"></td>
                                <td><input type="radio" name="watch_movies" value="4"></td>
                                <td><input type="radio" name="watch_movies" value="5"></td>
                            </tr>
                            <tr>
                                <td>I like to listen to radio</td>
                                <td><input type="radio" name="listen_radio" value="1"></td>
                                <td><input type="radio" name="listen_radio" value="2"></td>
                                <td><input type="radio" name="listen_radio" value="3"></td>
                                <td><input type="radio" name="listen_radio" value="4"></td>
                                <td><input type="radio" name="listen_radio" value="5"></td>
                            </tr>
                            <tr>
                                <td>I like to eat out</td>
                                <td><input type="radio" name="eat_out" value="1"></td>
                                <td><input type="radio" name="eat_out" value="2"></td>
                                <td><input type="radio" name="eat_out" value="3"></td>
                                <td><input type="radio" name="eat_out" value="4"></td>
                                <td><input type="radio" name="eat_out" value="5"></td>
                            </tr>
                            <tr>
                                <td>I like to watch TV</td>
                                <td><input type="radio" name="watch_tv" value="1"></td>
                                <td><input type="radio" name="watch_tv" value="2"></td>
                                <td><input type="radio" name="watch_tv" value="3"></td>
                                <td><input type="radio" name="watch_tv" value="4"></td>
                                <td><input type="radio" name="watch_tv" value="5"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
