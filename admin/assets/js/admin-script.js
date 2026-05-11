/**
 * Turbo Addons Pro — Admin Dashboard Script
 * Mirrors the free plugin's admin-script.js but targets taep- prefixed elements.
 */

jQuery(document).ready(function ($) {

    // ---- Tab switching ----
    $('.taep-tab-link').on('click', function (e) {
        e.preventDefault();

        $('.taep-tab-link').removeClass('active');
        $('.taep-tab-content').removeClass('active');

        $(this).addClass('active');
        $('#' + $(this).data('tab')).addClass('active');

        // Keep all hidden current_tab inputs in sync
        $('input[name="current_tab"]').val($(this).data('tab'));
    });

    // Restore active tab on page load (after form save)
    var savedTab = $('input[name="current_tab"]').first().val();
    if (savedTab && savedTab !== '') {
        $('.taep-tab-link').removeClass('active');
        $('.taep-tab-content').removeClass('active');
        $('.taep-tab-link[data-tab="' + savedTab + '"]').addClass('active');
        $('#' + savedTab).addClass('active');
    }

    // ---- Alert dismiss ----
    $('.taep-alert-dismiss-button').on('click', function () {
        $(this).closest('.taep-alert-updated-div').fadeOut();
    });

    // ---- Admin menu icon class ----
    $('#adminmenu .toplevel_page_turbo_addons_pro .wp-menu-image img').addClass('taep-turbo-addon-pro-admin-dashboard-icon');

});


// ---- Widget category scroll-filter tabs (Free + Pro share same logic) ----
document.addEventListener('DOMContentLoaded', function () {

    // Helper: init a filter tab group
    function initFilterTabs(tabListSelector, tabContentSelector, offset) {
        var tabs        = document.querySelectorAll(tabListSelector);
        var tabContents = document.querySelectorAll(tabContentSelector);

        if (!tabs.length) return;

        // Show all sections by default (scroll-based navigation)
        tabContents.forEach(function (content) {
            content.style.display = 'block';
        });

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var targetId      = tab.getAttribute('data-tab');
                var targetContent = document.getElementById(targetId);

                tabs.forEach(function (t) { t.classList.remove('active'); });
                tab.classList.add('active');

                if (targetContent) {
                    var scrollOffset = targetContent.getBoundingClientRect().top + window.scrollY - (offset || 140);
                    window.scrollTo({ top: scrollOffset, behavior: 'smooth' });
                }
            });
        });
    }

    // Free widgets tab
    initFilterTabs(
        '.taep-widget-tabs-list .taep-widget-filter-tab-item',
        '.taep-widget-tabs-content .taep-widget-tab-content',
        140
    );

});


// ---- Select All — Free widgets ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll        = document.getElementById('taep-select-all-free-widgets');
    var widgetCheckboxes = document.querySelectorAll('.taep-widget-checkbox');

    if (!selectAll || !widgetCheckboxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(widgetCheckboxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        widgetCheckboxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    widgetCheckboxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


// ---- Select All — Pro widgets ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll        = document.getElementById('taep-select-all-pro-widgets');
    var widgetCheckboxes = document.querySelectorAll('.taep-pro-widget-checkbox');

    if (!selectAll || !widgetCheckboxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(widgetCheckboxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        widgetCheckboxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    widgetCheckboxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


// ---- Select All — Extensions ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll  = document.getElementById('taep-select-all-extensions');
    var extBoxes   = document.querySelectorAll('.taep-extension-checkbox');

    if (!selectAll || !extBoxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(extBoxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        extBoxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    extBoxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


/* ============================================================
   Realtime Latest Template Polling
   - Polls the AJAX endpoint every 30 seconds
   - Compares template name with what's currently shown
   - If different → smoothly updates the card in place (no reload)
   ============================================================ */
(function ($) {
    'use strict';

    // Only run on the pro dashboard page
    if ( typeof taepAdmin === 'undefined' ) return;
    if ( ! document.getElementById('taep-template-card') ) return;

    var POLL_INTERVAL = 30000; // 30 seconds
    var currentName   = ( document.getElementById('taep-tpl-name') || {} ).textContent || '';

    function capitalize( str ) {
        return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
    }

    function buildDesc( name ) {
        return 'A brand-new "' + name + '" template is now available in the Turbo Addons template library. Import it in one click and go live faster.';
    }

    function flashCard() {
        var card = document.getElementById('taep-template-card');
        if ( ! card ) return;
        card.classList.add('taep-card-updated');
        setTimeout(function () { card.classList.remove('taep-card-updated'); }, 1200);
    }

    function updateCard( data ) {
        var name     = data.name     || '';
        var category = data.category || '';
        var type     = data.type     || '';
        var preview  = data.preview  || '#';
        var thumb    = data.thumb    || '';
        var isPro    = ( data.pro === 'on' );

        // Thumbnail
        var thumbEl = document.getElementById('taep-tpl-thumb');
        if ( thumbEl && thumb ) {
            thumbEl.src = thumb;
            thumbEl.alt = name;
        }

        // PRO badge
        var badgeEl = document.getElementById('taep-tpl-pro-badge');
        if ( badgeEl ) badgeEl.style.display = isPro ? '' : 'none';

        // Category pill
        var catEl = document.getElementById('taep-tpl-category');
        if ( catEl ) catEl.textContent = capitalize( category );

        // Type pill
        var typeEl = document.getElementById('taep-tpl-type');
        if ( typeEl ) typeEl.textContent = capitalize( type );

        // Name
        var nameEl = document.getElementById('taep-tpl-name');
        if ( nameEl ) nameEl.textContent = name;

        // Description
        var descEl = document.getElementById('taep-tpl-desc');
        if ( descEl ) descEl.textContent = buildDesc( name );

        // Preview button href
        var previewBtn = document.getElementById('taep-tpl-preview-btn');
        if ( previewBtn ) previewBtn.href = preview;

        // Update tracked name
        currentName = name;

        // Flash the card to signal update
        flashCard();
    }

    function poll() {
        $.ajax({
            url:      taepAdmin.ajaxUrl,
            type:     'POST',
            dataType: 'json',
            data: {
                action: 'taep_fetch_latest_template',
                nonce:  taepAdmin.nonce,
            },
            success: function ( response ) {
                if ( response.success && response.data && response.data.name ) {
                    // Only update DOM if the template actually changed
                    if ( response.data.name !== currentName ) {
                        updateCard( response.data );
                    }
                }
            },
            // Silently ignore errors — next poll will retry
        });
    }

    // Start polling after 5 s (let the page settle first)
    setTimeout(function () {
        poll(); // immediate first check
        setInterval( poll, POLL_INTERVAL );
    }, 5000);

}(jQuery));


/* ============================================================
   Template Slider — dot navigation + auto-advance
   ============================================================ */
(function () {
    'use strict';

    var templates = window.taepTemplates || [];
    if ( templates.length < 2 ) return; // nothing to slide

    var currentIdx   = 0;
    var autoTimer    = null;
    var AUTO_DELAY   = 4000; // 4 s auto-advance

    // DOM refs
    var slides      = document.querySelectorAll('#taep-tpl-slides .taep-tpl-slide');
    var dots        = document.querySelectorAll('#taep-tpl-dots .taep-tpl-dot');
    var nameEl      = document.getElementById('taep-tpl-name');
    var descEl      = document.getElementById('taep-tpl-desc');
    var categoryEl  = document.getElementById('taep-tpl-category');
    var typeEl      = document.getElementById('taep-tpl-type');
    var previewBtn  = document.getElementById('taep-tpl-preview-btn');
    var currentEl   = document.getElementById('taep-tpl-current');

    function goTo( idx ) {
        if ( idx < 0 ) idx = templates.length - 1;
        if ( idx >= templates.length ) idx = 0;

        // Slides
        slides.forEach(function (s, i) {
            s.classList.toggle('active', i === idx);
        });

        // Dots
        dots.forEach(function (d, i) {
            d.classList.toggle('active', i === idx);
        });

        // Info panel
        var tpl = templates[idx];
        if ( nameEl )     nameEl.textContent     = tpl.title || '';
        if ( descEl )     descEl.textContent     = tpl.desc  ||
            'A brand-new "' + (tpl.title||'') + '" template is now available. Import it in one click and go live faster.';
        if ( categoryEl ) categoryEl.textContent = tpl.category ? tpl.category.charAt(0).toUpperCase() + tpl.category.slice(1) : '';
        if ( typeEl )     typeEl.textContent     = tpl.type     ? tpl.type.charAt(0).toUpperCase()     + tpl.type.slice(1)     : '';
        if ( previewBtn ) previewBtn.href        = tpl.link || '#';
        if ( currentEl )  currentEl.textContent  = idx + 1;

        currentIdx = idx;
    }

    // Dot click
    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            resetAuto();
            goTo( parseInt( dot.getAttribute('data-index'), 10 ) );
        });
    });

    // Auto-advance
    function startAuto() {
        autoTimer = setInterval(function () {
            goTo( currentIdx + 1 );
        }, AUTO_DELAY);
    }
    function resetAuto() {
        clearInterval( autoTimer );
        startAuto();
    }

    startAuto();
}());


/* ============================================================
   "How to Use" button — smooth scroll to video section
   ============================================================ */
document.addEventListener('DOMContentLoaded', function () {
    var btn     = document.querySelector('.taep-scroll-to-video');
    var target  = document.getElementById('watch-guide-video');
    if ( ! btn || ! target ) return;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var offset     = 80; // account for sticky WP admin bar
        var targetTop  = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top: targetTop, behavior: 'smooth' });
    });
});
