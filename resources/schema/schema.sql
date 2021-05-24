CREATE TABLE `phoenix_log` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `migration_datetime` varchar(255) NOT NULL,
                               `classname` varchar(255) NOT NULL,
                               `executed_at` datetime NOT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `user_role_id` int(11) DEFAULT '2',
                         `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `enabled` tinyint(1) NOT NULL DEFAULT '0',
                         `created_at` datetime DEFAULT NULL,
                         `created_user_id` int(11) DEFAULT NULL,
                         `updated_at` datetime DEFAULT NULL,
                         `updated_user_id` int(11) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `username` (`username`),
                         KEY `created_user_id` (`created_user_id`),
                         KEY `updated_user_id` (`updated_user_id`),
                         KEY `user_role_id` (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

CREATE TABLE `taximen` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `identification_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `neighborhood` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `gray_card` tinyint(1) NOT NULL DEFAULT '0',
                         `driving_licence_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `id_card_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `owner` int(1) DEFAULT '2',
                         `insurance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `transport_license` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `sticker_validity_date` datetime DEFAULT NULL,
                         `technical_visit_validity_date` datetime DEFAULT NULL,
                         `registration_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `customs_clearance_certificate` tinyint(1) NOT NULL DEFAULT '0',
                         `vest_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `commune_of` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `division` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `identification_date` datetime DEFAULT NULL,
                         `created_user_id` int(11) DEFAULT NULL,
                         `last_modified` datetime DEFAULT NULL,
                         `updated_user_id` int(11) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `identification_number` (`identification_number`),
                         UNIQUE KEY `driving_licence_number` (`driving_licence_number`),
                         UNIQUE KEY `phone_number` (`phone_number`),
                         UNIQUE KEY `id_card_number` (`id_card_number`),
                         UNIQUE KEY `registration_number` (`registration_number`),
                         UNIQUE KEY `vest_number` (`vest_number`),
                         KEY `created_user_id` (`created_user_id`),
                         KEY `updated_user_id` (`updated_user_id`),
                         KEY `owner` (`owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
