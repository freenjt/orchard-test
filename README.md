# README

## Orchard PHP Developer Test

This project demonstrates a custom implementation in Drupal 10.3 to complete two tasks. The project utilizes PHP 8.3 and MariaDB 10.4. The banner background changes depending on the current menu item, adhering to the hierarchical structure of the menu links.

## Requirements

- **Drupal Version**: 10.3
- **PHP Version**: 8.3
- **MariaDB Version**: 10.4
- **Bootstrap Barrio**: 5 (for styling)
- **Custom SubTheme**: Depend on bootstrap barrio and was created for implementing styles and JavaScript logic.
- **Menu Item Extras Module**: To add an image field to menu items

## Task 1: Installation and Setup

1. **Drupal Installation**:
   Ensure you have a Drupal 10.3 installation set up with PHP 8.3 and MariaDB 10.4.

2. **Bootstrap Barrio Installation**:
   Install the Bootstrap Barrio 5 theme using Composer:
   ```bash
   composer require drupal/bootstrap_barrio
3. **Menu Item Extras**:
   Install the Menu Item Extras module using Composer:
   ```bash
   composer require drupal/menu_item_extras
4. **Change the Menu items**:
   Navigate to /admin/structure/menu/manage/banner-navigation and handle the menu items.

5. **Place the Banner Block**:
   Navigate to /admin/structure/block and find the block "Banner Navigation", place it on the region Primary Menu.

## Task 2: Installation and Setup

1. **Drupal Installation**:
   Ensure you have a Drupal 10.3 installation set up with PHP 8.3 and MariaDB 10.4.

2. **Product Day Installation**:
   Install the Product Day module using Composer:
   ```bash
   drush en product_day
3. **Configure the Settings Form**:
   Navigate to /admin/config/system/settings
4. **Managing Products**:
   Navigate to /admin/content/product
5. **Place the Product of the Day Block**:
   Navigate to /admin/structure/block and find the block "Product of the day", place it where you consider necessary.
