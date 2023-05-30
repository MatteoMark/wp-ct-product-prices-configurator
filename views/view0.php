<?php
/** @var string $panels_kw_list */
/** @var string $panels_page_title */
/** @var string $panels_pattern_articles_titles */
/** @var string $panels_pattern_articles_details */
/** @var string $min_price_for_each_panel */
/** @var string $max_price_for_each_panel */
/** @var string $price_for_each_converter */
/** @var string $k_for_each_panel */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<h1>
    <?php echo esc_html__('Configuratore pannelli', 'ct-admin'); ?>
</h1>
<p>
    <?php echo esc_html__('Configuratore avanzanto pannelli e prezzi', 'ct-admin'); ?>
</p>
<form method="POST" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="ct_admin_save">
    <?php wp_nonce_field('ct_admin_save', 'ct_admin'); ?>
    <input type="hidden" name="redirectToUrl" value="<?php echo ct_admin_view_pagename(''); ?>">

    <div class="row g-5">
        <div class="col-md-6">
            <fieldset class="mt-3">
                <legend class="mb-3">
                    <?php echo esc_html__('Informazioni generali', 'ct-admin') ?>
                </legend>

                <div class="mb-3">
                    <label for="panels_page_title" class="form-label">
                        <?php echo esc_html__("Titolo pagina", 'ct-admin') ?>
                    </label>
                    <p class="form-label text-secondary">
                        <?php echo esc_html__("Nome della pagina che verrà creata", 'ct-admin') ?>
                    </p>
                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                        <?php echo $panels_page_title; ?>
                        <button type="button" class="btn btn-info btn-sm p-1 m-2 w-50"
                            id="panels_create_page_button">Crea pagina</button>
                    </div>
                    <script>
                        $('#panels_create_page_button').click(function () {
                            $.ajax({
                                type: "POST",
                                url: "admin.php?page=panels-configurator",
                                data: { title: "<?php echo get_option("panels-admin-datas")["panels_page_title"] ?>" },
                            }).done(function (msg) { alert("Pagina creata con successo"); });
                        });
                    </script>
                </div>

                <div class="mb-3">
                    <label for="panels_pattern_articles_titles" class="form-label">
                        <?php echo esc_html__("Pattern titoli articoli", 'ct-admin') ?>
                    </label>
                    <p class="form-label text-secondary">
                        <?php echo esc_html__("Esempio: se pattern = 'Impianto &^sKWp casalingo', '&^s' verrà sostituito con le varie opzioni di KW -> 'Impianto 5KWp casalingo'", 'ct-admin') ?>
                    </p>
                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                        <?php echo $panels_pattern_articles_titles; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <div style="display:flex; flex-direction: row; align-items: center">
                        <div>
                            <label for="min_price_for_each_panel" class="form-label">
                                <?php echo esc_html__("Prezzo minimo a pannello | ", 'ct-admin') ?>
                            </label>
                            <div
                                style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                <?php echo $min_price_for_each_panel; ?>
                            </div>
                        </div>
                        <div style="margin-left: 5px">
                            <label for="max_price_for_each_panel" class="form-label">
                                <?php echo esc_html__("Prezzo massimo a pannello | ", 'ct-admin') ?>
                            </label>
                            <div
                                style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                <?php echo $max_price_for_each_panel; ?>
                            </div>
                        </div>
                        <div style="margin-left: 5px">
                            <label for="price_for_each_converter" class="form-label">
                                <?php echo esc_html__("Prezzo per converter", 'ct-admin') ?>
                            </label>
                            <div
                                style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                <?php echo $price_for_each_converter; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="k_for_each_panel" class="form-label">
                        <?php echo esc_html__("W per pannello", 'ct-admin') ?>
                    </label>
                    <p class="form-label text-secondary">
                        <?php echo esc_html__("Se il valore è 400 e i KW dell'impianto sono 3, allora i pannelli nel preventivo saranno 8 (3.2KW)", 'ct-admin') ?>
                    </p>
                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                        <?php echo $k_for_each_panel; ?>
                    </div>
                </div>

            </fieldset>

        </div>
        <div class="col-md-6">
            <fieldset class="mt-3">
                <legend class="mb-3">
                    <?php echo esc_html__('Informazioni dettagliate', 'ct-admin') ?>
                </legend>

                <div class="mb-3">
                    <label for="panels_kw_list" class="form-label">
                        <?php echo esc_html__('KW pannelli', 'ct-admin') ?>
                    </label>
                    <p class="form-label text-secondary">
                        <?php echo esc_html__("Dividere con ; - per esempio 5;10;15", 'ct-admin') ?>
                    </p>
                    <?php echo $panels_kw_list; ?>
                </div>

                <div class="mb-3">
                    <label for="panels_pattern_articles_details" class="form-label">
                        <?php echo esc_html__('Pattern descrizioni articoli', 'ct-admin') ?>
                    </label>
                    <p class="form-label text-secondary">
                        <?php echo esc_html__("Esempio: se pattern = 'Descrizione impianto &^sKWp casalingo', '&^s' verrà sostituito con le varie opzioni di KW -> 'Descrizione impianto 5KWp casalingo'", 'ct-admin') ?>
                    </p>
                    <?php echo $panels_pattern_articles_details; ?>
                </div>
            </fieldset>
        </div>

    </div>
    <!-- / row -->
    <div id="wp_panels"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(function () { $("#wp_panels").load("http://localhost:8888/websites/gc/wp-content/plugins/wp-ct-product-prices-configurator/includes/panels_list.html"); });
    </script>

    <?php ct_admin_submit(esc_html__('Salva i dati')); ?>

</form>