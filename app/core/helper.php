<?php

/**
 * Get root url
 */
function siteUrl(): string
{
    return (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
}

/**
 * Get assets path
 */
function url($path)
{
    echo siteUrl() . $path;
}

/**
 * Redirect to path
 */
function redirect($path)
{
    $host = siteUrl();

    if ($path != '/') {
        $host .= $path;
    }

    header('Location:' . $host);
}

/**
 * Current URL without params
 */
function currentUrl()
{
    $current_url = explode("?", $_SERVER['REQUEST_URI']);
    return $current_url[0];
}

/**
 * Current URL with params
 */
function getPage($page)
{
    $currentUrl = currentUrl();
    if (!strpos($currentUrl, 'app/index/'))
        $currentUrl = currentUrl() . 'app/index/';

    $params = [];
    if (count($_GET) > 0) {
        foreach ($_GET as $key => $value) {
            $params[$key] = $value;
        }
    }
    if (!array_key_exists('page', $params)) {
        $params['page'] = $page;
    } else {
        $params['page'] = $page;
    }
    $count = 0;
    foreach ($params as $key => $param) {
        $currentUrl .= $count == 0 ? '?' : "&";
        $currentUrl .= $key . '=' . $param;
        $count++;
    }
    return $currentUrl;
}

/*
 * Sorting function
 */
function sortBy($field)
{
    $rootUrl = currentUrl();
    if (!strpos($rootUrl, 'app/index/')) {
        $rootUrl = currentUrl() . 'app/index/';
    }

    $currentUrl = $rootUrl . '?sortBy=' . $field;
    if (count($_GET) > 0) {
        if (isset($_GET['sortBy']) && $_GET['sortBy'] == $field) {
            $currentUrl = $rootUrl . '?sortByDesc=' . $field;
        }
    }

    $name = false;
    if (isset($_GET['sortBy']) && $_GET['sortBy'] == $field) {
        $name = 'По возрастанию';
    }
    if (isset($_GET['sortByDesc']) && $_GET['sortByDesc'] == $field) {
        $name = 'По убыванию';
    }

    $isSort = false;
    if (isset($_GET['sortBy']) || isset($_GET['sortByDesc'])) {
        $isSort = true;
    }

    return [
        'url' => $currentUrl,
        'name' => $name,
        'isSort' => $isSort,
        'field' => $field
    ];
}