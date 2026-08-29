<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Vibe Commerce') | Vibe Commerce</title>
    <style>
        :root {
            --navy: #0e1525;
            --navy-soft: #1b2436;
            --purple: #6d5dfc;
            --purple-dark: #5a49e8;
            --purple-soft: #eeecff;
            --bg: #f7f8fc;
            --card: #ffffff;
            --line: #e7e9f2;
            --ink: #101828;
            --muted: #6b7590;
            --green: #12b76a;
            --green-soft: #e7f8f0;
            --red: #f04438;
            --red-soft: #fdeceb;
            --amber: #f79009;
            --amber-soft: #fef3e2;
            --blue: #4f7cf7;
            --blue-soft: #ecf1fe;
            --gray-soft: #eef0f5;
            --radius: 12px;
            --shadow: 0 1px 2px rgba(16, 24, 40, .04), 0 8px 24px rgba(16, 24, 40, .06);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 15px;
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; text-decoration: none; }

        .nav-vibe {
            background: var(--navy);
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
            min-height: 62px;
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            letter-spacing: -.2px;
            white-space: nowrap;
        }

        .brand-mark {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--purple), #9b7bff);
            display: grid;
            place-items: center;
            font-size: 15px;
            font-weight: 800;
            color: #fff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
            margin: 0;
            padding: 0;
            flex: 1;
            flex-wrap: wrap;
        }

        .nav-links a {
            display: block;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 14px;
            color: #b6bed3;
            font-weight: 500;
            transition: .15s;
        }

        .nav-links a:hover { color: #fff; background: var(--navy-soft); }
        .nav-links a.on { color: #fff; background: var(--purple); }

        .nav-sep {
            width: 1px;
            height: 22px;
            background: #2a3348;
            margin: 0 6px;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--purple);
            display: grid;
            place-items: center;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
        }

        .nav-user .who { font-size: 13px; line-height: 1.2; }

        .nav-user .who small {
            display: block;
            color: #8792ab;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .link-out {
            background: none;
            border: 1px solid #2a3348;
            color: #b6bed3;
            font: inherit;
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
        }

        .link-out:hover { border-color: var(--red); color: #fff; background: var(--red); }

        .page {
            max-width: 1240px;
            margin: 0 auto;
            padding: 38px 24px 72px;
        }

        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--purple);
            margin-bottom: 8px;
        }

        .page-head h1 {
            margin: 0;
            font-size: 32px;
            letter-spacing: -.7px;
            font-weight: 700;
        }

        .lede { margin: 8px 0 0; color: var(--muted); max-width: 62ch; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: 9px;
            border: 1px solid transparent;
            font: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .15s;
            white-space: nowrap;
        }

        .btn-primary { background: var(--purple); color: #fff; }
        .btn-primary:hover { background: var(--purple-dark); }
        .btn-ghost { background: #fff; color: var(--ink); border-color: var(--line); }
        .btn-ghost:hover { border-color: #cfd4e4; background: #fbfbfe; }
        .btn-view { background: var(--amber-soft); color: #b54708; }
        .btn-view:hover { background: #fde7c7; }
        .btn-edit { background: var(--blue-soft); color: #2f5ed4; }
        .btn-edit:hover { background: #dde7fd; }
        .btn-danger { background: var(--red-soft); color: #b42318; }
        .btn-danger:hover { background: #fbdcda; }
        .btn-success { background: var(--green); color: #fff; }
        .btn-success:hover { background: #0e9c5a; }
        .btn-sm { padding: 6px 12px; font-size: 13px; }
        .btn[disabled] { opacity: .5; cursor: not-allowed; }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .card-pad { padding: 22px 24px; }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 18px 24px;
            border-bottom: 1px solid var(--line);
        }

        .card-head h2 { margin: 0; font-size: 16px; font-weight: 700; }
        .card-head .muted { font-size: 13px; color: var(--muted); }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 26px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px 22px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 4px;
            background: var(--purple);
        }

        .stat-card.g::before { background: var(--green); }
        .stat-card.a::before { background: var(--amber); }
        .stat-card.b::before { background: var(--blue); }
        .stat-card.r::before { background: var(--red); }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .6px;
            text-transform: uppercase;
            color: var(--muted);
        }

        .stat-num {
            display: block;
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -1px;
            margin: 6px 0 4px;
        }

        .stat-link { font-size: 13px; font-weight: 600; color: var(--purple); }
        .stat-link:hover { text-decoration: underline; }

        .tbl-wrap { overflow-x: auto; }

        table.tbl { width: 100%; border-collapse: collapse; font-size: 14px; }

        table.tbl th {
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 12px 24px;
            border-bottom: 1px solid var(--line);
            background: #fcfcfe;
            white-space: nowrap;
        }

        table.tbl td {
            padding: 14px 24px;
            border-bottom: 1px solid #f1f2f8;
            vertical-align: middle;
        }

        table.tbl tr:last-child td { border-bottom: 0; }
        table.tbl tbody tr:hover { background: #fbfbfe; }

        .row-actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
        .row-actions form { margin: 0; }

        .empty { padding: 40px 24px; text-align: center; color: var(--muted); }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.5;
        }

        .badge-green { background: var(--green-soft); color: #05784a; }
        .badge-gray { background: var(--gray-soft); color: #556; }
        .badge-purple { background: var(--purple-soft); color: #4b3ad6; }
        .badge-amber { background: var(--amber-soft); color: #b54708; }
        .badge-red { background: var(--red-soft); color: #b42318; }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .prod {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 22px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: .18s;
        }

        .prod:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(16, 24, 40, .05), 0 14px 32px rgba(16, 24, 40, .1);
        }

        .prod-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .prod-cat {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--muted);
        }

        .prod h3 { margin: 0; font-size: 18px; font-weight: 700; letter-spacing: -.3px; }
        .prod p { margin: 0; color: var(--muted); font-size: 14px; flex: 1; }
        .prod-price { font-size: 24px; font-weight: 700; letter-spacing: -.6px; }

        .prod-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            padding-top: 14px;
            border-top: 1px solid var(--line);
        }

        .prod-actions form { margin: 0; }

        .form-card { max-width: 640px; }
        .field { margin-bottom: 18px; }

        .field label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; }
        .field .hint { font-weight: 400; color: var(--muted); }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--line);
            border-radius: 9px;
            font: inherit;
            font-size: 14px;
            background: #fff;
            color: var(--ink);
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            outline: none;
            border-color: var(--purple);
            box-shadow: 0 0 0 3px rgba(109, 93, 252, .14);
        }

        .err { color: #b42318; font-size: 13px; margin-top: 6px; }
        .form-actions { display: flex; gap: 10px; padding-top: 6px; }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-ok { background: var(--green-soft); color: #05784a; }
        .alert-bad { background: var(--red-soft); color: #b42318; }

        .two-col {
            display: grid;
            grid-template-columns: 1.35fr 1fr;
            gap: 20px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .two-col { grid-template-columns: 1fr; }
            .page-head h1 { font-size: 26px; }
        }

        .meter { height: 7px; border-radius: 999px; background: var(--gray-soft); overflow: hidden; margin-top: 6px; }
        .meter i { display: block; height: 100%; border-radius: 999px; background: var(--purple); }
        .meter-row { padding: 12px 24px; border-bottom: 1px solid #f1f2f8; }
        .meter-row:last-child { border-bottom: 0; }
        .meter-top { display: flex; justify-content: space-between; font-size: 14px; }
        .meter-top strong { font-weight: 700; }

        .stack { display: flex; flex-direction: column; gap: 20px; }
        .kv { display: grid; grid-template-columns: 190px 1fr; gap: 2px 18px; }
        .kv dt { font-size: 13px; font-weight: 600; color: var(--muted); padding: 10px 0; border-bottom: 1px solid #f1f2f8; }
        .kv dd { margin: 0; padding: 10px 0; border-bottom: 1px solid #f1f2f8; }
    </style>
    @stack('head')
</head>

<body>
    @auth
        @php($me = auth()->user())
        @php($isAdmin = ($me->role ?? 'user') === 'admin')
        <nav class="nav-vibe">
            <div class="nav-inner">
                <a href="{{ url('/') }}" class="brand"><span class="brand-mark">V</span> Vibe Commerce</a>
                <ul class="nav-links">
                    <li><a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'on' : '' }}">Products</a></li>
                    <li><a href="{{ route('cart.index') }}" class="{{ request()->is('cart*') ? 'on' : '' }}">Cart</a></li>
                    <li><a href="{{ route('chat.index') }}" class="{{ request()->is('chat*') ? 'on' : '' }}">Assistant</a></li>
                    @if ($isAdmin)
                        <li class="nav-sep"></li>
                        <li><a href="{{ route('dashboard') }}" class="{{ request()->is('admin*') ? 'on' : '' }}">Admin</a></li>
                        <li><a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'on' : '' }}">Users</a></li>
                        <li><a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'on' : '' }}">Categories</a></li>
                        <li><a href="{{ route('orders.index') }}" class="{{ request()->is('orders*') ? 'on' : '' }}">Orders</a></li>
                        <li><a href="{{ route('payments.index') }}" class="{{ request()->is('payments*') ? 'on' : '' }}">Payments</a></li>
                    @endif
                </ul>
                <div class="nav-user">
                    <div class="avatar">{{ strtoupper(substr($me->name, 0, 1)) }}</div>
                    <div class="who">{{ $me->name }}<small>{{ $me->role ?? 'user' }}</small></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="link-out">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <main class="page">
        @hasSection('heading')
            <div class="page-head">
                <div>
                    @hasSection('eyebrow')
                        <div class="eyebrow">@yield('eyebrow')</div>
                    @endif
                    <h1>@yield('heading')</h1>
                    @hasSection('lede')
                        <p class="lede">@yield('lede')</p>
                    @endif
                </div>
                <div class="row-actions">@yield('actions')</div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-ok">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-bad">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
