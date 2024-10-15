<?php
    class HomeView {

        public function __construct(){
        }

        function showHome(){
            require_once "templates/header.php";
            ?>
            <main>
                <section class="filters">
                        <h2>Filtros de busqueda</h2>
    
                        <!-- tabla para ubicar los filtros/categorias -->
                        <form action="" method="post">
                            <table class="filter-table"> 
                                <tr>
                                    <th>Valoraciones</th>
                                    <th>Genero</th>
                                    <th>Fecha de lanzamiento</th>
                                    <th>Clasificacion</th>
                                    <th>Desarrolladores</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="vandal_rating" id="rating-filter">
                                            <option value="null"></option>
                                            <option value="positive">Positivas</option>
                                            <option value="negative">Negativas</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="genre" id="genre-filter">
                                            <option value="null"></option>
                                            <option value="Accion">Accion</option>
                                            <option value="Aventura">Aventura</option>
                                            <option value="Rol">Rol</option>
                                            <option value="Carreras">Carreras</option>
                                            <option value="Disparos">Disparos</option>
                                            <option value="Plataformas">Plataformas</option>
                                            <option value="Deportes">Deportes</option>
                                            <option value="Pelea">Lucha</option>
                                            <option value="Terror">Horror</option>
                                            <option value="Simulacion">Simulacion</option>
                                            <option value="Supervivencia">Supervivencia</option>
                                            <option value="Mundo Abierto">Mundo Abierto</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="release" id="year-filter">
                                            <option value="null"></option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="pegi_class" id="pegi-filter">
                                            <option value="null"></option>
                                            <option value="1">Sin clasificacion</option>
                                            <option value="3">PEGI 3+</option>
                                            <option value="7">PEGI 7+</option>
                                            <option value="12">PEGI 12+</option>
                                            <option value="16">PEGI 16+</option>
                                            <option value="18">PEGI 18+</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="devs" id="devs-filter">
                                            <option value="null"></option>
                                            <option value="Activision">Activision</option>
                                            <option value="Ubisoft">Ubisoft</option>
                                            <option value="Team17">Team17</option>
                                            <option value="Harmonix">Harmonix</option>
                                            <option value="Bandai Namco">Bandai Namco</option>
                                            <option value="Blizzard">Blizzard</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </section>
            </main>
            <?php
            require_once "templates/footer.php";
        }
    
        function showTable($table){
            ?>
                <table>
                    <tr class="head">
                        <th>Portada</th>
                        <th>Titulo</th>
                        <th>ID de Microsoft</th>
                        <th>Género</th>
                        <th>Año de lanzamiento</th>
                        <th>Clasificación</th>
                        <th>Desarrolladores</th>
                        <th>Calificación</th>
                    </tr>
            <?php 
    
            foreach($table as $juego) {
                $thumbnail = $juego->thumbnail;
                $title = $juego->title;
                $id = $juego->title_id;
                $genre = $juego->genre;
                $release = $juego->realease;
                $class = $juego->pegi_class;
                $devs = $juego->devs;
                $rate = $juego->vandal_rating;
                ?>
                    <tr class="row">
                        <td class="thumbnail-property">
                            <img src="<?= $thumbnail ?>" alt="portada">
                        </td>
                        <td class="title-property"><?= $title ?></td>
                        <td class="id-property"><?= $id ?></td>
                        <td class="genre-property"><?= $genre ?></td>
                        <td class="release-property"><?= $release ?></td>
                        <td class="class-property"><?= $class ?></td>
                        <td class="devs-property"><?= $devs ?></td>
                        <td class="rating-property"><?= $rate ?></td>
                    </tr>
                <?php
            }
            ?>
                </table>
            <?php
        }
    }
?>
