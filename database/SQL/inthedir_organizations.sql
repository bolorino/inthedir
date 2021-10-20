CREATE TABLE IF NOT EXISTS organizations
(
    id          bigint unsigned auto_increment
        primary key,
    province_id bigint unsigned not null,
    name        varchar(140)    not null,
    slug        varchar(155)    not null,
    address     varchar(200)    not null,
    address_2   varchar(200)    null,
    city        varchar(90)     not null,
    postal_code varchar(5)      not null,
    phone       varchar(15)     null,
    website     varchar(125)    null,
    email       varchar(45)     null,
    image       varchar(155)    null,
    logo        varchar(155)    null,
    created_at  timestamp       null,
    updated_at  timestamp       null,
    constraint organizations_name_unique
        unique (name),
    constraint organizations_slug_unique
        unique (slug),
    constraint organizations_province_id_foreign
        foreign key (province_id) references provinces (id)
)
    collate = utf8mb4_unicode_ci;

INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (11, 41, 'Sala Cero Teatro', 'sala-cero-teatro', 'Sol, 5', null, 'Sevilla', '41003', '954225165', 'https://www.salacero.com', null, 'images/sala-cero-teatro.jpg', 'images/logos/sala-cero-teatro-logo.png', '2021-10-11 17:39:19', '2021-10-13 13:38:40');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (12, 14, 'Teatro Avanti', 'teatro-avanti', 'María Auxiliadora s/n', null, 'Córdoba', '14002', '957491166', 'https://www.teatroavanti.com', null, 'images/nBZcIYQX9SDLUh4VIvqkVFEDBkgyphS43HyKt46x.jpg', 'images/logos/yxToMnYCLj5rxjsh3V5qiT1d6yTbixGilcQY512m.png', '2021-10-12 15:23:53', '2021-10-12 15:23:53');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (16, 41, 'La Fundición', 'la-fundicion', 'Casa de la Moneda', 'Habana, 18', 'Sevilla', '41001', '954225844', 'https://www.fundiciondesevilla.es', null, 'images/la-fundicion.jpg', 'images/logos/la-fundicion-logo.png', '2021-10-13 13:41:54', '2021-10-13 13:41:54');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (17, 41, 'Centro T.N.T', 'centro-tnt', 'Avda. Parque de Despeñaperros, 1', null, 'Sevilla', '41015', '954950376', 'https://www.atalaya-tnt.com', null, 'images/centro-tnt.jpg', null, '2021-10-13 13:50:40', '2021-10-13 13:50:40');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (18, 50, 'Teatro de la Estación', 'teatro-de-la-estacion', 'Domingo Figueras Jariod, 8-10', null, 'Zaragoza', '50004', '976469494', 'https://www.teatrodelaestacion.com', null, 'images/teatro-de-la-estacion.jpg', 'images/logos/teatro-de-la-estacion-logo.png', '2021-10-14 14:12:54', '2021-10-14 14:12:54');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (19, 50, 'Teatro Arbolé', 'teatro-arbole', 'Parque Metropolitano del Agua Luis Buñuel', 'Paseo del Botánico, 4', 'Zaragoza', '50018', '976734466', 'https://www.teatroarbole.es', null, 'images/teatro-arbole.jpg', 'images/logos/teatro-arbole-logo.png', '2021-10-14 14:39:34', '2021-10-14 14:39:34');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (20, 22, 'La casa de los títeres', 'la-casa-de-los-titeres', 'Calle Entremuro', null, 'Abizanda', '22392', '974428218', 'https://www.lacasadelostiteres.com', null, 'images/la-casa-de-los-titeres.jpg', 'images/logos/la-casa-de-los-titeres-logo.png', '2021-10-14 14:45:14', '2021-10-14 14:45:14');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (21, 33, 'Espacio escénico El Huerto', 'espacio-escenico-el-huerto', 'Calle Severo Ochoa, 93', null, 'Gijón', '32210', '985391133', 'https://www.zigzagdanza.com/index.php/el-huerto/', null, 'images/espacio-escenico-el-huerto.jpg', 'images/logos/espacio-escenico-el-huerto-logo.png', '2021-10-14 15:46:55', '2021-10-14 15:46:55');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (22, 7, 'Teatre Sans', 'teatre-sans', 'Carrer Ca’n Sanç, 5', null, 'Palma de Mallorca', '07001', '971727166', 'https://www.estudizeroteatre.com', null, 'images/teatre-sans.jpg', 'images/logos/teatre-sans-logo.png', '2021-10-14 16:16:25', '2021-10-14 16:16:25');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (23, 7, 'Teatre del Mar', 'teatre-del-mar', 'Carrer Llucmajor, 90', null, 'Palma de Mallorca', '07006', '971248400', 'http://www.teatredelmar.com', 'info@teatredelmar.com', 'images/teatre-del-mar.jpg', 'images/logos/teatre-del-mar-logo.png', '2021-10-14 16:42:36', '2021-10-14 21:56:18');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (24, 7, 'Sala la Fornal', 'sala-la-fornal', 'Calle Coves dels Hams, 4', null, 'Manacor', '07500', '971847353', 'https://lafornal.cat', null, 'images/sala-la-fornal.jpg', 'images/logos/sala-la-fornal-logo.png', '2021-10-14 16:45:47', '2021-10-14 16:45:47');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (25, 8, 'Teatre de l''Aurora', 'teatre-de-laurora', 'Carrer de l’Aurora, 80', null, 'Igualada', '08700', '938050075', 'https://www.teatreaurora.cat', null, 'images/teatre-de-laurora.jpg', 'images/logos/teatre-de-laurora-logo.png', '2021-10-14 16:49:14', '2021-10-14 16:49:14');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (26, 17, 'La Planeta', 'la-planeta', 'Paseo Canalejas, 3', null, 'Girona', '17004', '972207754', 'https://www.laplaneta.net', null, 'images/la-planeta.jpg', 'images/logos/la-planeta-logo.png', '2021-10-14 16:53:21', '2021-10-14 16:53:21');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (27, 8, 'L''Autèntica', 'lautentica', 'Carrer de Martí, 18', null, 'Barcelona', '08424', '931854840', 'http://www.lautenticateatro.com', null, 'images/lautentica.jpg', 'images/logos/lautentica-logo.png', '2021-10-14 21:33:01', '2021-10-14 21:33:01');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (28, 8, 'Teatre Tantarantana', 'teatre-tantarantana', 'Carrer Les Flors, 22', null, 'Barcelona', '08001', '934417022', 'http://www.tantarantana.com', 'teatre@tantarantana.com', 'images/teatre-tantarantana.jpg', 'images/logos/teatre-tantarantana-logo.png', '2021-10-15 17:33:57', '2021-10-15 17:33:57');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (29, 8, 'Nau Ivanow', 'nau-ivanow', 'Carrer d’Hondures, 28', null, 'Barcelona', '08027', '933407468', 'https://www.nauivanow.com', 'info@nauivanow.com', 'images/nau-ivanow.jpg', 'images/logos/nau-ivanow-logo.png', '2021-10-15 17:39:57', '2021-10-15 17:39:57');
INSERT INTO inthedir.organizations (id, province_id, name, slug, address, address_2, city, postal_code, phone, website, email, image, logo, created_at, updated_at) VALUES (30, 38, 'Teatro Victoria', 'teatro-victoria', 'Calle Méndez Núñez, 36', null, 'Santa Cruz de Tenerife', '38003', '922290578', 'https://www.elteatrovictoria.com', 'info@elteatrovictoria.com', 'images/teatro-victoria.jpg', 'images/logos/teatro-victoria-logo.png', '2021-10-17 21:50:17', '2021-10-17 21:50:17');
