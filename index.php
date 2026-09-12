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
        include 'components/sign_in.php';
        include 'components/sign_up.php';
    ?>

    <script src="assets/js/auth_modal.js"></script>

<!-- Theme Toggle Logic -->
<script>
    const themeToggleBtn = document.getElementById('themeToggle');
    
    // 1. LocalStorage එකේ Save කරපු Theme එකක් තියෙනවද බැලීම
    const savedTheme = localStorage.getItem('inkora_theme');
    
    // 2. User ගේ OS/Browser Default Theme එක Dark ද කියලා බැලීම
    const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Theme එක Apply කරන Function එක
    const applyTheme = (isDark) => {
        if (isDark) {
            document.body.setAttribute('data-theme', 'dark');
            themeToggleBtn.textContent = '☀️ Light';
        } else {
            document.body.removeAttribute('data-theme');
            themeToggleBtn.textContent = '🌙 Dark';
        }
    };

    // පිටුව Load වෙද්දී නිවැරදි Theme එක ලබා දීම
    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        applyTheme(true);
    } else {
        applyTheme(false);
    }

    // Toggle Button Click එක
    themeToggleBtn.addEventListener('click', () => {
        const isDark = document.body.getAttribute('data-theme') === 'dark';
        applyTheme(!isDark);
        localStorage.setItem('inkora_theme', !isDark ? 'dark' : 'light');
    });
</script>
</body>
</html>