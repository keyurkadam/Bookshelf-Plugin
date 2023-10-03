# Craft CMS Plugin: Bookshelf

## Requirements

This plugin requires Craft CMS 4.5.0 or later, and PHP 8.0.2 or later.


## Overview

The **Bookshelf** plugin for Craft CMS is a powerful tool designed to help users to manage their book collections. With Bookshelf, users can easily add books and create wishlists of books they desire. This README provides an overview of the plugin, installation instructions, and usage guidelines.

## Table of Contents

1. [Installation](#installation)
2. [Usage](#usage)
3. [Screenshots](#screenshots)
4. [Technical Details](#technical-details)
5. [Contributing](#contributing)
6. [License](#license)

## Installation

To install the Bookshelf plugin, follow these steps:

1. Clone the plugin repository to your Craft CMS project's `plugins` directory:
   ```
   git clone [https://github.com/your/repository.git](https://github.com/keyurkadam/Bookshelf-Plugin/) craft/plugins/test-plugin
   ```

2. In the Craft CMS control panel, navigate to **Settings > Plugins**.

3. Find the **test-plugin** plugin and click the "Install" button.

4. After installation, click the "Settings" button to configure the plugin according to your requirements.

## Usage

### Adding Books

1. Log in to your Craft CMS admin panel.

2. Navigate to the "Bookshelf" section.

3. Click "Add Book" to add a new book to your collection.

4. Fill in the book details, including Title, Author, Genre, Publication Year, Cover Image, and a brief description.

5. Click "Save" to add the book to your collection.

### Viewing Collection

1. Access the "Bookshelf" section in the Craft CMS admin panel.

2. You will see a list of books in your collection displayed in a visually appealing grid format.

3. Hover over a book to view its details.


### Managing Wishlist

1. To create a wishlist for books you desire, navigate to the Front-End site.

2. Click heart icon to add the book to your wishlist.

3. The wishlist can be viewed and managed separately in the "Wishlist" section.

## Screenshots

![Screenshot 1](https://github.com/keyurkadam/Bookshelf-Plugin/blob/3cf3a71bd42f1565c0ef4e0214eac23acefaab28/Bookshelf%20Home%20Front-End.png)
*Screenshot 1: Bookshelf Home Front-End*

![Screenshot 2](https://github.com/keyurkadam/Bookshelf-Plugin/blob/3cf3a71bd42f1565c0ef4e0214eac23acefaab28/Adding%20a%20Book%20Front-End.png)
*Screenshot 2: Adding a Book Front-End*

![Screenshot 3](https://github.com/keyurkadam/Bookshelf-Plugin/blob/3cf3a71bd42f1565c0ef4e0214eac23acefaab28/Viewing%20a%20Book%20List%20Control%20Panel.png)
*Screenshot 3: Viewing a Book List Control Panel*

![Screenshot 4](https://github.com/keyurkadam/Bookshelf-Plugin/blob/main/Adding%20a%20Book%20Control%20Panel.png)
*Screenshot 4: Adding a Book Control Panel*

![Screenshot 5](https://github.com/keyurkadam/Bookshelf-Plugin/blob/3cf3a71bd42f1565c0ef4e0214eac23acefaab28/Editing%20a%20Book%20Control%20Panel.png)
*Screenshot 5: Editing a Book Control Panel*

![Screenshot 6](https://github.com/keyurkadam/Bookshelf-Plugin/blob/3cf3a71bd42f1565c0ef4e0214eac23acefaab28/Viewing%20a%20WIshlist%20Front-End.png)
*Screenshot 6: Viewing a WIshlist Front-End*

## Technical Details

### Back-End

- The plugin is developed using PHP and adheres to Craft CMS coding conventions.
- Custom 'Books' entry type is created in a new section.

### Front-End

- JavaScript is used for interactivity, including form validation and user interaction events.
- The plugin is designed to be responsive and visually appealing.
- AJAX is used to add books to the wishlist without a page reload.
- Books are displayed in a grid format with hover-over details.

## Contributing

We welcome contributions to enhance and improve the Bookshelf plugin. Please submit issues or pull requests to the GitHub repository.
