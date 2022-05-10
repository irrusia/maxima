CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `nickname` varchar(128) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `name` varchar(128) NOT NULL,
                         `surname` varchar(128) NOT NULL,
                         `password_hash` varchar(255) NOT NULL,
                         `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `nickname` (`nickname`),
    ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

