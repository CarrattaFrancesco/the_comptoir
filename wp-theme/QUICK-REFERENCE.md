# Le Comptoir Suisse - Quick Reference Guide

## 🎯 How to Edit Your Website

### Where to Make Changes

Your website content can be edited in **two places**:

1. **WordPress Customizer** - For most text, images, and contact info
2. **Comptoir Settings** - For gallery images and menu PDFs

---

## 📝 Editing Text & Basic Content

### Go to: Appearance → Customize

#### Hero Section (Top of Page)
- **Hero Section → Background Image** - Change hero background photo
- **Hero Section → Taglines** 
  - Main: "LIEU VIVANT ET GOURMAND"
  - Subtitle: "LOCAL • SINCÈRE • DE SAISON • SANS CHICHIS"
- **Hero Section → Reserve Button** - Change button text and link

#### Philosophy Section (Middle)
- **Philosophy Section → Content**
  - Title: "PHILOSOPHIE CENTRALE"
  - Subtitle: "Le Terroir Vivant"
  - Description: Full philosophy text (HTML allowed)
- **Philosophy Section → Image** - Featured image next to text

#### Contact Information (Footer)
- **Contact Information → Address & Phone**
  - Restaurant address
  - Phone number
  - Google Maps link
- **Contact Information → Opening Hours**
  - Business hours text

#### Footer Sections
- **Footer Content**
  - Team description
  - Booking information
  - Press contact text

---

## 🖼️ Managing Gallery Images

### Go to: Comptoir Settings (in admin menu)

#### Step 1: Upload Images to Media Library
1. Go to **Media → Add New**
2. Upload your gallery photos
3. After upload, click each image
4. Find the **image ID** in the URL (e.g., `post=123` means ID is 123)
5. Write down all image IDs

#### Step 2: Add IDs to Gallery
1. Go to **Comptoir Settings**
2. In "Gallery Image IDs" field, enter IDs separated by commas
   - Example: `123, 456, 789, 101, 112, 131`
3. Images will display in the order you enter them
4. Click **Save Settings**

**Preview thumbnails** appear below to confirm correct images.

---

## 📄 Managing Menu PDFs

### Go to: Comptoir Settings (in admin menu)

#### Upload Each Menu
1. Click **Upload PDF** button for each menu type:
   - Theatre Menu
   - After Theatre Menu
   - Normal Menu (this is your main menu)

2. Select PDF from Media Library or upload new file

3. Click **Save Settings**

#### Where Menus Appear
- **Navigation dropdown** (desktop)
- **Mobile menu** (hamburger menu)
- **"Découvrir la Carte" button** (uses Normal Menu)

#### To Update a Menu
1. Click **Upload PDF** to replace
2. Or click **Remove** to delete
3. Save settings

---

## 🎨 Quick Edits Checklist

### To Change...

| What | Where | How |
|------|-------|-----|
| **Hero background photo** | Customizer → Hero Section | Upload new image |
| **Taglines** | Customizer → Hero Section → Taglines | Edit text fields |
| **Logo** | Customizer → Site Identity | Upload logo |
| **Philosophy text** | Customizer → Philosophy Section | Edit description |
| **Philosophy image** | Customizer → Philosophy Section | Upload new image |
| **Address** | Customizer → Contact Information | Edit address field |
| **Phone number** | Customizer → Contact Information | Edit phone field |
| **Opening hours** | Customizer → Contact Information | Edit hours text |
| **Gallery photos** | Comptoir Settings | Enter image IDs |
| **Menu PDFs** | Comptoir Settings | Upload PDF files |

---

## 💡 Pro Tips

### Live Preview in Customizer
- All changes in Customizer show **live preview**
- Click **"Publish"** to save changes
- Click **X** to cancel without saving

### HTML in Text Fields
Some fields allow HTML tags:
- `<br>` - Line break
- `<strong>` - Bold text
- `<em>` - Italic text
- `<p>` - Paragraph

Example:
```
Centre de Beaulieu,<br>1004 Lausanne
```

### Finding Image IDs
1. Media → Library
2. Click any image
3. Look at URL: `...post.php?post=123&action=edit`
4. The number after `post=` is your image ID (123)

### Gallery Order
- Gallery images scroll left to right
- First ID = leftmost image
- Last ID = rightmost image
- Change order by rearranging IDs

### Menu PDF Tips
- **Normal Menu** is most important (appears in main button)
- Other menus only appear in dropdown
- If you only have one menu, just upload "Normal Menu"
- PDFs open in new browser tab

---

## ⚠️ Important Reminders

### Always Save Changes
- **Customizer**: Click "Publish" button
- **Comptoir Settings**: Click "Save Settings" button

### Clear Browser Cache
If changes don't appear:
1. Hard refresh: `Ctrl+F5` (Windows) or `Cmd+Shift+R` (Mac)
2. Clear browser cache
3. Try different browser

### Mobile View
- Test changes on phone/tablet
- Use Customizer's device preview buttons
- Ensure text is readable on small screens

---

## 🆘 Common Questions

**Q: Gallery images not showing?**
- Verify you entered correct image IDs
- Check IDs are separated by commas
- Ensure images exist in Media Library

**Q: PDF menu not opening?**
- Check PDF was uploaded in Comptoir Settings
- Click "Save Settings" after uploading
- Try re-uploading the PDF

**Q: Changes not visible on website?**
- Click "Publish" in Customizer
- Click "Save Settings" in Comptoir Settings
- Clear browser cache
- Wait a few seconds for cache to update

**Q: How do I change colors?**
- This requires editing CSS files
- Contact your developer for color changes

**Q: Can I add more pages?**
- Yes, but this theme is designed as single-page
- Additional pages need custom templates
- Contact your developer for multi-page setup

---

## 📞 Need Help?

If you can't find something or need assistance:
1. Contact your theme developer

---

**Last Updated**: December 2025  
**Theme Version**: 1.0.0
