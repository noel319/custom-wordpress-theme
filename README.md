# Espresso Joint WordPress Theme

A modern, responsive WordPress theme converted from a React landing page design for coffee shops and restaurants.

## Features

- **Responsive Design**: Fully responsive layout that works on all devices
- **Custom Post Types**: Menu items with categories and pricing
- **Customizer Options**: Easy customization through WordPress Customizer
- **Contact Form**: Built-in contact form with validation
- **Smooth Scrolling**: Smooth navigation between sections
- **Mobile Menu**: Touch-friendly mobile navigation
- **SEO Friendly**: Clean, semantic HTML structure
- **Font Awesome**: 6.0+ (loaded via CDN)
- **Google Fonts**: Inter and Playfair Display (loaded via CDN)

## Theme Hooks and Filters

### Custom Hooks
The theme provides several action hooks for developers:

```php
// Add custom content to hero section
add_action('espresso_joint_hero_content', 'your_custom_function');

// Modify menu categories
add_filter('espresso_joint_menu_categories', 'your_category_filter');
```

### Available Filters
- `espresso_joint_menu_categories` - Modify the default menu categories
- `espresso_joint_contact_form_fields` - Customize contact form fields
- `body_class` - Add custom body classes

## Troubleshooting

### Common Issues

1. **Menu Items Not Showing**
   - Make sure you've created menu items in the admin
   - Check that menu items are published
   - Verify menu categories are assigned

2. **Contact Form Not Working**
   - Check your server's mail configuration
   - Verify WordPress email settings
   - Test with a simple mail plugin

3. **Styles Not Loading**
   - Clear any caching plugins
   - Check file permissions
   - Verify the theme is properly activated

4. **Mobile Menu Not Working**
   - Ensure JavaScript is enabled
   - Check for JavaScript errors in browser console
   - Verify jQuery is loaded

### Debug Mode
To enable debug mode for troubleshooting, add this to your wp-config.php:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

## Performance Optimization

### Recommended Plugins
- **Caching**: WP Rocket or W3 Total Cache
- **Image Optimization**: Smush or ShortPixel
- **CDN**: Cloudflare or MaxCDN
- **Database**: WP-Optimize

### Built-in Optimizations
- Minified CSS and JavaScript (in production)
- Optimized images with proper alt tags
- Semantic HTML for better SEO
- Mobile-first responsive design

## Contributing

If you'd like to contribute to this theme:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## Support

For support and questions:
- Check the documentation above
- Search existing issues
- Create a new issue with detailed information

## Changelog

### Version 1.0.0
- Initial release
- Converted React components to WordPress PHP templates
- Added custom post types for menu items
- Implemented responsive design
- Added contact form functionality
- Included customizer options

## License

This theme is licensed under the GPL v2 or later.

## Credits

- **Design**: Based on modern coffee shop landing page design
- **Icons**: Font Awesome (https://fontawesome.com)
- **Fonts**: Google Fonts (Inter, Playfair Display)
- **Images**: Unsplash (demo images)

---

**Note**: This theme is designed specifically for coffee shops, restaurants, and similar businesses. While it can be customized for other uses, it works best for food and beverage establishments. Icons**: Comprehensive icon support
- **Google Fonts**: Beautiful typography with Inter and Playfair Display

## Installation

1. **Download the Theme**
   - Download all theme files and create a folder named `espresso-joint`
   - Place all PHP, CSS, and JS files in this folder

2. **Upload to WordPress**
   - Compress the `espresso-joint` folder into a ZIP file
   - Go to `Appearance > Themes > Add New > Upload Theme`
   - Upload the ZIP file and activate the theme

3. **Setup Menu**
   - Go to `Appearance > Menus`
   - Create a new menu and assign it to "Primary Menu" location
   - Add pages like About, Menu, Contact to your menu

4. **Customize the Theme**
   - Go to `Appearance > Customize`
   - Configure Hero Section, About Section, and Contact Information
   - Upload a custom logo if desired

## File Structure

```
espresso-joint/
├── style.css                    # Main stylesheet with theme header
├── functions.php                # Theme functions and setup
├── index.php                    # Main template file
├── header.php                   # Header template
├── footer.php                   # Footer template
├── page.php                     # Default page template
├── single-menu_item.php         # Single menu item template
├── archive-menu_item.php        # Menu items archive template
├── template-parts/
│   ├── hero.php                 # Hero section
│   ├── loyalty-section.php      # Loyalty program section
│   ├── about.php                # About section
│   ├── menu.php                 # Menu section
│   └── contact.php              # Contact section
├── assets/
│   └── js/
│       └── main.js              # Main JavaScript file
└── README.md                    # This file
```

## Creating Menu Items

1. **Add Menu Categories**
   - Go to `Menu Items > Menu Categories`
   - Create categories like "Coffee", "Sandwiches", "Salads", etc.

2. **Add Menu Items**
   - Go to `Menu Items > Add New`
   - Fill in the title, description, and content
   - Set a featured image
   - Add price and short description in the custom fields
   - Assign to appropriate categories

## Customization Options

### WordPress Customizer Settings

- **Hero Section**
  - Hero Title
  - Hero Subtitle

- **About Section**
  - About Title
  - About Text

- **Contact Information**
  - Address
  - Phone Number
  - Email Address

### CSS Customization

The theme uses CSS custom properties (variables) for easy color customization:

```css
:root {
    --primary: #dc2626;        /* Primary red color */
    --primary-hover: #b91c1c;  /* Darker red for hover states */
    --dark: #1f2937;           /* Dark gray */
    --light: #f9fafb;          /* Light gray */
    /* ... other color variables */
}
```

## Contact Form

The theme includes a built-in contact form that:
- Validates user input
- Sends emails to the site administrator
- Shows success/error messages
- Includes spam protection

## JavaScript Features

- **Smooth Scrolling**: Automatically scrolls to sections when clicking navigation links
- **Mobile Menu**: Responsive hamburger menu for mobile devices
- **Scroll Effects**: Navbar changes appearance on scroll
- **Form Validation**: Client-side validation for the contact form
- **Animation Effects**: Hover effects and scroll animations

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Dependencies

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **Font Awesome