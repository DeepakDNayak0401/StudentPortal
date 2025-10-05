//====================================Home Page slider css=================================

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    grabCursor: true,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

//====================================Home Page slider css=================================


//   =================================dashboard page scripting============================

const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-bar");
const closeBtn = document.querySelector("#close");

const themeToggler = document.querySelector(".theme-toggler");


menuBtn.addEventListener("click", () => {
    sideMenu.style.display = "block";
    menuBtn.style.display = "none"; 
}); 

closeBtn.addEventListener("click", () => {
    sideMenu.style.display="none";
    menuBtn.style.display = "block";
});    

themeToggler.addEventListener("click", () => {
    document.body.classList.toggle("dark-theme-variables");
    themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
    themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
});



document.querySelectorAll('.sidebar a').forEach(link => {
  link.addEventListener('click', function () {
      // Remove the active class from all links
      document.querySelectorAll('.sidebar a').forEach(nav => nav.classList.remove('active'));

      // Add the active class to the clicked link
      this.classList.add('active');
  });
});

function showCourseSection() {
  // Hide other sections
  document.querySelector('.maindashboard').style.display = 'none';
  document.querySelector('#profile-section').style.display = "none";
  document.querySelector('.course-section').style.display = 'block';
}

function showProfile() {
  // Hide other sections
  document.querySelector('.maindashboard').style.display = 'none';
  document.querySelector('.course-section').style.display = 'none';
  document.querySelector('#profile-section').style.display = "block";
}

function updateSubjects() {
  const semester = document.getElementById('semester').value;
  const subjectSelect = document.getElementById('subject');

  // Clear previous subjects
  subjectSelect.innerHTML = '<option value="">Select Subject</option>';
  subjectSelect.disabled = false;

  // Populate subjects based on selected semester
  if (semester === "1") {
      subjectSelect.innerHTML += '<option value="math">Mathematics</option>';
      subjectSelect.innerHTML += '<option value="physics">Physics</option>';
  } else if (semester === "2") {
      subjectSelect.innerHTML += '<option value="chemistry">Chemistry</option>';
      subjectSelect.innerHTML += '<option value="biology">Biology</option>';
  }
}

function displayModules() {
  const subject = document.getElementById('subject').value;
  const moduleList = document.getElementById('module-list');
  const modulesDiv = document.getElementById('modules');

  // Clear previous modules
  moduleList.innerHTML = '';

  // Populate modules based on selected subject
  if (subject === "math") {
      moduleList.innerHTML += '<tr><td>1</td><td>Math Module 1</td><td><a class="download-btn" href="../Modules/math_module1.pdf" download>Download</a></td></tr>';
      moduleList.innerHTML += '<tr><td>2</td><td>Math Module 2</td><td><a class="download-btn" href="../Modules/math_module2.pdf" download>Download</a></td></tr>';
  } else if (subject === "physics") {
      moduleList.innerHTML += '<tr><td>1</td><td>Physics Module 1</td><td><a class="download-btn" href="../Modules/physics_module1.pdf" download>Download</a></td></tr>';
      moduleList.innerHTML += '<tr><td>2</td><td>Physics Module 2</td><td><a class="download-btn" href="../Modules/physics_module2.pdf" download>Download</a></td></tr>';
  } else if (subject === "chemistry") {
      moduleList.innerHTML += '<tr><td>1</td><td>Chemistry Module 1</td><td><a class="download-btn" href="../Modules/chemistry_module1.pdf" download>Download</a></td></tr>';
  } else if (subject === "biology") {
      moduleList.innerHTML += '<tr><td>1</td><td>Biology Module 1</td><td><a class="download-btn" href="../Modules/biology_module1.pdf" download>Download</a></td></tr>';
  }

  modulesDiv.style.display = moduleList.children.length > 0 ? 'block' : 'none';
}



//   =================================dashboard page scripting============================


