# WordPress Theme Setup Instructions

## ✅ Completed

The WordPress theme has been successfully created in:
`wp-theme/le-comptoir-suisse/`

All core files are in place:
- Theme configuration files (style.css, functions.php, index.php)
- Template files (front-page.php, header.php, footer.php)
- Customizer settings (inc/customizer.php)
- Admin settings page (inc/admin-settings.php)
- Converted CSS and JavaScript files

## 📋 Next Steps to Complete Installation

### 1. Copy Font Files

Copy the following files from `font/` to `wp-theme/le-comptoir-suisse/assets/fonts/`:

```
SizmoPro.woff2
SizmoPro.woff
SizmoPro.ttf
SizmoPro-Bold.woff2
SizmoPro-Bold.woff
SizmoPro-Bold.ttf
SizmoPro-Light.woff2
SizmoPro-Light.woff
SizmoPro-Light.ttf
SizmoLinePro.woff2
SizmoLinePro.woff
SizmoLinePro.ttf
```

### 2. Copy Image Files

Copy the following files from `img/` to `wp-theme/le-comptoir-suisse/assets/images/`:

```
logo.svg
favicon.svg
hero_background.jpg
img1.avif
img2.avif
img3.avif
img5.jpeg
img6.jpeg
img7.jpeg
```

### 3. Install Theme in WordPress

1. **Upload theme folder** to your WordPress installation:
   - Upload `wp-theme/le-comptoir-suisse/` to `/wp-content/themes/`

2. **Activate the theme**:
   - Go to WordPress Admin → Appearance → Themes
   - Find "Le Comptoir Suisse"
   - Click "Activate"

### 4. Configure Theme Settings

#### A. Upload Logo and Favicon

1. Go to **Appearance → Customize → Site Identity**
2. Upload your logo (logo.svg)
3. Upload site icon/favicon (favicon.svg)

#### B. Configure Hero Section

1. Go to **Appearance → Customize → Hero Section**
2. Upload hero background image
3. Set taglines:
   - Main: "LIEU VIVANT ET GOURMAND"
   - Subtitle: "LOCAL • SINCÈRE • DE SAISON • SANS CHICHIS"
4. Configure reserve button text and link

#### C. Configure Philosophy Section

1. Go to **Appearance → Customize → Philosophy Section**
2. Set title and subtitle
3. Add philosophy text (HTML allowed)
4. Upload philosophy image

#### D. Configure Contact Information

1. Go to **Appearance → Customize → Contact Information**
2. Enter address, phone number
3. Add Google Maps URL
4. Set opening hours

#### E. Configure Footer Content

1. Go to **Appearance → Customize → Footer Content**
2. Set team description
3. Configure booking and press text

### 5. Upload Gallery Images and Menu PDFs

#### A. Upload Images to Media Library

1. Go to **Media → Add New**
2. Upload all gallery images (img1.avif, img2.avif, etc.)
3. Note the image IDs (shown in URL: `post=123`)

#### B. Configure Gallery

1. Go to **Comptoir Settings** in admin menu
2. Enter comma-separated image IDs in "Gallery Image IDs" field
   - Example: `123, 456, 789, 101, 112, 131`
3. Images will appear in the order you enter them
4. Preview thumbnails shown below

#### C. Upload Menu PDFs

1. Go to **Comptoir Settings** in admin menu
2. Upload PDFs for each menu type:
   - Theatre Menu
   - After Theatre Menu
   - Normal Menu (main menu)
3. PDFs will automatically appear in navigation dropdowns

### 6. Test the Website

1. **Visit your homepage** - should display the single-page layout
2. **Test navigation**:
   - Click navigation links (should scroll to sections)
   - Click menu dropdowns (should open PDFs in new tabs)
   - Test mobile menu (hamburger icon)
3. **Test gallery**:
   - Should auto-scroll
   - Pause on hover
   - Click images to open lightbox
4. **Test customizer**:
   - Make changes in Customizer
   - Should see live preview
5. **Test on mobile devices**

## 🎨 Customization Tips

### Change Colors

Edit `wp-theme/le-comptoir-suisse/assets/css/main.css`:

```css
:root {
    --primary-color: #4D1526;    /* Burgundy - chef section background */
    --secondary-color: #FCFAD7;  /* Cream - main text color */
    --tertiary-color: #273420;   /* Dark Green - navbar/footer background */
    --quaternary-color: #F1E7CB; /* Light Beige - highlights */
}
```

### Add Custom CSS

Use **Appearance → Customize → Additional CSS** to add custom styles without editing theme files.

### Modify Templates

Template files are in the theme root:
- `front-page.php` - Homepage
- `header.php` - Navigation
- `footer.php` - Footer
- `inc/customizer.php` - Add more Customizer options
- `inc/admin-settings.php` - Modify admin settings page

## 🔧 Troubleshooting

### Fonts not loading
- Verify font files are in `assets/fonts/` directory
- Check file permissions (should be readable)

### Images not showing
- Check image paths in Media Library
- Verify images are in `assets/images/` for defaults
- Ensure image IDs are correct in Comptoir Settings

### Gallery not auto-scrolling
- Check browser console for JavaScript errors
- Verify gallery has at least 6 images
- Clear browser cache

### PDFs not opening
- Verify PDFs uploaded in Comptoir Settings
- Check that attachment IDs are saved
- Test PDF links directly

### Customizer changes not showing
- Click "Publish" after making changes
- Clear browser cache
- Check that changes are being saved (blue "Published" notification)

## 📱 Mobile Testing Checklist

- [ ] Hero section displays correctly
- [ ] Hamburger menu opens/closes
- [ ] Logo is visible at correct size
- [ ] Reserve button is accessible
- [ ] Taglines are readable
- [ ] Philosophy section stacks properly
- [ ] Gallery scrolls horizontally
- [ ] Footer sections stack vertically
- [ ] All text is legible
- [ ] Touch targets are large enough

## 🚀 Performance Optimization

After setup, consider:

1. **Install caching plugin** (WP Rocket, W3 Total Cache)
2. **Optimize images** (use WebP format, compress files)
3. **Enable CDN** for faster global delivery
4. **Minify CSS/JS** (can be done with caching plugins)
5. **Enable gzip compression** on server

## 📄 Required Files Checklist

Before going live, ensure you have:

- [ ] All font files copied
- [ ] All images copied
- [ ] Logo uploaded in WordPress
- [ ] Favicon set
- [ ] Hero background configured
- [ ] Philosophy image uploaded
- [ ] Gallery images uploaded and IDs configured
- [ ] Menu PDFs uploaded
- [ ] All Customizer fields filled
- [ ] Contact information updated
- [ ] Opening hours set
- [ ] Site tested on desktop
- [ ] Site tested on mobile
- [ ] All links working
- [ ] PDFs opening correctly

## 📞 Support

If you encounter any issues:

1. Check WordPress debug log (enable WP_DEBUG in wp-config.php)
2. Verify all required files are in place
3. Test with default WordPress theme to rule out conflicts
4. Check browser console for JavaScript errors
5. Review README.md for detailed documentation

## 🎉 You're All Set!

Once you complete these steps, your WordPress theme will be fully functional and ready for use. The site will maintain all the beautiful design and functionality of your original static website while being fully editable through the WordPress admin interface.
