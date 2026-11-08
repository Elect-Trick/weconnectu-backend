-- weconnectu.`user` definition

CREATE TABLE IF NOT EXISTS `user` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `name` varchar(25) NOT NULL DEFAULT '""',
    `email` varchar(255) NOT NULL,
    `contact_number` varchar(13) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `message` varchar(255) NOT NULL,
    `is_deleted` tinyint(1) DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `email_unique_key` (`email`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Sample data
-- Sample data
INSERT INTO user (name, email, contact_number, message, created_at, updated_at) VALUES
-- 2021
('Liam Smith', 'liam.smith@example.co.za', '27825550101', 'Inquiry about enterprise pricing models and bulk discounts.', '2021-03-14 09:15:00', '2021-03-14 09:15:00'),
('Olivia Brown', 'olivia.b@example.net', '0735550102', 'Found a broken link on the documentation page for API v2.', '2021-08-22 14:30:22', '2021-08-22 14:30:22'),
('Noah Garcia', 'noah.g@example.org', '27815550103', 'Requesting a demo for our regional sales team next Tuesday.', '2021-11-05 11:05:12', '2021-11-05 11:05:12'),

-- 2022
('Emma Martinez', 'emma.m@example.co.za', '0615550192', 'Are your servers fully compliant with European GDPR standards?', '2022-01-19 16:45:00', '2022-01-19 16:45:00'),
('Oliver Jones', 'ojones@example.co.za', '27725550155', 'I would love to partner with you guys for our upcoming tech summit.', '2022-06-30 10:20:15', '2022-06-30 10:20:15'),
('Ava Davis', 'ava.davis@example.com', '0845550144', 'Can I downgrade my subscription plan before the next billing cycle?', '2022-10-12 08:11:43', '2022-10-12 08:11:43'),

-- 2023
('Elijah Rodriguez', 'elijah.r@example.net', '27635550167', 'Our team needs custom onboarding support. Who should we contact?', '2023-02-28 13:24:00', '2023-02-28 13:24:00'),
('Charlotte Wilson', 'charlotte.w@example.co.za', '0715550189', 'Error 500 when attempting to export monthly CSV financial reports.', '2023-05-17 17:55:30', '2023-05-17 17:55:30'),
('James Anderson', 'j.anderson@example.org', '27835551234', 'Is there an offline mode available for the mobile application?', '2023-09-09 07:40:00', '2023-09-09 07:40:00'),
('Amelia Thomas', 'amelia.t@example.com', '0625550111', 'Do you offer non-profit organization discounts for active teams?', '2023-12-25 12:00:00', '2023-12-25 12:00:00'),

-- 2024
('Benjamin Taylor', 'ben.taylor@example.net', '27745550122', 'Feature request: Add multi-factor authentication via hardware keys.', '2024-03-03 15:10:22', '2024-03-03 15:10:22'),
('Lucas Moore', 'lucas.m@example.co.za', '0825550133', 'Interested in upgrading to a dedicated account manager tier.', '2024-07-14 11:35:00', '2024-07-14 11:35:00'),
('Mia Jackson', 'mia.j@example.org', '27735550121', 'Billing issue: Charged twice for this month subscription.', '2024-11-20 09:05:14', '2024-11-20 09:05:14'),

-- 2025
('Henry Martin', 'henry.m@example.com', '0655550155', 'Our webhook integrations are dropping payloads during peak traffic spikes.', '2025-01-05 14:22:18', '2025-01-05 14:22:18'),
('Evelyn Lee', 'evelyn.lee@example.net', '27815555678', 'General question regarding data retention policy for deleted accounts.', '2025-04-18 16:40:00', '2025-04-18 16:40:00'),
('Alexander Thompson', 'alex.t@example.org', '0795550177', 'Stripe checkout page fails to load properly on Safari mobile view.', '2025-08-30 21:15:33', '2025-08-30 21:15:33'),
('Sophia White', 'sophia.w@example.co.za', '27845550199', 'Our system needs a higher API rate limit window. Let us talk numbers.', '2025-12-12 10:00:00', '2025-12-12 10:00:00'),

-- 2026
('Michael Harris', 'mharris@example.com', '0725550211', 'Testing out the platform capabilities for our Q1 system migration.', '2026-02-10 13:45:10', '2026-02-10 13:45:10'),
('Harper Clark', 'harper.c@example.net', '27635550789', 'Your documentation formatting is incredibly clean. Great job!', '2026-06-05 08:30:25', '2026-06-05 08:30:25'),
('Daniel Lewis', 'dlewis@example.org', '0835550233', 'Urgent: Unable to access dashboard after updating my email address.', '2026-11-01 15:12:00', '2026-11-01 15:12:00');