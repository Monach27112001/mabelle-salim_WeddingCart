Mabelle & Salim — Wedding Invitation Cart

A modern and elegant wedding invitation website designed for Mabelle & Salim.

The website allows guests to view the wedding invitation, confirm their attendance, and submit the number of guests attending. An Admin Dashboard allows the wedding organizers to monitor invitations and calculate the total number of expected guests.

 Features
 Wedding Invitation Website
Elegant wedding-themed design
Mabelle & Salim wedding information
Wedding date and time
Wedding venue and location
Wedding invitation message
RSVP / attendance confirmation
Guest name submission
Number of attending guests
Responsive design for mobile, tablet, and desktop
Easy-to-use interface
Guest RSVP System

Guests can submit their attendance through the RSVP form.

The form can include:

Full Name
Phone Number or Email
Attendance status
 Attending
 Not Attending
Number of guests
Optional message

Each RSVP is stored in the database and can be viewed by the administrator.

 Admin Dashboard

The website includes a private Admin Dashboard for managing wedding invitations and guest information.

Dashboard Statistics

The administrator can see:

Statistic	Description
 Total Responses	Number of submitted RSVPs
 Attending	Number of guests who confirmed attendance
 Not Attending	Number of guests who declined
 Total Guests	Total number of people expected to attend
 Attendance Rate	Percentage of responses attending
 Guest Management

The admin can:

View all RSVP submissions
Search for guests
View guest details
See attendance status
See number of guests in each invitation
Calculate the total expected guests
Delete incorrect RSVP records
Delete guest information
Filter guests by attendance status
 Guest Calculation

The dashboard automatically calculates the total expected guests.

For example:

Mabelle & Salim Wedding

Confirmed Invitations: 85
People Attending: 173
Not Attending: 12

Total Expected Guests: 173

The total is calculated by adding the number of guests from all confirmed RSVP submissions.

Example
Guest 1 → 2 people
Guest 2 → 4 people
Guest 3 → 1 person
Guest 4 → 3 people

Total = 10 guests
 Technologies

The project can be built using:

HTML
CSS
JavaScript
PHP
MySQL
XAMPP for local development
📁 Project Structure
mabelle-salim-wedding/
│
├── index.php
├── invitation.php
├── rsvp.php
├── submit_rsvp.php
│
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── guests.php
│   ├── edit_guest.php
│   ├── delete_guest.php
│   └── logout.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   │
│   ├── js/
│   │   └── script.js
│   │
│   └── images/
│       ├── wedding-photo.jpg
│       └── background.jpg
│
├── config/
│   └── database.php
│
└── database/
    └── wedding.sql
 Database

The system uses MySQL to store RSVP and administrator information.

Main Tables
admin

Stores administrator login information.

admin
├── id
├── username
├── password
└── created_at
guests

Stores wedding RSVP information.

guests
├── id
├── name
├── phone
├── email
├── attendance
├── guest_count
├── message
└── created_at
Example
Name: Sarah Haddad
Phone: 03XXXXXX
Email: sarah@example.com
Attendance: Attending
Guest Count: 3
Message: Can't wait to celebrate with you!
 Admin Dashboard Security

The admin dashboard should not be publicly accessible without authentication.

Recommended security measures:

Admin login system
Password hashing using PHP password_hash()
Password verification using password_verify()
PHP sessions for authentication
Protect all admin pages from unauthorized users
Use prepared SQL statements
Validate and sanitize user input
Escape output to prevent XSS
Use CSRF protection for important forms
Do not store database passwords directly in public files
Do not upload .env or database credentials to GitHub

Example:

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

And when logging in:

password_verify($password, $passwordHash);
 Installation
1. Clone the Repository
git clone https://github.com/yourusername/mabelle-salim-wedding.git

Move the project into your XAMPP htdocs folder:

C:\xampp\htdocs\mabelle-salim-wedding
2. Start XAMPP

Open XAMPP and start:

Apache
MySQL
3. Create the Database

Open:

http://localhost/phpmyadmin

Create a database:

mabelle_salim_wedding

Import:

database/wedding.sql
4. Configure Database Connection

Update:

config/database.php

Example:

<?php

$host = "localhost";
$dbname = "mabelle_salim_wedding";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed.");
}
?>
Running the Website

After starting Apache and MySQL, open:

http://localhost/mabelle-salim-wedding/

Admin dashboard:

http://localhost/mabelle-salim-wedding/admin/login.php
 Responsive Design

The website is designed to work across:

Mobile phones
Tablets
Laptops
Desktop computers

The RSVP form is optimized for mobile users so guests can confirm their attendance quickly.

Design

The visual direction focuses on an elegant wedding aesthetic.

Suggested design elements:

Soft neutral colors
Elegant typography
Floral details
Romantic photography
Minimal UI
Smooth animations
Clear RSVP call-to-action

Example color palette:

Background: #FDF9F7
Primary:    #8B6F61
Secondary:  #D8C3B8
Text:       #3D3430
Accent:     #B8957A
Future Improvements

Possible future features include:

QR code invitations
Unique invitation links
Seating table management
Guest meal preferences
Dietary requirements
Plus-one management
WhatsApp RSVP notifications
Email confirmation
Export guest list to Excel/CSV
Printable guest list
Guest search and filtering
Real-time dashboard statistics
Wedding countdown timer
Google Maps venue integration
 Project Purpose

The goal of Mabelle & Salim Wedding Invitation is to provide a simple and elegant digital invitation experience while giving the wedding organizers an easy way to manage RSVP responses and keep track of the expected number of guests.

Mabelle & Salim

Together with their families,
Mabelle & Salim invite you to celebrate their special day.

Wedding Invitation Website
RSVP Management
Guest Tracking
Admin Dashboard

License

This project is created for the Mabelle & Salim wedding invitation website.

All wedding photographs, personal information, invitation designs, and branding are private property are not included.
