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
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const msg = document.getElementById("loginMessage");
    msg.textContent = "Logging in...";
    msg.style.color = "#6B7280";

    const payload = {
      email: document.getElementById("loginEmail").value,
      password: document.getElementById("loginPassword").value,
    };

    try {
      const loginApiUrl = window.location.pathname.includes("/pages/")
        ? "../api.php?action=login"
        : "api.php?action=login";

      const res = await fetch(loginApiUrl, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      const data = await res.json();

      if (res.ok) {
        msg.style.color = "var(--success)";
        msg.textContent = data.message;
        setTimeout(() => {
          // Home page (index.php) එකට redirect වීම
          window.location.href = window.location.pathname.includes("/pages/")
            ? "../index.php"
            : "index.php";
        }, 1000);
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
      const registerApiUrl = window.location.pathname.includes("/pages/")
        ? "../api.php?action=register_user"
        : "api.php?action=register_user";

      const res = await fetch(registerApiUrl, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      const data = await res.json();

      if (res.ok) {
        msg.style.color = "var(--success)";
        msg.textContent = data.message;

        // තත්පර 2කට පසුව Register එක වැහිලා Login එක open වීම
        setTimeout(() => {
          closeRegisterModal(); // Sign Up modal එක වසයි
          openLoginModal(); // Sign In modal එක විවෘත කරයි
        }, 2000);
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
