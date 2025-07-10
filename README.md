# About This Project
**Project Title**: *QuickRide* an online car rental system.

> In Partial Fulfillment of the Requirements for the Subject CC 221 Database Management System 2

### Built With

[![PHP](https://shields.io/badge/-PHP-3776AB?style=flat&logo=php)](https://www.php.net/)

[![JQuery](https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white)](https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js)

<br />

## Roadmap
### User and Customer Management
- [x] Customer registration & login
- [x] User profile management
- [x] Rental history & tracking
- [x] Customer feedback & ratings

### Vehicle and Rental Management
- [x] Vehicle catalog display
- [x] Car availability tracking
- [x] Search & filter options
- [x] Rental duraction selection
- [x] Booking summary & calculation

### Online Booking Payment
- [x] Rental request system
- [x] Multiple payment methods
- [x] Invoice & billing system
- [x] Discounts & promo codes


### Pickup and Return Management
- [x] Pick-up and drop-off location selection
- [x] Check-in and check-out system
- [x] Damage reporting & inspection logs
- [x] Late return & penalty fee calculation

### Notifications and Customer Support
- [x] Email Notification
- [x] Live chat & inquiry system
- [ ] SMS Notification
- [ ] Emergency assistance contact

### Admin and Dashboard Reports
- [x] Rental & income reports
- [x] Customer activity monitoring
- [x] Vehicle maintenance scheduling
- [ ] Employee management (optional)

### Security and System Backup
- [x] User role-based access
- [x] Secure login system
- [x] Audit logs
- [ ] Database backup & restore

<br />

## Acknowledgements

[![SocketIO](https://img.shields.io/badge/Socket.io-4.1.3-010101??style=flat-square&logo=Socket.io&logoColor=white)](https://cdn.socket.io/4.8.1/socket.io.min.js)

[![ChartJS](https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge&logo=Chart.js&logoColor=white)](https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js)

[EmailJS](https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js)

<br />

## File Structure
```
.
├── auth
│   ├── handler
│   │   ├── passwordResetHandler.php
│   │   └── signupHandler.php
│   ├── login.php
│   ├── logout.php
│   ├── passwordReset.php
│   ├── signup.php
│   ├── style.php
│   └── testAdmin.php
├── database
│   ├── car_rental_system.sql
│   ├── db_conn.php
│   └── test_data.sql
├── fonts
│   ├── SpaceGrotesk-Bold.otf
│   ├── SpaceGrotesk-Light.otf
│   ├── SpaceGrotesk-Medium.otf
│   ├── SpaceGrotesk-Regular.otf
│   └── SpaceGrotesk-SemiBold.otf
├── home
│   ├── components
│   │   ├── carSelection.php
│   │   └── cars.php
│   ├── images
│   │   ├── backgrounds ──
│   │   ├── cars ──
│   │   └── icons ──
│   ├── pages
│   │   ├── agreement.php
│   │   └── rent.php
│   ├── panels
│   │   ├── admin
│   │   │   ├── admin.php
│   │   │   ├── carManagement.php
│   │   │   ├── logs.php
│   │   │   ├── overview.php
│   │   │   ├── payments.php
│   │   │   ├── rentals.php
│   │   │   ├── tickets.php
│   │   │   ├── userManagement.php
│   │   │   └── voucherManagement.php
│   │   └── customer
│   │       ├── aboutUs.php
│   │       ├── account.php
│   │       ├── contactUs.php
│   │       ├── customerBooking.php
│   │       └── rentStatus.php
│   ├── queries
│   │   ├── brand
│   │   │   ├── addBrand.php
│   │   │   ├── deleteBrand.php
│   │   │   ├── editBrand.php
│   │   │   ├── getBrands.php
│   │   │   └── getBrandsList.php
│   │   ├── car
│   │   │   ├── addCar.php
│   │   │   ├── addCarStatistics.php
│   │   │   ├── checkCarAvailability.php
│   │   │   ├── fixCar.php
│   │   │   ├── getCarCondition.php
│   │   │   ├── getCarInfo.php
│   │   │   ├── getCarMaintenance.php
│   │   │   ├── getCarStatistics.php
│   │   │   └── getCars.php
│   │   ├── location
│   │   │   ├── addLocation.php
│   │   │   ├── deleteLocation.php
│   │   │   ├── editLocation.php
│   │   │   ├── getLocations.php
│   │   │   └── getLocationsList.php
│   │   ├── overview
│   │   │   ├── getInitialOverview.php
│   │   │   ├── getPeakRentalPeriods.php
│   │   │   └── getRevenue.php
│   │   ├── rent
│   │   │   ├── activeRentAction.php
│   │   │   ├── addRent.php
│   │   │   ├── addVoucher.php
│   │   │   ├── checkVoucher.php
│   │   │   ├── getPaymentStats.php
│   │   │   ├── getPayments.php
│   │   │   ├── getRentals.php
│   │   │   ├── getReturnPenalty.php
│   │   │   ├── getVouchers.php
│   │   │   ├── retrieveBookedCar.php
│   │   │   ├── returnBookedCar.php
│   │   │   └── sendNotif.php
│   │   └── user
│   │   │   ├── getBooking.php
│   │   │   ├── getCustomerSupport.php
│   │   │   ├── getMessages.php
│   │   │   ├── getUsers.php
│   │   │   ├── leaveReview.php
│   │   │   └── sendMessage.php
│   │   ├── backupRestore.php
│   │   ├── get_logs.php
│   │   ├── record_logs.php
│   ├── scripts
│   │   ├── messaging.js
│   │   └── realtime.js
│   ├── vendor
│   │   ├── chartjs-4.4.1.min.js
│   │   ├── emailjs-3.0.0.min.js
│   │   ├── jquery-3.7.1.min.js
│   │   └── socketio-4.8.1.min.js
│   ├── animations.php
│   ├── index.php
│   └── style.php
├── README.md
├── index.php
└── style.php
```
