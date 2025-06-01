<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Perbukuan Indonesia</title>
    <link rel="stylesheet" href="css/stylebanner.css" />
</head>

<body>
    <main>
        <section class="hero">
            <!-- Background Elements -->
            <div class="hero-pattern absolute inset-0 opacity-10"></div>
            <div class="hero-blob hero-blob-1"></div>
            <div class="hero-blob hero-blob-2"></div>

            <!-- Animated Particles -->
            <div class="hero-particles" id="hero-particles">
                <div class="hero-particle"
                    style="width: 12.2942px; height: 12.2942px; left: 68.4469%; top: 8.25363%; opacity: 0.145596; animation: 13.2332s ease-in-out 0.118543s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 10.4375px; height: 10.4375px; left: 49.7649%; top: 2.15425%; opacity: 0.317187; animation: 10.9496s ease-in-out 1.35822s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 8.59006px; height: 8.59006px; left: 21.0914%; top: 14.2234%; opacity: 0.239993; animation: 10.454s ease-in-out 4.27908s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 9.25434px; height: 9.25434px; left: 25.5661%; top: 31.869%; opacity: 0.405728; animation: 22.0942s ease-in-out 4.6565s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 5.69763px; height: 5.69763px; left: 13.7096%; top: 52.4044%; opacity: 0.576327; animation: 28.0657s ease-in-out 3.96632s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 11.2252px; height: 11.2252px; left: 67.0367%; top: 51.7931%; opacity: 0.456272; animation: 14.1793s ease-in-out 2.10106s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 5.85275px; height: 5.85275px; left: 76.9115%; top: 0.691209%; opacity: 0.55332; animation: 20.5362s ease-in-out 3.48295s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 14.9951px; height: 14.9951px; left: 6.35353%; top: 59.5829%; opacity: 0.226115; animation: 13.3107s ease-in-out 1.08279s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 7.77174px; height: 7.77174px; left: 13.1697%; top: 74.437%; opacity: 0.210484; animation: 13.3608s ease-in-out 4.94186s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 13.6269px; height: 13.6269px; left: 34.6427%; top: 6.70312%; opacity: 0.15337; animation: 23.2004s ease-in-out 0.163655s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 6.6386px; height: 6.6386px; left: 34.964%; top: 37.3416%; opacity: 0.319364; animation: 20.7338s ease-in-out 3.8632s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 8.30464px; height: 8.30464px; left: 12.8339%; top: 60.425%; opacity: 0.274272; animation: 19.8821s ease-in-out 1.98849s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 11.8672px; height: 11.8672px; left: 64.5008%; top: 42.1875%; opacity: 0.192462; animation: 16.0715s ease-in-out 2.31067s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 13.9358px; height: 13.9358px; left: 48.1299%; top: 61.0699%; opacity: 0.195182; animation: 18.4703s ease-in-out 0.345532s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 5.75244px; height: 5.75244px; left: 21.7748%; top: 23.6535%; opacity: 0.379488; animation: 18.389s ease-in-out 4.75657s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 12.4541px; height: 12.4541px; left: 9.13427%; top: 64.4585%; opacity: 0.187017; animation: 26.643s ease-in-out 4.69811s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 13.5696px; height: 13.5696px; left: 91.0033%; top: 11.5648%; opacity: 0.175407; animation: 21.5924s ease-in-out 4.64687s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 14.7252px; height: 14.7252px; left: 43.3343%; top: 9.71944%; opacity: 0.350942; animation: 12.4733s ease-in-out 4.19836s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 13.5731px; height: 13.5731px; left: 36.0981%; top: 5.77677%; opacity: 0.224637; animation: 22.6409s ease-in-out 0.137229s infinite alternate none running floating;">
                </div>
                <div class="hero-particle"
                    style="width: 10.4164px; height: 10.4164px; left: 38.8943%; top: 72.3413%; opacity: 0.386589; animation: 24.3857s ease-in-out 0.402703s infinite alternate none running floating;">
                </div>
            </div>
            <div class="text">
                <h1><span class="highlight">Buku untuk Semua</span></h1>
                <p>Akses di mana pun, kapan pun, Baca buku yuk!</p>

                <div class="search-box">
                    <input type="text" id="searchInput" value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>" placeholder="Cari buku disini" />
                    <button onclick="redirectToSearch()">Cari</button>
                </div>

            </div>

            <div class="image">
                <img src="assets/GettyImages-1442432325-1320x926 - Edited.png" alt="Ilustrasi Buku" />
            </div>

        </section>
    </main>
</body>

</html>