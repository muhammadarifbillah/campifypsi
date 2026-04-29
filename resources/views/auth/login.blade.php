<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Campify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #07110d;
            --panel: rgba(255, 255, 255, 0.08);
            --panel-strong: rgba(255, 255, 255, 0.12);
            --text: #f5f7f4;
            --muted: rgba(245, 247, 244, 0.72);
            --accent: #3ddc97;
            --accent-2: #8be9c2;
            --danger: #ff6b6b;
            --border: rgba(255, 255, 255, 0.16);
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.35);
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: 'Manrope', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(61, 220, 151, 0.22), transparent 32%),
                radial-gradient(circle at bottom right, rgba(139, 233, 194, 0.18), transparent 36%),
                linear-gradient(135deg, #05100c 0%, #0b1d16 50%, #12251d 100%);
        }

        .shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .card {
            width: min(1080px, 100%);
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            border: 1px solid var(--border);
            border-radius: 28px;
            overflow: hidden;
            background: var(--panel);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow);
        }

        .hero {
            position: relative;
            padding: 48px;
            background:
                linear-gradient(160deg, rgba(6, 24, 18, 0.92), rgba(8, 30, 22, 0.82)),
                radial-gradient(circle at top right, rgba(61, 220, 151, 0.25), transparent 30%);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 999px;
            color: var(--accent-2);
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 12px;
        }

        .brand-dot {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            background: var(--accent);
            box-shadow: 0 0 0 6px rgba(61, 220, 151, 0.12);
        }

        h1 {
            margin: 24px 0 16px;
            font-size: clamp(2.4rem, 5vw, 4.6rem);
            line-height: 0.95;
            letter-spacing: -0.05em;
            max-width: 8ch;
        }

        .hero p {
            margin: 0;
            max-width: 54ch;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.7;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 28px;
        }

        .role-chip {
            padding: 16px;
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.05);
        }

        .role-chip strong { display: block; margin-bottom: 4px; }
        .role-chip span { color: var(--muted); font-size: 0.9rem; }

        .form-side {
            padding: 42px;
            background: rgba(7, 17, 13, 0.76);
        }

        .panel {
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 28px;
            background: var(--panel-strong);
        }

        .title { margin: 0 0 8px; font-size: 1.65rem; letter-spacing: -0.03em; }
        .subtitle { margin: 0 0 24px; color: var(--muted); line-height: 1.6; }

        .alert {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(255, 107, 107, 0.12);
            border: 1px solid rgba(255, 107, 107, 0.22);
            color: #ffd8d8;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.92rem;
            color: rgba(245, 247, 244, 0.88);
            font-weight: 700;
        }

        .field {
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 16px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.06);
            color: var(--text);
            outline: none;
        }

        .field:focus {
            border-color: rgba(61, 220, 151, 0.7);
            background: rgba(255, 255, 255, 0.09);
        }

        .group + .group { margin-top: 18px; }

        .actions {
            margin-top: 24px;
            display: grid;
            gap: 12px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            border: 0;
            border-radius: 16px;
            padding: 14px 18px;
            background: linear-gradient(135deg, var(--accent), #23b978);
            color: #052014;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }

        .ghost-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .ghost {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 12px 16px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: var(--text);
            text-decoration: none;
            background: rgba(255, 255, 255, 0.04);
        }

        .footnote {
            margin-top: 18px;
            font-size: 0.9rem;
            color: var(--muted);
            text-align: center;
        }

        .footnote a {
            color: var(--accent-2);
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 960px) {
            .card { grid-template-columns: 1fr; }
            .hero, .form-side { padding: 28px; }
            .role-grid, .ghost-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <section class="hero">
                <div class="brand"><span class="brand-dot"></span> Campify</div>
                <h1>One login for every role.</h1>
                <p>
                    Admin, Seller, dan Pembeli masuk lewat halaman yang sama. Setelah autentikasi berhasil,
                    sistem mengarahkan user ke dashboard yang sesuai dengan role dan status akunnya.
                </p>

                <div class="role-grid">
                    <div class="role-chip">
                        <strong>Admin</strong>
                        <span>Kelola user, produk, toko, artikel, kurir, chat, dan monitoring.</span>
                    </div>
                    <div class="role-chip">
                        <strong>Seller</strong>
                        <span>Kelola produk, pesanan, sewa, chat, rating, dan profil toko.</span>
                    </div>
                    <div class="role-chip">
                        <strong>Pembeli</strong>
                        <span>Belanja, sewa, checkout, wishlist, keranjang, artikel, dan profil.</span>
                    </div>
                </div>
            </section>

            <section class="form-side">
                <div class="panel">
                    <h2 class="title">Masuk ke Campify</h2>
                    <p class="subtitle">Gunakan email dan password akun Anda. Role ditentukan otomatis dari data user.</p>

                    @if ($errors->any())
                        <div class="alert">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="field" value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="field" required>
                        </div>

                        <div class="actions">
                            <button type="submit" class="button">Masuk</button>
                            <div class="ghost-row">
                                <a class="ghost" href="{{ route('register') }}">Daftar Pembeli</a>
                                <a class="ghost" href="{{ route('seller.register') }}">Daftar Seller</a>
                            </div>
                        </div>
                    </form>

                    <div class="footnote">
                        Lupa password? <a href="{{ route('password.request') }}">Reset di sini</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>