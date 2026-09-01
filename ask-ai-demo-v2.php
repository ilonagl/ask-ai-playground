<?php
/**
 * Plugin Name: Ask AI Masterbar Prototype (Playground demo)
 * Description: Staged, self-contained replica of Ilona's wp-admin masterbar + Support Assistant prototype (2026-08-24). All chat responses are canned — no real AI, no wpcom backend.
 */

add_action( 'admin_bar_menu', function ( $bar ) {
	$icons = array(
		'help'   => '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M12 4a8 8 0 1 1 .001 16.001A8 8 0 0 1 12 4Zm0 1.5a6.5 6.5 0 1 0-.001 13.001A6.5 6.5 0 0 0 12 5.5Zm.75 11h-1.5V15h1.5v1.5Zm-.445-9.234a3 3 0 0 1 .445 5.89V14h-1.5v-1.25c0-.57.452-.958.917-1.01A1.5 1.5 0 0 0 12 8.75a1.5 1.5 0 0 0-1.5 1.5H9a3 3 0 0 1 3.305-2.984Z"/></svg>',
		'bell'   => '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M17 11.5c0 1.353.17 2.368.976 3 .266.209.602.376 1.024.5v1H5v-1c.422-.124.757-.291 1.024-.5.806-.632.976-1.647.976-3V9c0-2.8 2.2-5 5-5s5 2.2 5 5v2.5ZM15.5 9v2.5c0 .93.066 1.98.515 2.897l.053.103H7.932a4.018 4.018 0 0 0 .053-.103c.449-.917.515-1.967.515-2.897V9c0-1.972 1.528-3.5 3.5-3.5s3.5 1.528 3.5 3.5Zm-5.492 9.008c0-.176.023-.346.065-.508h3.854A1.996 1.996 0 0 1 12 20c-1.1 0-1.992-.892-1.992-1.992Z"/></svg>',
		'reader' => '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M7.5 8.5A3.5 3.5 0 1 1 4 12a3.5 3.5 0 0 1 3.5-3.5Zm0 1.5A2 2 0 1 0 9.5 12 2 2 0 0 0 7.5 10Zm9-1.5A3.5 3.5 0 1 1 13 12a3.5 3.5 0 0 1 3.5-3.5Zm0 1.5a2 2 0 1 0 2 2 2 2 0 0 0-2-2ZM10.6 11h2.8v1.5h-2.8V11ZM2.2 9.6 4 8.4l.8 1.3-1.8 1.2-.8-1.3Zm17.2-1.2 1.8 1.2-.8 1.3-1.8-1.2.8-1.3Z"/></svg>',
		'spark'  => '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M18.7035 11.5821L15.8309 10.5912C14.6949 10.2009 13.7991 9.30509 13.4088 8.16908L12.4179 5.29651C12.2828 4.90116 11.7172 4.90116 11.5821 5.29651L10.5912 8.16908C10.2009 9.30509 9.30509 10.2009 8.16908 10.5912L5.29651 11.5821C4.90116 11.7172 4.90116 12.2828 5.29651 12.4179L8.16908 13.4088C9.30509 13.7991 10.2009 14.6949 10.5912 15.8309L11.5821 18.7035C11.7172 19.0988 12.2828 19.0988 12.4179 18.7035L13.4088 15.8309C13.7991 14.6949 14.6949 13.7991 15.8309 13.4088L18.7035 12.4179C19.0988 12.2828 19.0988 11.7172 18.7035 11.5821Z"/></svg>',
	);

	$bar->add_node( array(
		'id'     => 'demo-reader',
		'parent' => 'top-secondary',
		'title'  => '<span class="da-swap-icon">' . $icons['reader'] . '</span>',
		'href'   => '#',
		'meta'   => array( 'class' => 'da-item', 'title' => 'Reader (inert in this demo)' ),
	) );
	$bar->add_node( array(
		'id'     => 'demo-get-help',
		'parent' => 'top-secondary',
		'title'  => '<span class="da-swap-icon">' . $icons['help'] . '</span><span class="da-swap-label">Get help</span>',
		'href'   => '#',
		'meta'   => array( 'class' => 'da-item', 'title' => 'Get help' ),
	) );
	$bar->add_node( array(
		'id'     => 'demo-agent',
		'parent' => 'top-secondary',
		'title'  => '<span class="da-swap-icon">' . $icons['spark'] . '</span><span class="da-swap-label">Agent</span>',
		'href'   => '#',
		'meta'   => array( 'class' => 'da-item', 'title' => 'Agent (inert in this demo)' ),
	) );
	$bar->add_node( array(
		'id'     => 'demo-notes',
		'parent' => 'top-secondary',
		'title'  => '<span class="da-swap-icon">' . $icons['bell'] . '</span>',
		'href'   => '#',
		'meta'   => array( 'class' => 'da-item', 'title' => 'Notifications (inert in this demo)' ),
	) );
}, 500 );

add_action( 'admin_head', function () {
	?>
<style>
/* --- Outlined masterbar treatment (mirror of the widgets.wp.com prototype) --- */
#wpadminbar li.da-item > .ab-item,
#wpadminbar #wp-admin-bar-comments > .ab-item,
#wpadminbar #wp-admin-bar-new-content > .ab-item,
#wpadminbar #wp-admin-bar-command-palette > .ab-item {
	display: flex !important;
	align-items: center;
	gap: 2px;
	height: 32px;
}
#wpadminbar .da-swap-icon { display: flex; align-items: center; }
#wpadminbar .da-swap-icon svg { width: 24px; height: 24px; fill: currentColor; }
#wpadminbar .da-swap-label { font-size: 13px; line-height: 1; }
#wpadminbar #wp-admin-bar-comments .ab-icon,
#wpadminbar #wp-admin-bar-new-content .ab-icon,
#wpadminbar #wp-admin-bar-command-palette .ab-icon { display: none !important; }
#wpadminbar #wp-admin-bar-comments .ab-label,
#wpadminbar #wp-admin-bar-new-content .ab-label,
#wpadminbar #wp-admin-bar-command-palette .ab-label { margin: 0 !important; }
#wpadminbar #wp-admin-bar-top-secondary { display: flex; }
#wpadminbar #wp-admin-bar-my-account { order: 99; }
#wpadminbar li.da-item:hover > .ab-item,
#wpadminbar li.da-item > .ab-item:focus { color: #7b90ff; }

/* --- Support Assistant panel --- */
#da-panel {
	position: fixed; right: 24px; bottom: 24px; z-index: 99999;
	width: 400px; max-width: calc( 100vw - 32px ); height: 650px; max-height: calc( 100vh - 80px );
	background: #fff; border-radius: 16px; box-shadow: 0 3px 8px rgba(0,0,0,.12), 0 12px 32px rgba(0,0,0,.14);
	display: none; flex-direction: column; overflow: hidden;
	font: 14px/1.5 -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; color: #1e1e1e;
}
#da-panel.open { display: flex; }
.da-head { display: flex; align-items: center; gap: 8px; padding: 14px 16px; flex: 0 0 auto; }
.da-head-title { font-size: 15px; font-weight: 600; flex: 1; }
.da-head button { background: none; border: 0; padding: 4px; cursor: pointer; color: #1e1e1e; font-size: 18px; line-height: 1; }
.da-head button:hover { color: #3858e9; }
.da-body { flex: 1; overflow-y: auto; padding: 8px 20px 12px; display: flex; flex-direction: column; }
/* margin-top:auto bottom-anchors the greeting cluster (like the real panel)
   without the scroll breakage justify-content:flex-end causes. */
.da-spark { margin: auto 0 16px; }
.da-howdy { font-weight: 600; margin: 0 0 8px; }
.da-greeting { margin: 0 0 16px; }
.da-msg-user { align-self: flex-end; background: #f0f0f1; border-radius: 16px; padding: 8px 14px; margin: 6px 0; max-width: 85%; }
.da-msg-bot { align-self: flex-start; margin: 6px 0; max-width: 95%; }
.da-msg-bot a { color: #3858e9; }
.da-thinking { display: flex; gap: 8px; align-items: center; color: #757575; margin: 6px 0; }
.da-chips { flex: 0 0 auto; padding: 0 20px 8px; }
.da-chips.vertical .da-chip { display: block; width: 100%; text-align: left; margin-bottom: 8px; }
.da-chips.row { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 4px; scrollbar-width: none;
	mask-image: linear-gradient( to right, #000 calc( 100% - 24px ), transparent ); }
.da-chips.row::-webkit-scrollbar { display: none; }
.da-chips.stack { display: flex; flex-direction: column; gap: 0; }
.da-chips.stack .da-chip { width: 100%; text-align: left; margin: 0; padding: 14px 16px; line-height: 20px; border-radius: 0; }
.da-chips.stack .da-chip + .da-chip { margin-top: -1px; }
.da-chips.stack .da-chip:first-child { border-radius: 8px 8px 0 0; }
.da-chips.stack .da-chip:last-child { border-radius: 0 0 8px 8px; }
.da-chips.stack .da-chip:only-child { border-radius: 8px; }
.da-body .da-chips { padding: 0; }
/* Every chip in a horizontal row is a pill, questions included. */
.da-chips.row .da-chip { border-radius: 999px; }
.da-chips:empty { display: none; }
.da-chip.da-chip-topic { border-radius: 999px; padding: 8px 14px; }
.da-chip.da-chip-back { color: #3858e9; border-color: transparent; }
.da-chip { background: #fff; border: 1px solid #dcdcde; border-radius: 8px; padding: 10px 14px;
	font-size: 13px; cursor: pointer; white-space: nowrap; flex-shrink: 0; color: #1e1e1e; }
.da-chip:hover { background: #f6f7f7; }
.da-foot { flex: 0 0 auto; padding: 0 16px 6px; }
.da-input-wrap { display: flex; align-items: center; gap: 8px; border: 1px solid #dcdcde; border-radius: 12px; padding: 10px 12px; }
.da-input-wrap input { flex: 1; border: 0; outline: none; font-size: 14px; background: transparent; }
.da-send { width: 32px; height: 32px; border-radius: 50%; border: 0; background: #f0f0f1; cursor: pointer; font-size: 16px; }
.da-send.ready { background: #3858e9; color: #fff; }
.da-disclaimer { text-align: center; color: #757575; font-size: 12px; padding: 6px 0 10px; }
.da-disclaimer a { color: inherit; }

/* --- Help Center, behind the back arrow (mirrors the shipped panel) --- */
.da-help { display: none; flex: 1; flex-direction: column; overflow-y: auto; padding: 16px 20px; }
#da-panel.help .da-help { display: flex; }
#da-panel.help .da-body,
#da-panel.help .da-chips,
#da-panel.help .da-foot,
#da-panel.help #da-back { display: none; }
#da-panel.help .da-head { border-bottom: 1px solid #e0e0e0; }
.da-help-search { display: flex; align-items: center; gap: 10px; border: 1px solid #949494; border-radius: 4px; padding: 6px 12px; margin-bottom: 22px; }
/* wp-admin styles input[type=search] (min-height 30px, line-height 2, its own
   padding/shadow) — reset it or the field renders ~2x too tall. */
.da-help-search input { flex: 1; min-height: 0; height: auto; margin: 0; padding: 0; border: 0; outline: none;
	box-shadow: none; background: transparent; font-size: 14px; line-height: 1.5; -webkit-appearance: none; }
.da-help-search input::-webkit-search-cancel-button { -webkit-appearance: none; }
.da-help-search svg { flex: 0 0 auto; }
.da-help-label { font-size: 14px; color: #1e1e1e; margin-bottom: 10px; }
.da-card { border: 1px solid #dcdcde; border-radius: 4px; margin-bottom: 22px; }
.da-row { display: flex; align-items: center; gap: 14px; padding: 13px 15px; text-decoration: none; color: #1e1e1e; border-top: 1px solid #dcdcde; }
.da-card .da-row:first-child { border-top: 0; }
.da-row:hover { background: #f6f7f7; }
.da-row-label { flex: 1; font-size: 14px; }
.da-row-icon, .da-row-end { display: flex; color: #50575e; }
.da-help-cta { margin-top: auto; width: 100%; background: #fff; border: 1px solid #3858e9; color: #3858e9;
	border-radius: 4px; padding: 13px; font-size: 14px; cursor: pointer; }
.da-help-cta:hover { background: #f0f3ff; }

</style>
	<?php
} );

add_action( 'admin_footer', function () {
	$display_name = esc_js( wp_get_current_user()->display_name );
	?>
<div id="da-panel" class="open" role="dialog" aria-label="Support Assistant">
	<div class="da-head">
		<button type="button" id="da-back" aria-label="Back to Help Center">&#8249;</button>
		<span class="da-head-title" id="da-head-title">Support Assistant</span>
		<button type="button" aria-label="Menu">&#8942;</button>
		<button type="button" id="da-close" aria-label="Close">&#10005;</button>
	</div>
	<div class="da-body" id="da-body"></div>
	<div class="da-help" id="da-help">
		<div class="da-help-search"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="6"/><path d="m15.5 15.5 4 4"/></svg><input type="search" placeholder="Search guides&hellip;" aria-label="Search guides" /></div>
		<div class="da-help-label">Recommended guides</div>
		<div class="da-card">
			<a class="da-row" href="#"><span class="da-row-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><rect x="5.75" y="4.75" width="12.5" height="14.5" rx="1.25"/><path d="M9 9h6M9 12h6M9 15h3.5"/></svg></span><span class="da-row-label">Getting started on WordPress.com</span><span class="da-row-end"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" xmlns="http://www.w3.org/2000/svg"><path d="m10 7 5 5-5 5"/></svg></span></a>
			<a class="da-row" href="#"><span class="da-row-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><rect x="5.75" y="4.75" width="12.5" height="14.5" rx="1.25"/><path d="M9 9h6M9 12h6M9 15h3.5"/></svg></span><span class="da-row-label">Introduction to the WordPress editor</span><span class="da-row-end"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" xmlns="http://www.w3.org/2000/svg"><path d="m10 7 5 5-5 5"/></svg></span></a>
			<a class="da-row" href="#"><span class="da-row-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><rect x="5.75" y="4.75" width="12.5" height="14.5" rx="1.25"/><path d="M9 9h6M9 12h6M9 15h3.5"/></svg></span><span class="da-row-label">WordPress.com vs. WordPress.org</span><span class="da-row-end"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" xmlns="http://www.w3.org/2000/svg"><path d="m10 7 5 5-5 5"/></svg></span></a>
		</div>
		<div class="da-help-label">More resources</div>
		<div class="da-card">
			<a class="da-row" href="#"><span class="da-row-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="7.25"/><path d="M12 7.75V12l2.75 1.6"/></svg></span><span class="da-row-label">Support history</span><span class="da-row-end"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" xmlns="http://www.w3.org/2000/svg"><path d="m10 7 5 5-5 5"/></svg></span></a>
			<a class="da-row" href="#"><span class="da-row-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><rect x="4.75" y="5.75" width="14.5" height="12.5" rx="1.5"/><path d="M10.6 9.7l4.3 2.5-4.3 2.5Z" fill="currentColor" stroke="none"/></svg></span><span class="da-row-label">Courses</span><span class="da-row-end"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path d="M13.75 5.75h4.5v4.5M18.25 5.75 11.5 12.5"/><path d="M16.25 13.75v4.5H5.75V7.75h4.5"/></svg></span></a>
			<a class="da-row" href="#"><span class="da-row-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path d="M6 12.25A5.75 5.75 0 0 1 11.75 18"/><path d="M6 7.75A10.25 10.25 0 0 1 16.25 18"/><circle cx="6.3" cy="17.4" r="1.15" fill="currentColor" stroke="none"/></svg></span><span class="da-row-label">Product updates</span><span class="da-row-end"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path d="M13.75 5.75h4.5v4.5M18.25 5.75 11.5 12.5"/><path d="M16.25 13.75v4.5H5.75V7.75h4.5"/></svg></span></a>
		</div>
		<button type="button" class="da-help-cta" id="da-to-chat">Get help</button>
	</div>
	<div class="da-chips" id="da-chips"></div>
	<div class="da-foot">
		<div class="da-input-wrap">
			<input id="da-input" type="text" placeholder="Ask anything..." autocomplete="off" />
			<button class="da-send" id="da-send" aria-label="Send">&#8593;</button>
		</div>
		<div class="da-disclaimer">You&rsquo;re chatting with an AI assistant. Responses may be inaccurate. <a href="#">Learn&nbsp;more&nbsp;&#8599;</a> &middot; Demo: all responses are canned.</div>
	</div>
</div>
<script>
( function () {
	var DISPLAY_NAME = '<?php echo $display_name; ?>';
	var SPARK = '<svg width="32" height="32" viewBox="3 3 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="#3858e9" d="M18.7035 11.5821L15.8309 10.5912C14.6949 10.2009 13.7991 9.30509 13.4088 8.16908L12.4179 5.29651C12.2828 4.90116 11.7172 4.90116 11.5821 5.29651L10.5912 8.16908C10.2009 9.30509 9.30509 10.2009 8.16908 10.5912L5.29651 11.5821C4.90116 11.7172 4.90116 12.2828 5.29651 12.4179L8.16908 13.4088C9.30509 13.7991 10.2009 14.6949 10.5912 15.8309L11.5821 18.7035C11.7172 19.0988 12.2828 19.0988 12.4179 18.7035L13.4088 15.8309C13.7991 14.6949 14.6949 13.7991 15.8309 13.4088L18.7035 12.4179C19.0988 12.2828 19.0988 11.7172 18.7035 11.5821Z"/></svg>';

	// Mirrors the Help Center guide taxonomy: topics first, then that topic's
	// follow-up questions. Each question id keys into REPLIES below.
	var TOPICS = [
		{ id: 'domains', label: 'Domains', questions: [
			{ id: 'domain', label: 'How do I connect a custom domain?' },
			{ id: 'domains-dns', label: 'How do I manage DNS records for my domain?' },
			{ id: 'domains-ssl', label: 'When does SSL activate on my domain?' }
		] },
		{ id: 'email', label: 'Email', questions: [
			{ id: 'email', label: 'How do I set up a professional email address?' },
			{ id: 'email-manage-mailboxes', label: 'How do I rename or remove a mailbox?' },
			{ id: 'email-forwarding-setup', label: 'Can I forward email from my custom domain?' }
		] },
		{ id: 'themes', label: 'Themes & design', questions: [
			{ id: 'theme', label: "How do I change my site's theme?" },
			{ id: 'themes-fonts-colors', label: 'Can I change fonts and colors in the Site Editor?' },
			{ id: 'themes-switch-safe', label: 'Will switching themes delete my content or menus?' }
		] },
		{ id: 'seo', label: 'Traffic & SEO', questions: [
			{ id: 'google', label: "Why isn't my site showing up on Google?" },
			{ id: 'seo-sitemap', label: 'How do I submit my sitemap to Google?' },
			{ id: 'seo-basics', label: 'How do I improve my SEO on WordPress.com?' }
		] },
		{ id: 'backups', label: 'Backups', questions: [
			{ id: 'backup', label: 'How do I backup my site?' },
			{ id: 'backups-restore-site', label: 'How do I restore my site from a backup?' },
			{ id: 'backups-export-content', label: 'How do I export my content?' }
		] },
		{ id: 'plans', label: 'Plans & billing', questions: [
			{ id: 'plan', label: 'How do I upgrade or cancel my plan?' },
			{ id: 'plans-refund', label: 'Can I get a refund on my plan?' },
			{ id: 'plans-after-cancel', label: 'What happens to my site if I cancel my plan?' }
		] },
		{ id: 'users', label: 'Users', questions: [
			{ id: 'user', label: 'How do I add another user to my site?' },
			{ id: 'users-roles', label: 'What can each user role do on my site?' },
			{ id: 'users-remove-role', label: 'How do I remove a user or change their role?' }
		] }
	];
	var REPLIES = {
		backup: 'Here are the two most relevant guides:<br><br>&bull; <a href="#">Back up your WordPress.com site</a> &mdash; covers how backups work, what&rsquo;s included, and how to view them.<br>&bull; <a href="#">Download a backup of your site</a> &mdash; covers downloading a full backup or restoring to a self-hosted site.<br><br>Would you like help with anything specific from those guides?',
		domain: 'You can connect a domain you already own in <strong>Upgrades &rarr; Domains &rarr; Use a domain I own</strong>. I&rsquo;ll walk you through updating your name servers &mdash; it usually takes a few minutes and up to 24h to propagate. The guides that cover this:<br><br>&bull; <a href="#">Connect an existing domain</a> &mdash; the whole connection flow, start to finish.<br>&bull; <a href="#">Change your domain name servers</a> &mdash; the name server step in detail.<br><br>Want the step-by-step?',
		email: 'Professional Email lives under <strong>Upgrades &rarr; Emails</strong>. You can add a mailbox on your custom domain (there&rsquo;s a free trial for the first mailbox). Two guides worth having open:<br><br>&bull; <a href="#">Add a professional email address</a> &mdash; setting up your first mailbox.<br>&bull; <a href="#">Manage your Professional Email mailboxes</a> &mdash; adding, renaming, and removing them later.<br><br>Want me to check what would work with your current domain?',
		google: 'Usually this is one of three things: the site is new (indexing takes days), Search Engine Visibility is discouraged in <strong>Settings &rarr; Reading</strong>, or there&rsquo;s no sitemap submitted. Your privacy setting looks fine. The other two are covered here:<br><br>&bull; <a href="#">Site visibility and search engine settings</a> &mdash; what the Reading setting actually does.<br>&bull; <a href="#">Sitemaps on WordPress.com</a> &mdash; finding your sitemap and submitting it to Google.<br><br>Shall I check the other two?',
		theme: 'Head to <strong>Appearance &rarr; Themes</strong> to browse and activate a new theme &mdash; your content stays put. These two guides cover it:<br><br>&bull; <a href="#">Find, preview, and activate a theme</a> &mdash; previewing a theme before you commit to it.<br>&bull; <a href="#">Customize your theme with the Site Editor</a> &mdash; colors, fonts, and layout after you switch.<br><br>If you tell me the look you&rsquo;re after, I can suggest a few that fit.',
		plan: 'You can change your plan any time in <strong>Upgrades &rarr; Plans</strong>. Upgrades are prorated, and cancelling within the refund window gives your money back automatically. Both directions are covered here:<br><br>&bull; <a href="#">Upgrade your WordPress.com plan</a> &mdash; what each plan includes and how proration works.<br>&bull; <a href="#">Cancel a purchase and request a refund</a> &mdash; refund windows and how to cancel.<br><br>Which direction are you thinking?',
		user: 'Invite people in <strong>Users &rarr; Add New</strong> &mdash; you choose their role (Admin, Editor, Author&hellip;) and they get an email invite. The guides for this:<br><br>&bull; <a href="#">Invite people to your site</a> &mdash; sending, resending, and managing invites.<br>&bull; <a href="#">User roles and permissions</a> &mdash; what each role can and can&rsquo;t do.<br><br>Want a quick rundown of what each role can do?',
		'domains-dns': 'You can add, edit, or delete DNS records in <strong>Upgrades &rarr; Domains &rarr; your domain &rarr; DNS records</strong> &mdash; A, CNAME, MX, and TXT records are all managed there, as long as your name servers point to WordPress.com. The guides for this:<br><br>&bull; <a href="#">Manage custom DNS records</a> &mdash; adding, editing, and deleting each record type.<br>&bull; <a href="#">Restore default DNS records</a> &mdash; undo custom changes if something breaks.<br><br>Which record are you setting up?',
		'domains-ssl': 'No setup needed &mdash; an SSL certificate is issued automatically once your domain finishes connecting. It usually activates within minutes of your name servers propagating, though the padlock can take up to 24 hours to show everywhere. You can check its status in <strong>Upgrades &rarr; Domains &rarr; your domain</strong>.<br><br>&bull; <a href="#">Secure your site with HTTPS and SSL</a> &mdash; how certificates are issued, renewed, and fixed.<br><br>Still seeing a security warning after 24 hours?',
		'email-manage-mailboxes': 'You can manage existing mailboxes in <strong>Upgrades &rarr; Emails</strong> &mdash; pick your domain, then the mailbox you want to change. Removing a mailbox also deletes its stored mail, so export anything important first. The guide that covers this:<br><br>&bull; <a href="#">Manage your Professional Email mailboxes</a> &mdash; renaming, resetting passwords, and removing mailboxes.<br><br>Which mailbox change did you have in mind?',
		'email-forwarding-setup': 'Email forwarding is free with any custom domain &mdash; set it up in <strong>Upgrades &rarr; Emails &rarr; Add email forwarder</strong>. New forwards usually start working within a few minutes. The guides that cover this:<br><br>&bull; <a href="#">Add email forwarding to your domain</a> &mdash; the setup flow, step by step.<br>&bull; <a href="#">Set up email for your custom domain</a> &mdash; forwarding vs. a full mailbox, compared.<br><br>Want me to walk you through adding one?',
		'themes-fonts-colors': 'You can restyle your whole site in <strong>Appearance &rarr; Editor &rarr; Styles</strong> &mdash; pick a ready-made style variation or fine-tune fonts and colors one by one. Changes apply site-wide and only go live when you hit <strong>Save</strong>. These guides cover it:<br><br>&bull; <a href="#">Change fonts and colors with Styles</a> &mdash; the Styles panel, start to finish.<br>&bull; <a href="#">Use style variations in the Site Editor</a> &mdash; one-click looks designed for your theme.<br><br>Want to start with a style variation?',
		'themes-switch-safe': 'No &mdash; your posts, pages, and media stay exactly where they are when you switch themes. Menus and widgets can shift position because each theme places them differently, so preview first via <strong>Appearance &rarr; Themes</strong> &rarr; <em>Live Preview</em>. The details:<br><br>&bull; <a href="#">What happens when you change your theme</a> &mdash; what carries over and what to double-check afterwards.<br><br>Want a quick pre-switch checklist for your menus?',
		'seo-sitemap': 'Your sitemap is generated automatically at <strong>yoursite.com/sitemap.xml</strong> &mdash; no plugin needed. Verify your site under <strong>Tools &rarr; Marketing &rarr; Traffic</strong>, then paste the sitemap URL into Search Console. The guides that cover this:<br><br>&bull; <a href="#">Submit your sitemap to Google Search Console</a> &mdash; verification and submission, step by step.<br>&bull; <a href="#">Sitemaps on WordPress.com</a> &mdash; what your sitemap includes and how it updates.<br><br>Want help verifying your site first?',
		'seo-basics': 'The technical side &mdash; sitemaps, clean code, fast hosting &mdash; is handled for you. Your biggest wins are strong page titles and descriptions, which you can set under <strong>Tools &rarr; Marketing &rarr; Traffic</strong>. Two guides to start with:<br><br>&bull; <a href="#">SEO essentials for WordPress.com sites</a> &mdash; the fundamentals, from titles to internal links.<br>&bull; <a href="#">Customize your meta description</a> &mdash; control how your site appears in search results.<br><br>Which page would you like to optimize first?',
		'plans-refund': 'Yes &mdash; plans come with a <strong>14-day money-back guarantee</strong> (96 hours for domain registrations). Head to <strong>Upgrades &rarr; Purchases</strong>, pick your plan, and choose <em>Cancel and refund</em> &mdash; the amount goes back to your original payment method.<br><br>&bull; <a href="#">Refunds and cancellation policy</a> &mdash; refund windows for plans, domains, and add-ons.<br><br>Want me to check whether your plan is still inside the refund window?',
		'plans-after-cancel': 'Your site stays online &mdash; cancelling moves you to the free plan, so paid features like plugins and premium themes stop working, but your content is safe. A domain stays yours until its own expiry date; renew it in <strong>Upgrades &rarr; Domains</strong>.<br><br>&bull; <a href="#">Cancel your WordPress.com plan</a> &mdash; what changes on your site when a plan ends.<br>&bull; <a href="#">Domain expiration and renewal</a> &mdash; keeping your domain after cancelling.<br><br>Curious which features your site would lose?',
		'users-roles': 'Each role unlocks a different level of access &mdash; <strong>Administrators</strong> control everything, <strong>Editors</strong> manage all content, <strong>Authors</strong> publish their own posts, and <strong>Contributors</strong> write drafts for review. You can see who has which role under <strong>Users &rarr; All Users</strong>.<br><br>&bull; <a href="#">User roles and capabilities</a> &mdash; a full breakdown of what every role can and can&rsquo;t do.<br><br>Curious which role fits the person you have in mind?',
		'users-remove-role': 'You can change a role or remove someone in <strong>Users &rarr; All Users</strong> &mdash; hover over their name, then choose <strong>Edit</strong> to switch roles or <strong>Remove</strong> to revoke access. Their published posts stay put &mdash; you&rsquo;ll just be asked to reassign them.<br><br>&bull; <a href="#">Change a user&rsquo;s role</a> &mdash; updating access levels step by step.<br>&bull; <a href="#">Remove a user from your site</a> &mdash; what happens to their content.<br><br>Want a hand with a specific team member?',
		'backups-restore-site': 'You can restore your site to any earlier point from <strong>Jetpack &rarr; Activity Log</strong> &mdash; pick an event, choose <strong>Restore</strong>, and it rolls back your content, themes, plugins, and database in a few minutes. The guide that covers this:<br><br>&bull; <a href="#">Restore your site from a backup</a> &mdash; choosing a restore point and what gets rolled back.<br><br>Not sure which point to pick &mdash; want help narrowing it down?',
		'backups-export-content': 'You can export everything from <strong>Tools &rarr; Export</strong> &mdash; it creates an XML file of your posts, pages, and comments that any WordPress site can import. The guides that cover this:<br><br>&bull; <a href="#">Export your content</a> &mdash; downloading the XML export file, step by step.<br>&bull; <a href="#">Move your site to a new host</a> &mdash; the full migration flow, including your media library.<br><br>Where are you planning to take your content?',
		human: 'Of course &mdash; I&rsquo;m connecting you with a Happiness Engineer now. You&rsquo;ll keep this whole conversation, so there&rsquo;s no need to repeat yourself. <em>(End of demo &mdash; in the real flow a human joins here.)</em>',
		fallback: 'Great question &mdash; in the real assistant I&rsquo;d answer this from the WordPress.com guides. <em>(This demo only has canned answers for the suggestion chips &mdash; and typing &ldquo;Human&rdquo;.)</em>'
	};

	var asked = [], started = false, busy = false, activeTopic = null, suggestEl = null;
	var body = document.getElementById( 'da-body' );
	var chipsEl = document.getElementById( 'da-chips' );
	var input = document.getElementById( 'da-input' );
	var sendBtn = document.getElementById( 'da-send' );
	var panel = document.getElementById( 'da-panel' );

	function el( cls, html ) { var d = document.createElement( 'div' ); d.className = cls; d.innerHTML = html; return d; }

	function renderIntro() {
		body.appendChild( el( 'da-spark', SPARK ) );
		body.appendChild( el( 'da-howdy', 'Howdy ' + DISPLAY_NAME + ' 👋' ) );
		body.appendChild( el( 'da-greeting', 'I&rsquo;m your Support Assistant. You can ask for a human at any time, just type &ldquo;Human&rdquo;.' ) );
		suggestEl = el( 'da-suggest', '' );
		body.appendChild( suggestEl );
	}

	function chip( target, label, cls, fn ) {
		var b = document.createElement( 'button' );
		b.className = 'da-chip' + ( cls ? ' ' + cls : '' );
		b.textContent = label;
		b.onclick = function () { if ( busy ) { return; } fn(); };
		target.appendChild( b );
	}

	// Pre-conversation, suggestions live inside the chat flow (agenttic
	// vertical layout) so the greeting is never squeezed; once the chat
	// starts they move to the pinned row above the composer (horizontal).
	function renderChips() {
		chipsEl.innerHTML = '';
		suggestEl.innerHTML = '';
		var target = started ? chipsEl : suggestEl;
		function setLayout( layout ) {
			target.className = ( started ? '' : 'da-suggest ' ) + 'da-chips ' + layout;
		}
		if ( activeTopic ) {
			var remaining = activeTopic.questions.filter( function ( q ) { return asked.indexOf( q.id ) === -1; } );
			if ( ! remaining.length ) { activeTopic = null; renderChips(); return; }
			setLayout( started ? 'row' : 'vertical' );
			chip( target, '\u2039 All topics', 'da-chip-back', function () { activeTopic = null; renderChips(); } );
			remaining.forEach( function ( q ) {
				chip( target, q.label, '', function () { asked.push( q.id ); send( q.label, q.id ); } );
			} );
			return;
		}
		setLayout( started ? 'row' : 'stack' );
		// Landing shows the top 5 topics (like the Help Center home); the
		// full set stays reachable from the mid-chat row and by typing.
		var visible = started ? TOPICS : TOPICS.slice( 0, 5 );
		visible.forEach( function ( t ) {
			var left = t.questions.filter( function ( q ) { return asked.indexOf( q.id ) === -1; } ).length;
			if ( ! left ) { return; }
			chip( target, t.label, 'da-chip-topic', function () { activeTopic = t; renderChips(); } );
		} );
	}

	function send( text, id ) {
		started = true; busy = true;
		body.appendChild( el( 'da-msg-user', text.replace( /</g, '&lt;' ) ) );
		renderChips();
		input.placeholder = 'Just a moment...';
		var thinking = el( 'da-thinking', SPARK.replace( 'width="32" height="32"', 'width="18" height="18"' ) + ' Thinking&hellip;' );
		body.appendChild( thinking );
		body.scrollTop = body.scrollHeight;
		setTimeout( function () {
			thinking.remove();
			var key = id || ( /human/i.test( text ) ? 'human' : 'fallback' );
			body.appendChild( el( 'da-msg-bot', REPLIES[ key ] || REPLIES.fallback ) );
			body.scrollTop = body.scrollHeight;
			busy = false;
			input.placeholder = 'Ask anything...';
		}, 1200 );
	}

	function submitInput() {
		var text = input.value.trim();
		if ( ! text || busy ) { return; }
		input.value = '';
		sendBtn.className = 'da-send';
		var match = null;
		TOPICS.forEach( function ( topic ) {
			topic.questions.forEach( function ( q ) {
				if ( q.label.toLowerCase() === text.toLowerCase() ) { match = q; activeTopic = topic; }
			} );
		} );
		if ( match && asked.indexOf( match.id ) === -1 ) { asked.push( match.id ); }
		send( text, match && match.id );
	}

	input.addEventListener( 'keydown', function ( e ) { if ( e.key === 'Enter' ) { submitInput(); } } );
	input.addEventListener( 'input', function () { sendBtn.className = 'da-send' + ( input.value.trim() ? ' ready' : '' ); } );
	sendBtn.addEventListener( 'click', submitInput );
	document.getElementById( 'da-close' ).addEventListener( 'click', function () { panel.classList.remove( 'open' ); } );

	// Back arrow reveals the Help Center; its "Get help" button returns to the
	// chat. Chat state survives the round trip.
	var headTitle = document.getElementById( 'da-head-title' );
	function setView( help ) {
		panel.classList.toggle( 'help', help );
		headTitle.textContent = help ? 'Help Center' : 'Support Assistant';
	}
	document.getElementById( 'da-back' ).addEventListener( 'click', function () { setView( true ); } );
	document.getElementById( 'da-to-chat' ).addEventListener( 'click', function () { setView( false ); } );
	Array.prototype.forEach.call( document.querySelectorAll( '.da-row' ), function ( a ) {
		a.addEventListener( 'click', function ( e ) { e.preventDefault(); } );
	} );

	function wireBar( id, fn ) {
		var n = document.getElementById( id );
		if ( n ) { n.addEventListener( 'click', function ( e ) { e.preventDefault(); if ( fn ) { fn(); } } ); }
	}
	wireBar( 'wp-admin-bar-demo-get-help', function () { panel.classList.toggle( 'open' ); } );
	wireBar( 'wp-admin-bar-demo-agent' );
	wireBar( 'wp-admin-bar-demo-reader' );
	wireBar( 'wp-admin-bar-demo-notes' );

	// Outlined swaps for the stock comments / +New / command-palette items,
	// mirroring the real prototype.
	var COMMENT = '<span class="da-swap-icon"><svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M18 4H6c-1.1 0-2 .9-2 2v12.9c0 .6.5 1.1 1.1 1.1.3 0 .5-.1.8-.3L8.5 17H18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm.5 11c0 .3-.2.5-.5.5H7.9l-2.4 2.4V6c0-.3.2-.5.5-.5h12c.3 0 .5.2.5.5v9z"/></svg></span>';
	var PLUS = '<span class="da-swap-icon"><svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M11 12.5V17.5H12.5V12.5H17.5V11H12.5V6H11V11H6V12.5H11Z"/></svg></span>';
	var SEARCH = '<span class="da-swap-icon"><svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M13 5c-3.3 0-6 2.7-6 6 0 1.4.5 2.7 1.3 3.7l-3.8 3.8 1.1 1.1 3.8-3.8c1 .8 2.3 1.3 3.7 1.3 3.3 0 6-2.7 6-6S16.3 5 13 5zm0 10.5c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5z"/></svg></span>';
	[ [ 'wp-admin-bar-comments', COMMENT ], [ 'wp-admin-bar-new-content', PLUS ], [ 'wp-admin-bar-command-palette', SEARCH ] ].forEach( function ( pair ) {
		var item = document.querySelector( '#' + pair[ 0 ] + ' .ab-item' );
		if ( item ) { item.insertAdjacentHTML( 'afterbegin', pair[ 1 ] ); }
	} );

	renderIntro();
	renderChips();
} )();
</script>
	<?php
} );
