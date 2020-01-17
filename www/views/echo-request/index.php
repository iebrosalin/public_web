<?php

use Components\View\SimpleView;

SimpleView::render('layouts/header_admin.php') ?>
    <div class="row justify-content-center">

    <div class="col-xl-6 col-lg-8 col-md-12">
        <div class="form-group">
                <textarea id="valueRequest" class="form-control" placeholder="Echo echo echo"></textarea>
        </div>
        <div class="list-group">
            <a methods="get" class="list-group-item list-group-item-action">
                GET
            </a>
            <a  methods="post" class="list-group-item list-group-item-action">POST</a>
        </div>
    </div>
    </div>

    <div class="row">

        <div class="col">
            <div class="text-center mt-2">
                <h4>Request</h4>
            </div>

            <pre id="resRequest">

            </pre>
        </div>
    </div>

<?php SimpleView::render('layouts/footer_admin.php') ?>