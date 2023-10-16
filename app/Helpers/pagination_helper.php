<?php

const PAGE = 1;
const PER_PAGE = 10;

function getPagination($model) {
    return [
        'page' => $model->pager->getCurrentPage(),
        'total' => $model->countAll(),
    ];
}