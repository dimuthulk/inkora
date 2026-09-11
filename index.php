<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inkora - Share Your Story</title>
    <!-- Base Theme CSS -->
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/auth_modal.css">
</head>
<body>

    <!-- Navbar Component -->
    <?php include 'components/navbar.php'; ?>

    <header class="hero" style="text-align: center; padding: 4rem 1rem; background-color: var(--surface); border-bottom: 1px solid var(--border);">
        <h1 style="margin-top: 0; font-size: 2.5rem;">Welcome to Inkora</h1>
        <p style="color: var(--secondary-text); font-size: 1.2rem;">“Share Your Story. Inspire the World.”</p>
    </header>

    <main class="container">
        <h2>Latest Posts</h2>
        <div id="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <div style="background-color: var(--surface); padding: 2rem; border-radius: 8px; border: 1px solid var(--border); text-align: center; grid-column: 1 / -1; color: var(--secondary-text);">
                No posts available yet. Be the first to create one!
            </div>
        </div>
    </main>

    <!-- Modals -->
    <?php 
        //include 'components/sign_in.php';
        //include 'components/sign_up.php';
    ?>

    <script src="assets/js/auth_modal.js"></script>

    <!-- Theme Toggle Logic -->
<script>
        const themeToggleBtn = document.getElementById('themeToggle');
        
        // Load saved theme
        const savedTheme = localStorage.getItem('inkora_theme');
        if (savedTheme === 'dark') {
            document.body.setAttribute('data-theme', 'dark');
            themeToggleBtn.textContent = '☀️ Light';
        }

        themeToggleBtn.addEventListener('click', () => {
            const isDark = document.body.getAttribute('data-theme') === 'dark';
            if (isDark) {
                document.body.removeAttribute('data-theme');
                localStorage.setItem('inkora_theme', 'light');
                themeToggleBtn.textContent = '🌙 Dark';
            } else {
                document.body.setAttribute('data-theme', 'dark');
                localStorage.setItem('inkora_theme', 'dark');
                themeToggleBtn.textContent = '☀️ Light';
            }
        });
    </script>
</body>
</html>