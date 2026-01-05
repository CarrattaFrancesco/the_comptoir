# Le Comptoir Suisse WordPress Theme

A custom WordPress theme for Le Comptoir Suisse restaurant featuring a modern, elegant single-page design with auto-scrolling gallery, parallax effects, and fully customizable content.

## Features

- **Single-page landing page** design
- **Fully responsive** - works on all devices
- **Auto-scrolling gallery** with lightbox functionality
- **Parallax effects** on featured images
- **WordPress Customizer** integration for easy content editing
- **Custom admin settings page** for gallery and menu PDFs
- **Mobile-friendly** navigation with hamburger menu
- **No external dependencies** - uses only native WordPress features
- **Translation ready** - French language support built-in

## Installation

1. Upload the `le-comptoir-suisse` folder to `/wp-content/themes/`
2. Copy font files from your original theme to `assets/fonts/` directory
3. Copy image files to `assets/images/` directory
4. Activate the theme through the 'Appearance → Themes' menu in WordPress
5. Go to 'Appearance → Customize' to configure your site settings
6. Go to 'Comptoir Settings' in the admin menu to manage gallery and menu PDFs

## Font Files Required

Place these files in `assets/fonts/`:
- SizmoPro.woff2
- SizmoPro.woff
- SizmoPro.ttf
- SizmoPro-Bold.woff2
- SizmoPro-Bold.woff
- SizmoPro-Bold.ttf
- SizmoPro-Light.woff2
- SizmoPro-Light.woff
- SizmoPro-Light.ttf
- SizmoLinePro.woff2
- SizmoLinePro.woff
- SizmoLinePro.ttf

## Default Images

Place these files in `assets/images/`:
- logo.svg (your restaurant logo)
- favicon.svg (site icon)
- hero_background.jpg (hero section background)
- img2.avif (philosophy section image)

## Configuration

### WordPress Customizer (Appearance → Customize)

The theme includes the following customizer panels:

#### Hero Section
- **Background Image** - Upload hero background image
- **Taglines** - Main tagline and subtitle
- **Reserve Button** - Button text and link URL

#### Philosophy Section
- **Content** - Title, subtitle, and description text
- **Image** - Featured philosophy image

#### Contact Information
- **Address & Phone** - Restaurant address, phone number, Google Maps URL
- **Opening Hours** - Business hours text

#### Footer Content
- **Team Description** - Team section text
- **Booking Text** - Reservation information
- **Press Text** - Press contact information

### Admin Settings Page (Comptoir Settings)

Located in the WordPress admin menu:

#### Gallery Management
- Enter comma-separated image IDs (e.g., `123, 456, 789`)
- Find image IDs in Media Library URL (post=**ID**)
- Images display in entered order
- Preview thumbnails shown below input field

#### Menu PDFs
- **Theatre Menu** - Upload PDF for theatre menu
- **After Theatre Menu** - Upload PDF for after-theatre menu  
- **Normal Menu** - Main menu PDF (appears in "Découvrir la Carte" button)

PDFs are linked in:
- Desktop dropdown navigation
- Mobile menu
- Philosophy section button (Normal Menu)

## Customization

### Colors

Edit color variables in `assets/css/main.css`:

```css
:root {
    --primary-color: #4D1526;    /* Burgundy */
    --secondary-color: #FCFAD7;  /* Cream */
    --tertiary-color: #273420;   /* Dark Green */
    --quaternary-color: #F1E7CB; /* Light Beige */
}
```

### Fonts

To use different fonts, update the `@font-face` declarations in `assets/css/main.css` and replace font files in `assets/fonts/`.

## Template Files

- `front-page.php` - Homepage template (main landing page)
- `header.php` - Site header and navigation
- `footer.php` - Site footer
- `index.php` - Fallback template
- `functions.php` - Theme functions and setup
- `inc/customizer.php` - WordPress Customizer settings
- `inc/admin-settings.php` - Admin settings page for gallery and PDFs

## JavaScript Features

All JavaScript is in `assets/js/main.js`:

- Mobile menu toggle
- Smooth scroll for anchor links
- Parallax effect on philosophy image
- Auto-scrolling gallery with pause on hover
- Lightbox for gallery images
- Fade-in animations for sections

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Future Enhancements

Planned improvements (noted in admin settings page):

- Visual drag-and-drop gallery manager with thumbnail previews
- Advanced menu management with multiple menu types
- Integration with booking platforms
- Additional language support (English translation)

## Support

For issues or questions about this theme, contact the theme developer.

## Credits

- **Theme Developer**: Francesco Carratta
- **Restaurant**: Le Comptoir Suisse
- **Font**: FF Sizmo Pro (custom licensed font)

## License

This theme is licensed under the GNU General Public License v2 or later.

## Changelog

### Version 1.0.0
- Initial release
- Single-page landing page design
- WordPress Customizer integration
- Custom admin settings page
- Gallery and PDF management
- Mobile responsive design
- Auto-scrolling gallery
- Parallax effects
