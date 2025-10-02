# Twitter Theme

A streamlined PeoplePods theme inspired by Twitter’s layout. It introduces a sticky navigation header, left-hand navigation rail, card-based timeline feed, and right-hand suggestion rail.

## Highlights
- Responsive three-column layout with central feed focus
- Avatar-driven timeline cards with quick actions
- Modern typography and color palette based on Twitter blue
- Sticky top navigation bar with search and messaging indicators
- Right-rail widgets for follow suggestions and footer links

## Enabling the Theme
1. Copy the `twitter` folder into your `themes/` directory (already included in this repository).
2. In `lib/etc/options.php`, set:
   ```php
   $options['currentTheme'] = 'twitter';
   ```
3. Clear cached theme output by deleting files under `files/cache`.
4. Reload the site; the Twitter-inspired interface should now appear.

If you customised templates in the default theme, replicate those edits inside the corresponding `themes/twitter` files.
