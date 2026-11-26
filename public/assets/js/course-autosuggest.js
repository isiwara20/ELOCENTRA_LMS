/**
 * ELOCENTRA LMS - Course Search Auto-Suggestions Engine
 * Provides fast, debounced, keyboard-navigable auto-suggestions with
 * live course previews, highlighted matches, and theme integration.
 */
(function() {
    'use strict';

    var queryCache = {};

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function highlightMatch(text, query) {
        if (!text || !query) return escapeHtml(text || '');
        var escapedText = escapeHtml(text);
        var escapedQuery = escapeHtml(query).replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        var regex = new RegExp('(' + escapedQuery + ')', 'gi');
        return escapedText.replace(regex, '<mark class="bg-amber-400/30 text-amber-600 dark:text-amber-300 font-semibold px-0.5 rounded">$1</mark>');
    }

    function initAutoSuggest(config) {
        var input = document.querySelector(config.inputSelector);
        var container = document.querySelector(config.containerSelector);
        var form = config.formSelector ? document.querySelector(config.formSelector) : (input ? input.closest('form') : null);

        if (!input || !container) return;

        var debounceTimer = null;
        var activeIndex = -1;
        var currentItems = [];
        var baseUrl = window.ELOCENTRA_BASE_URL || '';

        // Position & styling guarantee
        container.style.zIndex = '9999';

        function showLoading() {
            container.innerHTML = `
                <div class="p-4 text-center text-xs text-slate-500 dark:text-slate-400 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 animate-spin text-amber-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Searching courses...</span>
                </div>
            `;
            container.classList.remove('hidden');
        }

        function renderResults(query, results) {
            currentItems = results;
            activeIndex = -1;

            if (!results || results.length === 0) {
                container.innerHTML = `
                    <div class="p-5 text-center text-xs text-slate-500 dark:text-slate-400">
                        <svg class="w-8 h-8 mx-auto mb-2 text-slate-400 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-medium text-slate-700 dark:text-slate-200">No matching courses found</p>
                        <p class="text-[11px] text-slate-400 mt-1">Try keywords like "English", "Business", "Grammar", or "Diploma"</p>
                    </div>
                `;
                container.classList.remove('hidden');
                return;
            }

            var html = '<div class="p-2 space-y-1">';
            results.forEach(function(item, idx) {
                var titleHl = highlightMatch(item.title, query);
                var categoryHl = highlightMatch(item.category, query);
                var codeHl = item.code ? `<span class="text-[10px] font-mono text-slate-400 bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded ml-1.5">${escapeHtml(item.code)}</span>` : '';

                html += `
                    <a href="${item.url}" 
                       data-index="${idx}" 
                       class="course-suggest-item flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/80 transition-all cursor-pointer group text-left">
                        <div class="w-11 h-11 rounded-lg overflow-hidden flex-shrink-0 bg-slate-200 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                            <img src="${item.image}" alt="${escapeHtml(item.title)}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='${baseUrl}/public/assets/img/courses/detail-preview.jpg'">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-1.5">
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate group-hover:text-blue-600 dark:group-hover:text-[#F59E0B] transition-colors">
                                    ${titleHl}
                                </h4>
                                ${codeHl}
                            </div>
                            <div class="flex items-center gap-2 mt-0.5 text-[11px] text-slate-500 dark:text-slate-400">
                                <span class="truncate">${categoryHl}</span>
                                <span>&middot;</span>
                                <span class="font-semibold text-amber-600 dark:text-amber-400">${escapeHtml(item.fee)}</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 dark:group-hover:text-[#F59E0B] flex-shrink-0 transform group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                `;
            });
            html += '</div>';

            // Footer row with "View all results" link
            var targetSearchUrl = `${baseUrl}/courses?search=${encodeURIComponent(query)}`;
            html += `
                <div class="p-2.5 bg-slate-50 dark:bg-slate-900/60 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
                    <span class="text-slate-500 dark:text-slate-400">${results.length} course${results.length > 1 ? 's' : ''} found</span>
                    <a href="${targetSearchUrl}" class="font-bold text-blue-600 dark:text-blue-400 hover:text-amber-500 dark:hover:text-amber-400 inline-flex items-center gap-1 transition-colors">
                        <span>See all matching courses</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            `;

            container.innerHTML = html;
            container.classList.remove('hidden');
        }

        function hideDropdown() {
            container.classList.add('hidden');
            activeIndex = -1;
        }

        function highlightActiveItem() {
            var items = container.querySelectorAll('.course-suggest-item');
            items.forEach(function(el, idx) {
                if (idx === activeIndex) {
                    el.classList.add('bg-blue-50', 'dark:bg-slate-800', 'ring-1', 'ring-blue-500/40');
                    el.scrollIntoView({ block: 'nearest' });
                } else {
                    el.classList.remove('bg-blue-50', 'dark:bg-slate-800', 'ring-1', 'ring-blue-500/40');
                }
            });
        }

        function fetchSuggestions(query) {
            query = query.trim();
            if (query.length < 1) {
                hideDropdown();
                return;
            }

            if (queryCache[query]) {
                renderResults(query, queryCache[query]);
                return;
            }

            showLoading();

            var suggestUrl = `${baseUrl}/courses/suggest?q=${encodeURIComponent(query)}`;
            fetch(suggestUrl, { credentials: 'same-origin' })
                .then(function(res) {
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    return res.json();
                })
                .then(function(data) {
                    var items = (data && data.results) ? data.results : [];
                    queryCache[query] = items;
                    renderResults(query, items);
                })
                .catch(function(err) {
                    console.error('Course auto-suggest error:', err);
                    container.innerHTML = `
                        <div class="p-3 text-center text-xs text-slate-500 dark:text-slate-400">
                            <span>Press enter to search courses</span>
                        </div>
                    `;
                });
        }

        // Input event (debounced)
        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            var query = this.value;
            debounceTimer = setTimeout(function() {
                fetchSuggestions(query);
            }, 200);
        });

        // Focus event
        input.addEventListener('focus', function() {
            if (this.value.trim().length >= 1) {
                fetchSuggestions(this.value);
            }
        });

        // Keyboard navigation
        input.addEventListener('keydown', function(e) {
            if (container.classList.contains('hidden') || !currentItems.length) {
                return;
            }

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                activeIndex = (activeIndex + 1 >= currentItems.length) ? 0 : activeIndex + 1;
                highlightActiveItem();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                activeIndex = (activeIndex - 1 < 0) ? currentItems.length - 1 : activeIndex - 1;
                highlightActiveItem();
            } else if (e.key === 'Enter') {
                if (activeIndex >= 0 && activeIndex < currentItems.length) {
                    e.preventDefault();
                    window.location.href = currentItems[activeIndex].url;
                }
            } else if (e.key === 'Escape') {
                e.preventDefault();
                hideDropdown();
            }
        });

        // Close on click outside
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !container.contains(e.target)) {
                hideDropdown();
            }
        });
    }

    // Initialize all search instances when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Courses Page Search Bar
        initAutoSuggest({
            inputSelector: '#courseSearchInput',
            containerSelector: '#courseAutoSuggestions',
            formSelector: '#courseCatalogSearchForm'
        });

        // 2. Desktop Header Search Bar
        initAutoSuggest({
            inputSelector: '#headerSearchInput',
            containerSelector: '#headerSearchSuggestions',
            formSelector: '#headerSearchForm'
        });

        // 3. Mobile Header Search Bar
        initAutoSuggest({
            inputSelector: '#mobileSearchInput',
            containerSelector: '#mobileSearchSuggestions',
            formSelector: '#mobileSearchForm'
        });
    });
})();
