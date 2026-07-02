-- Demo accounts for MotoRent checkout testing.
-- Import with: mysql -u root sewa_motor_rpl < database/dumps/demo_accounts.sql

INSERT INTO `users` (`name`, `email`, `phone`, `role`, `address`, `ktp_path`, `sim_path`, `verification_status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
  ('Admin MotoRent', 'admin@motorent.test', '081234567890', 'admin', NULL, NULL, NULL, 'terverifikasi', NULL, '$2y$12$Ilwunk2z6oQkf/rwMzfGquM4aLbVEYBNHsA6xCKn1qax4qW73ULA2', NULL, NOW(), NOW()),
  ('Pelanggan Demo', 'pelanggan@motorent.test', '089876543210', 'customer', NULL, NULL, NULL, 'terverifikasi', NULL, '$2y$12$zIe8aoazO6W1p79Onl0reezrFYOPJ1lvF2ZRFyTpUruG0f0MdbUlS', NULL, NOW(), NOW()),
  ('Akun Checkout Demo', 'checkout@motorent.test', '081122334455', 'customer', 'Jl. Demo Checkout No. 1, Jakarta', NULL, NULL, 'terverifikasi', NULL, '$2y$12$5ZJjGalnS6mbK5Vtur9wmO8Ifh9puNDc6Q9LTDIRtBhsk/8uG7./q', NULL, NOW(), NOW())
ON DUPLICATE KEY UPDATE
  `name` = VALUES(`name`),
  `phone` = VALUES(`phone`),
  `role` = VALUES(`role`),
  `address` = VALUES(`address`),
  `verification_status` = VALUES(`verification_status`),
  `password` = VALUES(`password`),
  `updated_at` = NOW();
