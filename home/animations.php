<style type="text/css">
    nav {
        animation: fadeDown 1s ease-out;
    }
    
    .carFilter, .myBooking, .contactPage, .aboutPage, .carManagement, .logs, .overview, .payments, .rentals, .tickets, .userManagement, .voucherManagement {
        animation: fadeIn 1s ease-in;
    }
    
    .loginWrapper {
        animation: fadeIn .4s ease-in;
    }

    .car {
        animation: fadeUp 1s ease-in;
    }
    
    @keyframes fadeUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0px);
            opacity: 1;
        }
    }
    
    @keyframes fadeDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0px);
            opacity: 1;
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>