<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account | Vibe Commerce</title>
    <style>
        :root {
            --navy: #0e1525;
            --purple: #6d5dfc;
            --purple-dark: #5a49e8;
            --line: #e7e9f2;
            --ink: #101828;
            --muted: #6b7590;
            --red-soft: #fdeceb;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 20px;
            background: radial-gradient(1100px 520px at 50% -8%, #223055 0%, var(--navy) 62%);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 15px;
        }

        a { color: inherit; }

        .auth {
            width: 100%;
            max-width: 420px;
        }

        .auth-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #fff;
            font-weight: 700;
            font-size: 19px;
            margin-bottom: 22px;
        }

        .auth-brand span {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--purple), #9b7bff);
            display: grid;
            place-items: center;
            font-size: 17px;
            font-weight: 800;
        }

        .auth-card {
            background: #fff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 24px 60px rgba(3, 8, 20, .38);
        }

        .auth-card h1 {
            margin: 0 0 6px;
            font-size: 23px;
            letter-spacing: -.5px;
        }

        .auth-card .sub {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 14px;
        }

        .field { margin-bottom: 16px; }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .field input {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid var(--line);
            border-radius: 9px;
            font: inherit;
            font-size: 14px;
        }

        .field input:focus {
            outline: none;
            border-color: var(--purple);
            box-shadow: 0 0 0 3px rgba(109, 93, 252, .16);
        }

        .btn-full {
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 9px;
            background: var(--purple);
            color: #fff;
            font: inherit;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 6px;
        }

        .btn-full:hover { background: var(--purple-dark); }

        .err { color: #b42318; font-size: 13px; margin-top: 6px; }

        .alert-bad {
            background: var(--red-soft);
            color: #b42318;
            padding: 11px 14px;
            border-radius: 9px;
            font-size: 13.5px;
            margin-bottom: 18px;
        }

        .foot {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--muted);
        }

        .foot a { color: var(--purple); font-weight: 600; text-decoration: none; }
        .foot a:hover { text-decoration: underline; }

        .demo {
            margin-top: 18px;
            padding: 14px;
            border: 1px dashed var(--line);
            border-radius: 10px;
            font-size: 12.5px;
            color: var(--muted);
            line-height: 1.7;
        }

        .demo b { color: var(--ink); }
    </style>
</head>

<body>
    <div class="auth">
        <div class="auth-brand"><span>V</span> Vibe Commerce</div>

        <div class="auth-card">
            <h1>Create your account</h1>
            <p class="sub">Start browsing the catalogue in a minute.</p>

            <form action="{{ route('auth.register') }}" method="post">
                @csrf

                <div class="field">
                    <label for="name">Full name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
                    @error('name')<div class="err">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')<div class="err">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    @error('password')<div class="err">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-full">Create account</button>
            </form>
        </div>

        <p class="foot">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
    </div>
</body>

</html>
