<!-- Login Modal (Popup) -->
<div id="loginModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span class="close-btn" onclick="closeLoginModal()">&times;</span>
        <h2>Welcome Back</h2>
        <p class="tagline" style="text-align: center; color: var(--secondary-text); margin-bottom: 20px;">Login to your Inkora account.</p>
        
        <form id="loginForm">
            <input type="email" id="loginEmail" placeholder="Email" required style="width: 100%; padding: 10px; margin: 8px 0; border: 1px solid var(--border); border-radius: 5px;">
            <input type="password" id="loginPassword" placeholder="Password" required style="width: 100%; padding: 10px; margin: 8px 0; border: 1px solid var(--border); border-radius: 5px;">
            
            <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; margin-top: 10px;">Login</button>
        </form>
        <div id="loginMessage" style="margin-top: 15px; text-align: center; font-size: 14px; font-weight: bold;"></div>
    </div>
</div>