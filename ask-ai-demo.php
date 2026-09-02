<?php
/**
 * Plugin Name: Ask AI Masterbar Prototype (Playground demo)
 * Description: Staged, self-contained replica of the v1 "Increase usage of Odie" experiment state: "Get help" masterbar entry opening a chat-forward Support Assistant, guides one tap away behind the back arrow. No suggestions UI — that lives in the v1.1 follow-up demo (ask-ai-demo-v2.php). All chat responses are canned — no real AI, no wpcom backend.
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
		'meta'   => array( 'class' => 'da-item', 'title' => 'Agent' ),
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

	// v1 experiment state: no suggestions UI — free typing only. Typed
	// questions match canned replies by keyword; everything else falls back.
	var REPLIES = {
		backup: 'Backups are included with your plan and run automatically &mdash; you&rsquo;ll find them under <strong>Jetpack &rarr; Activity Log</strong>, where you can restore your site to any earlier point or download a copy. Would you like the steps to restore, or to download a backup?',
		domain: 'You can connect a domain you already own in <strong>Upgrades &rarr; Domains &rarr; Use a domain I own</strong>. I&rsquo;ll walk you through updating your name servers &mdash; it usually takes a few minutes and up to 24h to propagate. Want the step-by-step?',
		email: 'Professional Email lives under <strong>Upgrades &rarr; Emails</strong>. You can add a mailbox on your custom domain &mdash; there&rsquo;s a free trial for the first one &mdash; or set up free email forwarding instead. Want me to check what would work with your current domain?',
		google: 'Usually this is one of three things: the site is new (indexing takes days), Search Engine Visibility is discouraged in <strong>Settings &rarr; Reading</strong>, or there&rsquo;s no sitemap submitted yet. Your privacy setting looks fine &mdash; shall I check the other two?',
		theme: 'Head to <strong>Appearance &rarr; Themes</strong> to browse and activate a new theme &mdash; your content stays put when you switch. If you tell me the look you&rsquo;re after, I can suggest a few that fit.',
		plan: 'You can change your plan any time in <strong>Upgrades &rarr; Plans</strong>. Upgrades are prorated, and cancelling within the refund window gives your money back automatically. Which direction are you thinking?',
		user: 'Invite people in <strong>Users &rarr; Add New</strong> &mdash; you choose their role (Admin, Editor, Author&hellip;) and they get an email invite. Want a quick rundown of what each role can do?',
		human: 'Of course &mdash; I&rsquo;m connecting you with a Happiness Engineer now. You&rsquo;ll keep this whole conversation, so there&rsquo;s no need to repeat yourself. <em>(End of demo &mdash; in the real flow a human joins here.)</em>',
		fallback: 'Great question &mdash; in the real assistant I&rsquo;d answer this from the WordPress.com guides. <em>(This demo has canned answers for a few common topics &mdash; try asking about backups, domains, email, themes, plans, users, or SEO.)</em>'
	};
	var KEYWORDS = [
		[ /human|agent|person|someone/i, 'human' ],
		[ /backup|restore|export/i, 'backup' ],
		[ /domain|dns|ssl/i, 'domain' ],
		[ /e-?mail|mailbox|forward/i, 'email' ],
		[ /google|seo|search engine|sitemap|traffic/i, 'google' ],
		[ /theme|design|font|color/i, 'theme' ],
		[ /plan|billing|refund|upgrade|cancel|price/i, 'plan' ],
		[ /user|invite|role/i, 'user' ]
	];
	function matchReply( text ) {
		for ( var i = 0; i < KEYWORDS.length; i++ ) {
			if ( KEYWORDS[ i ][ 0 ].test( text ) ) { return KEYWORDS[ i ][ 1 ]; }
		}
		return 'fallback';
	}

	var busy = false;
	var body = document.getElementById( 'da-body' );
	var input = document.getElementById( 'da-input' );
	var sendBtn = document.getElementById( 'da-send' );
	var panel = document.getElementById( 'da-panel' );

	function el( cls, html ) { var d = document.createElement( 'div' ); d.className = cls; d.innerHTML = html; return d; }

	function renderIntro() {
		body.appendChild( el( 'da-spark', SPARK ) );
		body.appendChild( el( 'da-howdy', 'Howdy ' + DISPLAY_NAME + ' 👋' ) );
		body.appendChild( el( 'da-greeting', 'I&rsquo;m your Support Assistant. What can I help you with?' ) );
	}

	function send( text ) {
		busy = true;
		body.appendChild( el( 'da-msg-user', text.replace( /</g, '&lt;' ) ) );
		input.placeholder = 'Just a moment...';
		var thinking = el( 'da-thinking', SPARK.replace( 'width="32" height="32"', 'width="18" height="18"' ) + ' Thinking&hellip;' );
		body.appendChild( thinking );
		body.scrollTop = body.scrollHeight;
		setTimeout( function () {
			thinking.remove();
			body.appendChild( el( 'da-msg-bot', REPLIES[ matchReply( text ) ] || REPLIES.fallback ) );
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
		send( text );
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
	wireBar( 'wp-admin-bar-demo-agent', function () { setView( false ); panel.classList.add( 'open' ); } );
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
} )();
</script>
	<?php
} );
