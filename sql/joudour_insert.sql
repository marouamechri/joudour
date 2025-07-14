-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name_category`) VALUES
(1, 'Robe'),
(2, 'Ensemble');

-- --------------------------------------------------------

-- Déchargement des données de la table `colors`
--

INSERT INTO `colors` (`id`, `ref_color`, `name_color`) VALUES
(1, '#e91c1c', 'Rouge'),
(2, '#000000', 'Noir'),
(3, '#eee7c9', 'Beige'),
(4, '#4f8b8c', 'bleu turquoise');
-- --------------------------------------------------------
-- Déchargement des données de la table `cut`
--

INSERT INTO `cut` (`id`, `cut_value`) VALUES
(1, 'Taill');
-- --------------------------------------------------------

-- Déchargement des données de la table `imageweb_site`
--

INSERT INTO `imageweb_site` (`id`, `poster`, `titre_poster`, `poster_text_btn`, `robe1`, `robe2`, `robe3`, `img_shop1`, `img_shop2`, `img_shop3`, `imgloca1`, `imgloca2`, `imgloca3`) VALUES
(1, '1fe79d5fe79c6c828a86311aec10a07f.jpg', 'La robe de vos rêves vous attend.', 'Découvrez nos créations', '72f793a2910dc5534ee369b0bda0f662.jpg', '74a3c0de6e8a3a0f226c236d2c07ecda.jpg', 'e40c24196fabd60a1cfb1aeaed7adf55.jpg', 'f0371e32d8dd6897059bcbf447c56359.jpg', 'b9f675d061086998cf06f95913906c4b.jpg', 'bc47ab33b0e661e81fb6889b940822b5.jpg', 'c2609684c02eee32be53963aaba62124.jpg', '499aabd1e4323b0f17eedd9c6328beae.jpg', '3b316815187492ef03184a5f6f4e8eee.jpg');

-- --------------------------------------------------------

INSERT INTO `option` (`id`, `category_id`, `name_option`) VALUES
(1, 1, 'Robe de mariée'),
(2, 1, 'Robe de fiançailles'),
(3, 1, 'Robe d\'invitée');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `product_color_id`, `picture_name`) VALUES
(1, 1, 'aa4355145ff9de9252c46d4d1d8df3ab.jpg'),
(2, 1, '8debd0d6295c190ef683ee3b6b10368b.jpg'),
(3, 1, '93c66ca6104e1a7c243abdd831acb1c7.jpg'),
(4, 1, 'de6456d8af2c33eecf12701109767d3f.jpg'),
(5, 1, '728a1ad4846a076090c47535d1ee0db0.jpg'),
(6, 1, '36ad1b50e46a5c6194be611601b4c82a.jpg'),
(7, 1, '76ae14ca48ea231a3846dd6465aa7990.jpg'),
(8, 2, 'd3934cc15a2023f228661ae102a1accf.jpg'),
(9, 2, 'f19161a472bf464438b986029a46f44f.jpg'),
(10, 2, '38a294a5c869f01fc80016cbeb315f60.jpg'),
(11, 2, '32b703d0afa7372f4e65a2806462ea55.jpg'),
(12, 2, '2c0c721c388c3fe4bdca1c8a76f1fc86.jpg'),
(13, 3, '8552ff4ef466cdd018cc6e51cbbbce0c.jpg'),
(14, 3, 'a2a131fee726ede796b129dff9f4e14f.jpg'),
(15, 3, 'e91a23b110d13a11b5e49ce005e91a65.jpg'),
(16, 3, '0d947f4d0de1596b30e2a67d095ef74c.jpg'),
(17, 4, '33b750368470f1d2cd55938308829c3c.jpg'),
(18, 4, 'db81c51322a888f8b29328a9d31d46e6.jpg'),
(19, 4, '4262bf613e6d421cf0488eb8798e6b4d.jpg'),
(20, 4, 'af81c1c40e9d4b92256f5211a9c68072.jpg'),
(21, 4, 'e39de97f56993c8a5542a413d27efdba.jpg'),
(22, 4, 'f7504d92dd2d2c5b497b5ba2134ffc18.jpg'),
(23, 5, 'cd9bacc80acfd84bbfaebc785cecc761.jpg'),
(24, 5, 'a681b59eb579c9af3a2030b5b308a9fc.jpg'),
(25, 5, '3e94d109f6654c7d35afd683c54a5576.jpg'),
(26, 5, '989d3fe35c434c8c0eaf94d08e9a82b5.jpg'),
(27, 5, 'dd7352182a2e2689513297a2768abe75.jpg'),
(28, 5, '4d3d01535ab68bf9a6122a3b08ef75cc.jpg');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `type_product_id`, `name_product`, `description_product`, `amount_htva`, `created_at`, `modified_at`, `action`, `first_image`, `active`, `ref_product`, `genre`, `new_colletion`) VALUES
(1, 1, 'Robe Elsa', 'Quand la grâce rencontre le tissu, naît une robe d’exception.', 50000, '2025-07-14 16:00:39', NULL, 'Vente', 'f484d940ae1c90424c589a8c33c11f58.jpg', 1, '42f5b5613e', 'Femme', 1),
(2, 2, 'Robe Nejma', 'Simplement sublime.', 50000, '2025-07-14 16:02:40', NULL, 'Vente', '4e44642340691e6ed9a7ac8bb0f8af0f.jpg', 1, '43b0026147', 'Femme', 1),
(3, 2, 'Robe Amal', 'Laissez parler votre élégance, en toute légèreté', 50000, '2025-07-14 16:08:24', NULL, 'Vente', '980a013c99fd1d92f3a0ff7a03ee016b.jpg', 1, '2b5eb67c39', 'Femme', 1),
(4, 1, 'Robe Jasmin', 'Votre robe. Votre pouvoir.', 50000, '2025-07-14 16:47:33', NULL, 'Vente', 'e177cfcc9db57a97931a12f73aaf8fb1.jpg', 1, '51423d9d19', 'Femme', 1);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `product_color`
--

INSERT INTO `product_color` (`id`, `color_id`, `product_id`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 3, 3),
(4, 2, 4),
(5, 1, 4);

-- --------------------------------------------------------
--
-- Déchargement des données de la table `product_cut`
--

INSERT INTO `product_cut` (`id`, `product_color_id`, `stock_id`, `cut_id`, `active`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 2, 1, 1),
(3, 3, 3, 1, 1),
(4, 4, 4, 1, 1);

-- --------------------------------------------------------
--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `stock_min`, `stock_max`, `nbr_product`) VALUES
(1, 5, 200, 100),
(2, 5, 200, 44),
(3, 5, 200, 65),
(4, 5, 200, 50);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `transporteur`
--

INSERT INTO `transporteur` (`id`, `name_transport`, `description`, `prices_transport`, `created_at`) VALUES
(1, 'La Poste / Colissimo', 'Livraison sous 48h en France métropolitaine,  suivi en ligne,  livraison en boîte aux lettres possible et remise avec ou sans signature', 450, '2025-07-14 15:26:30'),
(2, 'Chronopost', 'Livraison express dès le lendemain (24h),  large choix de créneaux horaires,  suivi en temps réel et  livraison en point relais, domicile ou entreprise', 450, '2025-07-14 15:29:08'),
(3, 'Mondial Relay', 'Livraison en points relais (3 à 5 jours ouvrés),  tarifs compétitifs,  Suivi du colis en ligne,  et réseau dense de relais en France et en Europe', 300, '2025-07-14 15:30:25');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `civilite`, `nom`, `prenom`, `email`, `roles`, `password`, `is_verified`, `tel`) VALUES
(1, 'Madame', 'admin', 'admin', 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$qHXE2WNhCOCkBuOSRE1KUex7VCFNCnMaJVKawFVwneQuEs79KQBb.', 1, NULL),
(2, 'Madame', 'user', 'user', 'user@gmail.com', '[]', '$2y$13$Ccr/Uxerx4j1KxRzIRAxCOMPWyrCYyq/TZKG/fx3WnblBOmu9Fs.C', 1, NULL);

