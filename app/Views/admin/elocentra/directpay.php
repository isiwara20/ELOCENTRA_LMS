<?php
/**
 * DirectPay Payment Gateway Configuration
 * ELOCENTRA – English Academy (PVT) LTD
 */
?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="2" y="5" width="20" height="14" rx="2" stroke-width="2"/>
                    <line x1="2" y1="10" x2="22" y2="10" stroke-width="2"/>
                </svg>
                DirectPay Payment Gateway
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Configure card payment processing for student course purchases via DirectPay Sri Lanka.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold <?= !empty($config['is_enabled']) ? 'bg-emerald-100 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700' ?>">
                <span class="w-2 h-2 rounded-full <?= !empty($config['is_enabled']) ? 'bg-emerald-500' : 'bg-slate-400' ?>"></span>
                <?= !empty($config['is_enabled']) ? 'Gateway Active' : 'Gateway Disabled' ?>
            </span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-950/40 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800 uppercase">
                <?= htmlspecialchars($config['environment'] ?? 'sandbox') ?> Mode
            </span>
        </div>
    </div>

    <!-- Alert / Notice -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/30 border border-blue-200 dark:border-blue-800/60 rounded-xl p-4 text-sm text-blue-900 dark:text-blue-200 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="font-semibold mb-1">DirectPay Payment Processing</p>
            <p class="text-xs text-blue-800/80 dark:text-blue-300/80">
                DirectPay allows students to pay for courses instantly using Visa, MasterCard, and LankaPay. When configured, students who choose Card Payment during checkout are enrolled immediately upon payment verification.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Configuration Form -->
        <div class="lg:col-span-2">
            <form action="<?= BASE_URL ?>/admin/directpay" method="POST" class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-6">
                <?= csrf_field() ?>

                <!-- Status Toggle -->
                <div class="flex items-center justify-between pb-5 border-b border-slate-200 dark:border-slate-700">
                    <div>
                        <h3 class="font-semibold text-slate-900 dark:text-white">Enable DirectPay Card Payments</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">When disabled, only Bank Transfer payment will be available to students.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_enabled" value="1" <?= !empty($config['is_enabled']) ? 'checked' : '' ?> class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-amber-500"></div>
                    </label>
                </div>

                <!-- Environment -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Gateway Environment</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center gap-3 p-3.5 border rounded-xl cursor-pointer hover:border-amber-500 transition-colors <?= ($config['environment'] ?? 'sandbox') === 'sandbox' ? 'border-amber-500 bg-amber-50/50 dark:bg-amber-950/20' : 'border-slate-200 dark:border-slate-700' ?>">
                            <input type="radio" name="environment" value="sandbox" <?= ($config['environment'] ?? 'sandbox') === 'sandbox' ? 'checked' : '' ?> class="text-amber-500 focus:ring-amber-500">
                            <div>
                                <span class="block text-sm font-semibold text-slate-900 dark:text-white">Sandbox (Testing)</span>
                                <span class="block text-xs text-slate-500 dark:text-slate-400">Use for test transactions without real charges</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3.5 border rounded-xl cursor-pointer hover:border-amber-500 transition-colors <?= ($config['environment'] ?? '') === 'production' ? 'border-amber-500 bg-amber-50/50 dark:bg-amber-950/20' : 'border-slate-200 dark:border-slate-700' ?>">
                            <input type="radio" name="environment" value="production" <?= ($config['environment'] ?? '') === 'production' ? 'checked' : '' ?> class="text-amber-500 focus:ring-amber-500">
                            <div>
                                <span class="block text-sm font-semibold text-slate-900 dark:text-white">Production (Live)</span>
                                <span class="block text-xs text-slate-500 dark:text-slate-400">Live processing with real bank settlement</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Merchant ID -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        Merchant ID <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="merchant_id" required value="<?= htmlspecialchars($config['merchant_id'] ?? '') ?>" placeholder="e.g., DP_ELOCENTRA_01" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm font-mono">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Provided by DirectPay when your merchant account is created.</p>
                </div>

                <!-- API Key -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        API Key (Public Key)
                    </label>
                    <input type="text" name="api_key" value="<?= htmlspecialchars($config['api_key'] ?? '') ?>" placeholder="dp_live_xxxx... or dp_test_xxxx..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm font-mono">
                </div>

                <!-- Secret Key -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        Secret Key / Signature Secret
                    </label>
                    <div class="relative">
                        <input type="password" id="secret_key_input" name="secret_key" value="<?= htmlspecialchars($config['secret_key'] ?? '') ?>" placeholder="••••••••••••••••••••••••" class="w-full px-4 py-2.5 pr-10 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm font-mono">
                        <button type="button" onclick="toggleSecret()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                            <svg id="eye_icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Used to verify incoming payment notification webhooks securely.</p>
                </div>

                <!-- Currency -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Processing Currency</label>
                    <select name="currency" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm">
                        <option value="LKR" <?= ($config['currency'] ?? 'LKR') === 'LKR' ? 'selected' : '' ?>>LKR – Sri Lankan Rupee (Rs.)</option>
                        <option value="USD" <?= ($config['currency'] ?? '') === 'USD' ? 'selected' : '' ?>>USD – United States Dollar ($)</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-semibold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Configuration
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar Info & Webhook Details -->
        <div class="space-y-6">
            <!-- Webhook / Callback card -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-5 shadow-sm space-y-4">
                <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    Callback & Webhook URLs
                </h3>
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="block text-slate-500 dark:text-slate-400 font-medium mb-1">Return / Success URL:</span>
                        <div class="p-2 bg-slate-100 dark:bg-slate-900 rounded-lg text-slate-700 dark:text-slate-300 font-mono break-all select-all">
                            <?= BASE_URL ?>/payment/directpay/callback
                        </div>
                    </div>
                    <div>
                        <span class="block text-slate-500 dark:text-slate-400 font-medium mb-1">Cancel / Failure URL:</span>
                        <div class="p-2 bg-slate-100 dark:bg-slate-900 rounded-lg text-slate-700 dark:text-slate-300 font-mono break-all select-all">
                            <?= BASE_URL ?>/courses
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supported Payment Channels -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-5 shadow-sm space-y-3">
                <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">
                    Accepted Channels
                </h3>
                <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Visa Credit & Debit Cards
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        MasterCard Credit & Debit Cards
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        LankaPay JustPay (Instant Bank Debit)
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        3D Secure 2.0 OTP Authentication
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSecret() {
    const input = document.getElementById('secret_key_input');
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}
</script>
