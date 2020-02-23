SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `issue_id` int(11) NOT NULL,
  `issue_code` varchar(15) NOT NULL,
  `issue_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tagmap`
--

CREATE TABLE IF NOT EXISTS `tagmap` (
  `id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `version_id` int(11) NOT NULL,
  `version_name` varchar(15) NOT NULL,
  `version_value` varchar(15) NOT NULL,
  `maint_value` decimal(2,0) NOT NULL,
  `version_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

--
-- Table structure for table `versionmap`
--

CREATE TABLE IF NOT EXISTS `versionmap` (
  `id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issue_id`),
  ADD UNIQUE KEY `issue_id` (`issue_code`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_id` (`tag_name`);

--
-- Indexes for table `tagmap`
--
ALTER TABLE `tagmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_id` (`issue_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`version_id`),
  ADD UNIQUE KEY `version_id` (`version_name`);

--
-- Indexes for table `versionmap`
--
ALTER TABLE `versionmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_id` (`issue_id`),
  ADD KEY `version_id` (`version_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tagmap`
--
ALTER TABLE `tagmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `version_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `versionmap`
--
ALTER TABLE `versionmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagmap`
--
ALTER TABLE `tagmap`
  ADD CONSTRAINT `tagmap_ibfk_1` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`),
  ADD CONSTRAINT `tagmap_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`);

--
-- Constraints for table `versionmap`
--
ALTER TABLE `versionmap`
  ADD CONSTRAINT `versionmap_ibfk_1` FOREIGN KEY (`version_id`) REFERENCES `version` (`version_id`),
  ADD CONSTRAINT `versionmap_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
