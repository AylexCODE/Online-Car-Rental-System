> Database Data
```
--
-- Database: `car_rental_system`
--

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`BrandID`, `BrandName`) VALUES
(2, 'COROLLA'),
(3, 'TOYOTA'),
(1, 'WIGO');

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`ModelID`, `BrandID`, `ModelName`) VALUES
(1, 1, 'G CVT'),
(2, 2, 'CROSS 1.8 GR-S'),
(3, 3, 'CAMRY'),
(4, 3, 'COROLLA ATLIS'),
(5, 3, 'YARIS CROSS'),
(6, 3, 'FORTUNER'),
(7, 3, 'LAND CRUISER'),
(8, 3, 'LAND CRUISER PRADO'),
(9, 3, 'ZENIX'),
(10, 3, 'AVANZA'),
(11, 3, 'TAMARAW'),
(12, 3, 'COASTER'),
(13, 3, 'LITE ACE Panel Van'),
(14, 3, 'HILUX'),
(15, 3, 'ALPHARD');

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `BrandID`, `ModelID`, `FuelType`, `Transmission`, `RentalPrice`, `Availability`, `ImageName`) VALUES
(1, 1, 1, 'Gasoline', 'Continuously Var', 2000.00, 1, 'wigo_c_gvt.png'),
(2, 2, 2, 'Gasoline', 'Automatic', 1471.91, 1, 'corolla_cross_1-8_gr-s.png'),
(3, 3, 3, 'Gasoline', 'Automatic', 3690.27, 1, 'camry_2-5_v_hev_cvt.png'),
(4, 3, 4, 'Gasoline', 'Continuously Var', 2445.83, 1, 'corolla_atlis.png'),
(5, 3, 5, 'Gasoline', 'Continuously Var', 2236.11, 1, 'yaris_cross_1-5_s_hev_cvt.png'),
(6, 3, 6, 'Diesel', 'Dual Clutch', 3688.88, 1, 'fortuner_gr_s.png'),
(7, 3, 7, 'Diesel', 'Dual Clutch', 4009.00, 1, 'land_cruiser_3-3_v6.png'),
(8, 3, 8, 'Gasoline', 'Dual Clutch', 3337.50, 1, 'land_cruiser_prado_2-4_turbo.png'),
(9, 3, 9, 'Gasoline', 'Continuously Var', 2741.66, 1, 'zenix.png'),
(10, 3, 10, 'Gasoline', 'Continuously Var', 1487.50, 1, 'avanza_1-5_g.png'),
(11, 3, 11, 'Diesel', 'Semi-Automatic', 2945.20, 1, 'tamaraw_2-4_gl_dropside.png'),
(12, 3, 12, 'Diesel', 'Manual', 5713.00, 1, 'coaster_29_seater.png'),
(13, 3, 13, 'Gasoline', 'Dual Clutch', 908.50, 1, 'lite_ace_panel_van.png'),
(14, 3, 14, 'Gasoline', 'Automatic', 3033.33, 1, 'hilux_2-5_gr_sport.png'),
(15, 3, 15, 'Gasoline', 'Continuously Var', 6515.27, 1, 'alphard_2-5_hev_cvt.png');

--
-- Dumping data for table `damages`
--

INSERT INTO `damages` (`CarID`, `IsDamaged`, `Dents`, `Scratches`, `ChippedPaint`, `CrackedWindshields`) VALUES
(1, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0),
(14, 0, 0, 0, 0, 0),
(15, 0, 0, 0, 0, 0);

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`LocationID`, `Address`, `AddressCode`, `DistanceKM`) VALUES
(1, 'Bisu Balilihan Campus', 'PXW6+572, Provincial Road, Balilihan, Bohol', 0.00),
(2, 'Balilihan Municipal Hall', 'QX3C+WFW, Balilihan, 6342 Bohol', 1.90),
(3, 'Cabad Barangay Hall', 'QW3V+6VV, Barangay Road (Cabad), Balilihan, Bohol', 4.00);
```
