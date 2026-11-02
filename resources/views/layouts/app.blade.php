<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#183D32">
    <title>@yield('title', 'Academic Records')</title>

    <style>
        :root {
            color-scheme: light;
            --forest: #183D32;
            --forest-hover: #245746;
            --sage: #D9E5D9;
            --paper: #F3F1E9;
            --surface: #FFFDF8;
            --ink: #252C28;
            --muted: #656D67;
            --line: #DEDCD3;
            --danger: #A63F38;
            --danger-pale: #F8E9E6;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }

        button, input, select, textarea {
            font: inherit;
        }

        .navbar {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px max(24px, calc((100% - 1200px) / 2));
            background: var(--surface);
            border-bottom: 1px solid var(--line);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: inherit;
            text-decoration: none;
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 4px;
            background: var(--forest);
            color: var(--surface);
            font-family: Georgia, serif;
            font-size: 21px;
        }

        .brand-name {
            font-size: 13px;
            font-weight: 750;
            letter-spacing: 1.3px;
        }

        .brand-sub {
            margin-top: 2px;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: 1px;
        }

        .nav-label {
            color: var(--muted);
            font-size: 11px;
            letter-spacing: 1.1px;
        }

        .container {
            width: min(1200px, 100%);
            min-height: calc(100vh - 138px);
            margin: 0 auto;
            padding: 52px 24px 64px;
        }

        .page-heading {
            margin-bottom: 32px;
        }

        .eyebrow, .section-label {
            margin: 0 0 12px;
            color: var(--forest);
            font-size: 10px;
            font-weight: 750;
            letter-spacing: 1.7px;
        }

        .eyebrow span {
            padding: 0 5px;
            color: var(--muted);
        }

        h1, h2, h3, p {
            margin-top: 0;
        }

        h1 {
            margin-bottom: 8px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(32px, 4vw, 43px);
            font-weight: 400;
            letter-spacing: -.8px;
            line-height: 1.15;
        }

        .subtitle {
            max-width: 620px;
            margin-bottom: 0;
            color: var(--muted);
        }

        .workspace {
            display: grid;
            grid-template-columns: minmax(270px, 330px) minmax(0, 1fr);
            align-items: start;
            gap: 22px;
        }

        .panel {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 5px;
            background: var(--surface);
        }

        .panel-heading {
            padding: 21px 22px 18px;
            border-bottom: 1px solid var(--line);
        }

        .panel-heading .section-label {
            margin-bottom: 7px;
            font-size: 9px;
        }

        .panel-heading h2 {
            margin-bottom: 4px;
            font-size: 16px;
            font-weight: 700;
        }

        .panel-heading > p:last-child {
            margin-bottom: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .panel-body {
            padding: 22px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 650;
        }

        input, select, textarea {
            width: 100%;
            min-height: 42px;
            padding: 10px 11px;
            border: 1px solid #C9C8BF;
            border-radius: 3px;
            outline: none;
            background: #FFFEFA;
            color: var(--ink);
            font-size: 13px;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input::placeholder, textarea::placeholder {
            color: #777D78;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--forest);
            box-shadow: 0 0 0 3px rgb(24 61 50 / 12%);
        }

        [aria-invalid="true"] {
            border-color: var(--danger);
        }

        [aria-invalid="true"]:focus {
            box-shadow: 0 0 0 3px rgb(166 63 56 / 12%);
        }

        .error {
            margin: 6px 0 0;
            color: var(--danger);
            font-size: 12px;
        }

        .btn {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 13px;
            border: 1px solid transparent;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 650;
            line-height: 1.2;
            text-decoration: none;
            transition: background-color .15s ease, border-color .15s ease, color .15s ease;
        }

        .btn:focus-visible, .brand:focus-visible {
            outline: 3px solid #819B88;
            outline-offset: 2px;
        }

        .btn-primary {
            width: 100%;
            background: var(--forest);
            color: var(--surface);
        }

        .btn-primary:hover {
            background: var(--forest-hover);
        }

        .btn-edit, .btn-secondary {
            border-color: #C6D5C7;
            background: #EDF2EC;
            color: var(--forest);
        }

        .btn-edit:hover, .btn-secondary:hover {
            border-color: #A8BDAA;
            background: var(--sage);
        }

        .btn-delete {
            border-color: #E7C7C2;
            background: var(--danger-pale);
            color: var(--danger);
        }

        .btn-delete:hover {
            border-color: #D6A9A3;
            background: #F2DAD6;
        }

        .alert {
            margin: -12px 0 24px;
            padding: 12px 15px;
            border: 1px solid #C6D5C7;
            border-left: 3px solid var(--forest);
            border-radius: 3px;
            background: #EDF2EC;
            color: var(--forest);
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 720px;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 13px 14px;
            border-bottom: 1px solid var(--line);
            background: #F8F7F1;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .8px;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #E8E6DE;
            font-size: 12px;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tbody tr:hover {
            background: #FAF9F4;
        }

        .row-number {
            color: var(--muted);
        }

        .student-name {
            min-width: 140px;
            font-weight: 650;
        }

        .gender {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 2px;
            background: #E8EFE7;
            color: var(--forest);
            font-size: 10px;
            white-space: nowrap;
        }

        .address-cell {
            min-width: 150px;
            max-width: 230px;
            color: var(--muted);
        }

        .phone-cell {
            white-space: nowrap;
        }

        .actions, .form-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .actions form {
            margin: 0;
        }

        .actions .btn {
            min-height: 32px;
            padding: 7px 9px;
            font-size: 11px;
        }

        .empty {
            padding: 42px 20px;
            text-align: center;
        }

        .empty h3 {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .empty p {
            margin-bottom: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .edit-panel {
            max-width: 680px;
        }

        .form-actions {
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .form-actions .btn-primary {
            width: auto;
            min-width: 170px;
        }

        .footer {
            padding: 18px 24px;
            border-top: 1px solid var(--line);
            background: var(--surface);
            color: var(--muted);
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 900px) {
            .workspace {
                grid-template-columns: minmax(0, 1fr);
            }

            .form-panel {
                max-width: 680px;
            }
        }

        @media (max-width: 560px) {
            .navbar {
                min-height: 68px;
                padding: 12px 16px;
            }

            .nav-label {
                display: none;
            }

            .container {
                min-height: calc(100vh - 130px);
                padding: 34px 16px 44px;
            }

            .page-heading {
                margin-bottom: 25px;
            }

            .panel-heading, .panel-body {
                padding-right: 17px;
                padding-left: 17px;
            }

            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .form-actions .btn-primary, .form-actions .btn-secondary {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar" aria-label="Navigasi utama">
        <a class="brand" href="{{ route('mahasiswa.index') }}">
            <span class="brand-mark" aria-hidden="true">A</span>
            <span>
                <span class="brand-name">ACADEMIC RECORDS</span><br>
                <span class="brand-sub">STUDENT MANAGEMENT SYSTEM</span>
            </span>
        </a>
        <span class="nav-label">SISTEM INFORMASI AKADEMIK</span>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="footer">
        Academic Records &copy; {{ date('Y') }} · Student Data Management
    </footer>
</body>
</html>
