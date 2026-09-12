<!-- Register Modal (Popup) -->
<div id="registerModal" class="modal-overlay" style="display: none;">
    <div class="register-layout" style="position: relative; max-width: 900px; width: 95%; margin: auto; z-index: 1001;">
        <!-- Close (X) Button -->
        <span class="close-btn" onclick="closeRegisterModal()" style="position: absolute; right: 20px; top: 15px; font-size: 28px; cursor: pointer; color: var(--secondary-text); z-index: 10;">&times;</span>
        
        <section class="register-brand bg-image-panel">
            <div class="brand-header">
                <svg class="inkora-logo" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 548 769" style="width:40px;">
                    <!-- Logo Path Here (Same as login) -->
                    <path fill="currentColor" stroke-width="0" d="M244.581,527.35h69.151c-4.808,6.121-8.425,11.232-12.548,15.896-38.136,43.149-86.353,68.764-142.243,80.186-16.724,3.418-33.967,4.352-51.002,6.142-3.055.321-4.599,1.187-5.885,4.046-14.444,32.123-29.008,64.192-43.651,96.225-2.76,6.038-5.629,12.089-9.125,17.712-3.971,6.386-9.784,10.304-17.767,10.226-9.172-.09-16.514-6.389-15.959-15.467.491-8.031,2.153-16.145,4.441-23.885,10.634-35.974,26.435-69.866,43.126-103.312,3.906-7.828,4.775-14.187,1.444-22.605-10.379-26.231-12.348-54.067-12.721-81.927-.472-35.289,3.543-70.097,13.688-104.024,16.742-55.99,45.461-105.151,85.022-148.028,23.079-25.013,49.187-46.375,78.386-63.911,2.241-1.346,4.543-2.589,7.744-4.406-13.352,44.873-28.06,88.487-24.392,135.509,2.086-6.539,4.216-13.064,6.25-19.619,10.944-35.256,22.786-70.158,40.021-102.974,30.234-57.566,74.733-101.073,130.717-133.488,35.902-20.788,74.296-35.656,113.373-49.011,9.089-3.107,18.236-6.047,28.436-9.42,11.045,135.448-43.841,232.486-166.494,291.285.409.476.818.953,1.227,1.429,32.467-4.407,64.934-8.813,98.798-13.409-2.368,9.043-4.014,17.123-6.596,24.891-15.449,46.489-40.97,86.861-75.417,121.509-38.598,38.824-83.961,67.413-134.866,87.343-1.076.421-2.135.885-3.202,1.329l.041,1.758ZM75.402,634.706c.5.289.999.578,1.499.868,4.842-5.845,10.26-11.313,14.403-17.618,7.764-11.813,14.992-23.994,22.088-36.228,29.733-51.261,59.936-102.217,93.102-151.376,39.063-57.9,81.879-113.013,124.283-168.438,1.863-2.434,3.703-4.886,5.554-7.329-1.548.294-2.581,1.017-3.49,1.873-10.195,9.59-20.68,18.895-30.503,28.852-82.769,83.893-151.292,178.404-208.817,281.054-6.335,11.304-12.087,22.902-14.561,35.876-2.051,10.758-4.503,21.423-3.558,32.466Z"/>
                </svg>
                <h1 style="margin: 0; font-size: 2.4rem; font-weight: 800;">Inkora</h1>
            </div>
            <p>Share your story, connect with creators, and be part of a vibrant community that inspires and grows together.</p>
            <div class="info-box">
                <strong>Why join?</strong>
                <span>Create posts, discover inspiring content, and build your network.</span>
            </div>
        </section>
        
        <section class="register-form-panel" style="max-height: 80vh; overflow-y: auto;">
            <div class="register-form-content" style="width: 100%;">
                <h2>Create Your Account</h2>
                <p class="tagline">Join Inkora and start your writing journey.</p>
                <form id="registerForm" class="inkora-register-form">
                    <!-- First Name & Last Name (එක පේළියට) -->
                    <div class="form-row">
                        <div class="field-group">
                            <label for="regFirstName">First Name</label>
                            <div class="input-wrap"><input type="text" id="regFirstName" required></div>
                        </div>
                        <div class="field-group">
                            <label for="regLastName">Last Name</label>
                            <div class="input-wrap"><input type="text" id="regLastName" required></div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="regEmail">Email address</label>
                        <div class="input-wrap"><input type="email" id="regEmail" required></div>
                    </div>
                    
                    <div class="field-group">
                        <label for="regPassword">Password</label>
                        <div class="input-wrap"><input type="password" id="regPassword" required></div>
                    </div>

                    <!-- Birthday & Country (එක පේළියට) -->
                    <div class="form-row">
                        <div class="field-group">
                            <label for="regBirthday">Birthday</label>
                            <div class="input-wrap"><input type="date" id="regBirthday" required></div>
                        </div>
                        <div class="field-group">
                            <label for="regCountry">Country</label>
                            <div class="input-wrap select-wrap">
                                <select id="regCountry" required>
                                    <option value="" disabled>Select your country</option>
                                    <?php
                                    // ලෝකයේ ප්‍රධාන රටවල් ලැයිස්තුව
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
                                        // ශ්‍රී ලංකාව default select වී තිබීමට අවශ්‍ය නම් පහත if condition එක භාවිතා කරයි
                                        $selected = ($country === "Sri Lanka") ? "selected" : "";
                                        echo "<option value=\"$country\" $selected>$country</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <label class="checkbox-row" style="margin-top: 5px;">
                        <input type="checkbox" required>
                        <span>I agree to the <a href="#">Terms and Conditions</a></span>
                    </label>
                    
                    <button type="submit" class="btn-primary btn-wide" style="margin-top: 10px;">Create Account</button>
                </form>
                <div id="regMessage" style="margin-top: 15px; text-align: center; font-size: 14px; font-weight: bold;"></div>
                <p class="login-footer">
                    Already have an account? <a href="#" onclick="closeRegisterModal(); openLoginModal(); return false;">Login</a>
                </p>
            </div>
        </section>
    </div>
</div>