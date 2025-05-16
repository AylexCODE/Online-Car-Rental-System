<style type="text/css">
    nav {
        animation: fadeDown 1s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .adminNav {
        animation: fadeRight 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .carFilter, .myBooking, .contactPage, .aboutPage, .carManagement, .logs, .overview, .payments, .rentals, .tickets, .userManagement, .voucherManagement {
        animation: fadeIn 1s cubic-bezier(0.19, 1, 0.22, 1);
    }
    
    .loginWrapper {
        animation: fadeIn .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .car {
        animation: fadeUp 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
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

    @keyframes fadeRight {
        from {
            transform: translateX(-20px);
            opacity: 0;
        }
        to {
            transform: translateX(0px);
            opacity: 1;
        }
    }
</style>