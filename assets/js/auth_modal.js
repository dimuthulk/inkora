// ==========================================
// 1. Login Modal Logic
// ==========================================
function openLoginModal() {
  document.getElementById("loginModal").style.display = "flex";
}

function closeLoginModal() {
  document.getElementById("loginModal").style.display = "none";
  document.getElementById("loginForm").reset();
  document.getElementById("loginMessage").textContent = "";
}

const loginForm = document.getElementById("loginForm");
if (loginForm) {
  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    document.getElementById("loginMessage").textContent = "Logging in...";
    // (Login API එකට දත්ත යවන කේතය අනාගතයේදී මෙතනට එකතු කරන්න)
  });
}

// ==========================================
// 2. Register Modal Logic
// ==========================================
function openRegisterModal() {
  document.getElementById("registerModal").style.display = "flex";
}

function closeRegisterModal() {
  document.getElementById("registerModal").style.display = "none";
  document.getElementById("registerForm").reset();
  document.getElementById("regMessage").textContent = "";
}

const registerForm = document.getElementById("registerForm");
if (registerForm) {
  registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const msg = document.getElementById("regMessage");
    msg.textContent = "Registering...";
    msg.style.color = "#6B7280";

    const payload = {
      firstName: document.getElementById("regFirstName").value,
      lastName: document.getElementById("regLastName").value,
      email: document.getElementById("regEmail").value,
      password: document.getElementById("regPassword").value,
      birthday: document.getElementById("regBirthday").value,
      country: document.getElementById("regCountry").value,
    };

    try {
      const res = await fetch("api.php?action=register_user", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      const data = await res.json();

      if (res.ok) {
        msg.style.color = "var(--success)";
        msg.textContent = data.message;
        setTimeout(closeRegisterModal, 2000);
      } else {
        msg.style.color = "var(--error)";
        msg.textContent = data.message;
      }
    } catch (err) {
      msg.style.color = "var(--error)";
      msg.textContent = "Connection Error: " + err.message;
    }
  });
}
