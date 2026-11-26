<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Two-Step Student Registration View
 * Matching uploaded reference design (Bottom panels 2 & 3)
 */
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="text-center space-y-1">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            Student Registration
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Join ELOCENTRA English Academy in two simple steps
        </p>
    </div>

    <!-- Two-Step Progress Stepper (Matching Reference Image) -->
    <div class="flex items-center justify-center max-w-xs mx-auto mb-6">
        <!-- Step 1 Indicator -->
        <div class="flex flex-col items-center">
            <div id="step1Circle" class="w-9 h-9 rounded-full bg-blue-600 text-white font-bold text-sm flex items-center justify-center shadow-md shadow-blue-500/30 transition-all">
                1
            </div>
            <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300 mt-1">Personal Info</span>
        </div>

        <!-- Connector Line -->
        <div id="stepConnector" class="flex-1 h-0.5 bg-slate-200 dark:bg-slate-700 mx-3 -mt-4 transition-all"></div>

        <!-- Step 2 Indicator -->
        <div class="flex flex-col items-center">
            <div id="step2Circle" class="w-9 h-9 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 font-bold text-sm flex items-center justify-center transition-all">
                2
            </div>
            <span class="text-[10px] font-bold text-slate-400 mt-1">Account Setup</span>
        </div>
    </div>

    <!-- Two-Step Registration Form -->
    <form id="studentRegistrationForm" action="<?= BASE_URL ?>/register" method="POST" novalidate data-loading-text="Creating Account..." class="space-y-5">
        <?= csrfField() ?>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- STEP 1: PERSONAL INFORMATION                                -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div id="step1Container" class="space-y-4">
            <div class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 mb-3">
                Step 1: Personal Information
            </div>

            <!-- First Name & Last Name (Matching Reference Image) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        First Name <span class="text-amber-500 font-bold">*</span>
                    </label>
                    <input type="text" id="reg_first_name" name="first_name" required
                           value="<?= htmlspecialchars($old['first_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="e.g. Kasun"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        Last Name <span class="text-amber-500 font-bold">*</span>
                    </label>
                    <input type="text" id="reg_last_name" name="last_name" required
                           value="<?= htmlspecialchars($old['last_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="e.g. Perera"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                    Email Address <span class="text-amber-500 font-bold">*</span>
                </label>
                <input type="email" id="reg_email" name="email" required
                       value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                       placeholder="e.g. kasun@example.com"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
            </div>

            <!-- WhatsApp Contact Number -->
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                    WhatsApp Contact Number <span class="text-amber-500 font-bold">*</span>
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 text-xs font-bold">
                        +94
                    </div>
                    <input type="tel" id="reg_whatsapp" name="whatsapp" required
                           value="<?= htmlspecialchars($old['whatsapp'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="77 123 4567"
                           class="w-full pl-14 pr-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
                </div>
            </div>

            <!-- Address -->
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                    Address <span class="text-amber-500 font-bold">*</span>
                </label>
                <input type="text" id="reg_address" name="address" required
                       value="<?= htmlspecialchars($old['address'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                       placeholder="e.g. No. 45, Flower Road, Colombo 07"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
            </div>

            <!-- Step 1 Next Button -->
            <div class="pt-4 flex justify-end">
                <button type="button" id="btnGoToStep2" class="btn-gold text-sm py-3 px-8 font-bold">
                    Next &rarr;
                </button>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════ -->
        <!-- STEP 2: CREATE YOUR ACCOUNT                                 -->
        <!-- ═══════════════════════════════════════════════════════════ -->
        <div id="step2Container" class="space-y-4 hidden">
            <div class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 mb-3">
                Step 2: Create Your Account
            </div>

            <!-- Username -->
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                    Username <span class="text-amber-500 font-bold">*</span>
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <input type="text" id="reg_username" name="username" required
                           value="<?= htmlspecialchars($old['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="Choose a unique username"
                           class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                    Password <span class="text-amber-500 font-bold">*</span>
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <input type="password" id="reg_password" name="password" required
                           placeholder="At least 8 characters"
                           class="w-full pl-11 pr-11 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
                    <button type="button" onclick="togglePassVisibility('reg_password')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                    Confirm Password <span class="text-amber-500 font-bold">*</span>
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <input type="password" id="reg_confirm_password" name="confirm_password" required
                           placeholder="Re-enter password"
                           class="w-full pl-11 pr-11 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all text-sm">
                    <button type="button" onclick="togglePassVisibility('reg_confirm_password')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
            </div>

            <!-- Step 2 Action Buttons (Matching Reference Image: [<- Back] [Register]) -->
            <div class="pt-4 flex items-center justify-between gap-4">
                <button type="button" id="btnBackToStep1" class="btn-outline-gold text-sm py-2.5 px-6">
                    &larr; Back
                </button>
                <button type="submit" id="btnCompleteRegister" class="btn-gold text-sm py-3 px-8 font-bold flex-1 text-center justify-center">
                    Register
                </button>
            </div>
        </div>

    </form>

    <!-- Already have an account link -->
    <div class="text-center pt-4 border-t border-slate-200 dark:border-slate-800 text-xs text-slate-500 dark:text-slate-400">
        Already have an account? 
        <a href="<?= BASE_URL ?>/login" class="font-bold text-blue-600 dark:text-blue-400 hover:text-amber-500 transition-colors ml-1">
            Login here
        </a>
    </div>
</div>

<script>
function togglePassVisibility(id) {
    var el = document.getElementById(id);
    if (el) {
        el.type = (el.type === 'password') ? 'text' : 'password';
    }
}

(function() {
    var step1 = document.getElementById('step1Container');
    var step2 = document.getElementById('step2Container');
    var circle1 = document.getElementById('step1Circle');
    var circle2 = document.getElementById('step2Circle');
    var connector = document.getElementById('stepConnector');

    var btnGoToStep2 = document.getElementById('btnGoToStep2');
    var btnBackToStep1 = document.getElementById('btnBackToStep1');
    var regForm = document.getElementById('studentRegistrationForm');

    var step1Inputs = [
        document.getElementById('reg_first_name'),
        document.getElementById('reg_last_name'),
        document.getElementById('reg_email'),
        document.getElementById('reg_whatsapp'),
        document.getElementById('reg_address')
    ];

    btnGoToStep2.addEventListener('click', function() {
        var isValid = true;
        var firstInvalid = null;

        step1Inputs.forEach(function(input) {
            if (!input) return;
            if (window.ElocentraValidation) {
                if (!window.ElocentraValidation.validateInput(input)) {
                    isValid = false;
                    if (!firstInvalid) firstInvalid = input;
                }
            } else {
                if (!input.value.trim()) {
                    isValid = false;
                    if (!firstInvalid) firstInvalid = input;
                }
            }
        });

        if (!isValid) {
            if (firstInvalid) {
                firstInvalid.focus();
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }

        // Advance to Step 2
        step1.classList.add('hidden');
        step2.classList.remove('hidden');

        circle1.className = 'w-9 h-9 rounded-full bg-emerald-600 text-white font-bold text-sm flex items-center justify-center shadow-md';
        circle1.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>';
        connector.className = 'flex-1 h-0.5 bg-blue-600 mx-3 -mt-4 transition-all';
        circle2.className = 'w-9 h-9 rounded-full bg-blue-600 text-white font-bold text-sm flex items-center justify-center shadow-md shadow-blue-500/30 transition-all';

        // Focus first field in step 2
        var uInput = document.getElementById('reg_username');
        if (uInput) setTimeout(function() { uInput.focus(); }, 100);
    });

    btnBackToStep1.addEventListener('click', function() {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');

        circle1.className = 'w-9 h-9 rounded-full bg-blue-600 text-white font-bold text-sm flex items-center justify-center shadow-md shadow-blue-500/30 transition-all';
        circle1.innerHTML = '1';
        connector.className = 'flex-1 h-0.5 bg-slate-200 dark:bg-slate-700 mx-3 -mt-4 transition-all';
        circle2.className = 'w-9 h-9 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 font-bold text-sm flex items-center justify-center transition-all';
    });
})();
</script>
