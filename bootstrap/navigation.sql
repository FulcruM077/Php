CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `slug` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);