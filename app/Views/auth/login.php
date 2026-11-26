<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Dedicated Login View
 * Matching uploaded reference design (Bottom-Left panel)
 */
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Welcome Back
        </h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Login to your ELOCENTRA account
        </p>
    </div>

    <!-- Login Form -->
    <form action="<?= BASE_URL ?>/login" method="POST" class="space-y-5" novalidate data-loading-text="Signing In...">
        <?= csrfField() ?>

        <!-- Username / Email / ID -->
        <div>
            <label for="login_user_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                Username or Email <span class="text-amber-500 font-bold">*</span>
            </label>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <input type="text" id="login_user_id" name="user_id" required autofocus
                       value="<?= htmlspecialchars($old['user_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                       placeholder="Enter your username, email, or ID"
                       class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="login_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                Password <span class="text-amber-500 font-bold">*</span>
            </label>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input type="password" id="login_password" name="password" required
                       placeholder="Enter your password"
                       class="w-full pl-11 pr-11 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                <button type="button" id="togglePasswordBtn" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <svg id="pwEyeOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg id="pwEyeClosed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                </button>
            </div>
        </div>

        <!-- Remember Me & Forgot Password Row (Matching Reference Image) -->
        <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2 cursor-pointer text-slate-600 dark:text-slate-400">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#E5A93C] focus:ring-[#E5A93C] border-slate-300 dark:border-slate-700">
                <span>Remember Me</span>
            </label>
            <a href="<?= BASE_URL ?>/forgot-password" class="font-semibold text-blue-600 dark:text-blue-400 hover:text-amber-500 transition-colors">
                Forgot Password?
            </a>
        </div>

        <!-- Golden Login Button -->
        <div class="pt-2">
            <button type="submit" class="btn-gold w-full text-base py-3.5 shadow-lg shadow-amber-500/25 font-bold">
                Login
            </button>
        </div>
    </form>

    <!-- Register Link (Matching Reference Image) -->
    <div class="text-center pt-4 border-t border-slate-200 dark:border-slate-800 text-xs text-slate-500 dark:text-slate-400">
        Don't have an account? 
        <a href="<?= BASE_URL ?>/register" class="font-bold text-blue-600 dark:text-blue-400 hover:text-amber-500 transition-colors ml-1">
            Register as a Student
        </a>
    </div>
</div>

<script>
(function() {
    var toggleBtn = document.getElementById('togglePasswordBtn');
    var pwInput = document.getElementById('login_password');
    var eyeOpen = document.getElementById('pwEyeOpen');
    var eyeClosed = document.getElementById('pwEyeClosed');

    if (toggleBtn && pwInput) {
        toggleBtn.addEventListener('click', function() {
            var isPass = pwInput.type === 'password';
            pwInput.type = isPass ? 'text' : 'password';
            if (isPass) {
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        });
    }
})();
</script>
