<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inkora</title>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/auth_modal.css">
</head>
<body>
    <main class="container register-page">
        <div class="register-layout">
            <section class="register-brand">
                <div class="brand-header">
                    <svg class="inkora-logo" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 548 769">
                        <path fill="currentColor" stroke-width="0" d="M244.581,527.35h69.151c-4.808,6.121-8.425,11.232-12.548,15.896-38.136,43.149-86.353,68.764-142.243,80.186-16.724,3.418-33.967,4.352-51.002,6.142-3.055.321-4.599,1.187-5.885,4.046-14.444,32.123-29.008,64.192-43.651,96.225-2.76,6.038-5.629,12.089-9.125,17.712-3.971,6.386-9.784,10.304-17.767,10.226-9.172-.09-16.514-6.389-15.959-15.467.491-8.031,2.153-16.145,4.441-23.885,10.634-35.974,26.435-69.866,43.126-103.312,3.906-7.828,4.775-14.187,1.444-22.605-10.379-26.231-12.348-54.067-12.721-81.927-.472-35.289,3.543-70.097,13.688-104.024,16.742-55.99,45.461-105.151,85.022-148.028,23.079-25.013,49.187-46.375,78.386-63.911,2.241-1.346,4.543-2.589,7.744-4.406-13.352,44.873-28.06,88.487-24.392,135.509,2.086-6.539,4.216-13.064,6.25-19.619,10.944-35.256,22.786-70.158,40.021-102.974,30.234-57.566,74.733-101.073,130.717-133.488,35.902-20.788,74.296-35.656,113.373-49.011,9.089-3.107,18.236-6.047,28.436-9.42,11.045,135.448-43.841,232.486-166.494,291.285.409.476.818.953,1.227,1.429,32.467-4.407,64.934-8.813,98.798-13.409-2.368,9.043-4.014,17.123-6.596,24.891-15.449,46.489-40.97,86.861-75.417,121.509-38.598,38.824-83.961,67.413-134.866,87.343-1.076.421-2.135.885-3.202,1.329l.041,1.758ZM75.402,634.706c.5.289.999.578,1.499.868,4.842-5.845,10.26-11.313,14.403-17.618,7.764-11.813,14.992-23.994,22.088-36.228,29.733-51.261,59.936-102.217,93.102-151.376,39.063-57.9,81.879-113.013,124.283-168.438,1.863-2.434,3.703-4.886,5.554-7.329-1.548.294-2.581,1.017-3.49,1.873-10.195,9.59-20.68,18.895-30.503,28.852-82.769,83.893-151.292,178.404-208.817,281.054-6.335,11.304-12.087,22.902-14.561,35.876-2.051,10.758-4.503,21.423-3.558,32.466Z"/>
                    </svg>
                    <h1 style="margin: 0; font-size: 2.4rem; font-weight: 800;">Inkora</h1>
                </div>

                <p>
                    Share your story, connect with creators, and be part of a vibrant community that inspires and grows together.
                </p>

                <div class="info-box">
                    <strong>Welcome back</strong>
                    <span>Continue your creative journey and discover fresh inspiration every day.</span>
                </div>
            </section>

            <section class="login-form-panel">
                <div class="modal-content register-form-content">
                    <h2>Welcome Back</h2>
                    <p class="tagline">Login to continue your journey.</p>

                    <form id="loginForm" class="inkora-register-form">
                        <div class="field-group">
                            <label for="loginEmail">Email address</label>
                            <div class="input-wrap">
                                <input type="email" id="loginEmail" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <div class="field-group">
                            <label for="loginPassword">Password</label>
                            <div class="input-wrap">
                                <input type="password" id="loginPassword" placeholder="Enter your password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary btn-wide">Login</button>
                    </form>

                    <div id="loginMessage"></div>

                    <p class="login-footer">
                        Don't have an account? <a href="register.php">Sign Up</a>
                    </p>
                </div>
            </section>
        </div>
    </main>

    <script src="../assets/js/auth_modal.js"></script>
</body>
</html>
