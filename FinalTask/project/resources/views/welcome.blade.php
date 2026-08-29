<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibe Commerce</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 40px 20px;
            background: radial-gradient(1100px 560px at 50% -10%, #243259 0%, #0e1525 62%);
            color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            text-align: center;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            font-weight: 700;
            font-size: 19px;
            margin-bottom: 26px;
        }

        .brand span {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: linear-gradient(135deg, #6d5dfc, #9b7bff);
            display: grid;
            place-items: center;
            font-size: 18px;
            font-weight: 800;
        }

        h1 {
            font-size: clamp(34px, 6vw, 54px);
            letter-spacing: -1.6px;
            margin: 0 0 16px;
            line-height: 1.08;
        }

        p.lede {
            color: #a8b2c9;
            font-size: 17px;
            max-width: 54ch;
            margin: 0 auto 34px;
            line-height: 1.6;
        }

        .cta { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

        .btn {
            display: inline-block;
            padding: 13px 24px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: .15s;
        }

        .btn-primary { background: #6d5dfc; color: #fff; }
        .btn-primary:hover { background: #5a49e8; }
        .btn-ghost { border: 1px solid #2a3348; color: #cfd6e6; }
        .btn-ghost:hover { border-color: #46527a; color: #fff; }

        .feats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 16px;
            margin-top: 54px;
            max-width: 780px;
        }

        .feat {
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 12px;
            padding: 20px;
            text-align: left;
        }

        .feat h3 { margin: 0 0 6px; font-size: 15px; }
        .feat p { margin: 0; color: #9aa5bd; font-size: 13.5px; line-height: 1.6; }
    </style>
</head>

<body>
    <main>
        <div class="brand"><span>V</span> Vibe Commerce</div>

        <h1>Run your store,<br>not your spreadsheets.</h1>
        <p class="lede">Products, categories, carts, orders and payments in one clean workspace -
            with an assistant that answers questions about your data.</p>

        <div class="cta">
            @auth
                <a href="{{ route('products.index') }}" class="btn btn-primary">Browse products</a>
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost">Control center</a>
                @else
                    <a href="{{ route('cart.index') }}" class="btn btn-ghost">My cart</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Sign in</a>
                <a href="{{ route('register') }}" class="btn btn-ghost">Create account</a>
            @endauth
        </div>

        <div class="feats">
            <div class="feat">
                <h3>Catalogue</h3>
                <p>Products grouped into categories, with live stock badges.</p>
            </div>
            <div class="feat">
                <h3>Cart</h3>
                <p>Add items, change quantities and watch the total update.</p>
            </div>
            <div class="feat">
                <h3>Control center</h3>
                <p>Admins manage users, categories, orders and payments.</p>
            </div>
            <div class="feat">
                <h3>Vibe Assistant</h3>
                <p>Ask about products, stock or your cart in plain English.</p>
            </div>
        </div>
    </main>
</body>

</html>
