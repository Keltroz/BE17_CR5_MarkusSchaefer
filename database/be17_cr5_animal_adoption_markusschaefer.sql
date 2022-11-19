-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2022 at 05:53 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be17_cr5_animal_adoption_markusschaefer`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `vaccinated` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `name`, `photo`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`) VALUES
(1, 'Munchi', 'munchkin.jpg', 'Erdbergstraße 54', 'These adorable cats were named after the magical townspeople in The Wizard of Oz. A munchkin’s tiny size is due to a gene mutation that makes its legs shorter than other cats.', 'small', 3, 'Yes', 'Munchkin'),
(2, 'Scarlet', 'russian_blue.jpg', 'Erdbergstraße 54', 'Russian blues have short coats that range in shades from silver to dark gray. And while some cats are very energetic and social, this breed can be a bit shy. However, they warm up once they feel comfortable around someone new.', 'small', 5, 'Yes', 'Russian Blue'),
(3, 'Diego', 'oriental_short_hair.jpg', 'Hasnerstraße 86', 'Oriental short hairs are part of the siamese cat family. They’re known for their elegant features and their very short coat, which comes in all kinds of colors. Besides being known for their lack of fur, they are also known for being super vocal.', 'small', 7, 'No', 'Oriental Short Hair'),
(4, 'Zedes', 'maine_coon.jpg', 'Marchetstraße 16', 'The strong, shaggy Maine coon is a well-proportioned large domesticated cat. There are many stories of how this breed developed. Some believe they originated in America as a cross between a house cat and a raccoon, although that myth has been scientifical', 'large', 9, 'No', 'Maine Coon'),
(5, 'Shaggy', 'ragdoll.jpg', 'Schellmanngasse 78', 'The ragdoll earned its name because of its docile, cuddly, and affectionate nature. Ragdolls collapse into their favorite person’s arms when picked up, just like a rag doll. Their history is shrouded in mystery, and there are many claims of how they came ', 'large', 6, 'Yes', 'Ragdoll'),
(6, 'Benji', 'bengal.jpg', 'Schellmanngasse 78', 'At first glance, it’s hard to believe the Bengal is a domesticated cat and not wild. With an athletic body and a unique, patterned coat, the Bengal cat breed looks like it´s straight out of the jungle. Bengal owners say this breed is as loving and friendl', 'large', 9, 'Yes', 'Bengal'),
(7, 'Akira', 'akita_inu.jpg', 'Erdbergstraße 54', 'Coming from Japan, this breed of dog is affectionate, smart, and very loyal. These dogs are guard dogs by default and will assert their dominance against anyone that tries to encroach on their territory. ', 'default', 4, 'Yes', 'Akita Inu'),
(8, 'Djinni', 'golden_retriever.jpg', 'Hasnerstraße 86', 'The Golden Retriever is one of the most popular dog breeds in the United States. The breed’s friendly, tolerant attitude makes them great family pets, and their intelligence makes them highly capable working dogs.', 'default', 7, 'No', 'Golden Retriever'),
(9, 'Duke', 'australian_terrier.jpg', 'Marchetstraße 16', 'The Australian Terrier is a spirited, alert and self-assured dog bred in Australia to control vermin population and guard livestock. Friendly and affectionate with a strong sense of devotion, the Australian Terrier is an excellent family dog. This small, ', 'small', 12, 'Yes', 'Australian Terrier'),
(10, 'Idefix', 'maltese.jpg', 'Wiener Straße 23', 'Maltese dogs have the look of an aristocrat and were favored by royalty over the years. But they’re also typically playful, energetic, and loving dogs who adore the attention of their dog parents.', 'small', 13, 'Yes', 'Maltese'),
(11, 'Akito', 'alaskan_malamute.jpg', 'Marchetstraße 16', 'Alaskan Malamutes are energetic sled dogs who thrive living and working alongside family members. The American Kennel Club recommends establishing pack hierarchy early—aka, you’re the boss. Instill commands and reinforce them regularly. A Malamute’s water', 'large', 14, 'No', 'Alaskan Malamute'),
(12, 'Beethoven', 'bernese_mountain_dog.jpg', 'Wiener Straße 23', 'One of the biggest sweethearts in the canine world is the Bernese Mountain Dog. These pups make excellent companion dogs thanks to their calm demeanor, affectionate nature and ability to adapt to just about any situation. Incredibly responsive to commands', 'large', 11, 'No', 'Bernese Mountain Dog'),
(13, 'Kesha', 'kerry_blue_terrier.jpg', 'Wiener Straße 23', 'Described as fierce, intelligent, charming and trust-worthy, the Kerry Blue is still a formidable character even though they are more popular as a show dog than working dog today. Bred to deal with vermin and guard property, the Kerry Blue is an independe', 'default', 13, 'Yes', 'Kerry Blue Terrier');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` bigint(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `status`) VALUES
(11, 'Markus', 'Schäfer', 'test2@mail.com', 1234567890, 'testadress 23/2', 'avatar.png', '12345678', 'admin'),
(18, 'test', 'user', 'test@mail.com', 12345678902, 'Testaddress 23', 'avatar.png', '12345678', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
