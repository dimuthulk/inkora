<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InkOra - Home</title>
    <link rel="stylesheet" href="bin/theme.css"> <!-- ඔයාගේ අනාගත Theme CSS එක -->
    <style>
        body { font-family: Arial, sans-serif; background-color: #F9FAFB; margin: 0; padding: 0; }
        header { background: #FFFFFF; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        h1 { color: #1F2937; margin: 0; }
        .action-btn { background: #4F46E5; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        main { padding: 30px; max-width: 800px; margin: auto; }
        .post-placeholder { background: #FFFFFF; padding: 20px; border-radius: 8px; margin-bottom: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); color: #6B7280; text-align: center; }
    </style>
</head>
<body>

    <header>
        <h1>InkOra</h1>
        <!-- මේ බොත්තම එබුවාම තමයි Register Popup එක එන්නේ -->
        <button class="action-btn" onclick="openRegisterModal()">Register</button>
        <a href="./components/login_modal.php" class="action-btn">Login</a>
        
    </header>

    <main>
        <h2 style="color: #1F2937;">Latest Posts</h2>
        <div id="postsContainer">
            <!-- අනාගතයේදී Database එකෙන් Posts මෙතනට Load වේවි -->
            <div class="post-placeholder">No posts available yet. Be the first to create one!</div>
        </div>
    </main>

    <!-- Register Modal Component එක මෙතනින් Include කරගන්නවා -->
    <?php include 'components/register_modal.php'; ?>
    

</body>
</html>