-- id barang
INSERT INTO `id_barang` (`id`, `id_barang`, `nama`) VALUES
(1, 'SRT', 'SERUT'),
(2, 'AKMR', 'ALDA KHIMAR'),
(3, 'AMR', 'AMIRA'),
(4, 'BALZ', 'BERGO AL-AZHAR'),
(5, 'BOW', 'BOW TURBAN'),
(6, 'DKMR', 'DAILY KHIMAR'),
(7, 'FDH', 'FADIAH'),
(8, 'HANA', 'HANA POLOS'),
(9, 'LCB', 'LCB'),
(10, 'LRBH', 'LINEN RUBIAH'),
(11, 'MEI', 'MEIKA INSTAN'),
(12, 'OLA', 'OLAND'),
(13, 'ORGZ', 'ORGANZA'),
(14, 'PKMR', 'PLAIN KHIMAR'),
(15, 'RLN', 'RALIN'),
(16, 'RING', 'RING'),
(17, 'SRH', 'SARAH INSTANT'),
(18, 'OGZR', 'ORGANZA RUBIAH');

-- id warna
INSERT INTO `id_warna` (`id`, `id_warna`, `nama`) VALUES
(1, 'DUS', 'DUSTY'),
(2, 'BLK', 'BLACK'),
(3, 'NAV', 'NAVY'),
(4, 'BRWN', 'BROWN'),
(5, 'GREY', 'GREY'),
(6, 'MILO', 'MILO'),
(7, 'MRON', 'MAROON'),
(8, 'SALM', 'SALMON'),
(9, 'UNGU', 'UNGU'),
(10, 'TOSC', 'TOSCA'),
(11, 'RED', 'RED'),
(12, 'PINK', 'PINK'),
(13, 'PEAC', 'PEACH'),
(14, 'LAV', 'LAVENDER'),
(15, 'GOLD', 'GOLD'),
(16, 'FANT', 'FANTA'),
(17, 'CREM', 'CREME'),
(18, 'BPNK', 'BABY PINK'),
(19, 'ABU', 'ABU MUDA'),
(20, 'LGRY', 'LIGHT GREY'),
(21, 'MINT', 'MINT');

-- barang
CALL tambah_barang(1, 1, 'SERUT DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/2ed226590f8bf4d659f1925b3e533ab6e8b349fa.jpg', '', '1', current_date(), 100);
CALL tambah_barang(1, 2, 'SERUT BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/53ee03c05607b0fc94a708d154e334ff5996c888.jpg', '', '1', current_date(), 100);
CALL tambah_barang(2, 1, 'ALDA KHIMAR DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/77c3094e78f00ca7fdcb59b990a592dfa1523150.jpg', '', '1', current_date(), 100);
CALL tambah_barang(2, 2, 'ALDA KHIMAR BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/1fb96f43b141064eba96930eafee86c8245e1bbb.jpg', '', '1', current_date(), 100);
CALL tambah_barang(2, 3, 'ALDA KHIMAR NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/a719ce214e406dd6fd750e0941125b6bf9c21e43.jpg', '', '1', current_date(), 100);
CALL tambah_barang(2, 5, 'ALDA KHIMAR GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/ca1d1a5d6a6e604358e0579a4ebd91845ebf90d9.jpg', '', '1', current_date(), 100);
CALL tambah_barang(2, 7, 'ALDA KHIMAR MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/9d65bc741f9227106be53d8f9a3b1c9bf87b7775.jpg', '', '1', current_date(), 100);
CALL tambah_barang(2, 6, 'ALDA KHIMAR MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/85bd607ab442d84d09c6ac2673b6a181295b7a14.jpg', '', '1', current_date(), 100);
CALL tambah_barang(3, 19, 'AMIRA ABU MUDA', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/10058dd0c76f62f4998167c9e671a500fcddf9a3.jpg', '', '1', current_date(), 100);
CALL tambah_barang(3, 2, 'AMIRA BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/6e902b5a363591596df4df06b05fd0c932dcf9d9.jpg', '', '1', current_date(), 100);
CALL tambah_barang(3, 1, 'AMIRA DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/e33092f25a5ce37749bfafe298d84698bc8f125b.jpg', '', '1', current_date(), 100);
CALL tambah_barang(3, 7, 'AMIRA MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/a4020162a22221add9daaecd3f5d1a655726e4b9.jpg', '', '1', current_date(), 100);
CALL tambah_barang(3, 6, 'AMIRA MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/850b20889ae8d2a08c9c1de5b949a69dfec42223.jpg', '', '1', current_date(), 100);
CALL tambah_barang(3, 3, 'AMIRA NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/73afe71248de7e380ee9ae0f554c89ac565a23af.jpg', '', '1', current_date(), 100);
CALL tambah_barang(4, 2, 'BERGO AL BLACK', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/ab0d46f8f68cea8ed917693640a29e7edb7f637a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(4, 1, 'BERGO AL DUSTY', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/2f764d57754537dc5155db0ab9911849c5080c5a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(4, 5, 'BERGO AL GREY', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/f1b1ae221b26486bd3820d6b5c899f4dce37e273.jpg', '', '1', current_date(), 100);
CALL tambah_barang(4, 7, 'BERGO AL MAROON', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/62eb138a7fc0b3eec08e3d0fa495b7beded2538a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(4, 6, 'BERGO AL MILO', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/a046bb9ba9b5f647a8e82d04d01d475b16375565.jpg', '', '1', current_date(), 100);
CALL tambah_barang(4, 3, 'BERGO AL NAVY', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/fe67ab6476d79de8ef7b3ec9847bb42b31f5c00a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(5, 1, 'BOW TURBAN DUSTY', 10000.00, 15000.00, 20000.00, 26000.00, 'barang/691d7358ced8fd3adfafc2e668a64090f26b9954.jpg', '', '1', current_date(), 100);
CALL tambah_barang(5, 5, 'BOW TURBAN GREY', 10000.00, 15000.00, 20000.00, 26000.00, 'barang/ad261300f721c63e2822b43d33605c2c7aab01d6.jpg', '', '1', current_date(), 100);
CALL tambah_barang(5, 7, 'BOW TURBAN MAROON', 10000.00, 15000.00, 20000.00, 26000.00, 'barang/aa4e77acfcaa05b27473be5395e64203aa95ab33.jpg', '', '1', current_date(), 100);
CALL tambah_barang(5, 21, 'BOW TURBAN MINT', 10000.00, 15000.00, 20000.00, 26000.00, 'barang/f3b07ae35fd58d31c3a834b1066f6466aa6e71dd.jpg', '', '1', current_date(), 100);
CALL tambah_barang(5, 3, 'BOW TURBAN NAVY', 10000.00, 15000.00, 20000.00, 26000.00, 'barang/3e23453d161f8ee5f7411527aab367cbf6df5cc3.jpg', '', '1', current_date(), 100);
CALL tambah_barang(8, 7, 'HANA POLOS MAROON', 30000.00, 35000.00, 40000.00, 45000.00, 'barang/bd718d732ca44f39e4ab71c5d91f2fd9ac3ffacf.jpg', '', '1', current_date(), 100);
CALL tambah_barang(8, 2, 'HANA POLOS BLACK', 30000.00, 35000.00, 40000.00, 45000.00, 'barang/443112f639f00e6802b0faa77832cb30504cb17f.jpg', '', '1', current_date(), 100);
CALL tambah_barang(8, 3, 'HANA POLOS NAVY', 30000.00, 35000.00, 40000.00, 45000.00, 'barang/a54bfbdb6921f997094bc021b76f98dc31a5d943.jpg', '', '1', current_date(), 100);
CALL tambah_barang(8, 4, 'HANA POLOS BROWN', 30000.00, 35000.00, 40000.00, 45000.00, 'barang/4d8f8315ad4d0c155df789d59c56ee879a8b9063.jpg', '', '1', current_date(), 100);
CALL tambah_barang(8, 1, 'HANA POLOS DUSTY', 30000.00, 35000.00, 40000.00, 45000.00, 'barang/697dc49ce34f2caf39022057fc1381268b1823d5.jpg', '', '1', current_date(), 100);
CALL tambah_barang(8, 5, 'HANA POLOS GREY', 30000.00, 35000.00, 40000.00, 45000.00, 'barang/845a2178af33ec7f0a01ed43ede4763de21d79de.jpg', '', '1', current_date(), 100);
CALL tambah_barang(12, 2, 'OLAND BLACK', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/0c3e65cfa64e34b115df336f687ae6d1a95d672c.jpg', '', '1', current_date(), 100);
CALL tambah_barang(12, 4, 'OLAND BROWN', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/9b7e4fb108351a1b2f6009bdfb3412da65625628.jpg', '', '1', current_date(), 100);
CALL tambah_barang(12, 1, 'OLAND DUSTY', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/52d697d339a558b9257413fb1c5e81d2b2737ee0.jpg', '', '1', current_date(), 100);
CALL tambah_barang(12, 5, 'OLAND GREY', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/213774c1e41a76b345fbc10cf71b26db4a54e47a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(12, 7, 'OLAND MAROON', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/88e9ca6113fbfcb453988523de3b48c8f8189b14.jpg', '', '1', current_date(), 100);
CALL tambah_barang(12, 3, 'OLAND NAVY', 20000.00, 25000.00, 30000.00, 36000.00, 'barang/22cf0ac0f8ff834c217d0e8733dd4b70651396fe.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 15, 'ORGANZA GOLD', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/60954613f26c5de98eb29de659620d83adca85ed.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 13, 'ORGANZA PEACH', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/212656e50d33c37c61dc38c213fa0a5c44016b60.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 10, 'ORGANZA TOSCA', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/6de40218a9286ca0e0f6fc0c663735672b032046.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 19, 'ORGANZA ABU MUDA', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/2da426702c4d9f6c777d9f36e99a9cc0d3388d95.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 18, 'ORGANZA BABY PINK', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/906cb88fde5feefc3f996362dfc813484c752a4a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 17, 'ORGANZA CREME', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/44b69e617f2d54c592457774d09494853a185e4f.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 16, 'ORGANZA FANTA', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/3f5fbe67994284bfe866a52c6687b99a4d6617f9.jpg', '', '1', current_date(), 100);
CALL tambah_barang(18, 2, 'ORGANZA RUBIAH BLACK', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/198afada1c45370b50203a8c06c813dfcae7a13d.jpg', '', '1', current_date(), 100);
CALL tambah_barang(18, 14, 'ORGANZA RUBIAH LAVENDER', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/3454ec0cb72bd42a9b19412b5bcf3b03815150fe.jpg', '', '1', current_date(), 100);
CALL tambah_barang(18, 7, 'ORGANZA RUBIAH MAROON', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/cbd9daf8bb932f82a6eb1bd74bfb55967882f6bd.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 3, 'ORGANZA NAVY', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/13ff7f4cad86e2e2d0b6d2663857d96904cb7a1e.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 12, 'ORGANZA PINK', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/2a30c53cfde0293347a32fc505d46d5043c43d64.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 11, 'ORGANZA RED', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/d039ab042adcda9f65c08d1d7ecc5f3fc0c3f51d.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 8, 'ORGANZA SALMON', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/9f000bfd1d681d65dbf8e0504d16343466e4d766.jpg', '', '1', current_date(), 100);
CALL tambah_barang(13, 9, 'ORGANZA UNGU', 45000.00, 50000.00, 55000.00, 58000.00, 'barang/c5894c9e8d018e4e1788975d5afd6ad4b1990967.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 18, 'LINEN RUBIAH BABY PINK', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/2ed71b57060177bde891398a3f899b3af76048b1.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 2, 'LINEN RUBIAH BLACK', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/bdb67d78b725b27a506d944c65e5cdc809636b8d.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 4, 'LINEN RUBIAH BROWN', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/7d9db1413bbb2b7ce6f60cbaec0ade3a08771c77.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 15, 'LINEN RUBIAH GOLD', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/ec1bd4b6aec2ab68dccf583fdedbecd207ab3e9a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 7, 'LINEN RUBIAH MAROON', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/4bd6b8e69ed1c2390df1d3764c308ed47920c22f.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 3, 'LINEN RUBIAH NAVY', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/b3edf92df661cdd52be715559d39c8edf4d32c28.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 13, 'LINEN RUBIAH PEACH', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/81f3e823b70459c693d03e4d7dee8ee17144c808.jpg', '', '1', current_date(), 100);
CALL tambah_barang(10, 12, 'LINEN RUBIAH PINK', 50000.00, 55000.00, 60000.00, 63000.00, 'barang/5e53c0c61b1867b0fd255b7344fd1393be001d7a.jpg', '', '1', current_date(), 100);
CALL tambah_barang(17, 3, 'SARAH INSTANT NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/0eea5ae83ddc36e184184851c82342b030be9ed6.jpg', '', '1', current_date(), 100);
CALL tambah_barang(17, 2, 'SARAH INSTANT BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/2f5cb530366b88802ad853905b332b59c47c7724.jpg', '', '1', current_date(), 100);
CALL tambah_barang(17, 1, 'SARAH INSTANT DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/18519f752c913b0de5eb032b67303ba9dad74818.jpg', '', '1', current_date(), 100);
CALL tambah_barang(17, 5, 'SARAH INSTANT GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/7cc0d8096866b9c71ae6471071ff25459654c916.jpg', '', '1', current_date(), 100);
CALL tambah_barang(17, 7, 'SARAH INSTANT MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/c211f64f463af9b24aba8aae95140e1ae0729a8d.jpg', '', '1', current_date(), 100);
CALL tambah_barang(17, 6, 'SARAH INSTANT MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/e7fe1202d731bfc33975f420692d48d931ee932e.jpg', '', '1', current_date(), 100);
CALL tambah_barang(16, 2, 'RING BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/a70b2b88017d4a16fcf7d654312b021524350a23.jpg', '', '1', current_date(), 100);
CALL tambah_barang(16, 1, 'RING DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/483efca0121e7544937b06460bfee07aafe47b0b.jpg', '', '1', current_date(), 100);
CALL tambah_barang(16, 5, 'RING GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/abd68fb8d508ea5222b8096f6aa4b86b3c0edc0d.jpg', '', '1', current_date(), 100);
CALL tambah_barang(16, 7, 'RING MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/3de2a97a1ed16d34ef108db92b54a4bbb74254e5.jpg', '', '1', current_date(), 100);
CALL tambah_barang(16, 6, 'RING MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/2dd32ece1fefbf708a042414f25ceb60ca5344ab.jpg', '', '1', current_date(), 100);
CALL tambah_barang(16, 3, 'RING NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/35b622617b1a89c3675265cef4062c227195a6d4.jpg', '', '1', current_date(), 100);
CALL tambah_barang(1, 5, 'SERUT GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/b06bfd548cf5639092418e6ccc9261916a538b64.jpg', '', '1', current_date(), 100);
CALL tambah_barang(1, 7, 'SERUT MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/f6c99d5e268d19452318631e46bceefbcbe67785.jpg', '', '1', current_date(), 100);
CALL tambah_barang(1, 6, 'SERUT MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/97edf3979915375d8627399f9be8fd4efe883ede.jpg', '', '1', current_date(), 100);
CALL tambah_barang(1, 3, 'SERUT NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/c8e7a2c72b6c54e15ca5d0e4e5cd1ea04307e09c.jpg', '', '1', current_date(), 100);
CALL tambah_barang(7, 2, 'FADIAH BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/2d70556e594a053d3aac800cf36db42806e5d1ce.jpg', '', '1', current_date(), 100);
CALL tambah_barang(7, 1, 'FADIAH DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/3b9c9364b5d695909a90fc1423aec4a561b60c0e.jpg', '', '1', current_date(), 100);
CALL tambah_barang(7, 5, 'FADIAH GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/f03acbe6e972f8aa10664ae0eecceb466b81d0ac.jpg', '', '1', current_date(), 100);
CALL tambah_barang(7, 7, 'FADIAH MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/f270830147397083cf2bd0f1153c23803cdcd5e5.jpg', '', '1', current_date(), 100);
CALL tambah_barang(7, 6, 'FADIAH MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/baeac2582f972cd22f30d799e23fa52b29f7fc61.jpg', '', '1', current_date(), 100);
CALL tambah_barang(7, 3, 'FADIAH NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/6ac61c91777e7aaf7133e086c33490ee6be3b0d2.jpg', '', '1', current_date(), 100);
CALL tambah_barang(6, 2, 'DAILY KHIMAR BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/d43d3c9bca9b5aa0847c05862c3ddcbebcd6494b.jpg', '', '1', current_date(), 100);
CALL tambah_barang(6, 4, 'DAILY KHIMAR BROWN', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/a009bc629a073b6f663ec87a0a7bcd1536a4bf66.jpg', '', '1', current_date(), 100);
CALL tambah_barang(6, 1, 'DAILY KHIMAR DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/37f692827fd3fcac4f97b5c4feb343f6e733c60b.jpg', '', '1', current_date(), 100);
CALL tambah_barang(6, 5, 'DAILY KHIMAR GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/0b7d5a66e761dbf7d736ef6fed211b9b808a7946.jpg', '', '1', current_date(), 100);
CALL tambah_barang(6, 7, 'DAILY KHIMAR MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/3b3ac5926d1cfc9876aeb4ef42ef4778e55f274e.jpg', '', '1', current_date(), 100);
CALL tambah_barang(6, 3, 'DAILY KHIMAR NAVY', 2500.00, 30000.00, 35000.00, 39000.00, 'barang/6a9cc4d2687c35d4b8d311dd3eb69b39a3e4f88f.jpg', '', '1', current_date(), 100);
CALL tambah_barang(14, 2, 'PLAIN KHIMAR BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/7eb698364eda1b9d5003eb2980f466e061701165.jpg', '', '1', current_date(), 100);
CALL tambah_barang(14, 1, 'PLAIN KHIMAR DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/5eb708e5450ed39892df66cec156cc6178a85a53.jpg', '', '1', current_date(), 100);
CALL tambah_barang(14, 5, 'PLAIN KHIMAR GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/2213b1fa9d805c4320ac64957abb17d8965875ce.jpg', '', '1', current_date(), 100);
CALL tambah_barang(14, 7, 'PLAIN KHIMAR MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/6cd18cb9ddb5079645c94ca266bbcc7b4ce11413.jpg', '', '1', current_date(), 100);
CALL tambah_barang(14, 6, 'PLAIN KHIMAR MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/eed82ce955ee0a733ec235a1168130261a0388ed.jpg', '', '1', current_date(), 100);
CALL tambah_barang(14, 3, 'PLAIN KHIMAR NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/13b98745550bd1f0fd7a8effe9d6a3d562dec231.jpg', '', '1', current_date(), 100);
CALL tambah_barang(9, 2, 'LCB BLACK', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/dba11a07a3a1432096a8359388b492311ca30c49.jpg', '', '1', current_date(), 100);
CALL tambah_barang(9, 1, 'LCB DUSTY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/69c7568c3f02de18a855a0c6064e51492f9e72fd.jpg', '', '1', current_date(), 100);
CALL tambah_barang(9, 20, 'LCB LIGHT GREY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/48d6c3b13620c5c1b689366d54e1e3b89c4df43b.jpg', '', '1', current_date(), 100);
CALL tambah_barang(9, 7, 'LCB MAROON', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/726e8c65dc4e26f9625c4c66fecb5330d7f0dd20.jpg', '', '1', current_date(), 100);
CALL tambah_barang(9, 6, 'LCB MILO', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/ee9171a4ba690fb1d44ee8b5687fb4981114d579.jpg', '', '1', current_date(), 100);
CALL tambah_barang(9, 3, 'LCB NAVY', 25000.00, 30000.00, 35000.00, 39000.00, 'barang/ca27407a5f393e53f85827fb01fae646e886dc7d.jpg', '', '1', current_date(), 100);