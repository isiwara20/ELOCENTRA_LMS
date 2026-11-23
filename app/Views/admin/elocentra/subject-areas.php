<?php
/**
 * ELOCENTRA – Subject Areas Management
 */
?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Subject Areas</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage academic disciplines (English & Communication, Psychology, Business Accounting, etc.) dynamically.</p>
        </div>
        <div>
            <button type="button" onclick="openCreateSubjectModal()" class="btn-gold text-xs py-2.5 px-5 font-bold">
                + Add Subject Area
            </button>
        </div>
    </div>

    <!-- Subject Areas Table -->
    <div class="bg-white dark:bg-[#111A2E] rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/60 border-b border-slate-200 dark:border-slate-800 text-slate-500 uppercase font-bold text-[11px]">
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">Subject Name</th>
                        <th class="py-3 px-4">Slug</th>
                        <th class="py-3 px-4">Description</th>
                        <th class="py-3 px-4 text-center">Courses Count</th>
                        <th class="py-3 px-4 text-center">Sort Order</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    <?php if (empty($subjects)): ?>
                        <tr><td colspan="8" class="text-center py-8 text-slate-400">No subject areas found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($subjects as $i => $s): ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                                <td class="py-3 px-4 font-bold text-slate-400"><?= $i + 1 ?></td>
                                <td class="py-3 px-4 font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($s['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4 font-mono text-slate-400"><?= htmlspecialchars($s['slug'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4 max-w-xs truncate"><?= htmlspecialchars($s['description'] ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 font-bold">
                                        <?= (int) ($s['course_count'] ?? 0) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center font-bold"><?= (int) $s['sort_order'] ?></td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase <?= $s['status'] === 'active' ? 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300' : 'bg-slate-200 text-slate-600' ?>">
                                        <?= $s['status'] ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right space-x-2">
                                    <button type="button" onclick='openEditSubjectModal(<?= json_encode($s) ?>)' class="text-blue-600 hover:underline font-semibold">Edit</button>
                                    <form action="<?= BASE_URL ?>/admin/subject-areas/<?= (int) $s['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this subject area?');">
                                        <?= csrfField() ?>
                                        <button type="submit" class="text-red-500 hover:underline font-semibold">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create / Edit Modal -->
<div id="subjectModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111A2E] rounded-2xl max-w-md w-full border border-slate-200 dark:border-slate-800 shadow-2xl p-6">
        <h3 id="subjectModalTitle" class="text-lg font-bold text-slate-900 dark:text-white mb-4">Add Subject Area</h3>
        
        <form id="subjectForm" action="<?= BASE_URL ?>/admin/subject-areas" method="POST" class="space-y-4">
            <?= csrfField() ?>
            
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Subject Area Name *</label>
                <input type="text" id="sub_name" name="name" required placeholder="e.g. Psychology"
                       class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">URL Slug</label>
                <input type="text" id="sub_slug" name="slug" placeholder="e.g. psychology (optional auto-generated)"
                       class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-mono">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Description</label>
                <textarea id="sub_desc" name="description" rows="3" placeholder="Brief subject description..."
                          class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white resize-none"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Sort Order</label>
                    <input type="number" id="sub_order" name="sort_order" value="0"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Status</label>
                    <select id="sub_status" name="status"
                            class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="closeSubjectModal()" class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold">Cancel</button>
                <button type="submit" class="btn-gold text-xs py-2 px-5 font-bold">Save Subject Area</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateSubjectModal() {
    document.getElementById('subjectModalTitle').innerText = 'Add Subject Area';
    document.getElementById('subjectForm').action = '<?= BASE_URL ?>/admin/subject-areas';
    document.getElementById('sub_name').value = '';
    document.getElementById('sub_slug').value = '';
    document.getElementById('sub_desc').value = '';
    document.getElementById('sub_order').value = '0';
    document.getElementById('sub_status').value = 'active';
    document.getElementById('subjectModal').classList.remove('hidden');
}

function openEditSubjectModal(sub) {
    document.getElementById('subjectModalTitle').innerText = 'Edit Subject Area: ' + sub.name;
    document.getElementById('subjectForm').action = '<?= BASE_URL ?>/admin/subject-areas/' + sub.id + '/update';
    document.getElementById('sub_name').value = sub.name || '';
    document.getElementById('sub_slug').value = sub.slug || '';
    document.getElementById('sub_desc').value = sub.description || '';
    document.getElementById('sub_order').value = sub.sort_order || 0;
    document.getElementById('sub_status').value = sub.status || 'active';
    document.getElementById('subjectModal').classList.remove('hidden');
}

function closeSubjectModal() {
    document.getElementById('subjectModal').classList.add('hidden');
}
</script>
