<?php
/**
 * ELOCENTRA – Bank Transfer Verification Queue
 */
?>

<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Bank Transfer Verification</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Review student bank transfer receipts and payment slips. Approving automatically activates course enrollment and marks fee as paid.</p>
    </div>

    <!-- Bank Transfers Queue Table -->
    <div class="bg-white dark:bg-[#111A2E] rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/60 border-b border-slate-200 dark:border-slate-800 text-slate-500 uppercase font-bold text-[11px]">
                        <th class="py-3 px-4">Order #</th>
                        <th class="py-3 px-4">Student</th>
                        <th class="py-3 px-4">Course</th>
                        <th class="py-3 px-4">Amount</th>
                        <th class="py-3 px-4">Bank Ref</th>
                        <th class="py-3 px-4 text-center">Slip Proof</th>
                        <th class="py-3 px-4 text-center">Date</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="9" class="text-center py-8 text-slate-400">No bank transfer submissions in queue.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $ord): ?>
                            <?php $amt = number_format((float) $ord['amount'], 2); ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                                <td class="py-3 px-4 font-mono font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($ord['order_number'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($ord['student_name'], ENT_QUOTES, 'UTF-8') ?></div>
                                    <div class="text-[10px] text-slate-400"><?= htmlspecialchars($ord['student_email'], ENT_QUOTES, 'UTF-8') ?></div>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <span><?= htmlspecialchars($ord['student_whatsapp'] ?? '—', ENT_QUOTES, 'UTF-8') ?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 font-semibold text-slate-800 dark:text-slate-200">
                                    <?= htmlspecialchars($ord['course_name'], ENT_QUOTES, 'UTF-8') ?>
                                </td>
                                <td class="py-3 px-4 font-bold text-slate-900 dark:text-white">LKR <?= $amt ?></td>
                                <td class="py-3 px-4 font-mono text-slate-500"><?= htmlspecialchars($ord['bank_reference'] ?: '—', ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4 text-center">
                                    <?php if (!empty($ord['slip_path']) && $ord['slip_path'] !== 'no_slip_uploaded'): ?>
                                        <button type="button" onclick="previewSlip('<?= BASE_URL . htmlspecialchars($ord['slip_path'], ENT_QUOTES, 'UTF-8') ?>')"
                                                class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 font-bold text-[11px] hover:underline inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <span>View Slip</span>
                                        </button>
                                    <?php else: ?>
                                        <span class="text-slate-400 italic">No file</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 text-center text-slate-400 text-[11px]"><?= date('Y-m-d', strtotime($ord['created_at'])) ?></td>
                                <td class="py-3 px-4 text-center">
                                    <?php if ($ord['payment_status'] === 'approved' || $ord['payment_status'] === 'paid'): ?>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300">Approved</span>
                                    <?php elseif ($ord['payment_status'] === 'rejected'): ?>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">Rejected</span>
                                    <?php else: ?>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 animate-pulse">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 text-right space-x-2">
                                    <?php if ($ord['payment_status'] === 'pending'): ?>
                                        <form action="<?= BASE_URL ?>/admin/bank-transfers/<?= (int) $ord['id'] ?>/approve" method="POST" class="inline" onsubmit="return confirm('Approve this bank transfer and activate course enrollment?');">
                                            <?= csrfField() ?>
                                            <button type="submit" class="px-3 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px]">Approve</button>
                                        </form>
                                        <button type="button" onclick="openRejectModal(<?= (int) $ord['id'] ?>)" class="px-3 py-1 rounded-lg bg-red-500 hover:bg-red-600 text-white font-bold text-[11px]">Reject</button>
                                    <?php else: ?>
                                        <span class="text-slate-400 text-[11px]">Processed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Slip Image Preview Modal -->
<div id="slipModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111A2E] rounded-3xl max-w-xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl p-6 overflow-hidden">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800 mb-4">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Bank Payment Slip Preview</h3>
            <button type="button" onclick="closeSlipModal()" class="text-slate-400 hover:text-white text-xl font-bold">&times;</button>
        </div>
        <div class="flex items-center justify-center max-h-[70vh] overflow-y-auto">
            <img id="slipImagePreview" src="" class="max-w-full max-h-[65vh] object-contain rounded-xl border border-slate-300 dark:border-slate-700">
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111A2E] rounded-2xl max-w-sm w-full border border-slate-200 dark:border-slate-800 shadow-2xl p-6">
        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Reject Bank Transfer</h3>
        <p class="text-xs text-slate-500 mb-4">Specify the reason for rejection (e.g. illegible slip, amount mismatch).</p>
        
        <form id="rejectForm" action="" method="POST" class="space-y-3">
            <?= csrfField() ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Reason</label>
                <textarea name="reason" rows="3" required placeholder="Reason for rejection..."
                          class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white resize-none"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-1.5 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold">Cancel</button>
                <button type="submit" class="px-4 py-1.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold">Confirm Reject</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewSlip(url) {
    document.getElementById('slipImagePreview').src = url;
    document.getElementById('slipModal').classList.remove('hidden');
}

function closeSlipModal() {
    document.getElementById('slipModal').classList.add('hidden');
}

function openRejectModal(id) {
    document.getElementById('rejectForm').action = '<?= BASE_URL ?>/admin/bank-transfers/' + id + '/reject';
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
