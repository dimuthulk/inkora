<!-- Register Modal (Popup) -->
<div id="registerModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span class="close-btn" onclick="closeRegisterModal()">&times;</span>
        <h2>Join InkOra</h2>
        <p class="tagline">Create an account to share your posts.</p>
        
        <form id="registerForm">
            <input type="text" id="regFirstName" placeholder="First Name" required>
            <input type="text" id="regLastName" placeholder="Last Name" required>
            <input type="email" id="regEmail" placeholder="Email" required>
            <input type="password" id="regPassword" placeholder="Password" required>
            
            <label style="font-size: 12px; margin-top: 10px; display: block;">Birthday:</label>
            <input type="date" id="regBirthday">
            
            <!-- <select id="regCountry">
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <option value="UK">UK</option>
                <option value="Other">Other</option>
            </select> -->

            <label style="font-size: 12px; margin-top: 10px; display: block;">Country:</label>
<select id="regCountry" required>
    <option value="" disabled selected>Select your country</option>
    <?php
    // ලෝකයේ ප්‍රධාන රටවල් ලැයිස්තුවක් (ඔයාට අවශ්‍ය නම් තව එකතු කරන්න පුළුවන්)
    $countries = [
        "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan",
        "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi",
        "Côte d'Ivoire", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic",
        "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic",
        "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia",
        "Fiji", "Finland", "France",
        "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana",
        "Haiti", "Holy See", "Honduras", "Hungary",
        "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy",
        "Jamaica", "Japan", "Jordan",
        "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan",
        "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg",
        "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar",
        "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway",
        "Oman",
        "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal",
        "Qatar",
        "Romania", "Russia", "Rwanda",
        "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria",
        "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu",
        "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan",
        "Vanuatu", "Venezuela", "Vietnam",
        "Yemen",
        "Zambia", "Zimbabwe"
    ];

    // Array එක හරහා ගොස් HTML <option> tags ස්වයංක්‍රීයව නිර්මාණය කිරීම
    foreach ($countries as $country) {
        // ශ්‍රී ලංකාව default select වී තිබීමට අවශ්‍ය නම් පහත if condition එක භාවිතා කළ හැක
        $selected = ($country === "Sri Lanka") ? "selected" : "";
        echo "<option value=\"$country\" $selected>$country</option>";
    }
    ?>
</select>
            
            <button type="submit" class="btn-primary">Register</button>
        </form>
        <div id="regMessage"></div>
    </div>
</div>

<style>
/* Modal (Popup) Styles */
.modal-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(17, 24, 39, 0.7); /* Deep Midnight semi-transparent */
    display: flex; justify-content: center; align-items: center;
    z-index: 1000;
}
.modal-content {
    background: #FFFFFF; /* Pure White */
    color: #1F2937; /* Charcoal */
    padding: 25px 30px; border-radius: 10px;
    width: 100%; max-width: 400px;
    position: relative;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    font-family: Arial, sans-serif;
}
.close-btn { 
    position: absolute; top: 10px; right: 15px; font-size: 24px; cursor: pointer; color: #6B7280;
}
.close-btn:hover { color: #EF4444; } /* Crimson Error Color */
#registerForm input, #registerForm select {
    width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #9CA3AF; 
    border-radius: 5px; box-sizing: border-box; font-size: 14px;
}
.btn-primary {
    width: 100%; padding: 10px; margin-top: 10px; background: #4F46E5; /* Electric Indigo */
    color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;
}
.btn-primary:hover { background: #4338CA; }
#regMessage { margin-top: 15px; text-align: center; font-size: 14px; font-weight: bold; }
</style>

<script>
// Modal Open/Close Logic
function openRegisterModal() { document.getElementById('registerModal').style.display = 'flex'; }
function closeRegisterModal() { 
    document.getElementById('registerModal').style.display = 'none'; 
    document.getElementById('registerForm').reset();
    document.getElementById('regMessage').textContent = '';
}

// Form Submit Logic
document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const msg = document.getElementById('regMessage');
    msg.textContent = 'Registering...';
    msg.style.color = '#6B7280';
    
    const payload = {
        firstName: document.getElementById('regFirstName').value,
        lastName: document.getElementById('regLastName').value,
        email: document.getElementById('regEmail').value,
        password: document.getElementById('regPassword').value,
        birthday: document.getElementById('regBirthday').value,
        country: document.getElementById('regCountry').value
    };

    try {
        const res = await fetch('api.php?action=register_user', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        
        if (res.ok) {
            msg.style.color = '#10B981'; // Success Green
            msg.textContent = data.message;
            setTimeout(closeRegisterModal, 2000); // 2 තත්පරයකින් popup එක වැහෙනවා
        } else {
            msg.style.color = '#EF4444'; // Crimson Error
            msg.textContent = data.message;
        }
    } catch (err) {
        msg.style.color = '#EF4444';
        msg.textContent = 'Connection Error: ' + err.message;
    }
});
</script>