<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A basic Point-of-Sale system built with CodeIgniter 4.">
    <title><?= esc($title) ?> | Ivan Frondarina</title>
    <style>
        :root {
            --navy: #14213d;
            --blue: #2563eb;
            --blue-dark: #1d4ed8;
            --gold: #f59e0b;
            --ink: #172033;
            --muted: #64748b;
            --line: #dbe3ef;
            --surface: #ffffff;
            --background: #f4f7fb;
        }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--background); color: var(--ink); font-family: Inter, "Segoe UI", Arial, sans-serif; line-height: 1.6; }
        a { color: inherit; }
        .site-header { background: var(--navy); color: #fff; box-shadow: 0 2px 12px rgba(15, 23, 42, .18); }
        .nav-wrap { width: min(1100px, calc(100% - 2rem)); min-height: 72px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 2rem; }
        .brand { display: flex; align-items: center; gap: .75rem; font-size: 1.1rem; font-weight: 800; text-decoration: none; letter-spacing: .02em; }
        .brand-mark { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 9px; background: var(--gold); color: var(--navy); font-size: .72rem; }
        .nav-links { display: flex; flex-wrap: wrap; gap: .25rem; margin: 0; padding: 0; list-style: none; }
        .nav-links a { display: block; padding: .55rem .8rem; border-radius: 7px; color: #dbeafe; text-decoration: none; font-weight: 600; }
        .nav-links a:hover, .nav-links a:focus { background: rgba(255, 255, 255, .12); color: #fff; }
        main { width: min(1100px, calc(100% - 2rem)); margin: 0 auto; padding: 3.5rem 0; }
        .eyebrow { margin: 0 0 .5rem; color: var(--blue); font-size: .78rem; font-weight: 800; letter-spacing: .13em; text-transform: uppercase; }
        h1, h2 { line-height: 1.15; }
        h1 { margin: 0 0 1rem; font-size: clamp(2.1rem, 5vw, 4rem); }
        h2 { margin-top: 0; }
        .lead { max-width: 700px; margin: 0 0 2rem; color: var(--muted); font-size: 1.12rem; }
        .hero { min-height: 480px; display: grid; grid-template-columns: 1.2fr .8fr; align-items: center; gap: 3rem; }
        .hero-card, .content-card, .table-card { border: 1px solid var(--line); border-radius: 18px; background: var(--surface); box-shadow: 0 12px 35px rgba(15, 23, 42, .07); }
        .hero-card { padding: 2rem; }
        .content-card { max-width: 820px; padding: 2rem; }
        .metric { display: flex; align-items: center; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--line); }
        .metric:last-child { border-bottom: 0; }
        .metric strong { font-size: 1.35rem; }
        .metric span { color: var(--muted); }
        .button-row { display: flex; flex-wrap: wrap; gap: .75rem; }
        .button { display: inline-block; padding: .75rem 1.05rem; border-radius: 9px; background: var(--blue); color: #fff; font-weight: 700; text-decoration: none; }
        .button:hover, .button:focus { background: var(--blue-dark); }
        .button.secondary { background: var(--navy); }
        .page-heading { margin-bottom: 2rem; }
        .table-card { overflow: hidden; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 1rem 1.25rem; border-bottom: 1px solid var(--line); text-align: left; white-space: nowrap; }
        th { background: #eaf1ff; color: var(--navy); font-size: .78rem; letter-spacing: .08em; text-transform: uppercase; }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #f8faff; }
        .badge { display: inline-block; padding: .25rem .65rem; border-radius: 999px; background: #e0ecff; color: #1e40af; font-size: .82rem; font-weight: 700; }
        .site-footer { border-top: 1px solid var(--line); color: var(--muted); text-align: center; }
        .site-footer p { width: min(1100px, calc(100% - 2rem)); margin: 0 auto; padding: 1.5rem 0; }
        @media (max-width: 760px) {
            .nav-wrap { padding: 1rem 0; align-items: flex-start; flex-direction: column; gap: .75rem; }
            .hero { grid-template-columns: 1fr; min-height: auto; }
            main { padding: 2.5rem 0; }
            th, td { padding: .85rem 1rem; }
        }
    </style>
</head>
<body>
<header class="site-header">
    <nav class="nav-wrap" aria-label="Main navigation">
        <a class="brand" href="<?= base_url('/') ?>"><span class="brand-mark" aria-hidden="true">JIF</span>Ivan Frondarina POS</a>
        <ul class="nav-links">
            <li><a href="<?= base_url('/') ?>">Home</a></li>
            <li><a href="<?= base_url('about') ?>">About</a></li>
            <li><a href="<?= base_url('customers') ?>">Customers</a></li>
            <li><a href="<?= base_url('users') ?>">Users</a></li>
        </ul>
    </nav>
</header>
<main>
