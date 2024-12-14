<?php
return [
    [
        'icon' => 'nav-icon fas fa-home',
        'route' => 'dashboard.dashboard',
        'title' => 'لوحة التحكم',
        'active' => 'dashboard.dashboard'
    ],

    [
        'icon' => 'fas fa-user nav-icon',
        'route' => 'dashboard.user.index',
        'title' => 'المستخدمين',
        'active' => 'dashboard.user.*'
    ],

    [
        'icon' => "fas fa-house-user nav-icon",
        'route' => 'dashboard.provider.index',
        'title' =>  'مقدمي الخدمات',
        'active' => 'dashboard.provider.*'
    ],

    [
        'icon' => "fas fa-user-cog nav-icon",
        'route' => 'dashboard.admin.index',
        'title' =>  'المسؤولون',
        'active' => 'dashboard.admin.*'
    ],

    [
        'icon' => "fas fa-building nav-icon",
        'route' => 'dashboard.service.index',
        'title' =>  'الخدمات المقدمة',
        'active' => 'dashboard.service.*'
    ],

    [
        'icon' => "fas fa-info-circle nav-icon",
        'route' => 'dashboard.work.index',
        'title' =>  ' وصف الية عمل الموقع',
        'active' => 'dashboard.work.*'
    ],

    [
        'icon' => "fas fa-plus nav-icon",
        'route' => 'dashboard.material.index',
        'title' =>  ' المواد الفائضة ',
        'active' => 'dashboard.material.*'
    ],









];
