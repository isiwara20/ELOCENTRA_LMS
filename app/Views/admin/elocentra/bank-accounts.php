<?php
/**
 * Academy Bank Accounts Management
 * ELOCENTRA – English Academy (PVT) LTD
 */
?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Academy Bank Accounts
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Manage bank accounts displayed to students during course purchasing for bank transfer payments.
            </p>
        </div>
        <div>
            <button onclick="openAddAccountModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-semibold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Bank Account
            </button>
        </div>
    </div>

    <!-- Alert / Notice -->
    <div class="bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800/60 rounded-xl p-4 text-sm text-amber-900 dark:text-amber-200 flex items-start gap-3">
        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="font-semibold mb-0.5">Dynamic Checkout Sync</p>
            <p class="text-xs text-amber-800/80 dark:text-amber-300/80">
                Any active bank account listed here is automatically presented to students on the course enrollment popup whenever they choose "Bank Transfer" as their payment method.
            </p>
        </div>
    </div>

    <!-- Accounts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($accounts)): ?>
            <?php foreach ($accounts as $acc): ?>
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col justify-between">
                    <!-- Top Ribbon -->
                    <div class="absolute top-0 right-0 left-0 h-1.5 <?= ($acc['status'] ?? 'active') === 'active' ? 'bg-gradient-to-r from-amber-500 to-amber-600' : 'bg-slate-300 dark:bg-slate-600' ?>"></div>

                    <div>
                        <div class="flex items-start justify-between gap-2 mb-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold <?= ($acc['status'] ?? 'active') === 'active' ? 'bg-emerald-100 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400' ?>">
                                <?= ucfirst($acc['status'] ?? 'active') ?>
                            </span>
                            <div class="w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 dark:text-white"><?= htmlspecialchars($acc['bank_name']) ?></h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-4"><?= htmlspecialchars($acc['branch_name'] ?: 'Main Branch') ?></p>

                        <div class="space-y-2 text-xs bg-slate-50 dark:bg-slate-900/60 p-3.5 rounded-xl border border-slate-100 dark:border-slate-800 font-mono">
                            <div>
                                <span class="text-slate-400 font-sans text-[11px] block">Account Number</span>
                                <span class="text-slate-900 dark:text-white font-bold text-sm tracking-wide"><?= htmlspecialchars($acc['account_number']) ?></span>
                            </div>
                            <div>
                                <span class="text-slate-400 font-sans text-[11px] block">Account Name</span>
                                <span class="text-slate-800 dark:text-slate-200"><?= htmlspecialchars($acc['account_name']) ?></span>
                            </div>
                            <?php if (!empty($acc['swift_code'])): ?>
                                <div>
                                    <span class="text-slate-400 font-sans text-[11px] block">SWIFT / BIC Code</span>
                                    <span class="text-slate-800 dark:text-slate-200"><?= htmlspecialchars($acc['swift_code']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($acc['instructions'])): ?>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-3 italic line-clamp-2">
                                "<?= htmlspecialchars($acc['instructions']) ?>"
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-700/60 flex items-center justify-end gap-2">
                        <button onclick='openEditAccountModal(<?= json_encode($acc) ?>)' class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                            Edit
                        </button>
                        <form action="<?= BASE_URL ?>/admin/bank-accounts/<?= $acc['id'] ?>/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this bank account?');" class="inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-12 text-center">
                <p class="text-slate-500 dark:text-slate-400 mb-4">No bank accounts configured yet.</p>
                <button onclick="openAddAccountModal()" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-semibold text-sm">
                    Add First Bank Account
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add / Edit Modal -->
<div id="accountModal" class="fixed inset-0 z-50 hidden bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in-95 duration-150">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
            <h3 id="modalTitle" class="font-bold text-slate-900 dark:text-white text-base">Add Bank Account</h3>
            <button onclick="closeAccountModal()" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="accountForm" action="<?= BASE_URL ?>/admin/bank-accounts" method="POST" class="p-6 space-y-4">
            <?= csrf_field() ?>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Bank Name <span class="text-rose-500">*</span></label>
                <input type="text" id="bank_name" name="bank_name" required placeholder="e.g., Commercial Bank of Ceylon" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Branch Name</label>
                    <input type="text" id="branch_name" name="branch_name" placeholder="e.g., Colombo Main Branch" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">SWIFT / BIC Code</label>
                    <input type="text" id="swift_code" name="swift_code" placeholder="e.g., CCEYLKLX" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Account Holder Name <span class="text-rose-500">*</span></label>
                <input type="text" id="account_name" name="account_name" required placeholder="ELOCENTRA – English Academy (PVT) LTD" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Account Number <span class="text-rose-500">*</span></label>
                    <input type="text" id="account_number" name="account_number" required placeholder="e.g., 1000234567" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm font-mono focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Status</label>
                    <select id="status" name="status" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deposit Instructions / Reference Note</label>
                <textarea id="instructions" name="instructions" rows="2" placeholder="e.g., Please include your Student ID and Order Number as the deposit reference." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-amber-500"></textarea>
            </div>

            <div class="pt-3 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-3">
                <button type="button" onclick="closeAccountModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-700">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 text-sm font-semibold shadow-md">Save Account</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddAccountModal() {
    document.getElementById('modalTitle').innerText = 'Add Bank Account';
    const form = document.getElementById('accountForm');
    form.action = '<?= BASE_URL ?>/admin/bank-accounts';
    form.reset();
    document.getElementById('status').value = 'active';
    document.getElementById('accountModal').classList.remove('hidden');
}

function openEditAccountModal(acc) {
    document.getElementById('modalTitle').innerText = 'Edit Bank Account';
    const form = document.getElementById('accountForm');
    form.action = '<?= BASE_URL ?>/admin/bank-accounts/' + acc.id + '/update';
    document.getElementById('bank_name').value = acc.bank_name || '';
    document.getElementById('branch_name').value = acc.branch_name || '';
    document.getElementById('swift_code').value = acc.swift_code || '';
    document.getElementById('account_name').value = acc.account_name || '';
    document.getElementById('account_number').value = acc.account_number || '';
    document.getElementById('status').value = acc.status || 'active';
    document.getElementById('instructions').value = acc.instructions || '';
    document.getElementById('accountModal').classList.remove('hidden');
}

function closeAccountModal() {
    document.getElementById('accountModal').classList.add('hidden');
}
</script>
