<?php
    class Model {
        protected $db;

        public function __construct() {
            $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
            $this->_deploy();
        }

        private function _deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables=$query->fetchAll();
            if (count($tables) == 0) {
                $sql=<<<SQL
                    CREATE TABLE `listadox360` (
                    `id_listadox360` mediumint(5) NOT NULL,
                    `title_id` varchar(10) NOT NULL,
                    `pegi_class` tinyint(2) NOT NULL,
                    `title` varchar(60) NOT NULL,
                    `release` smallint(4) NOT NULL,
                    `genre` varchar(45) NOT NULL,
                    `devs` varchar(45) NOT NULL,
                    `vandal_rating` varchar(10) NOT NULL,
                    `thumbnail` varchar(300) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='listado de juegos de Xbox 360';

                    --
                    -- Volcado de datos para la tabla `listadox360`
                    --

                    INSERT INTO `listadox360` (`id_listadox360`, `title_id`, `pegi_class`, `title`, `release`, `genre`, `devs`, `vandal_rating`, `thumbnail`) VALUES
                    (1, '555308c2', 18, 'Assassins Creed IV: Black Flag', 2013, 'Accion', 'Ubisoft', '9', 'https://media.vandal.net/t200/20557/201322812018_1.jpg'),
                    (2, '373407d8', 7, 'Hora de Aventuras: Finn y Jake, Investigadores', 2015, 'Aventura', 'Bandai Namco', '6', 'https://m.media-amazon.com/images/I/81dt08wLF5L._AC_UF1000,1000_QL80_.jpg'),
                    (3, '373307d9', 12, 'Dance Central 3', 2012, 'Deporte', 'Harmonix', '9', 'https://http2.mlstatic.com/D_NQ_NP_658655-MLA76350674990_052024-O.webp'),
                    (5, '53450815', 7, 'Sonic and SEGA All-Stars Racing', 2010, 'Carreras', 'Sega', '8', 'https://media.vandal.net/t200/10765/201011911317_1.jpg'),
                    (6, '584112b0', 18, 'Call of Juarez: Gunslinger', 2013, 'Disparos', 'Techland', '8', 'https://media.vandal.net/t200/16708/2013427105836_1.jpg'),
                    (7, '394f07d1', 16, 'Diablo III', 2013, 'Rol', 'Blizzard', '8', 'https://media.vandal.net/t200/15249/diablo-iii-2013831113047_1.jpg'),
                    (8, '58411446', 12, 'Guacamelee! Super Turbo Championship Edition', 2014, 'Plataformas', 'Drinkbox', '8', 'https://products.eneba.games/resized-products/wO_lFLiS2CBrD9mN8WkNUBFl5ja309mxtrCklHTckT0_350x200_1x-0.jpeg'),
                    (9, '575207fd', 18, 'Mortal Kombat', 2011, 'Pelea', 'Warner Bros', '9', 'https://media.vandal.net/t200/12177/20114911120_1.jpg'),
                    (10, '58410afd', 12, 'Worms: Ultimate Mayhem', 2011, 'Disparos', 'Team17', '6', 'https://media.vandal.net/t200/14804/201222594227_1.jpg'),
                    (11, '4b4e0802', 18, 'Saw', 2009, 'Terror', 'Zombie Studios', '6', 'https://media.vandal.net/t200/8346/2009113124215_1.jpg'),
                    (12, '58411498', 1, 'Goat Simulator', 2015, 'Simulacion', 'Double Eleven', '8', 'https://media.vandal.net/t200/30037/goat-simulator-xbla-2015428103254_1.jpg'),
                    (13, '464f0802', 12, 'Terraria', 2013, 'Supervivencia', '505 Games', '8', 'https://media.vandal.net/t200/16737/2013316103629_1.jpg'),
                    (14, '584111f7', 7, 'Minecraft', 2012, 'Mundo Abierto', 'Mojang', '8', 'https://media.vandal.net/t200/14511/2012414103139_1.jpg'),
                    (15, '4d5308ed', 3, 'Kinect Adventures!', 2010, 'Deporte', 'Microsoft', '6', 'https://media.vandal.net/t200/12659/2011111911284_1.jpg'),
                    (16, '555308ca', 18, 'Far Cry 4', 2014, 'Aventura', 'Ubisoft', '8', 'https://media.vandal.net/t200/24455/far-cry-4-2014519123954_1.jpg'),
                    (17, '415608c3', 18, 'Call of Duty: Black Ops II', 2011, 'Disparos', 'Activision', '9', 'https://media.vandal.net/t200/14958/2012825101040_1.jpg'),
                    (18, '4e4d0862', 12, 'Dragon Ball Xenoverse', 2015, 'Pelea', 'Bandai Namco', '7', 'https://media.vandal.net/t200/24458/dragon-ball-xenoverse-201522695713_1.jpg'),
                    (19, '415608b5', 16, 'The Amazing Spider-Man', 2012, 'Aventura', 'Activision', '7', 'https://media.vandal.net/t200/15157/2012779248_1.jpg');

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `pegi`
                    --

                    CREATE TABLE `pegi` (
                    `id_pegi` tinyint(2) NOT NULL,
                    `age_range` varchar(10) NOT NULL,
                    `esrb_class` varchar(5) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    --
                    -- Volcado de datos para la tabla `pegi`
                    --

                    INSERT INTO `pegi` (`id_pegi`, `age_range`, `esrb_class`) VALUES
                    (1, 'NN', 'RP'),
                    (3, '3+', 'E'),
                    (7, '7+', 'E10+'),
                    (12, '12+', 'T'),
                    (16, '16+', 'M'),
                    (18, '18+', 'AO');

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `usuarios`
                    --

                    CREATE TABLE `usuarios` (
                    `id` int(11) NOT NULL,
                    `username` varchar(250) NOT NULL,
                    `pass` varchar(60) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    --
                    -- Volcado de datos para la tabla `usuarios`
                    --

                    INSERT INTO `usuarios` (`id`, `username`, `pass`) VALUES
                    (1, 'webadmin', '$2y$10$nTktMWUf/DqxAzkaR6ARZeVbC8FDGFiUH57G/aqy35kQfRLuWdXeK');

                    --
                    -- Índices para tablas volcadas
                    --

                    --
                    -- Indices de la tabla `listadox360`
                    --
                    ALTER TABLE `listadox360`
                    ADD PRIMARY KEY (`id_listadox360`),
                    ADD KEY `pegi_class` (`pegi_class`);

                    --
                    -- Indices de la tabla `pegi`
                    --
                    ALTER TABLE `pegi`
                    ADD PRIMARY KEY (`id_pegi`);

                    --
                    -- Indices de la tabla `usuarios`
                    --
                    ALTER TABLE `usuarios`
                    ADD PRIMARY KEY (`id`);

                    --
                    -- AUTO_INCREMENT de las tablas volcadas
                    --

                    --
                    -- AUTO_INCREMENT de la tabla `listadox360`
                    --
                    ALTER TABLE `listadox360`
                    MODIFY `id_listadox360` mediumint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

                    --
                    -- AUTO_INCREMENT de la tabla `usuarios`
                    --
                    ALTER TABLE `usuarios`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                    --
                    -- Restricciones para tablas volcadas
                    --

                    --
                    -- Filtros para la tabla `listadox360`
                    --
                    ALTER TABLE `listadox360`
                    ADD CONSTRAINT `listadox360_ibfk_2` FOREIGN KEY (`pegi_class`) REFERENCES `pegi` (`id_pegi`);
                    COMMIT;
                SQL;
                $this->db->query($sql);
            }
        }
    }
?>