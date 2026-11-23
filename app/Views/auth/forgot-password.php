<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Password Management & OTP Recovery
 * Matching uploaded reference design (Bottom panel 4)
 */
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Change Password
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Update your account password or verify via OTP if forgotten
        </p>
    </div>

    <!-- Main Password Form -->
    <form id="passwordResetForm" action="<?= BASE_URL ?>/forgot-password" method="POST" class="space-y-4">
        <?= csrfField() ?>
        <input type="hidden" name="action_type" id="formActionType" value="normal_change">
        <input type="hidden" name="verified_email" id="hiddenVerifiedEmail" value="">
        <input type="hidden" name="otp_token" id="hiddenOtpToken" value="">

        <!-- Account Identifier (Username or Email) -->
        <div>
            <label for="pwd_identifier" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                Account Username or Email <span class="text-[#E5A93C]">*</span>
            </label>
            <input type="text" id="pwd_identifier" name="identifier" required
                   placeholder="Enter your registered username or email"
                   value="<?= htmlspecialchars($old['identifier'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 text-sm">
        </div>

        <!-- Old Password Field -->
        <div id="oldPasswordGroup">
            <label for="pwd_old" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                Old Password <span class="text-[#E5A93C]">*</span>
            </label>
            <div class="relative rounded-xl shadow-sm">
                <input type="password" id="pwd_old" name="old_password"
                       placeholder="Enter your current old password"
                       class="w-full px-4 pr-11 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 text-sm">
                <button type="button" onclick="togglePassVisibility('pwd_old')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
            <!-- Clickable Link directly below Old Password (as in reference image) -->
            <div class="mt-1.5 text-right">
                <button type="button" onclick="openVerifyModal()" class="text-xs font-semibold text-[#E5A93C] hover:underline focus:outline-none">
                    Forgot your old password? Click here.
                </button>
            </div>
        </div>

        <!-- Verified OTP Notification Banner (hidden until verified) -->
        <div id="otpVerifiedBanner" class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-300 text-xs hidden flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Identity verified via OTP. You may now enter your new password.</span>
        </div>

        <!-- New Password Field -->
        <div id="newPasswordGroup">
            <label for="pwd_new" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                New Password <span class="text-[#E5A93C]">*</span>
            </label>
            <div class="relative rounded-xl shadow-sm">
                <input type="password" id="pwd_new" name="new_password" required
                       placeholder="At least 8 characters"
                       class="w-full px-4 pr-11 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 text-sm">
                <button type="button" onclick="togglePassVisibility('pwd_new')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <!-- Confirm New Password Field -->
        <div id="confirmPasswordGroup">
            <label for="pwd_confirm" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                Confirm New Password <span class="text-[#E5A93C]">*</span>
            </label>
            <div class="relative rounded-xl shadow-sm">
                <input type="password" id="pwd_confirm" name="confirm_password" required
                       placeholder="Re-enter new password"
                       class="w-full px-4 pr-11 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 text-sm">
                <button type="button" onclick="togglePassVisibility('pwd_confirm')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-3">
            <button type="submit" id="btnUpdatePassword" class="btn-gold w-full text-sm py-3 font-bold">
                Update Password
            </button>
        </div>
    </form>

    <!-- Return to Login link -->
    <div class="text-center pt-2 text-xs text-slate-500">
        Remember your password?
        <a href="<?= BASE_URL ?>/login" class="font-bold text-[#E5A93C] hover:underline ml-1">
            Back to Login
        </a>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- "VERIFY IT'S ME" OTP POPUP MODAL (MATCHING REFERENCE IMAGE)         -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<div id="verifyModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111A2E] rounded-3xl max-w-md w-full border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-8 relative">
        
        <!-- Close Button (x) -->
        <button type="button" onclick="closeVerifyModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 dark:hover:text-white text-xl font-bold">
            &times;
        </button>

        <!-- Title & Subtitle -->
        <div class="mb-5 space-y-1">
            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white">
                Verify It's Me
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Enter your registered email and the OTP sent to your email.
            </p>
        </div>

        <!-- Modal Status Notice -->
        <div id="modalNotice" class="hidden mb-4 p-3 rounded-xl text-xs font-medium"></div>

        <!-- Email Input with Send OTP Button -->
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                    Registered Email Address *
                </label>
                <div class="flex gap-2">
                    <input type="email" id="otp_email" placeholder="e.g. student@elocentra.academy"
                           class="flex-1 px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] text-sm">
                    <button type="button" id="btnSendOtp" onclick="sendOtpCode()" class="btn-gold text-xs py-2 px-4 shrink-0 font-bold">
                        Send OTP
                    </button>
                </div>
            </div>

            <!-- OTP 6 Digit Inputs (Matching Reference Image) -->
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">
                    Enter 6-Digit OTP *
                </label>
                <div class="flex items-center justify-between gap-2 max-w-xs mx-auto">
                    <input type="text" maxlength="1" class="otp-box w-11 h-12 text-center text-lg font-bold rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 outline-none">
                    <input type="text" maxlength="1" class="otp-box w-11 h-12 text-center text-lg font-bold rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 outline-none">
                    <input type="text" maxlength="1" class="otp-box w-11 h-12 text-center text-lg font-bold rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 outline-none">
                    <input type="text" maxlength="1" class="otp-box w-11 h-12 text-center text-lg font-bold rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 outline-none">
                    <input type="text" maxlength="1" class="otp-box w-11 h-12 text-center text-lg font-bold rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 outline-none">
                    <input type="text" maxlength="1" class="otp-box w-11 h-12 text-center text-lg font-bold rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 outline-none">
                </div>
            </div>

            <!-- Modal Action Buttons: [Close] [Verify It's Me] (Matching Reference Image) -->
            <div class="pt-4 flex items-center justify-between gap-3 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeVerifyModal()" class="px-5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-slate-800">
                    Close
                </button>
                <button type="button" id="btnVerifyOtp" onclick="verifyOtpCode()" disabled
                        class="btn-gold text-xs py-2.5 px-6 opacity-50 cursor-not-allowed transition-all font-bold">
                    Verify It's Me
                </button>
            </div>
        </div>

    </div>
</div>

<script>
function togglePassVisibility(id) {
    var el = document.getElementById(id);
    if (el) el.type = (el.type === 'password') ? 'text' : 'password';
}

function openVerifyModal() {
    var modal = document.getElementById('verifyModal');
    var iden = document.getElementById('pwd_identifier').value.trim();
    if (iden && iden.includes('@')) {
        document.getElementById('otp_email').value = iden;
    }
    if (modal) modal.classList.remove('hidden');
}

function closeVerifyModal() {
    var modal = document.getElementById('verifyModal');
    if (modal) modal.classList.add('hidden');
}

// 6-digit OTP Box Auto-tabbing
var otpBoxes = document.querySelectorAll('.otp-box');
otpBoxes.forEach(function(box, index) {
    box.addEventListener('input', function() {
        if (box.value.length === 1 && index < otpBoxes.length - 1) {
            otpBoxes[index + 1].focus();
        }
        checkOtpComplete();
    });

    box.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace' && !box.value && index > 0) {
            otpBoxes[index - 1].focus();
        }
    });
});

function getOtpValue() {
    var val = '';
    otpBoxes.forEach(function(b) { val += b.value.trim(); });
    return val;
}

function checkOtpComplete() {
    var verifyBtn = document.getElementById('btnVerifyOtp');
    var code = getOtpValue();
    if (code.length === 6) {
        verifyBtn.removeAttribute('disabled');
        verifyBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        verifyBtn.setAttribute('disabled', 'disabled');
        verifyBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }
}

function showNotice(msg, isSuccess) {
    var n = document.getElementById('modalNotice');
    n.classList.remove('hidden', 'bg-red-500/10', 'text-red-700', 'border-red-500/30', 'bg-emerald-500/10', 'text-emerald-700', 'border-emerald-500/30');
    if (isSuccess) {
        n.classList.add('bg-emerald-500/10', 'text-emerald-700', 'border', 'border-emerald-500/30');
    } else {
        n.classList.add('bg-red-500/10', 'text-red-700', 'border', 'border-red-500/30');
    }
    n.innerHTML = msg;
}

function sendOtpCode() {
    var email = document.getElementById('otp_email').value.trim();
    if (!email || !email.includes('@')) {
        showNotice('Please enter a valid registered email address.', false);
        return;
    }

    var btn = document.getElementById('btnSendOtp');
    btn.innerHTML = 'Sending...';
    btn.setAttribute('disabled', 'disabled');

    var fd = new FormData();
    fd.append('email', email);
    fd.append('_csrf_token', '<?= csrf_token() ?>');

    fetch('<?= BASE_URL ?>/auth/send-otp', {
        method: 'POST',
        body: fd
    })
    .then(function(r) { return r.json(); })
    .then(function(res) {
        btn.innerHTML = 'Send OTP';
        btn.removeAttribute('disabled');
        if (res.success) {
            showNotice(res.message, true);
            otpBoxes[0].focus();
        } else {
            showNotice(res.message || 'Email not found in our records.', false);
        }
    })
    .catch(function() {
        btn.innerHTML = 'Send OTP';
        btn.removeAttribute('disabled');
        showNotice('Connection error. Please try again.', false);
    });
}

function verifyOtpCode() {
    var email = document.getElementById('otp_email').value.trim();
    var code = getOtpValue();
    var btn = document.getElementById('btnVerifyOtp');

    btn.innerHTML = 'Verifying...';
    btn.setAttribute('disabled', 'disabled');

    var fd = new FormData();
    fd.append('email', email);
    fd.append('otp', code);
    fd.append('_csrf_token', '<?= csrf_token() ?>');

    fetch('<?= BASE_URL ?>/auth/verify-otp', {
        method: 'POST',
        body: fd
    })
    .then(function(r) { return r.json(); })
    .then(function(res) {
        btn.innerHTML = 'Verify It\'s Me';
        btn.removeAttribute('disabled');
        if (res.success) {
            closeVerifyModal();
            // Unlock fields
            document.getElementById('oldPasswordGroup').classList.add('hidden');
            document.getElementById('otpVerifiedBanner').classList.remove('hidden');
            document.getElementById('formActionType').value = 'otp_recovery';
            document.getElementById('hiddenVerifiedEmail').value = email;
            document.getElementById('hiddenOtpToken').value = res.token || code;
            document.getElementById('pwd_identifier').value = email;
            document.getElementById('pwd_new').focus();
        } else {
            showNotice(res.message || 'Invalid or expired OTP. Please check and retry.', false);
        }
    })
    .catch(function() {
        btn.innerHTML = 'Verify It\'s Me';
        btn.removeAttribute('disabled');
        showNotice('Verification failed. Please try again.', false);
    });
}
</script>
