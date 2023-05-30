<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<?php
require_once('../../../../wp-config.php');
$kw_list = explode(";", get_option("panels-admin-datas")["panels_kw_list"]);
$articles_titles_patter = get_option("panels-admin-datas")["panels_pattern_articles_titles"];
$panels_pattern_articles_details = get_option("panels-admin-datas")["panels_pattern_articles_details"];
$min_price_for_each_panel = get_option("panels-admin-datas")["min_price_for_each_panel"];
$max_price_for_each_panel = get_option("panels-admin-datas")["max_price_for_each_panel"];
$price_for_each_converter = get_option("panels-admin-datas")["price_for_each_converter"];
$k_for_each_panel = get_option("panels-admin-datas")["k_for_each_panel"];
echo "<div style='display:flex; flex-direction: row;'>";
foreach ($kw_list as $systemKw) {
    echo "<a type='button' href='#wp-ct-panels-$systemKw' class='btn btn-success mr-2' style='text-decoration: none;'><b>" . $systemKw . "</b>Kwp</a>";
}
echo "</div>";
foreach ($kw_list as $systemKw) {
    $nOfPanels = ceil(floatval($systemKw) / floatval($k_for_each_panel) * 1000);
    $minPrice = $nOfPanels * $min_price_for_each_panel + $price_for_each_converter - 0.01;
    $maxPrice = $nOfPanels * $max_price_for_each_panel + $price_for_each_converter - 0.01;
    $finalSystemKw = floatval($nOfPanels * ($k_for_each_panel / 1000));
    $finalSystemKwString = $systemKw . "/" . $finalSystemKw;
    $article_title = str_replace("&^s", $finalSystemKwString, $articles_titles_patter);
    $article_detais = str_replace("&^s", $finalSystemKwString, $panels_pattern_articles_details);
    $article_detais = str_replace("&^x", $nOfPanels, $article_detais);
    echo "<hr style='border-top: 2px solid #bbb; font-weight: bold;'>";
    echo "<div id='wp-ct-panels-$systemKw'>";
    echo "<h4>" . $article_title . "</h4>";
    echo "<div style='display:flex; flex-direction: row;'>";
    echo "<img style='width: 180px; height: 250px;' src='http://localhost:8888/websites/gc/wp-content/uploads/2023/05/pannello400.jpeg'/>";
    echo "<p class='mb-4 wp-ct-panels-details' style='align-self: end; font-size: 0.9em;'>" . $article_detais . "</p></div>";
    echo "<div style='display:flex; flex-direction: column; justify-content: end; align-items: end'> <p class='text-info'>Prezzo impianto fotovoltaico </b>$finalSystemKw Kwp</b> chiavi in mano:</p>";
    echo "<p class='text-success mr-2 pl-5' style='font-weight: bold; font-style: italic; background-color: rgb(255, 255, 203);'>Da € $minPrice a € $maxPrice</p>";
    echo "<button href='/preventivo' type='button' class='btn btn-success mb-4'>Preventivo</button></div>";
    echo "</div>";
}
echo "<style>@media screen and (min-width: 800px) { .wp-ct-panels-details { max-width: 30vw; } }</style>";
?>