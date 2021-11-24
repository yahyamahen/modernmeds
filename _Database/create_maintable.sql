CREATE OR REPLACE TABLE users (
    id_user INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(64),
    PASSWORD VARCHAR(512),
    email VARCHAR(128),
    PRIMARY KEY (id_user)
);

CREATE OR REPLACE TABLE customers (
    username VARCHAR(64),
    PASSWORD VARCHAR(512),
    nama_lengkap VARCHAR(128),
    email VARCHAR(128),
    tgl_lahir DATE,
    gender VARCHAR(16),
    alamat VARCHAR(128),
    kota VARCHAR(64),
    no_telp VARCHAR(16),
    paypal_id VARCHAR(32),
    PRIMARY KEY (username)
);

CREATE OR REPLACE TABLE produk(
    id_produk INT NOT NULL AUTO_INCREMENT,
    nama_produk VARCHAR(128),
    kategori VARCHAR(64),
    deskripsi_produk VARCHAR(1024),
    harga_produk INT,
    stok_produk INT,
    gambar VARCHAR(512),
    PRIMARY KEY(id_produk)
);

CREATE OR REPLACE TABLE pemesanan 
(  id_pemesanan 		INTEGER 		 	NOT NULL 	AUTO_INCREMENT,
   kode_pemesanan		VARCHAR(32)			NOT NULL,
   id_user             		INTEGER				DEFAULT NULL,
   username			VARCHAR(64)			NOT NULL,
   id_produk            	INTEGER          		NOT NULL,
   total_pcs			INTEGER				NULL,
   total                	INTEGER				NULL,
   metode_pembayaran      	VARCHAR(16)			NULL,
   nota_pemesanan     		VARCHAR(512)			DEFAULT NULL,
   waktu_pemesanan		TIMESTAMP			NULL,
   status_pemesanan     	VARCHAR(32)			NULL,
   catatan_pemesanan 		VARCHAR(255)			NULL,
   PRIMARY KEY(id_pemesanan)
);

CREATE OR REPLACE TABLE cart (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(64),
    id_produk INT,
    total_pcs INT,
    PRIMARY KEY (id)
);

ALTER TABLE pemesanan
   ADD FOREIGN KEY (id_user) REFERENCES users (id_user),
   ADD FOREIGN KEY (username) REFERENCES customers (username),
   ADD FOREIGN KEY (id_produk) REFERENCES produk (id_produk);
   

ALTER TABLE cart
   ADD FOREIGN KEY (username) REFERENCES customers(username),
   ADD FOREIGN KEY (id_produk) REFERENCES produk(id_produk);