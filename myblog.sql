-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 03:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `date_joined` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `email`, `password`, `role`, `date_joined`) VALUES
(3, 'Fahad', 'fahad@gmail.com', '$2y$10$gCNwtikvZL8hfYvRbE61quZFb8M0F3klpnk6IbgBJrJkK4dNAMuQm', 'user', '2023-01-05'),
(4, 'Arbash', 'arbash@gmail.com', '$2y$10$FqJ8xEIRqu44AUTtY2PQLujVRpPno5hkpqCNIWfhKvrSPpF3ZTn7q', 'user', '2022-03-02'),
(5, 'admin', 'admin@gmail.com', '$2y$10$vrs12qk/rM0zbJXSCgHdA.Dvpo88DsVQULf5JI3pIF.LXnN2v1nVS', 'admin', '2023-03-02'),
(7, 'u9', 'u9@gmail.com', '$2y$10$tJvK1iNGc72/uJyO4nDFsesOY4ncQOzipRHCUprGUKVT9hxvQnq5C', 'user', '2022-01-02'),
(8, 'u10', 'u10@gmail.com', '$2y$10$cSQtwKsm3Kq1nKWTzZVy3OW0dmsuN7BxTEfEJH0a2sqZAoTvnaJ9i', 'user', '2022-02-02'),
(9, 'u11', 'u11@gmail.com', '$2y$10$qoPAr7okqOllTjYgAPynkOTf02DMRsmpApz.RHksCmgysG1iq1TzW', 'user', '2022-03-02'),
(10, 'u12', 'u13@gmail.com', '$2y$10$aLgtxtLsEun4xemrwLnT0OfiO6sVqBgYFrVRPYtC1o/HKSbH6ga0i', 'user', '2022-04-02'),
(11, 'u14', 'u14@gmail.com', '$2y$10$oiCvVFrwq5GecXOBlMDScO8ZIKahnQjxJZfns1PkBC3Vr5gG/9CfC', 'user', '2022-05-02'),
(12, 'u15', 'u15@gmail.com', '$2y$10$ClMT6Nd.3IkOOHPFnEEd2.PNZ6diPbPIPsG3Hjc1sjuol50bFi14u', 'user', '2022-06-02'),
(13, 'u1', 'u1@gmail.com', '$2y$10$5dCt52SI7BouwYDanHrIoO1.PCLekkZ598/E1lnavJIpyQFx8.7IK', 'user', '2022-07-02'),
(14, 'u2', 'u2@gmail.com', '$2y$10$OW9u3W3sifPnim.g.UNFtu.Si3kHnmxy1QDlYLEj.Q.7WYzvfvdrS', 'user', '2022-08-02'),
(15, 'u3', 'u3@gmail.com', '$2y$10$66owLTREp7LDdHG0Gkm.P.TvqGJQ9X8y8zCbRB6kM.rhAwnJWXy1a', 'user', '2022-09-02'),
(16, 'u4', 'u4@gmail.com', '$2y$10$ieDqJGxemp2tgVX./eueh.xa886rySg3oRwKJih/cf.Vd/OzYQEzy', 'user', '2022-10-02'),
(17, 'u5', 'u5@gmail.com', '$2y$10$ZOobopPvaONjzP3xE8.skOIS06Hz3oJ1bdc34YCVnuIw1yNfMZvcG', 'user', '2022-11-02'),
(18, 'U6', 'u6@gmail.com', '$2y$10$TFSvzmWzBM/QFSyc..HZ0.Zx62M.64AQZ8z/RCxE4V/.eKYwfJdGW', 'user', '2022-12-02'),
(19, 'u7', 'u7@gmail.com', '$2y$10$DsqSmdyk99vQR/bp39ppb.7xmn7PqmIv9Uyix85WPk3wtcFxgj2rq', 'user', '2022-11-02'),
(20, 'u8', 'u8@gmail.com', '$2y$10$YG3jXH5ALpYRzr2hjGm4oORT1qse0oV/OS/zGUxWemXyID5o8jaJa', 'user', '2022-12-02'),
(21, 'u13', 'u13@gmail.com', '$2y$10$2HlJiQ8Es90rHDGaJAskUuSIjGpO7arUeaLvwA0VmxuD03dc0r4.O', 'user', '2022-08-02'),
(22, 'u20', 'u20@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-12-02'),
(23, 'u21', 'u21@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-05-02'),
(24, 'u22', 'u22@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-06-02'),
(25, 'u23', 'u23@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-04-02'),
(26, 'u24', 'u24@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-08-02'),
(27, 'u25', 'u25@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-12-02'),
(28, 'u26', 'u26@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-09-02'),
(29, 'u27', 'u27@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-06-02'),
(30, 'u28', 'u28@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-03-02'),
(31, 'u29', 'u29@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-06-02'),
(32, 'u30', 'u30@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-05-02'),
(33, 'u31', 'u31@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2022-10-02'),
(34, 'u32', 'u32@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2023-03-02'),
(35, 'u33', 'u33@gmail', '$2y$10$2nzluZJOhMYm/G7j6JGAsO7rCVM8NmxdTj6WzXKk9wbcuepMfsv3m', 'user', '2023-03-02'),
(36, 'aashar', 'aashar@gmail.com', '$2y$10$ZZM44yspL/pFOyxbPnymEu/H3pSnxCwpvOw5PRNCEex8BqadBTPf.', 'user', '2023-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `blog_data`
--

CREATE TABLE `blog_data` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_data`
--

INSERT INTO `blog_data` (`id`, `title`, `description`, `image`, `author_id`, `date_created`) VALUES
(2, 'Introduction to JavaScript', 'JavaScript, often abbreviated JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. As of 2022, 98% of websites use JavaScript on the client side for web page behavior, often incorporating third-party libraries', 'uploads/63ff3294acc6a3.95968173.png', 4, '2022-03-02'),
(3, 'Bootstrap', 'Bootstrap is a popular open-source framework for developing responsive, mobile-first websites and web applications. It was created by developers at Twitter and was first released in 2011. Bootstrap is designed to make web development faster and easier by providing a set of pre-designed CSS styles, JavaScript plugins, and other components that can be used to build modern, responsive web interfaces.', 'uploads/63ff43f017cd67.97836925.png', 4, '2023-02-02'),
(4, 'json', 'JSON (JavaScript Object Notation) is a lightweight data interchange format that is easy for humans to read and write, and easy for machines to parse and generate. It is a text format that is based on a subset of JavaScript syntax, and is often used to transmit data between a server and a web application, as an alternative to XML.\r\n\r\nJSON is structured as a collection of name/value pairs, similar to how objects are defined in JavaScript', 'uploads/63ff4492963071.66688620.png', 4, '2022-01-22'),
(5, 'What is Chart js', 'Chart.js is a popular open-source JavaScript library for creating various types of responsive and interactive charts and graphs for web pages. It allows developers to create dynamic and customizable charts that can be rendered on different devices and browsers, and supports various chart types including line, bar, pie, doughnut, radar, polar area, and more. Chart.js uses HTML5 canvas to draw charts, and provides a simple API and documentation for configuring and customizing charts, such as adding labels, legends, animations, tooltips, and more.', 'uploads/64009d6a53fcc2.22383547.svg', 36, '2022-11-02'),
(6, 'What is React', 'React is an open-source JavaScript library for building user interfaces. It was developed by Facebook and is widely used for building web applications, single-page applications, and mobile applications. React is based on the concept of components, which are self-contained and reusable building blocks for UI elements. Each component encapsulates its own logic, state, and rendering, and can be composed and nested to build complex UI hierarchies. React uses a declarative approach to programming, which means that developers describe the desired outcome of the code, rather than the step-by-step instructions to achieve it. React also uses a virtual DOM, which is a lightweight representation of the actual DOM, and enables efficient updates and re-rendering of components, without the need to manipulate the actual DOM. React is highly popular among developers due to its simplicity, performance, and extensive ecosystem of tools, libraries, and frameworks.', 'uploads/64009de6b355a7.07474976.svg', 36, '2022-03-02'),
(7, 'What is Three.js', 'I think you might be referring to Three.js, which is a popular JavaScript library for creating 3D graphics and visualizations in the browser. Three.js provides a wide range of features for creating and manipulating 3D objects, scenes, animations, and interactions in the browser using WebGL, a JavaScript API for rendering interactive 3D graphics in real-time. Three.js is widely used for creating 3D visualizations, games, simulations, and virtual environments on the web. It is open-source, free to use, and has a large and active community of developers contributing to its development and maintenance', 'uploads/64009f281c1292.08646721.png', 36, '2022-04-02'),
(8, 'what is chatgpt', 'is an artificial intelligence chatbot developed by OpenAI and launched in November 2022. It is built on top of OpenAI\'s GPT-3 family of large language models and has been fine-tuned (an approach to transfer learning) using both supervised and reinforcement learning techniques.\r\n\r\nChatGPT was launched as a prototype on November 30, 2022, and quickly garnered attention for its detailed responses and articulate answers across many domains of knowledge. Its uneven factual accuracy, however, has been identified as a significant drawback.[3] Following the release of ChatGPT, OpenAI\'s valuation was estimated at US$29 billion in 2023.', 'uploads/6400a8dcbf2f47.28999408.svg', 36, '2022-05-02'),
(9, '    Lorem, ipsum dolor sit amet', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?\r\n', 'uploads/6401d18e077852.64732136.png', 4, '2022-05-03'),
(10, ' iste doloribus consequuntu', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?', 'uploads/6401d1bfa07582.30346505.jpg', 4, '2022-06-03'),
(11, 'ipsum dolor sit a', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?', 'uploads/6401d1d7c7ce91.65262097.jpg', 4, '2022-05-03'),
(12, 'di sit emit', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?', 'uploads/6401d1f9b6eea5.03571303.jpg', 4, '2022-03-03'),
(13, 'asdf jkl', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error iste doloribus consequuntur non asperiores inventore minus voluptatem hic qui iure?', 'uploads/6401d215855256.54948711.jpg', 4, '2022-08-03'),
(14, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 10, '2023-04-03'),
(15, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 8, '2022-05-03'),
(16, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 9, '2022-06-03'),
(17, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 10, '2022-08-03'),
(18, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-09-03'),
(19, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 11, '2022-10-03'),
(20, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 12, '2022-11-03'),
(21, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-12-03'),
(22, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 11, '2022-12-03'),
(23, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 14, '2022-10-03'),
(24, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-11-03'),
(25, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 16, '2022-05-03'),
(26, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-07-03'),
(27, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-02-03'),
(28, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-01-03'),
(29, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-03-03'),
(30, 'lorem-ipsum', 'To increase the chances of recovering your data if your mobile device is lost or stolen, you should enable remote wipe .', 'uploads/6401d215855256.54948711.jpg', 7, '2022-01-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_data`
--
ALTER TABLE `blog_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `blog_data`
--
ALTER TABLE `blog_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
