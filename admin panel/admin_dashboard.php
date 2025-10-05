<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern Admin Dashboard</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #ecf0f1;
            --text-color: #34495e;
            --card-background: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        nav ul li {
            margin: 0.5rem;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        main {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-section {
            background-color: var(--card-background);
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        form {
            display: grid;
            gap: 1rem;
        }

        input,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            padding: 0.75rem;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        button:hover {
            background-color: #27ae60;
        }

        .password-section {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-top: 1rem;
        }

        .password-input {
            flex-grow: 1;
        }

        .copy-btn {
            background-color: var(--primary-color);
            padding: 0.5rem 1rem;
        }

        .copy-btn:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            main {
                padding: 1rem;
            }

            .form-section {
                padding: 1.5rem;
            }

            .password-section {
                flex-direction: column;
                align-items: stretch;
            }

            .copy-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="#addStudent">Add Student</a></li>
                <li><a href="#addFaculty">Add Faculty</a></li>
                <li><a href="#addEvent">Add Event</a></li>
            </ul>
        </nav>
    </header>

    <main>
              <!-- PHP Script to handle form submissions -->
      <?php
        // Define directories for storing JSON files and images
        $jsonDirectory = 'C:/Users/amans/Desktop/StudentPortal 4/StudentPortal/json/';
        $imageDirectory = 'C:/Users/amans/Desktop/StudentPortal 4/StudentPortal/Images/';

        // Ensure the directories exist or create them if not
        if (!file_exists($jsonDirectory)) {
            mkdir($jsonDirectory, 0777, true);
        }
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0777, true);
        }

        // Function to handle image upload and return the file path
        function uploadImage($file, $type) {
          global $imageDirectory;
          $targetDir = $imageDirectory . $type . '/'; // Separate folders for students, faculty, and events
      
          // Ensure the directory exists
          if (!file_exists($targetDir)) {
              mkdir($targetDir, 0777, true);
          }
      
          $targetFile = $targetDir . basename($file["name"]);
          $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
          $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
      
          // Validate image file type
          if (in_array($imageFileType, $allowedExtensions)) {
              if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                  // Replace backslashes with forward slashes in the file path
                  $targetFile = str_replace('\\', '/', $targetFile);
                  return $targetFile; // Return the file path if uploaded successfully
              } else {
                  return null; // Return null if upload fails
              }
          } else {
              return null; // Invalid file type
          }
      }

        // Function to write data to a JSON file
        function writeToJsonFile($filename, $data) {
            global $jsonDirectory;
            $filepath = $jsonDirectory . $filename;

            if (file_exists($filepath)) {
                $currentData = json_decode(file_get_contents($filepath), true);
            } else {
                $currentData = [];
            }

            $currentData[] = $data;
            file_put_contents($filepath, json_encode($currentData, JSON_PRETTY_PRINT));
        }

        // Check if a student already exists by email or regno
        function studentExists($email, $regno) {
            global $jsonDirectory;
            $filepath = $jsonDirectory . 'student.json';
            if (!file_exists($filepath)) return false;

            $students = json_decode(file_get_contents($filepath), true);
            foreach ($students as $student) {
                if ($student['email'] === $email || $student['regno'] === $regno) {
                    return true;
                }
            }
            return false;
        }

        // Check if a faculty already exists by email
        function facultyExists($email) {
            global $jsonDirectory;
            $filepath = $jsonDirectory . 'faculty.json';
            if (!file_exists($filepath)) return false;

            $faculties = json_decode(file_get_contents($filepath), true);
            foreach ($faculties as $faculty) {
                if ($faculty['email'] === $email) {
                    return true;
                }
            }
            return false;
        }

        // Check if an event already exists by name
        function eventExists($name) {
            global $jsonDirectory;
            $filepath = $jsonDirectory . 'event.json';
            if (!file_exists($filepath)) return false;

            $events = json_decode(file_get_contents($filepath), true);
            foreach ($events as $event) {
                if ($event['name'] === $name) {
                    return true;
                }
            }
            return false;
        }

        // Handle Student Form Submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addStudent'])) {
            $studentEmail = $_POST['studentEmail'];
            $studentRegno = $_POST['studentRegno'];

            if (studentExists($studentEmail, $studentRegno)) {
                echo "<script>alert('Student with this Email or Registration Number already exists!');</script>";
            } else {
                $studentImage = uploadImage($_FILES['studentImage'], 'student');
                if ($studentImage) {
                    $studentData = [
                        'name' => $_POST['studentName'],
                        'email' => $studentEmail,
                        'regno' => $studentRegno,
                        'password' => $_POST['studentPassword'],
                        'course' => $_POST['studentCourse'],
                        'section' => $_POST['studentSection'],
                        'image' => $studentImage
                    ];
                    writeToJsonFile('student.json', $studentData);
                    echo "<p>Student added successfully!</p>";
                    echo "<script>alert('Student added successfully!');</script>";
                } else {
                    echo "<p>Image upload failed!</p>";
                }
            }
        }

        // Handle Faculty Form Submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addFaculty'])) {
            $facultyEmail = $_POST['facultyEmail'];
            if (facultyExists($facultyEmail)) {
                echo "<script>alert('Faculty with this Email already exists!');</script>";
            } else {
                $facultyImage = uploadImage($_FILES['facultyImage'], 'faculty');
                if ($facultyImage) {
                    $facultyData = [
                        'name' => $_POST['facultyName'],
                        'email' => $facultyEmail,
                        'password' => $_POST['facultyPassword'],
                        'courses' => $_POST['facultyCourses'],
                        'image' => $facultyImage
                    ];
                    writeToJsonFile('faculty.json', $facultyData);
                    echo "<p>Faculty added successfully!</p>";
                    echo "<script>alert('Faculty added successfully!');</script>";
                } else {
                    echo "<p>Image upload failed!</p>";
                }
            }
        }

        // Handle Event Form Submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addEvent'])) {
            $eventName = $_POST['eventName'];
            if (eventExists($eventName)) {
                echo "<script>alert('Event with this name already exists!');</script>";
            } else {
                $eventImage = uploadImage($_FILES['eventImage'], 'event');
                if ($eventImage) {
                    $eventData = [
                        'name' => $eventName,
                        'venue' => $_POST['eventVenue'],
                        'from' => $_POST['eventFrom'],
                        'to' => $_POST['eventTo'],
                        'time' => $_POST['eventTime'],
                        'image' => $eventImage
                    ];
                    writeToJsonFile('event.json', $eventData);
                    echo "<p>Event added successfully!</p>";
                } else {
                    echo "<p>Image upload failed!</p>";
                }
            }
        }
      ?>

        <section id="addStudent" class="form-section">
            <h2>Add Student</h2>
            <form id="studentForm" method="POST" action="" enctype="multipart/form-data">
                <input type="text" name="studentName" placeholder="Name" required />
                <input type="email" name="studentEmail" placeholder="Email" required />
                <input type="text" name="studentRegno" placeholder="Reg No" required />
                <div class="password-section">
                    <input type="text" name="studentPassword" placeholder="Password" required class="password-input" id="studentPassword" />
                    <button type="button" onclick="generatePassword('studentPassword')">Generate Password</button>
                    <button type="button" class="copy-btn" onclick="copyPassword('studentPassword')">Copy</button>
                </div>
                <input type="text" name="studentCourse" placeholder="Course (B.Tech, MCA)" required />
                <input type="text" name="studentSection" placeholder="Section" required />
                <input type="file" name="studentImage" accept="image/*" required />
                <button type="submit" name="addStudent">Add Student</button>
            </form>
        </section>

        <section id="addFaculty" class="form-section">
            <h2>Add Faculty</h2>
            <form id="facultyForm" method="POST" action="" enctype="multipart/form-data">
                <input type="text" name="facultyName" placeholder="Name" required />
                <input type="email" name="facultyEmail" placeholder="Email" required />
                <div class="password-section">
                    <input type="text" name="facultyPassword" placeholder="Password" required class="password-input" id="facultyPassword" />
                    <button type="button" onclick="generatePassword('facultyPassword')">Generate Password</button>
                    <button type="button" class="copy-btn" onclick="copyPassword('facultyPassword')">Copy</button>
                </div>
                <textarea name="facultyCourses" placeholder="Courses and Sections (e.g., MCA - Section C - DBMS)" required></textarea>
                <input type="file" name="facultyImage" accept="image/*" required />
                <button type="submit" name="addFaculty">Add Faculty</button>
            </form>
        </section>

        <section id="addEvent" class="form-section">
            <h2>Add Event</h2>
            <form id="eventForm" method="POST" action="" enctype="multipart/form-data">
                <input type="text" name="eventName" placeholder="Event Name" required />
                <input type="text" name="eventVenue" placeholder="Venue" required />
                <input type="date" name="eventFrom" required />
                <input type="date" name="eventTo" required />
                <input type="time" name="eventTime" required />
                <input type="file" name="eventImage" accept="image/*" required />
                <button type="submit" name="addEvent">Add Event</button>
            </form>
        </section>
    </main>

    <script>
        function generatePassword(inputId) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            let password = "";
            for (let i = 0; i < 8; i++) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }
            document.getElementById(inputId).value = password;
        }

        function copyPassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            passwordInput.select();
            document.execCommand("copy");
            alert("Password copied to clipboard!");
        }
    </script>
</body>
</html>