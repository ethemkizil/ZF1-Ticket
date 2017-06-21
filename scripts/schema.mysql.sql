CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `detail` text NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `attachment` varchar(300) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;