# Get help masterbar prototype — Playground demo

Design exploration: a labeled **Get help** entry in the wp-admin masterbar
(outlined icon family) that opens a Support Assistant with starter-prompt
suggestions.

**Try it:**
https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/ilonagl/ask-ai-playground/main/blueprint.json

Everything runs in your browser via [WordPress Playground](https://playground.wordpress.net)
— nothing is installed anywhere, and the whole demo is staged: **all chat
responses are canned** (there is no real AI behind it). The suggestion chips,
the "type Human" hint, and the topped-up-to-three suggestion rotation are the
interactions being explored.

What to poke at:

- The masterbar: outlined icon treatment with text labels (Get help, Reader,
  search, comments, + New).
- The assistant panel (opens on load): click a suggestion, watch the row
  rotate a new question in; type "Human" for the handoff path.

Iterations get versioned files (`blueprint-v2.json`, …) so links in old
threads keep working.
