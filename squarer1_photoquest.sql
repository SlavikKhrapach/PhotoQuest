SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `accounts` (`id`, `username`, `password`, `token`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '$2y$10$YIjxtHP9f1iTusyqvTDZBemOMmJJ9TyV7kOiowStfXHYb8nRKiSES');

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `photos` (`id`, `account_id`, `name`, `description`, `path`) VALUES
(1, 1, 'PhoenixRising', '', 'SalmonWellington1.jpg'),
(2, 1, 'MasonWright', '', 'SalmonWellington2.webp'),
(3, 1, 'NebulaExplorer', '', 'SalmonWellington3.jpg'),
(4, 1, 'OliviaDavis', '', 'SalmonWellington4.jpg'),
(5, 1, 'DreamCatcher24', '', 'SalmonWellington5.jpg');

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `votes` (`id`, `account_id`, `photo_id`) VALUES
(1, 1, 5),
(2, 1, 4);

ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `photo_id` (`photo_id`);

ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;