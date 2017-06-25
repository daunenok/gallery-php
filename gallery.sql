CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comments` (`id`, `photo_id`, `name`, `comment`) VALUES
(1, 1, 'John', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed turpis sapien. Donec vel arcu ex.'),
(2, 1, 'Jane', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris '),
(4, 2, 'Tina', 'Hi!'),
(5, 2, 'Carol', 'Very nice work!'),
(6, 1, 'Ana', 'Wonderful!'),
(7, 1, 'Jane', 'Thank You!'),
(8, 6, 'Ana', 'Very nice!'),
(9, 6, 'Jack', 'Beautiful!'),
(10, 5, 'Anna', 'Very nice!');

ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `photos` (`id`, `filename`, `caption`) VALUES
(1, 'pic1.jpg', 'Such a beauty!'),
(2, 'pic2.jpg', 'Such a beauty!'),
(3, 'pic3.jpg', 'Such a beauty!'),
(4, 'pic4.jpg', 'Such a beauty!'),
(5, 'pic5.jpg', 'Wonderful!'),
(6, 'pic6.jpg', 'Wonderful!'),
(7, 'pic7.jpg', 'Wonderful!');

ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

INSERT INTO `users` (`id`, `name`, `password`, `access`) VALUES
(1, 'root', 'secret', 2),
(2, 'John', '123456', 1),
(3, 'Jane', 'qwerty', 1),
(4, 'Ana', 'qqqqqq', 1),
(5, 'Don', 'Don', 1),
(6, 'Pete', 'Pete', 1),
(7, 'Phil', 'Phil', 1);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


