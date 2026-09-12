<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$firstName = $isLoggedIn && isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'User';
$initial = strtoupper(substr($firstName, 0, 1));
$basePath = strpos($_SERVER['REQUEST_URI'], '/pages/') !== false ? '../' : '';
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/navbar.css">

<nav class="navbar">
    <!-- 1. Logo (Left Side) -->
    <a href="<?php echo $basePath; ?>index.php" class="nav-brand">
        <svg class="inkora-logo" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 548 769">
            <!-- (ඔයාගේ SVG Path එක මෙතන දාන්න) -->
            <path fill="currentColor" stroke-width="0" d="M244.581,527.35h69.151c-4.808,6.121-8.425,11.232-12.548,15.896-38.136,43.149-86.353,68.764-142.243,80.186-16.724,3.418-33.967,4.352-51.002,6.142-3.055.321-4.599,1.187-5.885,4.046-14.444,32.123-29.008,64.192-43.651,96.225-2.76,6.038-5.629,12.089-9.125,17.712-3.971,6.386-9.784,10.304-17.767,10.226-9.172-.09-16.514-6.389-15.959-15.467.491-8.031,2.153-16.145,4.441-23.885,10.634-35.974,26.435-69.866,43.126-103.312,3.906-7.828,4.775-14.187,1.444-22.605-10.379-26.231-12.348-54.067-12.721-81.927-.472-35.289,3.543-70.097,13.688-104.024,16.742-55.99,45.461-105.151,85.022-148.028,23.079-25.013,49.187-46.375,78.386-63.911,2.241-1.346,4.543-2.589,7.744-4.406-13.352,44.873-28.06,88.487-24.392,135.509,2.086-6.539,4.216-13.064,6.25-19.619,10.944-35.256,22.786-70.158,40.021-102.974,30.234-57.566,74.733-101.073,130.717-133.488,35.902-20.788,74.296-35.656,113.373-49.011,9.089-3.107,18.236-6.047,28.436-9.42,11.045,135.448-43.841,232.486-166.494,291.285.409.476.818.953,1.227,1.429,32.467-4.407,64.934-8.813,98.798-13.409-2.368,9.043-4.014,17.123-6.596,24.891-15.449,46.489-40.97,86.861-75.417,121.509-38.598,38.824-83.961,67.413-134.866,87.343-1.076.421-2.135.885-3.202,1.329l.041,1.758ZM75.402,634.706c.5.289.999.578,1.499.868,4.842-5.845,10.26-11.313,14.403-17.618,7.764-11.813,14.992-23.994,22.088-36.228,29.733-51.261,59.936-102.217,93.102-151.376,39.063-57.9,81.879-113.013,124.283-168.438,1.863-2.434,3.703-4.886,5.554-7.329-1.548.294-2.581,1.017-3.49,1.873-10.195,9.59-20.68,18.895-30.503,28.852-82.769,83.893-151.292,178.404-208.817,281.054-6.335,11.304-12.087,22.902-14.561,35.876-2.051,10.758-4.503,21.423-3.558,32.466Z"/>
        </svg>
        Inkora
    </a>

    <!-- Hamburger Menu Icon (Mobile Only) -->
    <div class="menu-toggle" id="mobile-menu" onclick="toggleNav()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <!-- Wrapper for Search and Links to collapse on Mobile -->
    <div class="nav-menu-wrapper" id="nav-wrapper">
        <!-- 2. Search Bar (Center) -->
        <div class="nav-search-container">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            <input type="text" placeholder="Search..." class="nav-search-input">
        </div>

        <!-- 3. Actions (Right Side) -->
        <div class="nav-links">
            <button class="btn btn-outline" id="themeToggle">☀️ Light</button>
            
            <?php if ($isLoggedIn): ?>
                <div class="profile-dropdown">
                    <div class="profile-trigger">
                        <div class="profile-avatar"><?php echo $initial; ?></div>
                        <span class="profile-name">
                            <?php echo htmlspecialchars($firstName); ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </span>
                    </div>
                    <div class="dropdown-menu">
                        <a href="<?php echo $basePath; ?>pages/profile.php">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            Settings
                        </a>
                        <a href="<?php echo $basePath; ?>api.php?action=logout">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            Logout
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <button class="btn btn-primary" onclick="openLoginModal()">Login</button>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
// Mobile Hamburger Toggle Logic
function toggleNav() {
    const navWrapper = document.getElementById('nav-wrapper');
    const menuToggle = document.getElementById('mobile-menu');
    navWrapper.classList.toggle('active');
    menuToggle.classList.toggle('active');
}
</script>