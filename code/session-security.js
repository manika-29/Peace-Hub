// Session Security Management for PeaceHub
// This file contains shared security functions for all pages

// Session management and security functions
function isSessionValid() {
    const userSession = localStorage.getItem('peacehub_user');
    const sessionTime = localStorage.getItem('peacehub_session_time');
    
    if (!userSession || !sessionTime) {
        return false;
    }
    
    const currentTime = new Date().getTime();
    const sessionStartTime = parseInt(sessionTime);
    const sessionDuration = 30 * 60 * 1000; // 30 minutes in milliseconds
    
    // Check if session has expired
    if (currentTime - sessionStartTime > sessionDuration) {
        clearUserSession();
        return false;
    }
    
    // Update session time for active users
    localStorage.setItem('peacehub_session_time', currentTime.toString());
    return true;
}

function clearUserSession() {
    localStorage.removeItem('peacehub_user');
    localStorage.removeItem('peacehub_session_time');
    console.log('User session cleared due to expiration or security check');
}

function initializeSessionSecurity() {
    // Check for tab visibility changes (user switching tabs/minimizing)
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            // User switched away from tab - start inactivity timer
            setTimeout(() => {
                if (document.hidden && localStorage.getItem('peacehub_user')) {
                    clearUserSession();
                    location.reload();
                }
            }, 10 * 60 * 1000); // 10 minutes of inactivity
        }
    });

    // Check for window focus/blur (user switching windows)
    let inactivityTimer;
    window.addEventListener('blur', function() {
        inactivityTimer = setTimeout(() => {
            if (localStorage.getItem('peacehub_user')) {
                clearUserSession();
                alert('Session expired due to inactivity. Please login again.');
                location.reload();
            }
        }, 15 * 60 * 1000); // 15 minutes of inactivity
    });

    window.addEventListener('focus', function() {
        if (inactivityTimer) {
            clearTimeout(inactivityTimer);
        }
    });

    // Check session validity every 5 minutes
    setInterval(() => {
        if (!isSessionValid() && localStorage.getItem('peacehub_user')) {
            alert('Your session has expired for security reasons. Please login again.');
            location.reload();
        }
    }, 5 * 60 * 1000);
}

// Enhanced logout function
function secureLogout() {
    if (confirm('Are you sure you want to logout?')) {
        clearUserSession();
        alert('You have been logged out successfully!');
        location.reload(); // Refresh page to reset UI
    }
}

// Enhanced user navigation initialization with security checks
function initializeSecureUserNavigation() {
    // First check if session is valid
    if (!isSessionValid()) {
        // Session invalid or expired, show login state
        return;
    }

    const userSession = localStorage.getItem('peacehub_user');
    if (userSession) {
        try {
            const user = JSON.parse(userSession);
            
            // Hide signup buttons
            const signupBtn = document.getElementById('signup-btn');
            const mobileSignupBtn = document.getElementById('mobile-signup-btn');
            if (signupBtn) signupBtn.style.display = 'none';
            if (mobileSignupBtn) mobileSignupBtn.style.display = 'none';
            
            // Show user account sections
            const userAccount = document.getElementById('user-account');
            const mobileUserSection = document.getElementById('mobile-user-section');
            if (userAccount) userAccount.style.display = 'flex';
            if (mobileUserSection) mobileUserSection.style.display = 'block';
            
            // Update user information in desktop nav
            const userNameDisplay = document.getElementById('user-name-display');
            const userFullName = document.getElementById('user-full-name');
            const userEmail = document.getElementById('user-email');
            
            if (userNameDisplay) userNameDisplay.textContent = user.fullName.split(' ')[0]; // First name only
            if (userFullName) userFullName.textContent = user.fullName;
            if (userEmail) userEmail.textContent = user.email;
            
            // Update user information in mobile nav
            const mobileUserName = document.getElementById('mobile-user-name');
            const mobileUserEmail = document.getElementById('mobile-user-email');
            
            if (mobileUserName) mobileUserName.textContent = user.fullName;
            if (mobileUserEmail) mobileUserEmail.textContent = user.email;
            
            console.log('Secure user navigation initialized for:', user.fullName);
        } catch (error) {
            console.error('Error parsing user session:', error);
            clearUserSession();
        }
    }
}