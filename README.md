# Submitted By: Abdul Rehman Shaikh(2K20/CSC/1)
## Here we explain the assignment

We were given the task to add the functionalities of Like, Share and Follow, in this regards i've done
my assignment in blog-host folder of the given assignment and i've shared it here.

`blog-host` folder previously had some files in which i created some other files to add the mentioned functionalities.

For Assignment I developed 5 files namely:
1. **post.php**
2. **addlike.php**
3. **addread.php**
4. **addfollower.php**
5. **my-style.css**

We explain each file one by one

## 1. post.php
This is the front-end file which displays complete blog post including the buttons **`Like`** **`Mark As Read`** **`Follow`**. User is directed to this page from Homepage when user clicks `Read More...` form any post.

This page displays the Complete Blog Post, with information such as Post Title, Author Name, Publish Date and Post Body. Underneath the post i created three buttons `Like` `Mark As Read` and `Follow` which are linked to their corresponding back-end pages where we have written logic of these buttons.

## 2. addlike.php
It is the back-end page which adds user's like activity to the database. 

When user first clicks **Like** button from `post.php` page he is re-directed to this page where We first check if user has already liked the post before or is it his first time liking. 
Based on the result appropriate action has been taken with suitable message being displayed to the user on screen. 

## 3. addread.php
It is the back-end page which adds user's read activity to the database. 

When user first clicks **Mark As Read** button from `post.php` page he is re-directed to this page where We first check if user has already read the post before or is it his first time reading. 
Based on the result appropriate action has been taken with suitable message being displayed to the user on screen. 

## 4. addfollower.php
It is the back-end page which adds user's follow activity to the database. 

When user first clicks **Follow** button from `post.php` page he is re-directed to this page where We first check if user is already following the post author or not. 
Based on the result appropriate action has been taken with suitable message being displayed to the user on screen. 

## 5. my-style.css
This page is used for styling `post.php` page.


---
**Note: `addlike.php` `addread.php` `addfollower.php` pages are for backend processing and have not been displayed to the user from the application.**

### Thank You


